<?php

namespace Libs\Database\Selector;
/**
 * implementace metod pro specifikovani dotazu SQL
 */
class Selectors {



	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		
	}



	/**
	 * [vrati nazev tabulky, popr tabulek ve spravnem formatu]
	 * @param  [type] $table [description]
	 * @return [type]        [description]
	 */
	public function table( $table )
	{
		return sprintf( " %s ", $table );
	}



	/**
	 * [vrati string where spravne naformatovany na zaklade vstupnich parametru]
	 * @param  [type] $condition [description]
	 * @return [type]            [description]
	 */
	public function where( $column, $condition, $or )
	{

		return new \Libs\Database\Selector\Where( $column, $condition, $or );
	}



	/**
	 * [vrati string limit na zaklade vstupni parametru]
	 * @param  [type] $limit [description]
	 * @return [type]        [description]
	 */
	public function limit( $limit )
	{	
		$limita = '';

		if ( isset( $limit ) ) {
			if( is_int( $limit ) ){ 
				$limita = strval( $limit );
			}

			if ( is_double( $limit ) ) {
				$limita = strval( round( $limit ) );
			} 

			if ( is_string( $limit ) && $limit != '' ) {
				$limita = $limit;
			}
			return sprintf( " limit %s ", $limita );
		} else {
			echo "vunimka, ze neni nastaveno";
		}

	}



	/** 
	 * [ vrati string order]
	 * @param  [type] $by [description]
	 * @return [type]     [description]
	 */
	public function order( $by, $sort )
	{
		if ( ( isset( $by ) && isset( $sort ) ) ) {
			if ( $by != '' && $sort == '') {
				return sprintf( " ORDER BY %s " , $by );
			} else if ( $by != '' && $sort != '' ) {
				return sprintf (" ORDER BY %s %s " , $by, $sort );
			} else {
				echo "napsat vunimku ze order nebyl zadanej spravne";
			}

		} else {
			echo "napsat vunimku ze order nebyl zadanej spravne";
		}
	}


}