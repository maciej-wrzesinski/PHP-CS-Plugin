<?php
	function mysql_escape_mimic($inp) {
		if(is_array($inp)) 
			return array_map(__METHOD__, $inp); 

		if(!empty($inp) && is_string($inp)) { 
			return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
		} 

		return $inp; 
	} 
	
	if(isset($_POST['ip']) && $_POST['ip'] != "" && isset($_POST['pl']) && $_POST['pl'] != "") { // Jeśli w ogóle coś się przesłało
		
		if(strpos($_SERVER['HTTP_USER_AGENT'], "Valve/Steam") === false){
			die('[1] This script can not be used like that');
		}
		
		$server_ip = mysql_escape_mimic($_POST['ip']);
		$plugin_id = mysql_escape_mimic($_POST['pl']);
		
		if(preg_match("/[a-z]/i", $server_ip)){
			die('[2] This script wants ONLY IPs!');
		}
		
		if(!preg_match('/^(\d+\.\d+\.\d+\.\d+):(\d+)$/', $server_ip)){
			die('[3] This script wants ONLY IPs!');
		}

        $SQL_HOSTNAME = "localhost";//DANE SQL
        $SQL_DATABASE = "csplugin";
        $SQL_USERNAME = "root";
        $SQL_PASSWORD = "";
        $SQL_TABLE = "csp_servers";
		
		$sql = mysqli_connect($SQL_HOSTNAME, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DATABASE) or die('[4] No database connection!');
		
		$query = "SELECT * FROM `".$SQL_TABLE."` WHERE ip='".$server_ip."' AND plugin_id='".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die('[5] No database connection!');
		
		if(mysqli_num_rows($result) == 1)
			die('OK');
		else
			die('IIIlIIIIllllIIIlIlIIllIIIlllIIl');
	}
	
	if(isset($_GET['ip']) && $_GET['ip'] != "" && isset($_GET['pl']) && $_GET['pl'] != "") { // Jeśli w ogóle coś się przesłało
		
		//if(strpos($_SERVER['HTTP_USER_AGENT'], "Valve/Steam") === false){
		//	die('[1] This script can not be used like that');
		//}
		
		$server_ip = mysql_escape_mimic($_GET['ip']);
		$plugin_id = mysql_escape_mimic($_GET['pl']);
		
		if(preg_match("/[a-z]/i", $server_ip)){
			die('[2] This script wants ONLY IPs!');
		}
		
		if(!preg_match('/^(\d+\.\d+\.\d+\.\d+):(\d+)$/', $server_ip)){
			die('[3] This script wants ONLY IPs!');
		}
		
		$SQL_HOSTNAME = "localhost";//DANE SQL
        $SQL_DATABASE = "csplugin";
		$SQL_USERNAME = "root";
		$SQL_PASSWORD = "";
		$SQL_TABLE = "csp_servers";
		
		$sql = mysqli_connect($SQL_HOSTNAME, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DATABASE) or die('[4] No database connection!');
		
		$query = "SELECT * FROM `".$SQL_TABLE."` WHERE ip='".$server_ip."' AND plugin_id='".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die('[5] No database connection!');
		
		if(mysqli_num_rows($result) == 1)
			die('OK');
		else
			die('IIIlIIIIllllIIIlIlIIllIIIlllIIl');
	}
	
	if(isset($_GET['ip']) && $_GET['ip'] != "") {
		
		if(strpos($_SERVER['HTTP_USER_AGENT'], "Valve/Steam") === false){
			die('[6] This script can not be used like that');
		}
		
		die('[7] No dude, we can not let you do that ;)');
	}
?>

