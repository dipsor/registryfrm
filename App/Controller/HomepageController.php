<?php

class HomepageController extends Libs\Controller\Controller {


	public function initDefault()
	{
		$menu2 = array( 'home function' => 'homepage/piskej',
		 				'home func arg' => 'homepage/piskej/123' );
		$this->template->assign( 'menu2', $menu2 );
	}

	public function piskej( $arg = false )
	{
		//$this->setTemplateAction('this');
		$this->template->assign( 'secti', $arg );
	}

	public function secti( )
	{	
		$a = '';
		$b = '';

		if( isset( $_POST['a'] ) && isset($_POST['b'] ) ) {
			$a = $_POST['a'];
			$b = $_POST['b'];
		}

		$this->setTemplateAction('this');
		$this->template->assign( 'secti', ( $a + $b ) );


	}
	
}