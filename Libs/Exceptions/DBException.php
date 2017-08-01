<?php

namespace Libs\Exceptions;

class DBException extends \Exception
{
	public function exceptionMessage()
	{
		printf("<h2>Vyhozena DBException vynimka</h2><pre>%s<br>V souboru: %s<br>Na radku: %s<br>Trace: %s<br></pre>",$this->getMessage(), $this->getFile(), $this->getLine(), $this->getTraceAsString());
	}
}