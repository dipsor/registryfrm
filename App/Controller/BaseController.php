<?php

namespace App\Controller;

class BaseController  {

	protected $template;
	private $model;



	public function __construct( \Smarty $smarty)
	{
		$this->template = $smarty;
	}



	public function beforeRender()
	{
		$this->template->assign('menu', $menu );
		$this->template->display('main.tpl');
	}
		
}