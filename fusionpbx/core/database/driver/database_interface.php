<?php

	namespace fusionpbx\core\database\driver;

	interface database_interface {
		public function connect(string $host, int $port, string $dbname, string $user, string $pass);
		public function list_tables(): array;
		public function list_column_names(string $table_name): array;
		public function is_connected(): bool;
	}