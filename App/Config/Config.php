<?php

namespace App\Config;

//use Libs\Exceptions;
class Config
{
	static private $instance = null;

	private $smarty;

	private $xmlCFG;

	private function __construct() {}


	
	public static function getInstance()
	{
		return self::$instance instanceof self ? self::$instance : self::$instance = new self(); 
	}


	
	/**
	 * [getCFG description]
	 * @param  [type] $xmlFile [description]
	 * @return [type]          [description]
	 */
	public function setXMLConfigurator($xmlFile)
	{
		if ( file_exists($xmlFile) && is_file($xmlFile) ) {
			$this->xmlCFG = simplexml_load_file($xmlFile);
		} else {
			throw new \Libs\Exceptions\FileException("Nelze nalezt soubor: $xmlFile", 1);
		}

	}

	public function getXMLConfigurator()
	{
		return $this->xmlCFG;
	}

	public function setSmarty( \Smarty $smarty )
	{
		$this->smarty = $smarty;
		$this->smarty->template_dir = APP_DIR . 'View';
		$this->smarty->compile_dir = ROOT_DIR . 'Tmp';
	}

	public function getSmarty()
	{
		return $this->smarty;
	}

}