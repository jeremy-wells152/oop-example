<?php
require_once 'config.php';

function autoloader($className) {
	// Need to replace back slashes with forward slashes.
	$className = preg_replace('/[^A-z0-9_]/', '', $className);
	$file = str_replace('\\', '/', '/assets/php/' . strtolower($className) . '.php');

	if (file_exists($file)) {
		require_once $file;
	}
}
spl_autoload_register('autoloader');