<?php 

namespace Libs\Database;



/**
 * trida se stara o pripojeni k databazi, vutvori objekt config,
 * vytahne z nej potrebne udaje a pripoji 
 * trida vyuziva navrhovy vzor singleton
 */
class DBConn
{
	/** @var [type] [description] */
	protected static $conn = null;
	
	/** @var [type] [description] */
	protected static $instance = null;
	
	/** @var [type] [description] */
	private $cfg;

	

	/**
	 * [__constructor pripoji k db]
	 */
	private function __construct()
	{
		try {
			$this->cfg = \App\Config\Config::getInstance()->getCFG(APP_DIR.'Config/configurations.xml');

			self::$conn = new \PDO( "mysql:host=".$this->cfg->database->db_host.";dbname=".$this->cfg->database->db_name,
									$this->cfg->database->db_username, $this->cfg->database->db_password );
			self::$conn->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
			echo "pripojeni k databazi je uspesne <br>";

		} catch ( \Libs\Exceptions\FileException $e) {
			$e->exceptionMessage();
		} catch ( PDOException $e ) {
			echo "Connection fail has been found: " . $e->getMessage();
		}
	}	


	
	
	/**
	 * [getConn vraci instanci tridy]
	 * @return [type] [description]
	 */
	public static function getConn()
	{
		if ( !self::$conn) {
			new self();
		} 

		return self::$conn;
	}

	public static function getInstance()
	{
		if ( !isset(self::$instance)) {
			echo 'insatnce';
			self::$instance = new self();
		}
		return self::$instance;
	}




}