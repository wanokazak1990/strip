<?php
class BaseConnect{
	
	public static function getDataBase(){
		$db = new PDO('mysql:host=localhost;dbname=two_continent', 'admin', 'admin');
		$db->query('SET CHARSET UTF8');
		return $db;
	}
}
?>
