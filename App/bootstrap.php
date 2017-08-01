<?php
//// Zapnuti chybnych varovani
error_reporting(E_ALL);
ini_set('display_errors', True);
require_once(LIBS_DIR . 'Sessions/Sess.php' );
//$sessions = new \Libs\Sessions\Sess( array( 'lifetime' => 0, 'path' => '/', 'domain' =>  $_SERVER['SERVER_NAME'], 'secure' => 0, 'httponly' => true ), 'hovno', 24 );
//$sessions = new \Libs\Sessions\Sess( 'hovno', 24 );
//$sessions->start();

//$web = "www.miroslavmasek.cz";
//$long = ip2long( $web );
//$hash = md5( $_SERVER['HTTP_USER_AGENT'] . (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0')));
//echo "<br>";
//echo "hash: ". $hash ;

//echo "<br>";
//printSess( $_SESSION );




// start casomiry
$start = microtime(true);

// Nacteni jadra a Inicializace autoloaderu
require_once ( LIBS_DIR . 'Autoloadings/Autoloader.php' );
Autoloader::getInstance()->startLoading();

// initiate configuration and laods data from xml
$cfg = \App\Config\Config::getInstance();
$cfg->setXMLConfigurator( APP_DIR.'Config/configurations.xml' );

// Inicializace aplikace a jejiho nastaveni
$app = new \Libs\Application\Application( $cfg );
//$app->registerNewObject('session', $sessions );


$app->runApplication();


// konec casomiry
$end = microtime(true);
echo "<br>Doba  - ".round ( $end - $start, 6 ) . "<br>";


/*
 *  PHP Session - Using SessionHandler
 *  When a plain instance of SessionHandler is set as the save handler using session_set_save_handler() 
 * it will wrap the current save handlers. 
 *  A class extending from SessionHandler allows you to override the methods or intercept or filter them 
 * by calls the parent class methods which ultimately wrap the interal PHP session handlers.
 * This allows you, for example, to intercept the read and write methods to encrypt/decrypt the session 
 * data and then pass the result to and from the parent class. 
 * Alternatively one might chose to entirely override a method like the garbage collection callback gc. 
 */
function printSess( $session )
{
	printf( "session id : %s<br>", session_id() );
	printf( "session name : %s<br>", session_name() );
	printf( "session status : %s<br>", session_status() );
	echo "session jako takova: <br>";
	echo "<pre>".print_r($session, 1)."</pre>";
	echo "cookie jako takova: <br>";
	echo "<pre>".print_r($_COOKIE, 1)."</pre>";

}