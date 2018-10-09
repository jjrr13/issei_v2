<?php 
	// session_start();
	// $ip= $ipcasa="192.168.0.105";
	// $ip= $ipcu1="192.168.0.200";
	$ip= $ipcu1="192.168.0.85";
	// $ip= $ipsiessa="192.168.1.74";
	// $ip= $ipsiessa="192.168.1.54";

	
	$puerto="8000";

	// $ip='172.16.9.20';
	
	define('SOCKET_BACKEND_PORT', $puerto);
	define('SOCKET_BACKEND_IP', $ip);
	define('SOCKET_FRONTEND', "$ip:$puerto");
	define('URL_BASE', 'http://$ip/issei/');

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'avalos12');
	define('DB_NAME', 'tutoriales_chat');
	define('DB_CHARSET', 'utf8');
?>