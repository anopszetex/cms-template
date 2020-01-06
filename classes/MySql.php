<?php  

	class MySql {

		private static $pdo;

		public static function connect() {
			if(is_null(self::$pdo)) {
				try {
					self::$pdo = new PDO('mysql:host=localhost;dbname=projeto_sms;charset=utf8;', 'root', '');
				} catch (Exception $ex) {
					die('Erro ao Conectar');
				}
			}

			return self::$pdo;
		}

	}



?>