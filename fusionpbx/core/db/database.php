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

	namespace fusionpbx\core\db;

	/**
	 * Description of database
	 *
	 * @author Tim Fry <tim@voipstratus.com>
	 */
	abstract class database {
		/**
		 * Connection to the database
		 * @var PDO
		 */
		protected $connection;

		abstract public function get_connection();
		abstract public function connect();
		abstract public function select();

		public static function new(int $index): database {
			$type = $_ENV['db'][$index]['type'];
//			$current_dir = __DIR__;
//			include($type. '.php');
			$database = new $type();
			$database->connect();
			return $database;
		}
	}
