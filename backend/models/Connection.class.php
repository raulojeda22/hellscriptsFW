<?
class Connection{

	private static function getSettings(){
		return parse_ini_file(dirname(__FILE__).'/config/DB.ini');;
	}

	public static function connect(){
		$settings = self::getSettings();                       
		$connection = mysqli_connect($settings['host'], $settings['user'], 
		$settings['pass'], $settings['db'], $settings['port'])or die(mysql_error());
		return $connection;
	}
	public static function close($connection){
		mysqli_close($connection);
	}
}