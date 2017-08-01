<?php

namespace Libs\Database\DMS;

use Libs\Database\Selector\Selectors as LDSS;


/**
 *	Trida na vytvareni UPDATE sql dotazu 
 */
class Update {

	/** @var [type] [ objekt selectoru ] */
	private $selectors;

	/** @var [type] [ databazove pripojeni ] */
	private $conn;

	/** @var string [description] */
	private $table ='';

	/** @var string [ vysledny tvar update query] */
	private $updateQuery ='';

	/** @var array [ hodnoto z metody where se ukladaji do pole ] */
	private $where = array();

	/** @var string [ vysledny tvar where sql ] */
	private $whereSQL = '';

	/** @var string [description] */
	private $order = '';

	/** @var string [description] */
	private $limit = '';

	/** @var array [ assoc pole s where condition, napr: ":role" => "user" , hodnoty,
		podle kterych se vyhledava ] */
	private $paramArray = array();

	
	/**
	 * [__construct description trida vola setry na vytvoreni dotazu
	 * ze tridy selectors ]
	 * @param LibsDatabaseSelectorSelectors $s  [ instance selectoru, 
	 *        kde sou implementovane metody where, order etc.]
	 * @param [type]                        $id [ id selectoru ]
	 */
	public function __construct( LDSS $s, \PDO $conn, $id )
	{
		echo "<br>";
		echo "id = $id ";	
		$this->selectors = $s;
		$this->conn = $conn;
	}


	/**
	 * [delete nastavi pouze nazev tabulky]
	 * @param  [type] $tablename [description]
	 */
	public function update( $updates )
	{
		//var_dump($updates);
		foreach ( $updates as $key => $value ) {
				$this->paramArray[ ':update'.$key ] = $value;
				$this->columns .= $key.' = :update'.$key.', '; 
		}	
	}


	/**
	 * [where description]
	 * @param  [type]  $column    [ nazev sloupce ]
	 * @param  [type]  $condition [ podminka ]
	 * @param  boolean $or        [ jestli se ma pouzit or ]
	 */
	public function where( $column, $condition, $or = false )
	{

		$this->where[] = $this->selectors->where( $column, $condition, $or );
	}

	public function table( $tableName )
	{
		$this->table = $this->selectors->table( $tableName );
	}
	/**
	 * [ nastavi poradi podle ktereho provadi delete ]
	 * @param  [type] $by   [ klic - nazev sloupce, podle ktereho se radi ]
	 * @param  [type] $sort [ jak se radi - DESC/ASC ]
	 */
	public function order( $by, $sort )
	{
		$this->order = $this->selectors->order( $by, $sort );
	}


	/**
	 * [limit nastavi limit ]
	 * @param  [type] $limit [description]
	 */
	public function limit( $limit )
	{
		$this->limit = $this->selectors->limit ( $limit );
	}


	/**
	 * [ spusti sql dotaz a provede ho ]
	 * @return [type] [description]
	 */
	public function getquery()
	{	
		if ( !empty( $this->where ) ) {
			for ($i=0; $i < count( $this->where ) ; $i++) { 

				$column = $this->where[$i]->getColumn();
				$condition = $this->where[$i]->getCondition();

				$this->where[$i]->setParamColumn( $column );
				//$this->where[$i]->setParamCondition( $condition );

				$this->paramArray[ $this->where[$i]->getParamColumn()] = $this->where[$i]->getCondition();
				$this->whereSQL .= $this->where[$i]->getWhere();

				\Libs\Database\Selector\Where::inceraseCounter(1);
			}
		}

		$columnss =  substr_replace( $this->columns, "", -2 );
		$this->updateQuery = sprintf( " UPDATE %s SET %s %s %s %s ", $this->table, $columnss, $this->whereSQL, $this->order, $this->limit );
		echo $this->updateQuery . "<br>";

		try {
			$stmt = $this->conn->prepare( $this->updateQuery );

			$stmt->execute( $this->paramArray );
			\Libs\Database\Selector\Where::resetCounter(1);		
			return $stmt;

		} catch ( \PDOException $e ) {
			echo "Select sql problem occured " . $e->getMessage();
		}

	}	
}