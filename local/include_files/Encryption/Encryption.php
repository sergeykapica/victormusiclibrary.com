<?
	namespace EncryptionScope;
	
	class Encryption
	{
		private static $salt = 'Kolya30041962';
		
		public static function GetEncryptedString($str)
		{
			for($i = 0; $i < 100; $i++)
			{
				$str = md5($str . self::$salt);
			}
			
			return $str;
		}
		
		public static function GetGeneratedCode($length)
		{
			$words = range('A', 'Z');
			$integers = range(0, 9);
			$symbols = array_merge($words, $integers);
			$encryptString = '';

			for($i = 0; $i <= $length; $i++)
			{
				$encryptString .= $symbols[rand(0, ( count($symbols) - 1))];
			}
			
			return $encryptString;
		}
	}
?>