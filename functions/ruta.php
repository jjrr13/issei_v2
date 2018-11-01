<?php 
	// session_start();
	// $ip= $ipcasa="192.168.0.105";
<<<<<<< HEAD
	$ip= $ipcu1="192.168.0.200";
	// $ip= $ipsiessa="192.168.1.54";
=======
	// $ip= $ipcu1="192.168.0.200";
	$ip= $ipcu1="192.168.0.85";
	// $ip= $ipsiessa="192.168.1.74";
	// $ip= $ipsiessa="192.168.1.54";

>>>>>>> 8ba4c6413a0b38182368377e78873497c321586c
	
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