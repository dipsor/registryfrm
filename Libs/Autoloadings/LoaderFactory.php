<?php

class LoaderFactory {
	public static function createLoader( $namespace )
	{
		switch ( $namespace )
		{
			case true :
				return new LoaderNormal();
				break;
			case false :
				return new LoaderNamespace();
				break;
			default:
			throw new Exception("Error Processing Request", 1);
					
		}
	}
}