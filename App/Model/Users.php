<?php

namespace App\model;

class Users
{

	private $database;

	public function __construct( \Libs\Database\DB $db )
	{
		$this->database = $db;
	}


	public function getAll()
	{
		return $this->database->select('*')->table('Users')->run();
	}

	public function getByRole( $role )
	{
		return $this->database->select('*')->table('Users')->where('role =', $role )->run();
	}

	public function insertUser( $name, $pass, $email, $role )
	{
		return $this->database->insert( array( 	'name'  => $name, 
												'pass'  => $pass, 
												'email' => $email, 
												'role'  => $role ) )->table('Users')->run();
	}
}