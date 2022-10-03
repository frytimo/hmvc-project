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

	namespace fusionpbx\core\db\driver;

	use fusionpbx\core\db\driver\database_interface;

	/**
	 * Description of postgresql
	 *
	 * @author Tim Fry <tim@voipstratus.com>
	 */
	class pgsql implements database_interface {

		public function __construct() {
//
		}

		public function connect(string $host, int $port, string $dbname, string $user, string $pass) {
			$dsn = "pgsql:host=$host port=$port dbname=$dbname user=$user password=$pass";
			$this->connection = new \PDO($dsn);
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		public function list_tables(): array {

		}

		public function list_column_names(string $table_name): array {

		}

		public function is_connected(): bool {
			
		}

	}
