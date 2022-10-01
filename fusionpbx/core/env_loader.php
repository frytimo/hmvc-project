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

