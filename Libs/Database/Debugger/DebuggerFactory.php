<?php

namespace Libs\Database\Debugger;

class DebuggerFactory {

	public static function createDebugger( $mode )
	{
		switch ( $mode ) {
			case 'echo':
				return new \Libs\Database\Debugger\EchoDebugger();
				break;
			case 'log':
				# code...
				break;
			case 'void':
				# code...
				break;
			case 'echolog':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
}