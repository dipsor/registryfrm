<?php
class Valid_Exception extends Exception
{
	public function __construct( $message, $code )
	{
		parent::__construct( $message, 0 );
		$this->code = $code;
	}
}