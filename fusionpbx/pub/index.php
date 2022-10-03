<?php
	/*
  FusionPBX
  Version: MPL 1.1

  The contents of this file are subject to the Mozilla Public License Version
  1.1 (the "License"); you may not use this file except in compliance with
  the License. You may obtain a copy of the License at
  http://www.mozilla.org/MPL/

  Software distributed under the License is distributed on an "AS IS" basis,
  WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
  for the specific language governing rights and limitations under the
  License.

  The Original Code is FusionPBX

  The Initial Developer of the Original Code is
  Mark J Crane <markjcrane@fusionpbx.com>
  Portions created by the Initial Developer are Copyright (C) 2018 - 2019
  the Initial Developer. All Rights Reserved.

  Contributor(s):
  Mark J Crane <markjcrane@fusionpbx.com>
  Tim Fry <tim@voipstratus.com>
 */

// Main entry point

	namespace fusionpbx\pub;
	
	use fusionpbx\core\env_loader;
	use fusionpbx\core\db\database;
	
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
