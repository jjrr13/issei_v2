<?php
	// @session_set_cookie_params('0');
	// ini_set("session.gc_maxlifetime", 12000);
	// session_start();


	$url				  = "http://192.168.0.200/issei_v2";
	// $url				  = "http://192.168.1.54/issei_v2";
	// $url				  = "http://192.168.0.103/issei_v2";
	$separador            = "\\";
	
	$path				  = "C:\\xampp\htdocs\\issei_v2";
	$pathIncludes		  = $path ."\\include";
	$pathJs				  = $pathIncludes . "\\validator";
	$pathLibs			  = $pathJs . "\\libs";
	$pathCaptcha		  = $pathLibs . "\\crypt";	
	$pathSite			  = $path . "\\sites";
	
	$httpInclude		  = "$url/include";
	$httpJs 			  = "$httpInclude/validator";
	$httpLibs 			  = $httpJs . "/libs";	
	$httpListDependientes = $httpLibs . "/listDependientes";
	$httpCaptcha		  = $httpLibs . "/crypt";
	$httpSite			  = $url . "/sites";

	//ruta de archivos
	$pathTemp			  = 'C:\\xampp\htdocs\issei_v2\registro\temp\\';
	$httpTemp			  = "$url/registro/temp/";
	
	$pathLiquidaciones	  = 'C:\Curaduria Urbana V2\LIQUIDACIONES\\';
	$pathLicencias		  = 'C:\Curaduria Urbana V2\LICENCIAS\\';
	$pathExpensas		  = 'C:\Curaduria Urbana V2\EXPENSAS\\';
	$pathFacturacion	  = 'C:\Curaduria Urbana V2\FACTURAS\\';
	$pathActas	  	  = 'C:\Curaduria Urbana V2\ACTAS\\';
	$pathActasCumplimiento	  	  = 'C:\Curaduria Urbana V2\ACTAS_CUMPLIMIENTO\\';
	$pathAportados	  	  = 'C:\Curaduria Urbana V2\DOC_APORTADOS\\';
    
	$httpLiquidaciones	  = $url.'/LIQUIDACIONES/';
	$httpLicencias		  = $url.'/LICENCIAS/';
	$httpExpensas		  = $url.'/EXPENSAS/';
	$httpFacturacion	  = $url.'/FACTURAS/';
	$httpActas	  	  = $url.'/ACTAS/';
	$httpActasCumplimiento	  	  = $url.'/ACTAS_CUMPLIMIENTO/';
    $httpAportados	  	  = $url.'/DOC_APORTADOS/';
	//modifique esta informacion dependiendo de su proyecto
	include_once("$pathIncludes\\funciones.inc.php"); 
	
	include_once("$path\cx\cx.php"); 
	// mysql_select_db($database_cx, $cx);
?>