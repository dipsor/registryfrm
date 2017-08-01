<?php

namespace Libs\Controller;

abstract class Controller {

	/** @var [type] [description] */
	protected $template;

	private $templateAction;

	/**
	 * [__construct description]
	 * @param Smarty $smarty [description]
	 */
	public function __construct( \Smarty $smarty ) 
	{
		$this->template = $smarty;
	}


	/**
	 * [ initDefault() metoda, kteoru musi obsahovat kazdy controller, muze byt prazdna,
	 * 	 slouzi pro inicializovani promennych v default sablonach. ]
	 */
	public abstract function initDefault();


	/**
	 * [ renderMain() slouzi pro vykresleni stranky a statickych objektu,
	 *   nebo objektu nezavislych na controllerech]
	 * @param  [type] $tpl    [ nazev sablony ]
	 * @param  [type] $action [ nazev akce ]
	 */
	public function renderMain( $tpl, $action )
	{
		$this->includeControllerTemplate( $tpl, $action );

		$menu = array( 	'www' => '', 
						'home' => 'homepage', 
						'SIGN UP' => 'sign',
						'akce' => 'action' );
		$this->template->assign('menu', $menu );
		
		$this->template->display('main.tpl');
	}


	/**
	 * [includeContentTemplate() metoda, ktera includne sablony pro controllery
	 * kdyz je nastavenoo $this->templateAction, pouzije se to pro volani specificke sablony,
	 * jinak se pouzije sablona podle volane funkce.
	 * Nastavuje nazevController .'.'. $this->templateAction .tpl  ]
	 * @param  [type] $tpl    [sablona]
	 * @param  [type] $action [akce]
	 */
	private function includeControllerTemplate( $tpl, $action )
	{
		$tpl_name = '';
		if ( isset( $this->templateAction ) ) {
			$action = $this->templateAction;
		}
		
		if ( !empty( $tpl ) ) {
			$tpl_path = APP_DIR . 'View/' . ucfirst( strtolower( $tpl ) ) . '/' . $tpl. '.' . $action . '.tpl';
			if ( file_exists( $tpl_path ) ) {
				$tpl_name = ucfirst( strtolower( $tpl ) ) . '/' . $tpl . '.'. $action . '.tpl';
				$this->template->assign( 'tpl_name', $tpl_name );
			} else {
				throw new Exception("template does not exist $tpl_name", 1);
			}
		} else {
			throw new Exception("No template tto includ ein main was found", 1);
		}
	}


	/**
	 * [setTemplateAction setter  pro promennou $templateAction]
	 * @param [type] $arg [description]
	 */
	protected function setTemplateAction( $arg ) 
	{
		if ( is_string( $arg ) ) {
			if( $arg == 'this' ) {
				$this->templateAction = 'default';
			} else {
				$this->templateAction = $arg;
			}
		}
	}
}