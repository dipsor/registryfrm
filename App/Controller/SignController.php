<?php

class SignController extends Libs\Controller\Controller {


	public function initDefault()
	{
		$signupmenu = array( 	'login' => 'login',
								'registrovat' => 'registration' );
		$this->template->assign('signupmenu', $signupmenu );
	}

	public function Login( )
	{
		$form  = new \Libs\Form\Form( 'login', 'http://localhost/registryfrm/www/sign/signUp' );

		$konkretni['name'] = $form->addText('Jmeno', 'name', array( 'required' => TRUE ) ) ;
		$konkretni['pass'] = $form->addText('Heslo', 'pass', array( 'required' => TRUE ) ) ;
		$konkretni['submit'] = $form->addSubmit('Odeslat', 'submit', 'lg', 'primary' );

		$tplForm = $form->getForm( $konkretni );

		$this->template->assign( 'form', $tplForm );


	}

	public function signUp()
	{
		$this->setTemplateAction('login');
		echo 'data odeslana ke zpracovani<br>';
	}

	public function Registration()
	{

	}
}