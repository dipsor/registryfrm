<?php

namespace Libs\Database;

use \Libs\Database\DMS as LDD;

class DB {

	/** @var [type] [ objekt pripojeni k db ( \PDO objekt ) ] */
	private $conn;

	/** @var [type] [ objekt debuggeru ] */
	private $debugger;

	/** @var array [ seznam tabulek v databazi pro overeni jejich existence ] */
	private $tables = array();

	/** @var array [ pole dotazu sql ] */
	private $queries = array();

	/** @var integer [ query id ] */
	private static $queryID = 0;

	/** @var [type] [ promenna bude uchovavat objekt selektoru ] */
	private $selectors;



	/**
	 * pri inicializaci db, se nastavi pripojeni, selectory a debugger. 
	 * 
	 * @param PDO $connection [PDO instance pripojeni k mysql]
	 * @param \Libs\Database\Selector\Selectors $s [objekt selektoru, kde jsou implementovany metody 
	 *                                              pro specifikovani sql dotazu. table(), where(), limit(), etc
	 *                                              zalezi, k jakemu objektu jsou metody volany
	 *                                              - insert, select, delete, update]   
	 * [debugger, podle parametru pri vytvareni se bude provadet co je treba. Log, Echo, Void, EchoLog]
	 */
	public function __construct( \PDO $connection, \Libs\Database\Selector\Selectors $s )
	{
		$this->conn = $connection;
		$this->selectors = $s;
		$this->debugger = \Libs\Database\Debugger\DebuggerFactory::createDebugger('echo');

		//$this->debugger->debug( "constructor inicialization.", $connection );
	}



	/**
	 * Vytvori instanci selectu, pak nastavi pres select cast sql query dms.
	 * jako parametr muze bejt string, a nebo pole stringu. popripade jeden dlouhej string. 
	 * @param  [type] $selector [*, nazvy sloupcu ]
	 * @return [type]           [description]
	 */
	public function select( $selector )
	{
		self::$queryID++;

		$this->queries[ self::$queryID ] = new LDD\Select( $this->selectors, $this->conn, self::$queryID );
		$this->queries[ self::$queryID ]->select( $selector );

		return $this;
	}



	/**
	 * [ metoda vytvori instanci pro insert , ktera se vlozi do pole $queris]
	 * @param  [type] $values [description]
	 * @return [type]         [description]
	 */
	public function insert( array $inserts )
	{
		self::$queryID++;

		$this->queries[ self::$queryID ] = new LDD\Insert( $this->selectors, $this->conn, self::$queryID );
		$this->queries[ self::$queryID ]->insert( $inserts );

		return $this;
	}


	/**
	 * [delete description]
	 * @param  [type] $tableName [description]
	 * @return [type]            [description]
	 */
	public function delete( $tableName ) 
	{
		self::$queryID++;

		$this->queries[ self::$queryID ] = new LDD\Delete( $this->selectors, $this->conn, self::$queryID );
		$this->queries[ self::$queryID ]->delete( $tableName );

		return $this;
	}

	/**
	 * [update description]
	 * @param  [type] $updates [description]
	 * @return [type]          [description]
	 */
	public function update( $updates )
	{
		self::$queryID++;

		$this->queries[ self::$queryID ] = new LDD\Update( $this->selectors, $this->conn, self::$queryID );
		$this->queries[ self::$queryID ]->update( $updates );

		return $this;
	}

	
	/**
	 * [tabulka, ze ktere se bude vybirat, nebo ktera se bude upravovat, popr do ni vkladat]
	 * @param  [type] $tableName [description]
	 * @return [type]            [description]
	 */
	public function table( $tableName )
	{
		$this->queries[ self::$queryID ]->table( $tableName );

		return $this;
	}



	/**
	 * [where setter valany z objektu ulozeneho v poli queries. ]
	 * @param  [type] $condition [description]
	 * @return [type]            [description]
	 */
	public function where( $column, $condition, $or = false ) 
	{
		$this->queries[ self::$queryID ]->where( $column, $condition, $or );

		return $this;
	}



	/**
	 * [limit limit setter volany z objektu ulozeneho v poli queries[] ]
	 * @param  [type] $limit [description]
	 * @return [type]        [description]
	 */
	public function limit( $limit )
	{
		$this->queries[ self::$queryID ]->limit( $limit );

		return $this;
	}



	/**
	 * [order setter volany z objektu ulozeneho v poli $queries ]
	 * @param  [type] $by   [description]
	 * @param  [type] $sort [description]
	 * @return [type]       [description]
	 */
	public function order( $by, $sort )
	{
		$this->queries[ self::$queryID ]->order( $by, $sort );

		return $this;
	}


	/**
	 * [ spousti dotazy, dotaz ulozeny v ojektu dms se ziska metodou getQuery() a pak spusti]
	 * @return [type] [description]
	 */
	public function run() 
	{
		return $this->queries[ self::$queryID ]->getQuery();
	}


	public function printQuery()
	{
		echo "printg query : ". self::$queryID . "<br>";
		$query = $this->queries[ self::$queryID ]->getQuery();
		echo $query."<br>";
	}



	/**
	 * metoda pro ziskani vsech zaznamu danne tabulky, 
	 * @param  [type] $table     [ table name]
	 * @param  [type] $fetchMode [ fetch mode - assoc, obj etc.]
	 * @return [type]            [ vraci pole, objekty atp. ]
	 */
	public function getTable( $table, $fetchMode = null )
	{
		if ( $fetchMode === null ) {
			$fetchMode = \PDO::FETCH_OBJ; 
		} 
		
		$query = '';
		if ( $this->tableExists( $table ) ) {
			$query = "SELECT * from $table";
			$results;
			
			foreach ( $this->conn->query( $query, $fetchMode ) as $row ) {
				$results[] = $row;
			}
			return $results;
		}
	}



	/**
	 * [ metoda ziska nazvy vsech tabulek v databazi, ulozi do pole $this->tables[] ]
	 * @return [type] [description]
	 */
	private function findAllTables()
	{
		$tables = $this->conn->query("show tables");

		$tableArray = array();

		foreach ($tables as $key ) {
			$this->tables[] = $key[0];
		}
	}




	/**
	 * [ bollean metado na zjisteni existence tabulky]
	 * @param  [type] $tableName [description]
	 * @return [type]            [description]
	 */
	private function tableExists( $tableName )
	{
		$this->findAllTables();

		if ( !in_array( $tableName, $this->tables ) ) {
			//throw new \Exception("Predelat vynimku, ze tabulka neexistuje", 1);
			
		} else {
			echo "tabulka existuje <br>";
			return true;
		}
		

	}






}