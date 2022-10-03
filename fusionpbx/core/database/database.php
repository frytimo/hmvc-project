<?php

	namespace fusionpbx\core\database;
	use fusionpbx\core\database\driver\database_interface;

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
			$driver = 'fusionpbx\\core\\database\\driver\\'.$type;
			$database = new database(new $driver());
			$database->connect($host, $port, $name, $user, $pass);
			return $database;
		}

		public function select(string $sql, array $params): array {
			$this->driver->prepare($sql);

		}

	}
