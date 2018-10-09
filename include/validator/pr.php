<?php
	//require("config.inc.php");
	ini_set("session.cache_expire", "100000800");
	ini_set("session.gc_maxlifetime", "100000800");
	echo "Es ".session_cache_expire();
?>