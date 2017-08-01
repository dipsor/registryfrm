<?php

namespace Libs\Database\DMS;

use Libs\Database\Selector\Selectors as LDSS;


/**
 * Trida vytvarejici select sql dotazy
 */
class Select {

	/** @var [type] [description] */
	private $conn  = null;

	/** @var string [description] */
	private $select = '';

	/** @var string [description] */
	private $table = '';
	
	/** @var string [ vysledny tvar where sql ] */
	private $whereSQL = '';

	/** @var array [ hodnoto z metody where se ukladaji do pole ] */
	private $where = array();
	
	/** @var string [description] */
	private $limit = '';
	
	/** @var string [description] */
	private $order = '';

	/** @var [type] [ objekt selektoru - table, where, limit , order ] */
	private $selectors;

	/** @var string [ vysledny retezec sql selectu ] */
	private $selectQuery = '';

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
	 * [ nastavi $select cast celeho dotazu ]
	 * @param  [type] $condition [ parametrem jsou vybirane entity ]
	 */
	public function select( $condition )
	{	
		$this->select = "SELECT $condition FROM ";
	}


	/**
	 * [ zavola metodu \Libs\Database\Selector\Selectors()->table a nastavi nazev tabulky ]
	 * @param  [type] $table [ nazev tabulky ]
	 */
	public function table( $table )
	{
		$this->table = $this->selectors->table( $table );
	}


	/**
	 * [ vlozi do pole where objekt tridy where ]
	 * @param  [type] $column    [ nazev sloupce ]
	 * @param  [type] $condition [ podminka ]
	 * @param  [boolen] $or        [ jestli se ma pouzit clausule or ]
	 */
	public function where( $column, $condition, $or )
	{	
		$this->where[] = $this->selectors->where( $column, $condition, $or );	
	}


	/**
	 * [ zavola metodu \Libs\Database\Selector\Selectors()->limit(),
	 *   a nastavi limit do promenne $limit]
	 * @param  [type] $limit [ limit vracenych radku ]
	 */
	public function limit( $limit )
	{
		$this->limit = $this->selectors->limit( $limit );
	}


	/**
	 * [ nastavi promennou $order ]
	 * @param  [type] $by   [ co radime]
	 * @param  [type] $sort [ jakym zpusobem - (desc, asc ) ]
	 */
	public function order( $by, $sort )
	{
		$this->order = $this->selectors->order( $by, $sort );
	}



	/**
	 * [getQuery description
	 * posklada vysledny dotaz dohromady, projede pole a nastavi objektum jejich citac counter,
	 * slozi dotaz, vyresetuje counter a vrati vysledny select dotaz ]
	 * @return [ string ] [ vysledny dotaz, ktery je ulozeny v $this->selectQuery ]
	 */
	public function getQuery()
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
		
		$this->selectQuery = $this->select . $this->table . $this->whereSQL . $this->order . $this->limit;
		echo $this->selectQuery."<br>";
		try {
			$stmt = $this->conn->prepare( $this->selectQuery );

			$stmt->execute( $this->paramArray );
			$results = $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch ( \PDOException $e ) {
			echo "Select sql problem occured " . $e->getMessage();
		}
		\Libs\Database\Selector\Where::resetCounter(1);		

		return $results;
	}



}