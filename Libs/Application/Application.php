<?php

namespace Libs\Application;

class Application {
	

	private $objects = array();

	public function __construct( $cfg )
	{
		$this->objects['cfg'] = $cfg;
		$this->objects['smarty'] = new \Smarty();
		$this->objects['cfg']->setSmarty( $this->objects['smarty'] );
		$this->objects['url'] = new \Libs\URL\URL( $this->objects['cfg']->getXMLConfigurator(), $this->objects['cfg']->getSmarty() );
	}

	public function registerNewObject( $key, $object ) {
		if( is_string( $key ) && is_object( $object ) ) {
			$this->objects[$key] = $object;
		}
	}

	public function runApplication()
	{
		$this->getObjectByKey('url')->getURLData();
	}

	private function getObjectByKey( $key )
	{
		if ( isset( $this->objects[$key] ) && !empty( $this->objects[$key] ) ) {
			return $this->objects[$key];
		} else {
			throw new Exception("Non existing object $key", 1);			
		}
	}

}