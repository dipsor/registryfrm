<?php

namespace Libs\Form;

class Form 
{
	
	/** @var [type] [predstavuje prvky formulare] */
	private $type;
	
	/** @var [type] [ nazev formulare, pouzije se k vygenerovani id html ] */
	private $name;

	/** @var [type] [ 	nazev akce ve formu <form action="$actionName"
						zadavase i s presenterem ] */
	private $actionName;
	
	/** @var [type] [ uskladnuje formular jako string ] */
	private $form;


	/**
	 * konstruktor, jako parametr je nazev formulare.
	 */
	public function __construct( $name, $action )
	{
		$this->name = $name;
		$this->actionName = $action;
	}


	/**
	 * [getActionName description]
	 * @return [type] [description]
	 */
	public function getActionName()
	{
		return $this->actionName;
	}

	/**
	 * return $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * return $type
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * vygeneruje string pri id html elementu
	 */
	public function getIdString( $string )
	{
		return 'form-'.$string;
	}
	
	/**
	 * vytvori input textu, nastavi label, name, rules
	 * a vlozi do atributu $type
	 */
	public function addText( $label, $name , array $rules = null)
	{
		$this->type['label'] = "<tr><td><label for='{$name}'>{$label}</label></td>";
		$this->type['name']  = "<td><input class='form-control' id='focusedInput' type='text' name='{$name}'  
								value='{$label}'></td></tr>";
		$this->type['inputname'] = $name;
		$this->type['rules'] = $rules;

		return $this->type;
		
	}

	/**
	 * vytvori input textarea, nastavi label, name, rules
	 * a vlozi do atributu $type
	 */
	public function addTextArea( $label, $name, array $rules = null )
	{
		$this->type['label'] = "<tr><td><label for='{$name}'>{$label}</label></td>";
		$this->type['name']  = "<td><textarea cols ='50' rows='4' name='{$name}' id='{$this->getIdString($this->getName())}'>{$label}</textarea></td></tr>";
		$this->type['inputname'] = $name;
		$this->type['rules'] = $rules;

		return $this->type;

	}

	/**
	 * vytvori input file, nastavi label, name, rules
	 * a vlozi do atributu $type
	 */
	public function addFile( $label, $name, array $rules = null )
	{
		$this->type['label'] = "<tr><td><label for='{$name}'>{$label}</label></td>";
		$this->type['name']  = "<td><input type='file' name='{$name}' id='focusedInput' class='form-control filestyle' data-classButton='btn btn-primary'></td></tr>";
		$this->type['inputname'] = $name;
		$this->type['rules'] = $rules;

		return $this->type;

	}

	/**
	 * prida do pole $type
	 */
	public function addSubmit( $label, $name, $size, $styleType )
	{
		$this->type['label'] = "<tr><td></td>";
		$this->type['name']  = "<td><input type='submit' name='$name' class='btn btn-{$size} btn-{$styleType}' value='{$label}'></td></tr>";
		$this->type['rules'] = NULL;
		$this->type['inputname'] = $name;


		return $this->type;
	}

	/**
	 * vygeneruje formular 
	 */
	public function renderForm($form)
	{

		echo "<form id='{$this->getIdString($this->getName())}' action='' method='post' enctype='multipart/form-data'><table id='form-edit'>\r\n";
		
 		foreach ($form as  $value) 
 		{
 			echo $value['label'] . "\r\n";
 			echo $value['name'] . "\r\n";
 		}

 		echo "</table></form>\r\n";

	}

	public function getForm( $form )
	{
		$this->form = "<form id='{$this->getIdString($this->getName())}' action='{$this->actionName}' method='post' enctype='multipart/form-data'><table id='form-edit'>\r\n";

		
		foreach ($form as  $value) 
		{
			$this->form .= $value['label'] . "\r\n";
			$this->form .= $value['name'] . "\r\n";
		}

		$this->form .= "</table></form>\r\n";

		return $this->form;
	}





}



?>