<?php

namespace Libs\Database\Debugger;

class EchoDebugger implements \Libs\Database\Debugger\Idebugger {

	public function __contruct()
	{
		echo "EchoDebugger<br>";
	}

	public function debug( $message, $input = null )
	{
		echo "<font color='red'>" . $message . "</font><br>";

		if ( $input != null ) {
			echo "<pre>";
			if ( is_array( $input ) ) {
				print_r( $input, 1 );
			} else {
				var_dump( $input );
			}
			echo "</pre>";	
		} else {
			echo "empty input<br>";
		}
	}

}