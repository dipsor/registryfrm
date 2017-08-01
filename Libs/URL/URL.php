<?php

namespace Libs\URL;

class URL {

	/** @var [string] [ nazev controlleru, ze ktereho je tvorena instance ] */
	private $controller;

	/** @var [object Config] [ obejct uchovavajici veskera nastaveni] */
	private $XMLCfg;


	/**
	 * [__construct pri vytvareni instance se musi vlozit objekt cfg a smarty]
	 * @param [type] $XMLCfg [description]
	 * @param Smarty $smarty [description]
	 */
	public function __construct( $XMLCfg, \Smarty $smarty )
	{
		$this->XMLCfg = $XMLCfg;
		$this->smarty = $smarty;
	}

	/**
	 * [getURLData zistak data z url, rozparsuje, vytvori controller a zavole jeho metody s argumentem, 
	 * kdyz je treba.
	 * Nainicializuje promenne pro sablonu k dannemu kontrolleru metodou initDefault(),
	 * pak se zavola metoda renderMain() a vsechno se vykresli.  
	 * Pro danny kontroller vzdy musi existovat alespon sablona se jmenem: controller.default.tpl ]
	 */
	public function getURLData()
	{
		$urlData 		= ( isset( $_GET[ "url" ] ) ) ? $_GET[ "url" ] : '';
		$this->urlPath 	= $urlData;
		$data 			= explode( "/", $urlData );
		$defaultPage 	= '';
		$action			= '';

		// prazdny retezec zmeni na defaultni stranku, coz je homepage. 
		// akci nastavi default. 
		if ( $data[0] === '' ) {
			$defaultPage = $this->XMLCfg->site->site_homepage;
			$action = 'default';
		} 

		// kdyz nejaky controller existuje, nastavi se do promenne $defaultPage
		// akce se nastavi opet defaultni.
		if ( isset( $data[0] ) && $data[0] !== '' ) {
			$defaultPage = $data[0];
			$action = 'default';
		}

		// orizne prazdnej string na pozici metody, kdyz se nachazi, nebo argumentu
		for ($i=1; $i < count( $data ) ; $i++) { 
			if ( $data[$i] === "" ) {
				unset( $data[$i] );
			}
		}
		
		// nastavi jmeno kontrolleru, ktery se ma vytvorit,
		// a pote se vytvori a vlozi do promenne $controller
		$this->setController( $defaultPage );
		$controller = $this->createController( $this->smarty );	

		// zjisti, zda byla volana metoda, popripade metoda s argumentem. 
		if ( count( $data ) > 1 ) {
			if( isset( $data[2] ) ) {
				$controller->{ $data[1] }( $data[2] );
			} else {
				$controller->{ $data[1] }();
			}
			$action = $data[1];
		}

		// nainicializuje konretni kontroller, v podstate do nej akorat posle promenne
		// zavola se metoda renderMain a vykresli se cela stranka
		$controller->initDefault();
		$controller->renderMain( $defaultPage, $action );
	}


	/**
	 * [setController nastavi nazev controlleru, kde nastavi prvni pismeno velky ]
	 * @param [type] $controllerName [description]
	 */
	private function setController( $controllerName )
	{
		$this->controller = ucfirst( strtolower( $controllerName ) ) . 'Controller';
	}


	/**
	 * [createController vytvore instanci controlleru, jehoz nazev je ulozenej v promenny $this->controller ]
	 * @param  [type] $controllerName [description]
	 * @return [type]                 [description]
	 */
	private function createController( \Smarty $smarty)
	{
		return new $this->controller( $smarty );
	}

}