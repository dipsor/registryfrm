<?php

namespace Libs\Exceptions;

class FileException extends \Exception
{
	public function exceptionMessage()
	{
		printf("<h2>Vyhozena FileException vynimka</h2><pre>%s<br>V souboru: %s<br>Na radku: %s<br>Trace: %s<br></pre>",$this->getMessage(), $this->getFile(), $this->getLine(), $this->getTraceAsString());
	}
}