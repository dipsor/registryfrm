<?php

if (! is_file( ROOT_DIR . '/Libs/Autoloading/AutoloadFactory.php' ) ) {
	echo ROOT_DIR . '/Libs/Autoloading/AutoloadFactory.php is missing<br>';
	die ('Framework is expected in directory ' . __DIR__ . '/Libs but not found. Check if the path is correct or edit file ' . __FILE__ . '.');
}

require ( ROOT_DIR . '/Libs/Autoloading/AutoloadFactory.php' );
