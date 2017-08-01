<?php

class Autoloader {

	/** @var [type] [description] */
	public static $instance = null;

	private $file;
	private $folders = array(
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => ''
		);
	private $files = array( 
		'loaderfactory'   => '/Libs/Autoloadings/LoaderFactory.php',  
		'autoloadedfile'  => '/Libs/Autoloadings/AutoloadedFile.php',  
		'iloader' 		  => '/Libs/Autoloadings/ILoader.php',  
		'loadernormal'    => '/Libs/Autoloadings/LoaderNormal.php',  
		'loadernamespace' => '/Libs/Autoloadings/LoaderNamespace.php',
		'smarty'		  => 'Smarty-3.1.21/libs/Smarty.class.php'  
	);

	/**
	 * 
	 */
	private function __construct(){}
	private function __clone() {}
	


	/**
	 * [getInstance description]
	 * @return [type] [description]
	 */
	public static function getInstance()
	{
		return self::$instance instanceof self ? self::$instance : self::$instance = new self(); 
	}



	/**
	 * [startLoader description]
	 * @return [type] [description]
	 */
	public function startLoading()
	{
		$this->loadCore();

		spl_autoload_register( array( $this , 'loadFile' ) );
	}



	/**
	 * Metoda zjistit, jestli je nacitanej soubor namespace. 
	 * Pak tovarna na zaklade funkce is loader vytvori instanci,
	 * bud LoaderNormal, nebo LoaderNamespace. 
	 * do promenny $file ulozim instanci Autoloaded file a zavolam metodu, 
	 * ktera se postara o vsechno- nastavi cestu k souboru, a nacte ho. 
	 * @param  [type] $class [description]
	 * @return [type]        [description]
	 */
	private function loadFile( $class )
	{
		$dir = $class . '.php';

		$namespace = ( strpos( $class, "\\" ) == true ) ? false : true;
		$loader = LoaderFactory::createLoader( $namespace );

		$loader->load( $class );
	}

	

	/**
	 * metoda naloaduje zaregistrovany soubory. 
	 * @return [type] [description]
	 */
	public function loadCore()
	{
		foreach ($this->files as $key => $value) {
			if ( is_file( ROOT_DIR . $value ) ) {
				require_once( ROOT_DIR . $value  );
			}
		}
	}



	/**
	 * tadyta metoda se vola pro registrovani novych souboru. 
	 * vzdycky se musi vlozit pole. 
	 * napr: Autoloader::getInstance->registerNewFiles( 'Autoloading/test.php' => 'Autoloading/test.php' );
	 * manualne nactene nove soubory, se naloaduji fci loadNewFiles. 
	 *  @param  array  $files [description]
	 * @return [type]        [description]
	 */
	public static function registerNewFiles( array $files )
	{

	}



	/**
	 * tadyta funkce nalouduje cely slozky.
	 * @param  array  $folder [description]
	 * @return [type]         [description]
	 */
	public static function loadFolder( array $folder )
	{

	}


}