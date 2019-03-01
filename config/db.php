<?php
	//SQL
	$SQL_HOSTNAME = "localhost";
	$SQL_DATABASE = "csplugin";
	$SQL_USERNAME = "root";
	$SQL_PASSWORD = "";
	
	$TABLE_PLUGINS = "csp_plugin";
	$TABLE_AUTHORS = "csp_authors";
	$TABLE_SERVERS = "csp_servers";
	$TABLE_LICENSES = "csp_licenses";
	$TABLE_USERS = "csp_users";
	$TABLE_HELPDESK = "csp_helpdesk";
	
	$sql = mysqli_connect($SQL_HOSTNAME, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DATABASE) or die("Did not connect".mysqli_connect_error());

	//fix for the polish letters
	$result = mysqli_query($sql, "SET NAMES UTF8;") or die("Connection error".mysqli_error($sql));
?>
