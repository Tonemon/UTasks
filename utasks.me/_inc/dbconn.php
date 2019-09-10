<?php
$serverName = "localhost";
$db_username = "UTasks";
$db_password = "UTasks";
mysql_connect($serverName,$db_username,$db_password)/* or die('the website is down for maintainance')*/;
// no mysql_select_db($dbname), because two databases are connected to the same user (UNotesDAT & UNotesMAIN)
?>