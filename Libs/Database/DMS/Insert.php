<?php

namespace Libs\Database\DMS;

use Libs\Database\Selector\Selectors as LDSS;

/**
 *  trida na vytvareni insert sql dotazu
 */
class Insert {

	/** @var string [description] */
	private $table = '';
	
	/** @var string [ sestavi string s nazvy sloupcu, do kterych se vkladaji nejaka data ] */
	private $columnString = '';
	
	/** @var string [ vytvori string s nazvy sloupcu pred kterymi je ":" ] */
	private $valuesString = '';

	/** @var string [ finalni tvar insert query ] */
	private $insertQuery = '';

	/** @var array [ assoc pole kde klic je ':nazevsloupce' a hodnota je vlozena hodnota ] */
	private $paramArray = array();

	/** @var [type] [ databazove pripojeni ] */
	private $conn;
	
	/** @var [type] [ objekt selectoru ] */
	private $selectors;

	/**
	 * [__construct description]
	 * @param PDO    $conn [ inicializace databazoveho pripojeni]
	 * @param [type] $id   [ id dotazu ]
	 */
	public function __construct( LDSS $s, \PDO $conn, $id )
	{
		echo "<br>";
		echo "id = $id ";	
		$this->selectors = $s;
		$this->conn = $conn;
	}


	/**
	 * [insert() funkce volana v tride Db, zavola setry a nastavi jednotlive promenne ]
	 * @param  [type] $inserts [description]
	 * @return [type]          [description]
	 */
	public function insert(  $inserts )
	{	
		foreach ( $inserts as $key => $value ) {
			$this->setColumnString( $key, ":".$key );
			$this->setValueString( ":".$key );
			$this->setParamArray( ":".$key, $value );
		}
	}


	/**
	 * [setColumnString setter na nastaveni stringu s nazvy sloupcu ]
	 * @param [type] $column [description]
	 */
	private function setColumnString( $column )
	{
		$this->columnString .= $column . ", "; 
	}


	/**
	 * [setValueString setter na nastaveni ":" pred klic na pozici hodnoti v dotazu insert 
	 * 	insert into table ( column1, ... columnN ) values ( :column1, :columnN )]
	 * @param [type] $changedValue [description]
	 */
	private function setValueString( $changedValue ) 
	{
		$this->valueString .= $changedValue . ", ";
	}


	/**
	 * [setParamArray vytvori pole s hodnotami pro funkci execute, klic je :column,
	 *  a hodnota je vlozena hodnota]
	 * @param [type] $key   [description]
	 * @param [type] $value [description]
	 */
	private function setParamArray( $key, $value )
	{
		$this->paramArray[$key] = $value;
	}


	/**
	 * [ getColumn vraci string s nazvy sloupcu oriznuty o posledni dva znaky ]
	 * @return [type] [description]
	 */
	public function getColumn()
	{
		return substr_replace( $this->columnString, "", -2 );
	}


	/**
	 * [getValues vraci string s :nazvysloupcu oriznuty o posledni dva znaky]
	 * @return [type] [description]
	 */
	public function getValues()
	{
		return substr_replace( $this->valueString, "", -2 );
	}


	/**
	 * [getParamArray vraci assoc pole ]
	 * @return [type] [description]
	 */
	public function getParamArray()
	{
		return $this->paramArray;
	}


	/**
	 * [table nastavi nazeev tabulky]
	 * @param  [type] $table [description]
	 * @return [type]        [description]
	 */
	public function table( $table )
	{
		$this->table = $this->selectors->table( $table );
	}


	/**
	 * [getQuery slozi dotaz, pripravi statment a provede dotaz ]
	 * @return [type] [description]
	 */
	public function getQuery()
	{
		$this->insertQuery = sprintf( "INSERT INTO %s ( %s ) VALUES ( %s ) ",
							 $this->table, $this->getColumn(), $this->getValues() );
		echo $this->insertQuery."<br>";
		$stmt = $this->conn->prepare($this->insertQuery );
		$stmt->execute( $this->getParamArray() );

		return $stmt;
		
	}




}