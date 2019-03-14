<?
class Connection{
	public static function connect(){
		$host = '127.0.0.1';  
		$user = "hellscripts";                     
		$pass = "hellscripts";                             
		$db = "hellscripts";                      
		$port = 3306;                           
		
		$connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
		return $connection;
	}
	public static function close($connection){
		mysqli_close($connection);
	}
}