<?php

class DBS
{
	public function __construct()
	{
		echo 'DBS<br>';
	}
	private function getAllTables()
	{
		$result = $this->conn->query("show tables");
		return $result->fetch(\PDO::FETCH_NUM);
	}

	protected function getTableName()
	{
		$table = explode('\\', get_class($this));
		return $table[ count($table) - 1 ];

	}

	private function isTable($tableName)
	{
		if ( in_array( $tableName, $this->getAllTables() )) {
			return true;
		} else {
			throw new \Libs\Exceptions\DBException("Tabulka: <strong>". $tableName."</strong> neni v databazi ", 1);       			
		}		
	}

	public function getTable($tableName = 'this')
	{
		if ( $tableName == null ) {
			$tableName = 'this';
		}
		
		if ( $tableName == 'this' ) {
			if( $this->isTable( $this->getTableName() ) ) {
				$this->query = sprintf("SELECT * FROM %s ", $this->getTableName() );
			}

		} elseif ( $this->isTable( $tableName ) ) {
			$this->query = sprintf("SELECT * FROM %s ", $tableName );
		}

		return $this;
	}

	public function where($key, $value)
	{
		if ( !empty($this->query) ) {
			$this->query .= " where $key='$value'";
		}

		return $this;
	}

	public function limit()
	{

	}

	public function fetch()
	{
		

	}