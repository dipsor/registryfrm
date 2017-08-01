<?php

namespace Libs\Form;

/**
 *
 * trida na uploadnuti souboru a zmenseni jeho velikosti, 
 * nefunguje uploadnuti originalni velikosti a zmenseny zaroven. 
 */
class FileUp 
{

	const UP_FOLDER = 'assets/uploaded_images/';

	private $original_size = array();
	private $new_size      = array();
	private $name;
	private $tmp_name;
	private $file;
	private $image_resized;
	private $temp_path;
	private $just_name;


	/**
	 *
	 * constructor plni se $_FILE, sirkou a vyskou, nastaveni promennych
	 *
	 */
	public function __construct( $file, $width = null, $height = null ) 
	{
		$this->original_size = $this->getOriginalSize( $file["img"]["tmp_name"] );
		$this->new_size      = array( 'width' => $width, 'height' => $height );
		$this->name          = $file["img"]["name"];
		$this->tmp_name      = $file["img"]["tmp_name"];
		$this->file          = $file;
		$this->just_name	 = $this->justName($this->name);
		 //var_dump($this->just_name);

	}

	/**
	 *
	 * vrati optimalni velikost po zmenseni, vyhodnoti na zaklade originalnich rozmeru
	 *
	 */
	private function getOptimalSize($original_size)
	{
		$optimal_size;
		// sirka vetsi nez nova a vyska mensi nebo rovno nez nova
		if ( $this->original_size["width"] > $this->new_size["width"] && $this->original_size["height"] <= $this->new_size["height"] )
		{
				$percent = $this->getPercent( $this->original_size["width"] );
				$ratio = $this->new_size["width"] / $percent;
				$optimal_size["width"]  = $this->new_size["width"];
				$optimal_size["height"] = $this->original_size["height"] / 100 * $ratio;
		} //sirka mensi rovno nova a vyska vetsi nez nova
		else if ( $this->original_size["width"] <= $this->new_size["width"] && $this->original_size["height"] > $this->new_size["height"])
		{
				$percent = $this->getPercent( $this->original_size["height"] );
				$ratio = $this->new_size["height"] / $percent;
				$optimal_size["height"] = $this->new_size["height"];
				$optimal_size["width"]  = $this->original_size["width"] / 100 * $ratio;
		} // sirka i vyska je vetsi nez nova
		else if ( $this->original_size["width"] > $this->new_size["width"] && $this->original_size["height"] > $this->new_size["height"])
		{
			if ( $this->original_size["width"] > $this->original_size["height"] ) {
				$percent = $this->getPercent( $this->original_size["width"] );
				$ratio = $this->new_size["width"] / $percent;
				$optimal_size["width"]  = $this->new_size["width"];
				$optimal_size["height"] = $this->original_size["height"] / 100 * $ratio;
			}
			else if ($this->original_size["width"] < $this->original_size["height"]) {
				$percent = $this->getPercent( $this->original_size["height"] );
				$ratio = $this->new_size["height"] / $percent;
				$optimal_size["height"] = $this->new_size["height"];
				$optimal_size["width"]  = $this->original_size["width"] / 100 * $ratio;
			}
			else {
				$optimal_size["height"] = $this->new_size["height"];
				$optimal_size["width"]  = $this->new_size["width"];
			}	
		} //sirka i vyska je rovna novy
		else if ( $this->original_size["width"] == $this->new_size["width"] && $this->original_size["height"] == $this->new_size["height"])
		{
			$optimal_size = $new_size;
		} // nebo oboji mensi 
		else 
		{
			$optimal_size["width"]  = $original_size["width"];
			$optimal_size["height"] = $original_size["height"];
		}
		return $optimal_size;
	}

	/**
	 *
	 * provede zmenseni obrazku jako takove, lze zmensit .png, .jpg, .gif
	 *
	 */
	private function resize( $file )
	{
		$optimal_size = $this->getOptimalSize( $this->original_size );
		$optimal_width = (int) $optimal_size["width"];
		$optimal_height = (int) $optimal_size["height"];

		$mime =	$this->getMime();

		//var_dump($image);
		switch ($mime) {
			case 'png':
				$image = imagecreatefrompng( $this->tmp_name );
				$thumb = imagecreatetruecolor( $optimal_width, $optimal_height );
				imagecopyresized( $thumb, $image, 0, 0, 0, 0, $optimal_width, $optimal_height, $this->original_size["width"], $this->original_size["height"] );
				imagepng( $thumb, $this->getImagePath('png') );

				break;
			case 'jpeg':
				$image = imagecreatefromjpeg( $this->tmp_name );
				$thumb = imagecreatetruecolor( $optimal_width, $optimal_height );
				imagecopyresized( $thumb, $image, 0, 0, 0, 0, $optimal_width, $optimal_height, $this->original_size["width"], $this->original_size["height"] );
				imagejpeg( $thumb, $this->getImagePath('jpeg') );
				break;
			case 'gif':
				$image = imagecreatefromgif( $this->tmp_name );
				$thumb = imagecreatetruecolor( $optimal_width, $optimal_height );
				imagecopyresized( $thumb, $image, 0, 0, 0, 0, $optimal_width, $optimal_height, $this->original_size["width"], $this->original_size["height"] );
				imagegif( $thumb, $this->getImagePath('gif') );
				break;
		}
	}
	/**
	 *
	 * vrati nazev souboru
	 *
	 */
	private function justName($name)
	{
		$name = explode('.', $name);

		return $name[0];
	}


	/**
	 *
	 * vypise vsechny soubory ve slozce
	 *
	 */
	public static function getFiles()
	{
		if ($handle = opendir('assets/uploaded_images/')) 
		{
			echo "Directory handle: $handle\n";
			echo "Entries:\n";

			/* This is the correct way to loop over the directory. */
			while (false !== ($entry = readdir($handle))) 
			{
				echo "$entry, \n";
			}
			closedir($handle);
		}
	}

	private function getPercent($numero)
	{
		return $numero / 100;
	}

	private function getImagePath($ext)
	{
		$path = 'assets/uploaded_images/mini_'.$this->just_name.'.'.$ext;
		return $path;
	}
	private function getOriginalSize( $tmp_name )
	{
		if ( !empty($tmp_name) )
		{
			$size = getimagesize($tmp_name);
			$this->original_size['width'] = $size[0];
			$this->original_size['height'] = $size[1];
		}

		return $this->original_size;
	}

	private function getMime( )
	{
		$mime = getimagesize($this->tmp_name);
		$ext = explode( "/", $mime["mime"] );
		return $ext[1];
	}

	private function upload( $file )
	{
		move_uploaded_file($file["img"]["tmp_name"],
		self::UP_FOLDER . $file["img"]["name"]) or die("Přenášený obrázek nelze zkopírovat. ");
		//chmod( $name, 777 );		
	}

	public function uploadFile(  )
	{

		// Kdyz soubor existuje, neudela to nic
		if ( file_exists(self::UP_FOLDER . $this->name) )
		{
			echo "nic nedelam, protoze soubor existuje !!"; 			
		}
		else  // jinak soubor existuje, tak se zjisti, jestli je neco nastaveno, nebo ne.. 
		{
			// kdyz jsou nastaveny hodnoty sirka a vyska, provede resize => upload
			if( !empty( $this->new_size ) )
			{
				//$this->getImagePath();
				//$this->upload($this->file);
				$this->resize($this->file);
				return true;
			} 
			else // jinak se muze uploadovat jakakoliv velikost a provede upload
			{
				echo "test";
				$this->upload($this->file);
				return true;
			}
		}

		return false;
	}




}


?>