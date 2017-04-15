<?php
class fsy{
	function __construct() {
		require_once "server_config.php";
		$link = mysql_connect($HOST,$USER,$PASSWORD);
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db($DBNAME, $link)or die(mysql_error());
	}
	function suspend(){
		mysql_query("UPDATE system set cd_status=0");
	}
	function set_aktif(){
		mysql_query("UPDATE system set cd_status=1");
	}
}
?>