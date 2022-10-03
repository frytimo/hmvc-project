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
	use fusionpbx\core\db\driver\database_interface;

	/**
	 * Description of database
	 *
	 * @author Tim Fry <tim@voipstratus.com>
	 */
	class database {
		/**
		 * Connection to the database
		 * @var PDO
		 */
		private $driver;

		public function __construct(database_interface $driver) {
			$this->driver = $driver;
		}

		public function connect(string $host, int $port, string $dbname, string $user, string $pass) {
			$this->driver->connect($host, $port, $dbname, $user, $pass);
		}

		public static function new(int $index): database {
			$type = $_ENV['db'][$index]['type'];
			$host = $_ENV['db'][0]['host'];
			$port = $_ENV['db'][0]['port'];
			$name = $_ENV['db'][0]['name'];
			$user = $_ENV['db'][0]['user'];
			$pass = $_ENV['db'][0]['password'];
			$driver = 'fusionpbx\\core\\db\\driver\\'.$type;
			$database = new database(new $driver());
			$database->connect($host, $port, $name, $user, $pass);
			return $database;
		}

	}
