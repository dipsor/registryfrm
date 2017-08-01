<?php

namespace Libs\Database\DMS;

use Libs\Database\Selector\Selectors as LDSS;
/**
 *  trida na vytvareni delete sql dotazu
 */
class Delete {
	/** @var [type] [ objekt selectoru ] */
	private $selectors;

	/** @var [type] [ databazove pripojeni ] */
	private $conn;

	/** @var string [description] */
	private $table ='';

	/** @var string [ vysledny tvar delete query] */
	private $deleteQuery ='';

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
	public function delete( $tablename )
	{
		$this->table = $tablename;
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
		
		$this->deleteQuery = sprintf( "DELETE FROM %s %s %s %s", $this->table, $this->whereSQL, $this->order, $this->limit );
		echo $this->deleteQuery;	
		$stmt = $this->conn->prepare( $this->deleteQuery );
		$result = $stmt->execute( $this->paramArray );
		\Libs\Database\Selector\Where::resetCounter(1);		

		return $stmt;
	}



}