<?php

	namespace fusionpbx\core;

	/**
	 * Description of env_loader
	 *
	 * @author Tim Fry <tim@voipstratus.com>
	 */
	/**
	 * Description of EnvLoader
	 *
	 * @author Tim Fry <tim@voipstratus.com>
	 */
	final class env_loader {

		private static $env;

		public static function load_env_file(string $directory) {
			if(file_exists($directory.'/.env')) {
				self::$env = self::load_text_file($directory.'/.env');
			}
		}

		public static function load_text_file($file) : string {
			$fileLen = filesize($file);
			if($fileLen > 0) {
				try {
					$handle = fopen($file, 'r');
					$contents = fread($handle, $fileLen);
				} catch (Exception $e) {
					return "";
				} finally {
					fclose($handle);
				}
				return $contents;
			}
		}

		public static function set_env(): void {
			if(strlen(self::$env)>0) {
				$lines = explode("\n",self::$env);
				foreach ($lines as $line) {
					$line = self::clean_line($line);
					if(strlen($line)>0) {
						$settings = explode('=', $line, 2);
						if(is_array($settings) && count($settings)>1) {				// check for valid assignment line
							$settings[0] = trim($settings[0]);
							$settings[1] = trim($settings[1]);

							if(strpos($settings[0], '.') !== false) {
								self::get_array($_ENV, $settings[0], $settings[1]);
							}
						}
					}
				}
			}
			return;
		}

		public static function clean_line(string $line): string {
			$line = trim($line);
			if(substr($line, 0, 1) === ';' || substr($line, 0, 1) === '#' || substr($line, 0, 1) === '//')
				return "";
			$parts = explode('//', $line, 2);			// strip any comments near eol
			if(gettype($parts) === 'array') {
				$line = $parts[0];
			}
			$parts = explode('#', $line, 2);
			if(gettype($parts) === 'array') {
				$line = $parts[0];
			}
			$parts = explode(';', $line, 2);
			if(gettype($parts) === 'array') {
				$line = $parts[0];
			}
			return trim($line);
		}

		public static function get_array(&$arr, string $parent, string $setting, string $path = ""): void {
			$keys = explode('.', $parent);
			foreach($keys as $key) {
				$arr = &$arr[$key];
			}
			$arr = $setting;
		}
	}

