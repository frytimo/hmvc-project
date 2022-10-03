<?php

// Main entry point

	namespace fusionpbx\pub;
	
	use fusionpbx\core\env_loader;
	use fusionpbx\core\database\database;
	
	error_reporting(E_ALL);

	$dirname = dirname(__DIR__);
	$auto_loader = $dirname.'/vendor/autoload.php';
	include $auto_loader;
	

// put .env file in to $_ENV global namespace
	env_loader::load_env_file($dirname);
	env_loader::set_env();

//	$pgsql = new \fusionpbx\core\db\postgres();
	$database = database::new(0);
	
	echo "";
