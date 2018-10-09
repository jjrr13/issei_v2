<?php
	if(!empty($uniSpan)){
		//Mensajes con unico span
		$errorTipoCampo      = "Tipo de campo no conocido";
		$obligatorio	     = "El campo '%s' es obligatorio";
		$errorTipoStatus     = "Valor a retornar no valido para el campo '%s'";
		$noAlfabetico        = "El campo '%s' debe ser alfabetico";
		$noNumerico          = "El campo '%s' debe ser numerico";
		$caracteresNoValidos = "El campo '%s' contiene caracteres no validos";
		$noCorreo			 = "El campo '%s' no es una direccion de correo valida";
		$compracionOblig     = "El campo '%s' y su verificacion son obligatorios";
		$compracionNoIguales = "El campo '%s' y su verificacion no son iguales";
		$fechaNoValida		 = "El campo '%s' contiene una fecha no valida";
		$existe		         = "Lo digitado en el campo '%s' ya existe en la base de datos";
		$rangoNoValido		 = "El campo '%s' contiene un numero no valido";
		$mjsError		     = "Algunos campos tiene errores";
	}else{
		//Mensajes con span por campo
		$errorTipoCampo      = " Tipo de campo no conocido";
		$obligatorio	     = " Este campo es obligatorio ingles";
		$errorTipoStatus     = " Valor a retornar no valido";
		$noAlfabetico        = " Debe ser alfabetico";
		$noNumerico          = " Debe ser numerico";
		$caracteresNoValidos = " Usted a digitado un caracter no valido";
		$noCorreo			 = " Esto no es una direccion de correo valida";
		$compracionOblig     = " Este campo y su verificacion son obligatorios";
		$compracionNoIguales = " Este campo y su verificacion no son iguales";
		$fechaNoValida		 = " Este campo contiene una fecha no valida";
		$rangoNoValido		 = " Este campo contiene un numero no valido";
		$existe		         = " Este registro ya existe en la base de datos";
		$mjsError		     = " Algunos campos tiene errores";
	}

?>