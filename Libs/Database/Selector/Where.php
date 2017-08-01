<?php

namespace Libs\Database\Selector;

class Where {

	/** @var string [ nazev sloupce + operator] */
	private $column = '';

	/** @var string [ podminka ] */
	private $condition = '';

	/** @var boolean [ bude pouzit or, nebo ne ] */
	private $or = false;

	/** @var integer [ citac where objektu ] */
	private static $counter = 1;

	private $namedParam = '';

	/**
	 * [ konstruktor nastavi parametry pri vytvareni instance do promennych ]
	 * @param [type] $column    [description]
	 * @param [type] $condition [description]
	 * @param [type] $or        [description]
	 */
	public function __construct( $column, $condition, $or )
	{
		$this->column = $column;
		$this->condition = $condition;
		$this->or = $or;
	}


	public function setParamColumn( $column )
	{
		$this->paramColumn = ":" . preg_replace( '/\PL/u', '', $column );
	}
	
	public function getParamColumn( )
	{
		return $this->paramColumn;
	}

	public function getColumn()
	{
		return $this->column;
	}	
	
	public function getCondition()
	{
		return $this->condition;
	}

	/**
	 * [ navyseni $counter promenne o $by ]
	 * @param  [type] $by [ o kolik se ma $counter navysit ]
	 */
	public function inceraseCounter( $by )
	{
		self::$counter = self::$counter + $by;
	}



	/**
	 * [ vrati aktualni hodnotu $counteru ]
	 * @return [type] [description]
	 */
	public static function getcounter()
	{
		return self::$counter;
	}
	


	/**
	 * [ wrati cast dotazu where, podle aktialni hodnotu promenne $counter 
	 *   rozhodne zda vrati pouze where, and, a nebo or .. ]
	 * @return [ string ] [ vraceny where ]
	 */
	public function getWhere()
	{
		
		if ( self::$counter == 1 ) {
			return sprintf( " WHERE %s %s", $this->column, $this->paramColumn );
		}

		if ( self::$counter > 1 ) 
		{
			if ( $this->or === TRUE ) {
				return sprintf( " OR %s %s", $this->column, $this->paramColumn );
			} 
			if( $this->or === false ) {
				return sprintf( " AND %s %s", $this->column, $this->paramColumn );
			}
		}
		
		
	}


	/**
	 * [resetCounter nastavi hodnotu counteru na puvodni hodnotu 1 ]
	 */
	public static function resetCounter()
	{
		self::$counter = 1;
	}	

	
} 