<?php
	include_once("config.inc.php");	

	include_once("$pathLibs/xajax/xajax.inc.php"); //Ruta del xajax
	include_once("FormChecker.class.php"); //Ruta del validator
	include_once("campos.php");
	include_once("$pathCaptcha/cryptographp.fct.php");
	############################################################################################
	#
	#								Funcion validar
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Funcion que escribe la accion del campo con los parametros requeridos para su
	#			  validacion
	# Fecha de realizacion: 15 Marzo de 2006
	# Ultima fecha de modificacion: 08 Abril de 2006
	#
	# - Se agrego el parametro 'enveto'
	############################################################################################
			 
	function validar($campo, $tipoCampo, $span, $obligatorio='true', $carateresEspeciales = '', $evento = 'onBlur', $submit = ''){
		$temp = " $evento=\"xajax_campoComun(document.getElementById('$campo').value,'$campo','$tipoCampo','$span', '$obligatorio', '$carateresEspeciales', '$submit');";
		
		if($campo == 'predial'){
		$temp .= "xajax_predial('predial_unico', this.value)";
		}elseif($campo == 'catastral'){
		$temp .= "xajax_predial(this.name, this.value)";
		}elseif($campo == 'cc_nit'){
		$temp .= "xajax_predial(this.name, this.value)";
		}elseif($campo == 'propietario'){
		$temp .= "xajax_predial(this.name, this.value)";
		}
		
		$temp .= ' "" ';		
		
		if($obligatorio){
			$temp .= " required='1'";
		}else{
			$temp .= " required='0'";
		}
		return $temp;
	}
		
	############################################################################################
	#
	#								Funcion archivo
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Funcion que escribe la accion del campo de tipo archivo con los parametros requeridos 
	#			  para su validacion. vease la funcion 'subirArchivo' en function.inc.php
	# Fecha de realizacion: 26 Marzo de 2006
	# Ultima fecha de modificacion: 26 Marzo de 2006
	############################################################################################
	
	function archivo($campo, $span){
		echo " onChange=\"xajax_subirArchivo(document.getElementById('$campo').value,'$span');\"";
		
		echo " required='0\'";
	}

	############################################################################################
	#
	#								Funcion comparar
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Funcion que escribe la accion para comparar dos campos
	# Fecha de realizacion: 7 Abril de 2006
	# Ultima fecha de modificacion: 9 Abril de 2006
	# 
	# - Se cambio el evento de onChange a onKeyPres
	############################################################################################
	
	function comparar_campos($campo1, $campo2, $tipoCampo = "texto", $span, $carateresEspeciales = ""){
		return " onKeyUp=\"xajax_comparar(document.getElementById('$campo1').value, document.getElementById('$campo2').value, '$campo2', '$tipoCampo', '$span', '$carateresEspeciales');\"";
	}
	
	############################################################################################
	#
	#								Funcion verificar
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Funcion que escribe la accion del campo con los parametros requeridos para su
	#			  verificacion en la base de datos
	# Fecha de realizacion: 11 Abril de 2006
	# Ultima fecha de modificacion: 11 Abril de 2006
	############################################################################################
			 
	function verificar_registro($campo, $tabla, $campo_tabla, $span, $sql='', $evento = 'onBlur'){
		return " $evento=\"xajax_verificar(document.getElementById('$campo').value,'$campo','$tabla','$campo_tabla','$span', '$sql');\"";
	}
?>