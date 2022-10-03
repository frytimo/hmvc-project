<?php


	namespace fusionpbx\core\database\driver;

	use fusionpbx\core\database\driver\database_interface;

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
