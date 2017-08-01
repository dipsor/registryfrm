<?php

namespace Libs\Sessions;

class Sess  extends \SessionHandler {

	const DELAY = 10;

	private $cookie;
	private $sessionName;
	private $keyLength;
	private $generated;

	public function __construct(  $sessionName , $keyLength )
	{
		$this->sessionName 	= $sessionName;
		$this->keyLength	= $keyLength;

	}

	
	/**
	 * [settings for sessions]
	 * @param array $opts [description]
	 */
	public function secureInit( $name = null )
	{
		session_set_save_handler( $this, true );

		$newName = isset( $name ) ? $name : $this->sessionName;
		$oldname = session_name( $newName );

		ini_set( 'session.use_cookies', 1 );
		ini_set( 'session.use_only_cookies', 1 );
		ini_set( 'session.use_trans_sid', FALSE );

		session_set_cookie_params(0,ini_get('session.cookie_path'), ini_get('session.cookie_domain'), isset( $_SERVER['HTTPS'] ), true );

		return $this;
	}


	/**
	 * [createKey description]
	 * @param  [type] $length [description]
	 * @return [type]         [description]
	 */
	private function createKey( $length = null ) {
    	$newLength = isset( $length ) ? $length : $this->keyLength;
		
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $newLength );
	}


	/**
	 * [ checks, if the flag obsolote is set and if it is true, if not
	 * sets flags obsolote and expires to session. 
	 * then it changes the id ]
	 * @return [type] [description]
	 */
	private function refresh() 
	{
		if ( isset($_SESSION['OBSOLOTE']) && $_SESSION['OBSOLOTE'] == true ) {
			return;
		} 

		$_SESSION['OBSOLOTE'] = true;
		$_SESSION['EXPIRES']  = time() + self::DELAY;

		session_regenerate_id( false );

		$newSID = session_id();
		session_write_close();

		session_id( $newSID );
		session_start();

		unset( $_SESSION['OBSOLOTE'] );
		unset( $_SESSION['EXPIRES'] );
	}

	/**
	 * [validateSession description]
	 * @return [type] [description]
	 */
	private function validateSession()
	{
		if ( isset( $_SESSION['OBSOLOTE']) && !isset( $_SESSION['EXPIRES']) ) {
			return false;
		}
		if ( isset( $_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time() ) {
			return false;
		}

		return true;
	}


	/**
	 * [checkIP description]
	 * @return [type] [description]
	 */
	private function checkUser()
	{
		$hash = md5($_SERVER['HTTP_USER_AGENT'] . (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0')));

		if ( isset( $_SESSION['check'] ) ) {
			return $_SESSION === $hash;
		}

		$_SESSION['check'] = $hash;

		return true;
	}


	/**
	 * [start description]
	 * @return [type] [description]
	 */
	public function start()
	{
		
		$this->secureInit();

		if ( !$this->checkUser() ) {
			echo "test. jsme pod utokem<br>";
		}

		if ( $this->validateSession() ) {
			echo "valid!! ";
			
			if ( session_id() == '' ) {
				if ( session_start() ) {
					return ( mt_rand(0,4) === 0 ? $this->refresh() : true );
				}
			}
		} else {
			echo "no - valid";			
		}




	}
}

