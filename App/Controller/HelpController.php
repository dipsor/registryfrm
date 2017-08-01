<?php

class HelpController extends Libs\Controller\Controller {


	public function initDefault()
	{
		$menu2 = array( 'help function' => 'help/hit', 'help func arg' => 'help/hit/sracky' );
		$this->template->assign('menu2', $menu2 );
	}

	public function test( $arg = false )
	{
		$this->template->assign( 'arg', $arg );
	}

	public function sessions()
	{
		$_SESSION['hit'] = 'hit';
		echo "pridana session - zacatek fce<br>";
		echo "<pre>".print_r($_SESSION, 1)."</pre>";
		echo "pridana session - konec fce<br>";
		$this->setTemplateAction('this');
	}

	public function deleteSession()
	{
		$_SESSION[] = array();
		session_destroy();
		var_dump($_SESSION);
		$this->setTemplateAction('this');
	}
}