<?
/**
 * Used to manage a connection to a database
 */
class Connection{

	/**
	 * Gets the database configuration to establish a connection
	 *
	 * @return array settings
	 */
	private static function getSettings(){
		return parse_ini_file(dirname(__FILE__).'/config/DB.ini');;
	}

	/**
	 * Connects to the database
	 *
	 * @return object mysqli_connect
	 */
	public static function connect(){
		$settings = self::getSettings();                       
		$connection = mysqli_connect($settings['host'], $settings['user'], 
		$settings['pass'], $settings['db'], $settings['port'])or die(mysql_error());
		return $connection;
	}

	/**
	 * Closes the connection to the database
	 *
	 * @param object $connection
	 * @return void
	 */
	public static function close($connection){
		mysqli_close($connection);
	}
}