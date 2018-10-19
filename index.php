<?php
	define("LOAD_TYPE", "basic");
	session_start();
	// Include all files
	include 'autoload.php';

	$app = new Application($config); // Start application using configuration
?>