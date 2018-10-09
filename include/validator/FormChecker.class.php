<?php
	

	$by      = "Andres Julian Rodriguez";
	$correo  = "webmaster@3creatives.com";
	$web     = "www.3creatives.com";
	$fecha   = "Junio de 2005";
	$name    = "FormChecker";
	$version = "1.0";
	$error   = " Error: ";
	$vectorErrores = array();
	
	if(!isset($uniSpan)){
		//se mostrara los errores en el span enviado por parametro
		$uniSpan = 0; 
	}
	if(!isset($nombre_boton)){
		//nombre del boton del formulario para deshabilitarlo
		$nombre_boton = 'Submit'; 
	}
	
	//patrones para comparacion
	$patronAlfabetico   = "^[[:alpha:]ñÑ[:space:]áéíóúÁÉÍÓÚ";
	$patronNumerico	    = "^[[:digit:]";
	$patronAlfanumerico = "^[[:alpha:]ñÑ.#-.()[:space:][:digit:]()áéíóúÁÉÍÓÚ";
	$patronCorreo		= "^[[:alpha:][:digit:]._-]+@[[:alpha:][:digit:]_]{3,}.[[:alpha:].";
	//estilo cuando hay un error en el campo
	//$estiloError;
	//estilo cuando no hay error en el campo
	//$estiloOk;

	//archivo de mensajes
	if(isset($FormChackerMsjIdioma) && $FormChackerMsjIdioma == 'EN'){
		include_once('FormChackerMsjEN.inc.php');
	}else{
		include_once('FormChackerMsjES.inc.php');
	}
	############################################################################################
	#
	#								Metodo FormChecker
	#							-----------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo constructor de la clase inicializa los atributos error
	#			  y ok, que almacenan el nombre de la class css a utilizar
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecah de modificacion: 8 Junio de 2005
	############################################################################################
	/*
	function FormChecker($error = "error", $ok = "bien"){
		$this->estiloError = $error;
		$this->estiloOk    = $ok;
		$this->error       = "<b>".$this->name."</b>".$this->error;
	}
	*/
	############################################################################################
	#
	#								Metodo campoComun
	#							-----------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo utilizado para direccionar los campos segun el tipo
	#			  de campo enviado por parametro
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 15 Marzo de 2006
	# Modificacion: - se agrego el campo fecha
	#				- se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	
		function campoComun($contenido, $campo, $tipoCampo, $span, $obligatorio, $carateresEspeciales, $submit){
		$objResponse = new xajaxResponse();
 		$obligatorio = TRUE;
		$carateresEspeciales = '';
		$submit = '';
		
		switch($tipoCampo){
			case "texto"       : CampoAlfabetico($contenido, $campo, $span, $objResponse, $obligatorio, $carateresEspeciales); 
			break;
			case "numerico"    : CampoNumerico($contenido, $campo, $span, $objResponse, $obligatorio, $carateresEspeciales); 
			break;
			case "alfanumerico": CampoAlfanumerico($contenido, $campo, $span, $objResponse, $obligatorio, $carateresEspeciales); 
			break;
			case "correo"      : CampoCorreo($contenido, $campo, $span, $objResponse, $obligatorio); 					  
			break;
			case "fecha"	   : CampoFecha($contenido, $campo, $span, $objResponse, $obligatorio);						  
			break;
			default	           : $objResponse->addAlert($GLOBALS['errorTipoCampo']);
		}
		
		if(!empty($submit)){
			$objResponse->addAssign($submit, "disabled", false);
		}
		return $objResponse->getXML();
	}
	
	############################################################################################
	#
	#								Metodo EliminarEspacios
	#							-----------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que elimina espacios al comienzo y al final de una
	#			  cadena, el valor que retorna es la nueva cadena sin espacios
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecah de modificacion: 8 Junio de 2005
	############################################################################################

	function EliminarEspacios($temp){
		return trim($temp); 
	}
	
	############################################################################################
	#
	#								Metodo AgregarError
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que agrega al final de vector de errores la descripcion
	#			  del error, y utiliza como indice del vector el nombre del campo
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecah de modificacion: 8 Junio de 2005
	############################################################################################
	
	function AgregarError($indice, $texto){
		global $vectorErrores;
		$texto = sprintf($texto, $indice);
		$vectorErrores[$indice] = $texto;
		return getError();
	}
	
	############################################################################################
	#
	#								Metodo BorrarError
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que clarea el contenido de un indice del vector de errores,
	#			  el indice no se elimina del todo para que la visualizacion de los errores
	#			  sea el orden de los campos	
	# Fecha de realizacion: 20 Marzo de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2005
	############################################################################################
	
	function BorrarError($indice){
		global $vectorErrores;
		$vectorErrores[$indice] = '';
	}

	############################################################################################
	#
	#								Metodo getError
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que retorna el contido del vector de errores	
	# Fecha de realizacion: 20 Marzo de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2005
	############################################################################################
	
	function getError(){
		global $vectorErrores;
		foreach($vectorErrores as $key => $value){
			$temp .= $value.'<br />';		
		}
		return $temp;
	}
	
	############################################################################################
	#
	#								Metodo Obligatorio
	#							--------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un campo considerado obligatorio 
	#			  tenga algun valor
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 8 Junio de 2005
	############################################################################################

	function Obligatorio($contenido){
		if(EliminarEspacios($contenido) != ""){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	############################################################################################
	#
	#								Metodo CampoAlfabetico
	#							----------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un campo alfabetico 
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 15 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	
	function CampoAlfabetico($contenido, $campo, $span, $objResponse, $obligatorio=FALSE, $carateresEspeciales=''){
		global $patronAlfabetico, $uniSpan;

		//limpia el posible contenido del Span
		if(EliminarEspacios($span) != '' && empty($uniSpan)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addAssign($span, "innerHTML", '');
		}
		
		//crea la esprecion regular	
		if(empty($caracteresEspeciales)){
			$tempPatron = $patronAlfabetico.$carateresEspeciales;
		}
		$tempPatron .= "]+$";
		
		//termina si es obligatorio y existe un error
		if($obligatorio){
			if(!Obligatorio($contenido)){
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['obligatorio']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['obligatorio']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");
			}
		}
		
		if(EliminarEspacios($contenido) && !isset($error)){
			if(!ereg($tempPatron, $contenido) && !isset($sw)){
				#NO ES ALFABETICO
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['noAlfabetico']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['noAlfabetico']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");
			}elseif(!isset($sw) && !empty($uniSpan)){
				//elimina el posible mensaje de error del campo en el vector de errores
				BorrarError($campo);
				$temp = getError();
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				$objResponse->addAssign($span, "className", 'bien_campo');
				$objResponse->addAssign(substr($span, 0, -2), "className", "");
			}
		}
		
		if(!isset($error)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
		}
	}
	
	############################################################################################
	#
	#								Metodo CampoNumerico
	#							----------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un campo sea numerico, se acepta
	#		      caracteres especiales, para el caso de '.', ',', etc
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	
	function CampoNumerico($contenido, $campo, $span, $objResponse, $obligatorio = TRUE, $carateresEspeciales = ""){
		global $patronNumerico, $uniSpan;

		//limpia el posible contenido del Span
		if(EliminarEspacios($span) != '' && empty($uniSpan)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addAssign($span, "innerHTML", '');
		}
		
		if(empty($caracteresEspeciales)){
			$tempPatron = $patronNumerico.$carateresEspeciales;
		}
		$tempPatron .= "]+$";
		
		//termina si es obligatorio y existe un error
		if($obligatorio){
			if(!Obligatorio($contenido)){
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['obligatorio']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['obligatorio']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);
					
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");
			}
		}
		
		if(EliminarEspacios($contenido)){
			if(!@ereg($tempPatron, $contenido) && !isset($error)){
				#NO ES ALFABETICO
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['noNumerico']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['noNumerico']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);			
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");				
			}elseif(!isset($sw) && !empty($uniSpan)){
				//elimina el posible mensaje de error del campo en el vector de errores
				BorrarError($campo);
				$temp = getError();
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				$objResponse->addAssign($span, "className", 'bien_campo');
				$objResponse->addAssign(substr($span, 0, -2), "className", "");
			}else{
				$objResponse->addClear($span, "innerHTML");	
			}
		}

		if(!isset($error)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
		}
	}
	
	############################################################################################
	#
	#								Metodo CampoAlfanumerico
	#							------------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un campo alfanumerico no contenga
	#		      caracteres especiales no permitidos
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	
	function CampoAlfanumerico($contenido, $campo, $span, $objResponse, $obligatorio = TRUE, $carateresEspeciales = ""){
		global $patronAlfanumerico, $uniSpan;
		
		//limpia el posible contenido del Span
		if(EliminarEspacios($span) != '' && empty($uniSpan)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addClear($span, "innerHTML");
		}		
		
		if(empty($caracteresEspeciales)){
			$tempPatron = $patronAlfanumerico.$carateresEspeciales;
		}
		$tempPatron .= "]+$";
		
		//termina si es obligatorio y existe un error
		if($obligatorio){
			if(!Obligatorio($contenido)){
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['obligatorio']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['obligatorio']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");				
			}
		}
		
		if(EliminarEspacios($contenido)){
			if(!ereg($tempPatron, $contenido) && !isset($error)){
				#NO ES ALFABETICO
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['caracteresNoValidos']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['caracteresNoValidos']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);			
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");								
			}elseif(!isset($sw) && !empty($uniSpan)){
				//elimina el posible mensaje de error del campo en el vector de errores
				BorrarError($campo);
				$temp = getError();
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				$objResponse->addAssign($span, "className", 'bien_campo');
				$objResponse->addAssign(substr($span, 0, -2), "className", "");
			}
		}
		
		if(!isset($error)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
		}		
	}
	
	############################################################################################
	#
	#								Metodo CampoCorreo
	#							------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un campo tenga la estructura
	#		      de una direccion de correo electronico
	# Fecha de realizacion: 8 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	
	function CampoCorreo($contenido, $campo, $span, $objResponse, $obligatorio = TRUE){
		global $patronCorreo, $uniSpan;

		//limpia el posible contenido del Span
		if(EliminarEspacios($span) != '' && empty($uniSpan)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addAssign($span, "innerHTML", '');
		}		
		
		$tempPatron = $patronCorreo;
		$tempPatron .= "_.]+$";
		
		//termina si es obligatorio y existe un error
		if($obligatorio){
			if(!Obligatorio($contenido)){
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['obligatorio']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['obligatorio']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);
					
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");	
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");					
			}
		}

		if(EliminarEspacios($contenido)){
			if(!ereg($tempPatron, $contenido) && !isset($error)){
				#NO ES ALFABETICO
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['noCorreo']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['noCorreo']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);			
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");								
			}elseif(!isset($sw) && !empty($uniSpan)){
				//elimina el posible mensaje de error del campo en el vector de errores
				BorrarError($campo);
				$temp = getError();
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				$objResponse->addAssign($span, "className", 'bien_campo');
				$objResponse->addAssign(substr($span, 0, -2), "className", "");
			}
		 }

		if(!isset($error)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
		}				 
	}

	############################################################################################
	#
	#								Metodo verificar
	#							------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica que un registro no existe en determinada tabla
	# Fecha de realizacion: 11 Abril de 2006
	# Ultima fecha de modificacion: 11 Abril de 2006
	############################################################################################
	
	function verificar($contenido, $campo, $tabla, $campo_tabla, $span, $sql_add='', $evento = 'onBlur'){
		$objResponse = new xajaxResponse();

		//limpia el posible contenido del Span
		if(EliminarEspacios($span) != '' && empty($uniSpan)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addAssign($span, "innerHTML", '');
		}		
		
		if(EliminarEspacios($contenido)){
			//realiza la consulta
			$sql = sprintf("SELECT %s 
							FROM %s
							WHERE %s = '%s' %s",  $campo_tabla,
												  $tabla,
												  $campo_tabla,
												  $contenido,
												  $sql_add);
			$result = mysql_query($sql);
			
			if(mysql_errno() != 0){
				$objResponse->addAlert("No se pudo consultar el registro en la base de datos");
			}else{
				$total = mysql_num_rows($result);
			}
			
			if(isset($total) && $total > 0){
				//ya existe el registro
				if(empty($uniSpan)){ 
					$objResponse->addAssign($span, "innerHTML", $GLOBALS['existe']);
				}else{
					$temp = AgregarError($campo, $GLOBALS['existe']);
					$objResponse->addAssign($uniSpan, "innerHTML", $temp);			
				}
				$error = true;
				$objResponse->addAssign($span, "className", "error_campo_mjs");	
				$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");							
			}elseif(!empty($uniSpan)){
				//elimina el posible mensaje de error del campo en el vector de errores
				BorrarError($campo);
				$temp = getError();
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
				$objResponse->addAssign($span, "className", 'bien_campo');
				$objResponse->addAssign(substr($span, 0, -2), "className", "");
			}
		 }

		if(!isset($error)){
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
		}				
		
		return $objResponse->getXML(); 
	}
	
	############################################################################################
	#
	#								Metodo Comparar
	#							-----------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Compara los dos campos del parametro para determinar si
	#			  los valores digitados son igules, los campos son considerados
	#			  obligatorios
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax (es de invocado
	# 				  directo, es decir que no se invoca desde la funcion CampoComun)
	############################################################################################
	function comparar($contenido1, $contenido2, $campo, $tipoCampo = "texto", $span, $carateresEspeciales = ""){
		global $patronAlfanumerico, $uniSpan;
		
		$objResponse = new xajaxResponse();
		//realiza la comparacion binaria
		if(strcmp($contenido1, $contenido2) != 0){
			if(empty($uniSpan)){ 
				$objResponse->addAssign($span, "innerHTML", $GLOBALS['compracionNoIguales']);
			}else{
				$temp = AgregarError($campo, $GLOBALS['compracionNoIguales']);
				$objResponse->addAssign($uniSpan, "innerHTML", $temp);
			}
			$objResponse->addAssign($span, "className", "error_campo_mjs");
			$objResponse->addAssign(substr($span, 0, -2), "className", "error_campo");	
		}else{
			$objResponse->addAssign($span, "className", 'bien_campo');
			$objResponse->addAssign(substr($span, 0, -2), "className", "");
			$objResponse->addAssign($span, "innerHTML", '');
		}
		return $objResponse->getXML();
	}
	
	############################################################################################
	#
	#								Metodo CampoFecha
	#							------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica si el formato de una fecha es correcto
	#		      de una direccion de correo electronico
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	/*
	function CampoFecha($nombreCampo, $obligatorio = TRUE){
		
		//termina si es obligatorio y existe un error
		if($obligatorio)
			if(!$this->Obligatorio($nombreCampo)){
				return FALSE;		
			}
		
		$dia = strtok ($this->EliminarEspacios($_REQUEST[$nombreCampo]),"/");
		$mes = strtok ("/");
		$ano = strtok ("/");
		
		if(checkdate($mes, $dia, $ano) != 1){
			$this->AgregarError($nombreCampo, $GLOBALS['fechaNoValida']);
			return FALSE;			
		}
		return TRUE;
	}
	*/
	############################################################################################
	#
	#								Metodo Rango
	#							------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que verifica si el formato de una fecha es correcto
	#		      de una direccion de correo electronico
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecha de modificacion: 20 Marzo de 2006
	# Modificacion: - se agrego soporte para Ajax usando la libreria xajax
	############################################################################################
	/*
	function Rango($nombreCampo, $rangoInferior = NULL, $rangoSuperior = NULL, $obligatorio = TRUE){
		
		if($this->CampoNumerico($nombreCampo, $obligatorio) == FALSE)
			return FALSE;
		
		if($rangoInferior != NULL && $rangoSuperior != NULL){
			if(!($_REQUEST[$nombreCampo] <= $rangoSuperior && 
			   $_REQUEST[$nombreCampo] >= $rangoInferior)){
					$this->AgregarError($nombreCampo, $GLOBALS['rangoNoValido']);
					return FALSE;			
			}		   	
		}elseif($rangoInferior == NULL){
			if(!($_REQUEST[$nombreCampo] <= $rangoSuperior)){
					$this->AgregarError($nombreCampo, $GLOBALS['rangoNoValido']);
					return FALSE;			
			}		   	
		}elseif($rangoSuperior == NULL){
			if(!($_REQUEST[$nombreCampo] >= $rangoInferior)){
					$this->AgregarError($nombreCampo, $GLOBALS['rangoNoValido']);
					return FALSE;			
			}		   	
		}	

		return TRUE;
	}
	*/
	############################################################################################
	#
	#								   Metodo by
	#							-----------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que muestra por pantalla los derechos de autoria 
	#			  de este script
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecah de modificacion: 12 Junio de 2005
	############################################################################################
	/*
	function by(){
		echo sprintf("<b>%s %s</b><br>Realizado por <a href=\"mailto:%s\">%s</a><br><a href=\"http:\\%s\">%s</a><br>%s",
		$this->name, $this->version, $this->correo, $this->by, $this->web, $this->web, $this->fecha);
	}
	*/
	############################################################################################
	#
	#								   Metodo Error
	#							------------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo que muestra por pantalla un mensaje cuando el  
	#			  formulario tiene errores
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecah de modificacion: 12 Junio de 2005
	############################################################################################
	/*
	function MjsError(){
		if(sizeof($this->vectorErrores) != 0){
			echo $GLOBALS['mjsError'];
		}
	}
	*/
	############################################################################################
	#
	#								   Metodo Status
	#							-----------------------
	# Autor: Andres Julian Rodriguez (webmaster@3creatives.com)
	# Accion(es): Metodo usado para conocer si un campo determinado por el
	#			  parametro campo tuvo algun error durante su validacion
	# Fecha de realizacion: 12 Junio de 2005
	# Ultima fecah de modificacion: 12 Junio de 2005
	# Valores a retornar: text  - texto del error ocurrido
	#					  class - class css de error o de ok
	# 					  value - valor digitado en el campo
	############################################################################################
	/*
	function Status($campo = '', $retornar = "text"){
		if($campo == "allResult"){
			if(sizeof($this->vectorErrores) == 0)
				return TRUE;
			else
				return FALSE;
		}
		
		if($this->EliminarEspacios($campo) == ''){
		//die("-".sizeof($this->vectorErrores));
			for($cont=1; sizeof($this->vectorErrores) > $cont; $cont+=2){
			   echo $this->vectorErrores[$cont]."<br>";
			}
		}else{
			for($cont=0; sizeof($this->vectorErrores) > $cont; $cont++){
				if($this->vectorErrores[$cont] == $campo){
					$indice = $cont+1;
				}
			}
			//
			//
			$sw = FALSE;
			switch($retornar){
				case "text" : echo $this->vectorErrores[$indice]; break;
				case "class": 
							  for($cont=0; sizeof($this->vectorErrores) > $cont; $cont++){
								 //echo $this->vectorErrores[$cont]."<br>";
								 if($this->vectorErrores[$cont] == $campo){
									//echo "-";
									echo $this->estiloError;
									$sw = TRUE;
									break;
								}
							  }
							  if($sw == FALSE){ echo $this->estiloOk; }
							  break;
				case "value": echo $_REQUEST[$campo]; break;
				default	    : die(sprintf($this->error.$GLOBALS['errorTipoStatus'], $campo));	
			}
		}
	}
}
	*/
?>