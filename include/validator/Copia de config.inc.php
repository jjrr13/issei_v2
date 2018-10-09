<?php
	session_start();
	$url				  = "http://localhost/vikosys";
	$separador            = "\\";
	
	$path				  = "C:\xampp\htdocs\vikosys";
	$pathIncludes		  = $path .$separador."include";
	$pathJs				  = $pathIncludes . $separador."validator";
	$pathLibs			  = $pathJs .$separador."libs";
	$pathCaptcha		  = $pathLibs .$separador."crypt";	
	$pathSite			  = $path .$separador. "sites";
	
	$httpInclude		  = "$url/include";
	$httpJs 			  = "$httpInclude/validator";
	$httpLibs 			  = $httpJs . "/libs";	
	$httpListDependientes = $httpLibs . "/listDependientes";
	$httpCaptcha		  = $httpLibs . "/crypt";
	$httpSite			  = $url . "/sites";

	//modifique esta informacion dependiendo de su proyecto
	include_once("$path\Connections\cx.php"); 
	mysql_select_db($database_cx, $cx);
?>