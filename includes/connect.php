<?php 
require("constants.php");
$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if(!$connection){
	die ("unable to connect to page");
}
$db = mysql_select_db(DB_NAME, $connection);
if (!$db){
	die ("unable to connect to database");
}
?>