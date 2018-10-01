<?php
	function textfield($parametros){
		extract($parametros);
		$rs = '';
		$rs .= "<table border='0' cellpadding='0' cellspacing='0'>
				  <tr>
					<td><span id=\"{$nombre}_e\" class=\"error_campo_mjs\"></span></td>
				  </tr>
				  <tr>
					<td><input type=\""; 
					
		if(isset($type)){ 
			$rs .= $type;
		}else{ 
			$rs .= 'text'; 
		}	
		$rs .= "\" id=\"{$nombre}\" name=\"{$nombre}\" value=\"{$value}\"";
		$rs .= (isset($obligatorio) && $obligatorio == true) ? 'class="textbox_alerta"' : '';
		$rs .= 'onClick="this.className=\'\'"';
		
		if(isset($campo1) && isset($campo2)){
			$rs .= comparar_campos($campo1, $campo2, $tipo, "{$nombre}_e", (isset($extras)) ? $extras : '');
		}else{
			$rs .= validar($nombre, $tipo, "{$nombre}_e", (isset($obligatorio)) ? $obligatorio : true, (isset($extras)) ? $extras : '');
		}
		if($solo_lectura){
			$rs .= " readonly" ;
		}
		if(isset($size)){
  			$rs .= " size = $size" ;
        }
		
		if(isset($maxlength)){
		$rs .= " maxlength = $maxlength" ;
		}
		
		//return acceptNum(event);	
		$rs .= " onkeypress='letras(this);";
		
		if($soloNumero){
			$rs .= "return acceptNum(event);";
		}
			
		if($nombre == "matricula_ingeniero"){
		$rs .= "'onChange='letras(this);xajax_comprueba(document.form1.matricula_ingeniero.value, this.name)'>";}
		elseif($nombre == "matricula_profesional"){
		$rs .= "'onChange='letras(this);xajax_comprueba(document.form1.matricula_profesional.value, this.name)'>";
		}else{
		$rs .= "'onChange='letras(this);'>";
		}
		$rs .= "</td></tr></table>";
		echo $rs;
	}
	
	/****************************************************************
		OBJETOS XAJAX
	*****************************************************************/
	
	$objAjax = new xajax();
	$objAjax->statusMessagesOn();
	$objAjax->errorHandlerOn(); 
	//$objAjax-> debugOn(); 
	$objAjax->registerFunction("campoComun");
	$objAjax->registerFunction("predial");
	$objAjax->registerFunction("addCar");
	$objAjax->registerFunction("delCar");
	$objAjax->registerFunction("prueba");
	$objAjax->registerFunction("opciones");
	$objAjax->registerFunction("pintarOpciones");
	$objAjax->registerFunction("delCar");
	$objAjax->registerFunction("desarrollo");
	$objAjax->registerFunction("cargarvecinos");
	$objAjax->registerFunction("activarActualizar");
	$objAjax->registerFunction("Opciones");
	$objAjax->registerFunction("cargarBusqueda");
	$objAjax->registerFunction("liquidacion");
	$objAjax->registerFunction("buscarRadicado");
	$objAjax->registerFunction("sumar");
	$objAjax->registerFunction("sumar2");
	$objAjax->registerFunction("sumar3");
	$objAjax->registerFunction("verificacion_cf");
	$objAjax->registerFunction("numero_letras");
	$objAjax->registerFunction("calculos");
	$objAjax->registerFunction("saldo");
	$objAjax->registerFunction("tramitador");
	$objAjax->registerFunction("side");
	$objAjax->registerFunction("notificado");
	$objAjax->registerFunction("desis");
	$objAjax->registerFunction("logueo");
	$objAjax->registerFunction("sancionados");
	$objAjax->registerFunction("comprueba");
	$objAjax->registerFunction("consulta_notificado");
	$objAjax->processRequests();

?>