<?php

namespace Libs\Form;

/**
 * Trida validator, pri vytvoreni instance je argumentem $_POST.
 * Metoda validate() ma jako argument inputy formularovy, s nastavenyma pravidlama,  
 * odfiltruje pravidla , zjisti, jestli existujou a zavola prislusny metody. 
 * Form::addText('label','name', array( 'rule1' => 'value', 'rule2' => 'value', ... ));
 * Form::addTextarea('label','name', array( 'rule1' => 'value', 'rule2' => 'value', ... ));
 * Form::addText('label','name', array( 'rule' => 'value' ));
 *   
 * U pravidla file se musi jako hodnata dat pole pravidel pro file input
 *   
 * Form::addFile( 'label', 'name', array( 'file' => array( 'file' => 'image/', 'size' => cislo )));   
 * u pravidla 'file' funguje jen hodnota 'image'.  
 *   
 */
class Validator 
{

	/**
	 * Regular expression used to match email addresses.
	 * Stored as string using Perl-compatible (PCRE) syntax.
	 * Final i represents a case-insensitive pattern
	 * 
	 * @link http://www.regular-expressions.info  
	 */
	const REGEX_EMAIL       = '/^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	const REGEX_ALPHA       = '/^[A-Z.]+$/i';
	const REGEX_ALPHA_NUM   = '/^[0-9._+-]+$/i';
	const REGEX_FILE        = '/^[^\s]+(\.(?i)(jpe?g|png|gif|bmp))$/';

	/**
	 * 
	 */
	private $formData;
	private $file;
	private $rules = array( 'required', 'email', 'number', 'letter', 'length', 'file' );
	private $fileRules = array( 'image', 'size' );
	private $errorMessage = array();
	private $imageExtensions = array( 'jpg','jpeg','JPG','JPEG','PNG','png','gif', null );
	
	/**
	 * plni se daty odeslanymi z formulare a souborem, 
	 * a provede se sanitize na soubory z formulare
	 */
	public function __construct( $data, $file = null )
	{
		$this->formData = $this->sanitize( $data );
		if ( $file !== null ) {
			$this->file     = $file;
		}
	}

	public function setMessage($message)
	{
		$this->errorMessage[] = $message;
	}

	public function getMessage()
	{
		return $this->errorMessage;
	}

	/**
	 * 
	 */
	private function sanitize($formData ) 
	{
	    $sanitizedData = filter_var_array($formData, FILTER_SANITIZE_STRING);
	 
	    // Return the sanitized datas
	    return $sanitizedData;
	}

	/**
	 *
	 * zajisti nutne vyplneni inputu, zjisti, 
	 * jestli se rule vztahuje na input, nebo soubor,
	 * jestlize je pole nevyplnene, nastavi chybovou hlasku metodou setMessege()
	 * 
	 */	
	private function form_rule_required( $inputName, $ruleValue )
	{
		if ( !array_key_exists( $inputName, $this->formData ) )
		{
			if ( array_key_exists( $inputName, $this->file ) )
			{
				if (strlen( $this->file[$inputName]['name'] == 0 ))
				{
					$this->setMessage("--pole <strong>".$inputName."</strong> musis vlozit obrazek </br>");
				}
			}
		} 
		else 
		{
			if ( strlen($this->formData[$inputName]) == 0 )
			{
				$this->setMessage("--pole <strong>".$inputName."</strong> musi byt vyplnene </br>");		
			} 	
		}

	}
	

	private function form_rule_email( $inputName, $ruleValue )
	{
		if ( !preg_match(self::REGEX_EMAIL, $this->formData[$inputName]) ) 
		{
			$this->setMessage("--pole <strong>".$inputName."</strong> nema zadany platny Email (". $this->formData[$inputName] .").</br>");
		}
	}

	private function form_rule_number( $inputName, $ruleValue )
	{
		if ( !preg_match(self::REGEX_ALPHA_NUM, $this->formData[$inputName]) ) 
		{
			$this->setMessage("--pole <strong>".$inputName."</strong> nema zadano cislo (". $this->formData[$inputName] .").</br>");
		}	
	}

	private function form_rule_letter( $inputName, $ruleValue )
	{
		if ( !preg_match(self::REGEX_ALPHA, $this->formData[$inputName]) ) 
		{
			$this->setMessage("--pole <strong>".$inputName."</strong> nema zadana nez pismena (". $this->formData[$inputName] .").</br>");
		}
	}

	private function form_rule_length( $inputName, $ruleValue )
	{
		if ( strlen($this->formData[$inputName]) < $ruleValue ) 
		{
			$this->setMessage("--pole <strong>".$inputName."</strong> ma retezec prilis kratky ( ".strlen($this->formData[$inputName]). ") | Musi mit alespon $ruleValue znaku</br>");
		}
	}

	/**
	 *
	 * proscanuje pravidla pro uplodovani souboru a zavola prislusne metody
	 * form_rule_file_image - overi zda obrazek je podporovaneho formatu
	 * form_rule_file_size - overi zda velikost obrazku neni vetsi, nez povolena
	 */
	private function form_rule_file( $inputName, $ruleValue )
	{
		if( is_array($ruleValue) && !empty($ruleValue) )
		{
			foreach ($ruleValue as $key => $value) {
				if (in_array( $key, $this->fileRules ))
				{
					call_user_func_array('self::form_rule_file_'.$key, array( $inputName, $value ) );
				}
				else
				{
					throw new Valid_Exception("'".$key."' ". "Pravidlo pro uploadnuti obrazku neexistuje", 1);					
				}
			}
		}
		else 
		{
			$this->findRules( $inputName, $ruleValue );
		}
	}			

	private function get_extension($name = null)
	{
		if ( !empty($name) )
		{
			$extension = explode( ".", $name );
			$lastItem = ( count($extension) - 1 );
			return $extension[$lastItem];
		}
	}

	private function form_rule_file_image ( $inputName , $ruleValue )
	{
 		$extension = $this->get_extension( $this->file[$inputName]['name'] );
 		if ( !in_array( $extension, $this->imageExtensions) )
 		{
 			$this->setMessage("--pole <strong>".$inputName."</strong> nepodporuje danny typ souboru ($extension)</br>");
 		}
	}	

	private function form_rule_file_size ( $inputName , $ruleValue )
	{
		if ( $this->file[$inputName]['size'] > $ruleValue )
		{
 			$this->setMessage("--pole <strong>".$inputName."</strong> ma vlozeny prilis velky obrazek, max - $ruleValue B</br>");			
		}

	}	

	public function printMessage( )
	{
		$messages = $this->getMessage();
		foreach ($messages as $key) {
			echo $key;
		}			
	}

	/**
	 *
	 * metoda projede pole s chybovyma hlaskama, kdyz je pole prazdny, 
	 * vrati true. jinak false
	 * 
	 */
	public function validate( $form )
	{
		foreach ($form as $key) {
			if ( $key['inputname'] != 'submit')
			{
				$this->findRules($key['inputname'], $key['rules']);
			}
		}
		$messages = $this->getMessage();
		
		if ( !empty($messages) )
		{
			//$this->printMessage( $this->getMessage() );
			return false;
		} 
		else
		{
			//echo "<span style='color:cyan'>validace prosla</span></br>";
			return true;
		}
	}

	/**
	 * proscanuje pravidla k inputum a zjisti jejich existenci 
	 */
	public function findRules( $inputName, $rules = null )
	{
		if ( $rules != null )
		{
			foreach ( $rules as $key => $value ) {
				if ( in_array( $key, $this->rules ) && $value != null )
				{
					call_user_func_array('self::form_rule_'.$key, array( $inputName, $value ) );
				}
				else 
				{
					throw new Valid_Exception("Neexistujici pravidlo", 1);
					
				}
			}	
		}
		
	}	





}
