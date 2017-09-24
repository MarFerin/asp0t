<?php
	/* Define MySQL connection details and database table name */ 
	$SETTINGS["hostname"] = 'localhost';
	$SETTINGS["mysql_user"] = 'agarspot';
	$SETTINGS["mysql_pass"] = 'Halospartan1';
	$SETTINGS["mysql_database"] = 'loginInfo';
	$SETTINGS["USERS"] = 'AgarSpotUsers';

	/* Connect to MySQL */
	$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
	$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
?>