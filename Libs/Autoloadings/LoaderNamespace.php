<?php

class LoaderNamespace implements Iloader {

	/** @var [type] [description] */
	private $pathToClassFolder = null;	
	/** @var [type] [description] */
	private $class = null;



	public function __construct(){}



	public function load( $namespace )
	{
		try {
			$this->setPathToClassFolder($namespace);
			$this->setClass($namespace);
			
			require ( $this->class );

		} catch ( \Libs\Exceptions\FileException $e ) {
			echo $e->exceptionMessage();
		}
	}

	/**
	 * jako parametr je namespace vlozeny z metody autoload metodou spl_autoload_register
	 * metoda oreze retezec na cestu k pozadovane slozce.
	 * @param [type] $namespace [description]
	 */
	private function setPathToClassFolder( $namespace )
	{
		echo $namespace."<br>";
		$replacedBackSlash = str_replace( "\\", "/", $namespace );
		echo $replacedBackSlash . "<br>";
		$explode 		   = explode('/', $replacedBackSlash);

		unset($explode[count( $explode ) - 1]);
		$dir = $this->getBetterRootPath(ROOT_DIR) . 'registryfrm/'.implode("/", $explode);
		echo "dir -> " . $dir . "<br>";
		if ( is_dir($dir) ){
			$this->pathToClassFolder =  $dir;
		} else {
			throw new \Libs\Exceptions\FileException("ErroProcessing Request: Slozka <font color='red'> $dir </font>neexistuje", 1);
		}
	}



	/**
	 * @param [type] $namespace [description]
	 * Metoda nastavi pouze nazev tridy
	 */
	private function setClass($namespace)
	{
		echo $namespace;
		$explode = explode("\\", $namespace);

		$class = $this->pathToClassFolder.'/'.$explode[ count($explode) - 1 ] . '.php';
		echo "class => " . $class . "<br>";
		if ( is_file($class) && file_exists($class) ) {
			$this->class = $class;	
		} else {
			throw new \Libs\Exceptions\FileException("ErroProcessing Request: Trida <font color='red'>$class</font> neexistuje", 1);
		}

	}



	/**
	 * [getBetterRootPath description]
	 * @param  [type] $path [description]
	 * @return [type]       [description]
	 */
	private function getBetterRootPath( $path )
	{
		$newPathArray = explode( '/', $path );

		$newPath = '';	

		for ( $i = 1; $i < 4; $i++) {
			$newPath .= '/'.$newPathArray[$i];
		}

		return $newPath."/";
	}
}
