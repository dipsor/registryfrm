<?php

class LoaderNormal implements Iloader {



	public function __construct(){}

	

	/**
	 * [load description]
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function load( $input )
	{
		$this->scanDir( $this->getBetterRootPath( ROOT_DIR ), $input.'.php' );
	}



	/**
	 * [findClass description]
	 * @param  [type] $folder     [description]
	 * @param  [type] $folderItem [description]
	 * @param  [type] $class      [description]
	 * @return [type]             [description]
	 */
	private function findClass( $folder, $folderItem, $class )
	{
		$info = new SplFileInfo($folderItem);
		$ext = $info->getExtension();
		
		if ( strpos( $class, "\\" ) == false ) {
			if ( !empty($ext) && ($ext == 'php') ) {
				if ( $folderItem == $class ) {
					require_once ($folder.'/'.$class);
				} 
			}	
		}
		 
	}



	/**
	 * [scanDir description]
	 * @param  [type] $startFolder [description]
	 * @param  [type] $class       [description]
	 * @return [type]              [description]
	 */
	private function scanDir( $startFolder, $class )
	{
		$contents = scandir( $startFolder );
		$folder = $startFolder;
		
		foreach ( $contents as $item ) {
			if ( is_dir( $startFolder . '/' . $item ) && ( substr( $item, 0, 1 ) != '.' ) ) {
				$folder = $startFolder . '/' . $item;
				$scannedFolder = scandir( $folder );

				foreach ( $scannedFolder as $item ) {
					if ( is_dir( $folder ) && ( substr( $item, 0,1 ) != '.' ) ) {
						$this->findClass( $folder, $item, $class );
					}
				}

				$this->scanDir( $folder, $class );
			}
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

		return $newPath;
		echo $newPath;
	}
}