<?php

namespace Libs\Sessions;

class Sessions  extends \SessionHandler {

	private $sessionName;
	private $keyLength;

	public function __construct( $sessionName , $keyLength )
	{
		$this->sessionName 	= $sessionName;
		$this->keyLength	=  $keyLength;
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
	 * [vytvori kopii session s novym id, a starou pote smaze po nastavene dobe ]
	 * @return [type] [description]
	 */
	public function regenerateSession()
	{
		// if the session is obsolete, it means there already is a new id
		if ( isset( $_SESSION['OBSOLETE']) && $_SESSION['OBSOLETE']  === true ) {
			return;
		}

		// set current session to expire in 10 sec
		$_SESSION['OBSOLETE'] = true;
		$_SESSION['EXPIRES']  = time() + 10;

		// create new session without destroying the old one;
		session_regenerate_id( false );

		// Grab current session ID and close both sessions to allow other scripts to use them
		$newSession = session_id();
		session_write_close();

		// Set session ID to the new one, and start it back up again
		session_id($newSession);
		session_start();

		// Now we unset the obsolete and expiration values for the session we want to keep
		unset($_SESSION['OBSOLETE']);
		unset($_SESSION['EXPIRES']);
	}

	
	/**
	 * [isSessionExpired description]
	 * @return boolean [description]
	 */
	private function isSessionExpired()
	{
		if( isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES']) ){
			return false;
		}

		if(isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time())
		{
			return false;
		}

		return true;		
	}

	
	/**
	 * [checkUser description]
	 * @return [type] [description]
	 */
	private function checkUser(){
		if( !isset($_SESSION['IPaddress']) || !isset($_SESSION['userAgent']) ) {
			return false;
		}
		
		if( $_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'] ) {
			return false;
		}

		if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'] ) {
			return false;
		}

		return true;
	}


	/**
	 * [read description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function read($id)
	{
		return mcrypt_decrypt(MCRYPT_3DES, $this->createKey(), parent::read($id), MCRYPT_MODE_ECB );
	}


	/**
	 * [write description]
	 * @param  [type] $id   [description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function write($id, $data)
	{
		return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->createKey(), $data, MCRYPT_MODE_ECB ));
	}
	

	/**
	 * [get description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public function get($name)
	{
	    $parsed = explode('.', $name);

	    $result = $_SESSION;

	    while ($parsed) {
	        $next = array_shift($parsed);

	        if (isset($result[$next])) {
	            $result = $result[$next];
	        } else {
	            return null;
	        }
	    }

	    return $result;
	}


	/**
	 * [put description]
	 * @param  [type] $name  [description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	public function add($name, $value)
	{
	    $parsed = explode('.', $name);

	    $session =& $_SESSION;

	    while (count($parsed) > 1) {
	        $next = array_shift($parsed);

	        if ( ! isset($session[$next]) || ! is_array($session[$next])) {
	            $session[$next] = [];
	        }

	        $session =& $session[$next];
	    }

	    $session[array_shift($parsed)] = $value;
	}


	/**
	 * [starts sessions]
	 * @return [type] [description]
	 */
	public function start()
	{
		$this->secureInit();

		session_start();

		// makes sure session has not expired, if so, thenit is destroyed 
		if ( $this->isSessionExpired() ) {

			// prevents hijacking
			if ( !$this->checkUser() ) {
				$_SESSION = array();
				$_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT']; 
				$this->regenerateSession();
			
			// gives 5% chance of the session id changing on any request
			} elseif( rand(1,100) <= 5 ) { 
				echo "kurvamatch!!! <br>";
				$this->regenerateSession();
			}			
		} else {
			$_SESSION = array();
			session_destroy();
			session_start();
		}

	}

}