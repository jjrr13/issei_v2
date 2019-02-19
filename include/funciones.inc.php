<?php



/*************************************************************************************************
Funcion que verifica si el acto administrativo a expedir a dicho radicado se le puede realizar acta de obs. u otro acto similar.
**************************************************************************************************/
function compruebaActos($radicado){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

$query_l = sprintf("select tipo_lic from radicado where nro_radicado like '%s' and estado = 1", $radicado);
$jg_query_l = mysql_query($query_l, $cx);
$row_query_l = mysql_fetch_assoc($jg_query_l);
$num_query_l = mysql_num_rows($jg_query_l);
//se elimino 'ph' de $licPermitidas para que permita tener acta de observaciones y su conteo legal
$licPermitidas = array('otras actuaciones', 'prorroga de licencia', 'revalidacion');
$html = 0;

if(@in_array($row_query_l['tipo_lic'], $licPermitidas)){
$html = 1;
}

return $html;	
}




function lic($radicado){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

$query_l = sprintf("select estado from licencias where id_radicado = %s and estado = 1", $radicado);
$jg_query_l = mysql_query($query_l, $cx);
$row_query_l = mysql_fetch_assoc($jg_query_l);
$num_query_l = mysql_num_rows($jg_query_l);

if($num_query_l > 0){
$res = 'bien';}
else{
$res = 'malo';
}

return $res;	
}
/*************************************************************************************************
Funcion que que ingresa un registro de oficio generado para bloquearlo
**************************************************************************************************/

function busca_oficio($nro_radicado, $id_usuario, $tipo_oficio){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

$query = sprintf("select nro_radicado from oficios_bloqueados where nro_radicado like '%s' and tipo_oficio like '%s'", $nro_radicado, $tipo_oficio);
$j_query = mysql_query($query, $cx) or die(mysql_error());
$num_query = mysql_num_rows($j_query);

return $num_query;

}

/*************************************************************************************************
Funcion que ingresa un registro de oficio generado para bloquearlo
**************************************************************************************************/

function bloquea_oficio($nro_radicado, $id_usuario, $tipo_oficio){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

if(busca_oficio($nro_radicado, $id_usuario, $tipo_oficio) == 0){

$query = sprintf("insert into oficios_bloqueados (nro_radicado, fecha, id_usuario, tipo_oficio) values ('%s', NOW(), %s, '%s')", $nro_radicado, $id_usuario, $tipo_oficio);
$j_query = mysql_query($query, $cx) or die(mysql_error());

}
}

/*************************************************************************************************
Funcion que devuelve la fecha en que se haria la ejecutoria
**************************************************************************************************/

function fecha_ejecutoria($fecha){

			$data=split("-",$fecha);
		$e= $data[1]."-".$data[2]."-".$data[0];
	
	
	 $fechaInicial           = mktime(0,0,0,$data[1],$data[2],$data[0]);  
 $lapso          = 6;//  dias habiles  
 $diasTrans      = 0; // dias transcurridos  
 $diasHabiles    = 0;
 $feriados       = array("1-1","8-1","19-3","26-3","27-3","28-3","29-3","30-3","1-5","14-5","4-6","11-6","2-7","20-7","7-8","20-8","15-10","5-11","12-11","8-12","25-12");
 //dias festivos.. DIA-MES while($diasHabiles<($lapso+1))  
 {   $fecha      = $fechaInicial+($diasTrans*86400);   
    $diaSemana  = getdate($fecha);  
     if($diaSemana["wday"]!=0 && $diaSemana["wday"]!=6)  
     {   $feriado    = $diaSemana['mday']."-".$diaSemana['mon'];  
         if(!in_array($feriado,$feriados))  
         {   $diasHabiles++; }  
     }  
     $diasTrans++;  
 }  
 $fechaFinal     = $fechaInicial+(($diasTrans-1)*86400); 
   
   if(date("Y/m/d") > date("Y/m/d",$fechaFinal) ){
   $total = "vencido";
   }else{
 $fecha_fin = date("j/n/Y",$fechaFinal);
$date = explode("/", $fecha_fin);
$cuando = mktime(0,0,0,$date[1],$date[0],$date[2]);
$hoy = time();
$resta = $hoy - $cuando;
$fecha = str_replace("-","",$resta);
$total = floor($fecha/86400);
$total+= 1;
 }
 

  $res = fechaLetras(date("d/m/Y",$fechaFinal));
 return $res; 
 }	


/*************************************************************************************************
Funcion que devuelve la fecha en que se haria la ejecutoria
**************************************************************************************************/

function fecha_acta_pago($dias_p, $estado_p, $fecha, $radicado){

			$data=split("-",$fecha);
		$e= $data[1]."-".$data[2]."-".$data[0];
	
 
 $fechaInicial    = mktime(0,0,0,$data[1],$data[2],$data[0]);  
 $lapso          = $dias_p;//  dias habiles  
 $diasTrans      = 0; // dias transcurridos  
 $diasHabiles    = 0;
 $feriados       = array("1-1","8-1","19-3","26-3","27-3","28-3","29-3","30-3","1-5","14-5","4-6","11-6","2-7","20-7","7-8","20-8","15-10","5-11","12-11","8-12","25-12"); //dias festivos.. DIA-MES
 while($diasHabiles<($lapso+1))  
 {   $fecha      = $fechaInicial+($diasTrans*86400);   
    $diaSemana  = getdate($fecha);  
     if($diaSemana["wday"]!=0 && $diaSemana["wday"]!=6)  
     {   $feriado    = $diaSemana['mday']."-".$diaSemana['mon'];  
         if(!in_array($feriado,$feriados))  
         {   $diasHabiles++; }  
     }  
     $diasTrans++;  
 }  
 $fechaFinal     = $fechaInicial+(($diasTrans-1)*86400); 
   
   if(date("Y/m/d") > date("Y/m/d",$fechaFinal) ){
   $total = "vencido";
   //bloquear_rad($radicado);
   }else{
 $fecha_fin = date("j/n/Y",$fechaFinal);
$date = explode("/", $fecha_fin);
$cuando = mktime(0,0,0,$date[1],$date[0],$date[2]);
$hoy = time();
$resta = $hoy - $cuando;
$fecha = str_replace("-","",$resta);
$total = floor($fecha/86400);
$total+= 1;
 }
 

  $res = fechaLetras(date("d/m/Y",$fechaFinal));
 return array($total, $res); 
 }	


/*************************************************************************************************
Funcion que ingresa un registro de en la tabla ejecutorias
**************************************************************************************************/

function inserta_ejecutoria($nro_radicado, $fecha, $id_usuario){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

//$alert = alertas($_SESSION['radicado'], $_POST['acta']);

$query = "INSERT INTO ejecutorias (nro_radicado, fecha_ejecutoria, id_usuario) VALUES ('".nro_radicado."', '".$fecha."','".$id_usuario."')";
$j_query = mysql_query($query, $cx) or die(mysql_error());
}

/*************************************************************************************************
Funcion que ingresa un registro de en la tabla alertas
**************************************************************************************************/

function inserta_alerta($nro_radicado, $id_usuario, $tipo_oficio){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

$alert = alertas($nro_radicado, 'licencia entregada');

if($alert[0] == 0){

$query = sprintf("insert into alertas (nro_radicado, id_usuario, fecha, tipo) values (%s, %s, NOW(), '%s')", 				                    $nro_radicado,
					$id_usuario, 
					$tipo_oficio); 
					$j_query = mysql_query($query, $cx) or die(mysql_error());
 }
}

/*************************************************************************************************
Funcion que consulta las licencias expedidas en esta curaduria a traves del numero de radicado
**************************************************************************************************/

function licencia_expedida($nro_radicado){
global $database_cx, $cx; 
mysql_select_db($database_cx, $cx);

$query = sprintf("select h.comentario from hoja_ruta h, radicado r where h.comentario like '%expedida%' and h.web = 1 and r.nro_radicado like '%s' and r.id_radicado = h.id_radicado", $nro_radicado);
$j_query = mysql_query($query, $cx) or die(mysql_error());
$num_rows = mysql_num_rows($j_query);

if($num_rows == 0){

$query = sprintf("select h.comentario from hoja_ruta h, radicado r where h.comentario like '%entregad%' and h.web = 1 and r.nro_radicado like '%s' and r.id_radicado = h.id_radicado", $nro_radicado);
$j_query = mysql_query($query, $cx) or die(mysql_error());
$num_rows = mysql_num_rows($j_query);

}

return $num_rows;
}

/*************************************************************************************************
Sistema de alertas para expedicion de licencia, acta de observaciones, prorrogas, actas de pago, incompletos y otras actuaciones.
**************************************************************************************************/

function categoria(){

	if(!empty($_POST['buscaradicado']) && !isset($_GET['r'])){
			$nro_radicado = $_SESSION['conse'].$_POST['buscaradicado'];
		}elseif(!empty($_GET['buscaradicado']) && isset($_GET['r'])){	
			$nro_radicado = $_GET['buscaradicado'];
		}elseif(isset($_SESSION['radicado'])){
			$nro_radicado = $_SESSION['radicado'];
		}
		if(isset($_GET['idb'])){
			$nro_radicado = $_GET['idb'];
		}

if(!empty($nro_radicado)){
	global $database_cx, $cx; 
	mysql_select_db($database_cx, $cx);

	$acto = alertas($nro_radicado, 'ultimo');
	$acta_pago = acta_pago($nro_radicado, '');
	/*$com_acta = alertas($nro_radicado, 'completa acta');
	$acta_p = alertas($nro_radicado, 'acta pago');
	$com_prorroga = alertas($nro_radicado, 'completa prorroga');
	$prorroga = alertas($nro_radicado, 'prorroga');
	$com_pago = alertas($nro_radicado, 'completa acta pago');*/

	$query = sprintf("select id_radicado, fecha_radicado, tipo_lic, categoria, formulario, estado_pro from radicado where nro_radicado = '%s' and categoria IS NOT NULL", $nro_radicado);
	$jg_query = mysql_query($query, $cx) or die(mysql_error);
	$row_query = mysql_fetch_assoc($jg_query);
	$cate = $row_query['categoria'];
	$tipo_lic = $row_query['tipo_lic'];
}
if(!empty($row_query['id_radicado'])){
	$query_h = sprintf("select acta_observacion, comentario from hoja_ruta where acta_observacion IS NOT NULL and id_radicado = %s order by id_hoja_ruta desc limit 1 ", $row_query['id_radicado']);
	$jg_query_h = mysql_query($query_h, $cx) or die(mysql_error);
	$row_query_h = mysql_fetch_assoc($jg_query_h);
	$acta = $row_query_h['acta_observacion'];

	$query_l = sprintf("select estado from licencias where id_radicado = %s", $row_query['id_radicado']);
	$jg_query_l = mysql_query($query_l, $cx);
	$row_query_l = mysql_fetch_assoc($jg_query_l);
	$num_query_l = mysql_num_rows($jg_query_l);

	$query_f = sprintf("select tipo_pago from facturacion where id_radicado = %s order by id_facturacion desc", $row_query['id_radicado']);
	$jg_query_f = mysql_query($query_f, $cx);
	$row_query_f = mysql_fetch_assoc($jg_query_f);

	$query_exp = sprintf("select comentario from hoja_ruta where web = 1 and id_radicado = %s order by fecha_registro asc", $row_query['id_radicado']);
	$jg_query_exp = mysql_query($query_exp, $cx) or die(mysql_error());
	$row_query_exp = mysql_fetch_assoc($jg_query_exp);
	$num_query_h = mysql_num_rows($jg_query_exp);
}

if($row_query['formulario'] != 'desistido' || $row_query['formulario'] != 'anulado'){
	if($row_query_l['estado'] == 0 || $num_query_l == 0){
		if($num_query_h == 0){
			if($tipo_lic == 'ph'){
				if($acto[2] == 'no completa acta' || $acto[2] == 'Acta de observaciones'){
					$dias = 30;
					$estado = 'Acta de Observaciones.';
					$fecha = fecha_cat($nro_radicado, 'Acta de observaciones');
				}else{
					$dias = 15;
					$fecha = $row_query['fecha_radicado'];
					$estado = 'ph';
				}
			}elseif(($tipo_lic == 'otras actuaciones' || $tipo_lic == 'prorroga de licencia')){
				if($acto[2] == 'no completa acta' || $acto[2] == 'Acta de observaciones'){
					$dias = 30;
					$estado = 'Acta de Observaciones.';
					$fecha = fecha_cat($nro_radicado, 'Acta de observaciones');
				}else{
					$dias = 15;
					$fecha = $row_query['fecha_radicado'];
					$estado = 'Otras Actuaciones'; 
				}
			}elseif($row_query['formulario'] == 'incompleto' && $tipo_lic != 'ph'){
				$dias = 30;
				$fecha = $row_query['fecha_radicado'];
				$estado = 'Incompleto'; 
			}elseif(($acto[2] == 'completa acta' || $acto[2] == 'completo'  && $row_query['formulario'] == 'completo' || $acto[2] == 'completa prorroga') && ($acta_pago[0] == 0 || $acta_pago[2] == 'completa acta pago') || ($acta_pago[2] == 'acta pago' && $acto[2] == 'completa prorroga') || $acto[2] == 'ninguna'){
			//if($acta_pago[0] == 0 || $acta_pago[2] == 'completa acta pago'){
			//echo 'HOMA MUNDO';
				if($cate == 'categoria 1'){
					$dias = 20;

					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Categoria 1'; 
				}
				elseif($cate == 'categoria 2'){
					$dias = 25;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Categoria 2';

				}
				elseif($cate == 'categoria 3'){
					$dias = 35;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Categoria 3';

				}
				elseif($cate == 'categoria 4'){
					$dias = 45;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Categoria 4';

				}elseif($tipo_lic == 'urbanizacion'){
					$dias = 45;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'urbanizacion';

				}elseif($tipo_lic == 'modificacion licencia'){
					$dias = 45;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Modificacion Licencia';

				}elseif($tipo_lic == 'revalidacion'){
					$dias = 15;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'revalidacion';
				}elseif($tipo_lic == 'reconocimiento'){
					$dias = 45;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Reconocimiento';

				}elseif($tipo_lic == 'subdivision'){
					$dias = 45;
					$fecha = fecha_cat($nro_radicado, 'completo');
					$estado = 'Subdivision';

				//}
				}
			}elseif($row_query['formulario'] == 'completo' && compruebaActos($nro_radicado) == 0){

				if($acto[2] == 'Acta de observaciones' || $acto[2] == 'no completa acta'){
					//if(true){
					//echo 'hola mundo';
					$dias = 30;
					$estado = 'Acta de Observaciones';
					$fecha = fecha_cat($nro_radicado, 'Acta de observaciones');
					////////////////////////////////////////
					if($acta_pago[2] == 'acta pago'){
						$dias_p = 30;
						$estado_p = 'Acta de Pago';
						$fecha_p = fecha_cat($nro_radicado, 'acta pago');
					}

				}elseif($acto[2] == 'prorroga' || $acto[2] == 'no completa prorroga'){
					$dias = 15;
					$estado = 'Prorroga';
					$fecha = fecha_cat($nro_radicado, 'prorroga');
					/////////////////////////////////////
					/*if($acta_pago[2] == 'acta pago'){
					$dias_p = 30;
					$estado_p = 'Acta de Pago';
					$fecha_p = fecha_cat($nro_radicado, 'acta pago');
					}*/
				}elseif($acta_pago[2] == 'acta pago' && $acto[2] != 'completa prorroga'){
					$dias = 30;
					$estado = 'Acta de Pago';
					$fecha = fecha_cat($nro_radicado, 'acta pago');

				}
			}
		}
	}
}

if(!empty($fecha) && !empty($dias))
	$resul = habiles1($fecha, $dias, $estado, $nro_radicado, $fecha_p, $dias_p, $estado_p); 

	return $resul;
}


function buscar_bloqueado($radicado){
global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);

$verifica = sprintf("select * from estado_rad where radicado like '%s' ", $radicado);
$q_verifica = mysql_query($verifica, $cx) or die(mysql_error());
$num_verifica = mysql_num_rows($q_verifica);

return $num_verifica;
}

/***********************************************************************************
FUNCION QUE INSERTA EL RADICADO QUE SERA LOQUEADO POR DESISTIMIENTO Y/O TERMINOS VENCIDOS
***********************************************************************************/
function bloquear_rad($radicado){
global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);

if(buscar_bloqueado($radicado) == 0){
$query = sprintf("insert into estado_rad (radicado, estado, fecha) values (%s, 'bloqueado', NOW())", $radicado);
$q_query = mysql_query($query, $cx) or die(mysql_error());
}

}
/***********************************************************************************
FUNCION QUE BLOQUEA EL RADICADO EN CASO DE QUE ESTE SE ENCUENTRE DESISTIDO
***********************************************************************************/
function desistidos($nro_radicado, $opcion){

global $database_cx, $cx;
mysql_select_db($database_cx, $cx);

$desistido=sprintf("select formulario, estado_pro from radicado where nro_radicado = '%s' and formulario like 'desistido' and estado_pro like 'desistido' ", $nro_radicado);
$jg_desistido= mysql_query($desistido, $cx) or die(mysql_error());
$num_desistidos = mysql_num_rows($jg_desistido);

if($num_desistidos > 0){

if(opcion == 'bloquea'){
bloquear_rad($nro_radicado);

}elseif($opcion == 'consulta'){
$html = "<div class='desistidos17' style='padding-top:12px;'>Radicado Desistido!!</div>";
return $html;
}

}

}	
/***********************************************************************************
FUNCION QUE BLOQUEA EL RADICADO EN CASO DE QUE ESTE SE ENCUENTRE ANULADO
***********************************************************************************/
function anulados($nro_radicado, $opcion){

global $database_cx, $cx;
mysql_select_db($database_cx, $cx);

$anulado=sprintf("select formulario, estado_pro from radicado where nro_radicado = '%s' and formulario like 'anulado' and estado_pro like 'anulado' ", $nro_radicado);
$jg_anulado= mysql_query($anulado, $cx) or die(mysql_error());
$num_anulado = mysql_num_rows($jg_anulado);

if($num_anulado > 0){
//REVISAR AQUI
if(opcion == 'bloquea'){
bloquear_rad($nro_radicado);

}elseif($opcion == 'consulta'){
$html = "<div class='anulados' style='padding-top:12px;'>Radicado Anulado!!</div>";
return $html;
}

}

}		
	
/***********************************************************************************
FUNCION QUE RETORNA LA LISTA DE USUARIO QUE PUEDEN MODIFICAR LA UBICACION DE UN PROYECTO
***********************************************************************************/

function ubicacion($ubicacion){

switch($ubicacion){

case '':
case 'Ninguna':
case 'ninguna':
$usuarios = array(3, 8, 14, 18, 19, 29, 34,47, 50, 54, 57, 59, 69);
break;

case 'archivo incompleto':
case 'revision estructural':
$usuarios = array(3, 14, 18, 29, 61, 48, 50, 53, 57, 58, 67);
break;

case 'revision estructural2':
$usuarios = array(3, 14, 18, 29, 48, 50, 57);
break;

case 'entrega':
case 'pago':
$usuarios = array(3, 14, 18, 29, 50, 54, 52, 57);
break;

case 'omar guerrero':
$usuarios = array(3, 29, 40);
break;

case 'felman tabares':
$usuarios = array(3, 8, 14, 18, 29, 50, 54, 57);
break;

case 'adrianita perdomo':
$usuarios = array(3, 14, 18, 29, 50, 54, 57, 60);
break;

case 'alex rodriguez':
$usuarios = array(3, 14, 18, 29, 50, 54, 57, 64);
break;

case 'gloria victoria':
$usuarios = array(3, 14, 18, 29, 34, 50, 57);
break;

case 'ines hoyos':
$usuarios = array(3, 14, 18, 29, 47, 50, 54, 57);
break;

case 'lina delgado':
$usuarios = array(3, 14, 18, 29, 50, 54, 57, 66);
break;

case 'maria delgado':
$usuarios = array(3, 14, 18, 29, 47, 50, 54, 57, 62);
break;

case 'yeiner soto':
$usuarios = array(3, 14, 18, 29, 47, 50, 54, 57, 63);
break;

case 'recepcion':
$usuarios = array(3, 14, 18, 29, 50, 52, 57, 58, 61, 67);
break;

case 'radicacion':
$usuarios = array(3, 14, 18, 29, 50, 57);
break;

case 'liquidacion':
$usuarios = array(3, 18, 50, 57, 54);
break;

case 'dario lopez':
$usuarios = array(3, 18, 29, 40, 50, 54, 57);
break;

case 'carlos angulo':
$usuarios = array(3, 14, 18, 19, 29, 40, 50, 54, 57);
break;

case 'kristhian salinas':
$usuarios = array(3, 14, 18, 29, 40, 50, 54, 57, 69);
break;

case 'fernando torres':
$usuarios = array(3, 14, 18, 29, 40, 50, 57, 59);
break;

case 'juridico':
$usuarios = array(3, 14, 18, 29, 40, 61, 50, 57, 65, 67);
break;

case 'juridico1':
$usuarios = array(3, 14, 18, 29, 40, 61, 50, 57, 65, 67);
break;

case 'juridico2':
$usuarios = array(3, 14, 18, 29, 40, 61, 50, 57, 65, 67);
break;

case 'comunicacion':
$usuarios = array(3, 18, 29, 40, 50, 57);
break;

case 'secretaria':
$usuarios = array(3, 18, 29, 40, 50, 57);
break;

case 'aux licencia':
$usuarios = array(3, 18, 29, 40, 50, 52, 57);
break;

case 'licencia':
$usuarios = array(3, 18, 29, 40, 50, 57, 70);
break;

case 'curador':
$usuarios = array(3, 18, 29, 40, 50, 54, 57);
break;

case 'archivo central':
case 'foliar y archivo':
$usuarios = array(3, 14, 18, 29, 61, 50, 57, 58, 67);
break;
}
return $usuarios;
}
	
	
	/***********************************************************************************
		FUNCION QUE RETORNA UNA FECHA CON UN FORMATO ESPECIFICADO
	***********************************************************************************/	
	function fechaFormato($fecha, $formatoInicial, $formatoFinal){
		$fecha = explode("/", $fecha);
		$formatoInicial = explode("/", $formatoInicial);
		
		for($cont = 0; $cont < count($formatoInicial); $cont++){
			switch($formatoInicial[$cont]){
				case 'd': $dia = $cont; break;
				case 'm': $mes = $cont; break;
				case 'a': $ano = $cont; break;
				default: die('Error en formato de fecha');
			}	
		}
		
		$nuevaFecha = $formatoFinal;
		$nuevaFecha = str_replace('d', $fecha[$dia], $nuevaFecha);
		$nuevaFecha = str_replace('m', $fecha[$mes], $nuevaFecha);
		$nuevaFecha = str_replace('a', $fecha[$ano], $nuevaFecha);
		
		return $nuevaFecha;
	} 
	/*************************************************************************
	*	FUNCION QUE RETORNA UNA DIRECCION SIN LOS SEPARADORES GUIAS INTERNOS
	*************************************************************************/
	function limpiar_direccion($direccion){
		$direccion = str_replace("BISTEMP%BIS%", "BIS", $direccion);
		$direccion = str_replace("BISTEMP", "", $direccion);
		$direccion = str_replace("%", "", $direccion);
		$direccion = str_replace("__", " ", $direccion);
		$temp = explode(" ", $direccion);

		for($cont = 0; $cont < count($temp); $cont++){
			if($temp[$cont] == 'Bloque' && $temp[$cont+1] == ''){
				$direccion = str_replace("Bloque", "", $direccion);
			}
			if($temp[$cont] == 'Piso' && $temp[$cont+1] == ''){
				$direccion = str_replace("Piso", "", $direccion);
			}
			if($temp[$cont] == 'Pred' && $temp[$cont+1] == ''){
				$direccion = str_replace("Pred", "", $direccion);
			}			
		}
		
		if(trim($direccion) == '#    -'){
			$direccion = '';
		}
		
		return trim($direccion);
		
	}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////
//FUNCION PARA RETORNAR FECHAS CORRESPONDIENTES A LAS LICENCIAS GENERADAS
/////////////////////////////////////////////////////////////////////////////////////////////////	

function fecha_licencia($radicado, $licencia){
global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);

	$a = sprintf("SELECT l.fecha_licencia, l.tipo_licencia, l.id_licencia, l.tipo_proyecto, l.tipo_licencia_c, l.uso
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = '$licencia' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", $radicado);
	$b = mysql_query($a, $cx) or die(mysql_error().$a);	
	$c = mysql_fetch_assoc($b);
	
	$tipo = sprintf("select l.tipo_proyecto from licencias l, radicado r where  l.id_radicado = %s and r.id_radicado = l.id_radicado and l.tipo_proyecto IS NOT NULL limit 1", $radicado);
	$q_tipo = mysql_query($tipo, $cx) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($q_tipo);
	
//consulta las modalidades
$mod = sprintf("select group_concat(distinct(m.modalidad)) as modalidad from licencias_modalidad m left join licencias l on m.id_licencias = l.id_licencia and l.id_licencia = '$c[id_licencia]' group by l.id_licencia desc");
$qu_mod=mysql_query($mod, $cx) or die(mysql_error());
$jg_mod = mysql_fetch_assoc($qu_mod);
	
/*if($licencia == 'URB_ARQUITECTONICA'){
$retorna = $c['tipo_licencia_c'];
}elseif($licencia == 'SUBDIVISION'){
$retorna = $c['uso'];
}*/

//	$lic_reconocimiento = str_replace('-', '/', substr($c['fecha_licencia'], 0, 10));
	
	return array($c['fecha_licencia'], $c['tipo_licencia'], $jg_mod['modalidad'], $row_tipo['tipo_proyecto'], $c['tipo_licencia_c'], $c['uso']);	
		
}
	//Funcion que lee un archivo de texto y lo mete en una cadena 
	function leef ($fichero) { 
		$texto = file($fichero); 
		$tamleef = sizeof($texto); 
		for ($n=0;$n<$tamleef;$n++) {$todo= $todo.$texto[$n];} 
		return $todo; 
	} 
	
	//funcion que genera un rtf 
	function rtf($campos, $plantilla, $fsalida, $pathSalida){
		global $path, $separador, $pathTemp, $httpTemp;
		
		$uq = time(); 
		
		$nombre_archivo = $fsalida."_".$uq.".rtf";
		
		//$fsalida        = $path."{$separador}registro{$separador}".$nombre_archivo; 
		$fsalida        = $pathSalida.$nombre_archivo; 
		//echo $fsalida."<br />";
		//Paso no 1.-Leo una plantilla rtf 
		$txtplantilla = leef($path."{$separador}plantillas{$separador}".$plantilla.".rtf"); 
		
		//Paso no.2 Saca cabecera, el cuerpo y el final 
		$matriz=explode("sectd", $txtplantilla); 
		$cabecera=$matriz[0]."sectd"; 
		$inicio=strlen($cabecera); 
		$final=strrpos($txtplantilla,"}"); 
		$largo=$final-$inicio; 
		$cuerpo=substr($txtplantilla, $inicio, $largo); 
		
		//Paso no.3 Escribo el fichero 
		$punt = fopen($fsalida, "w"); 
		fputs($punt, $cabecera); 
		
		//$despues = $cuerpo; 
		for($cont = 0; $cont < count($campos); $cont++){
			
			$despues = $cuerpo; 
			
			foreach($campos[$cont] as $key => $value){
				$temp    = stripslashes($value); 
				$despues = str_replace("#*".$key."*#", $temp, $despues); 
				
				if(!empty($campos[0]['OBSERVACIONES1'])){
				$despues2 = str_replace("/n", "\par", $campos[0]['OBSERVACIONES1']);	
				$despues = str_replace($campos[0]['OBSERVACIONES1'], $despues2, $despues);
				}
				
				if(!empty($campos[0]['DOCUMENTACION1'])){
				$despues3 = str_replace("/n", "\par", $campos[0]['DOCUMENTACION1']);	
				$despues = str_replace($campos[0]['DOCUMENTACION1'], $despues3, $despues);
				}
			}
			fputs($punt,$despues); 
			$saltopag="\par"; 
			//$saltopag="\par"; 
			fputs($punt,$saltopag); 
		}
		
		fputs($punt,"}"); 
		fclose ($punt); 
		
		/////
		//crea el archivo temporal
		/////
		if($pathTemp != $pathSalida){
			$fsalida        = $pathTemp.$nombre_archivo; 
			//echo $fsalida."<br />";
			//Paso no 1.-Leo una plantilla rtf 
			$txtplantilla = leef($path."{$separador}plantillas{$separador}".$plantilla.".rtf"); 
			
			//Paso no.2 Saca cabecera, el cuerpo y el final 
			$matriz=explode("sectd", $txtplantilla); 
			$cabecera=$matriz[0]."sectd"; 
			$inicio=strlen($cabecera); 
			$final=strrpos($txtplantilla,"}"); 
			$largo=$final-$inicio; 
			$cuerpo=substr($txtplantilla, $inicio, $largo); 
			
			//Paso no.3 Escribo el fichero 
			$punt = fopen($fsalida, "w"); 
			fputs($punt, $cabecera); 
			
			//$despues = $cuerpo; 
			for($cont = 0; $cont < count($campos); $cont++){
				
				$despues = $cuerpo; 
				
				foreach($campos[$cont] as $key => $value){
					$temp    = stripslashes($value); 
					$despues = str_replace("#*".$key."*#", $temp, $despues); 
					
				if(!empty($campos[0]['OBSERVACIONES1'])){
				$despues2 = str_replace("/n", "\par", $campos[0]['OBSERVACIONES1']);	
				$despues = str_replace($campos[0]['OBSERVACIONES1'], $despues2, $despues);
				}
				
				if(!empty($campos[0]['DOCUMENTACION1'])){
				$despues3 = str_replace("/n", "\par", $campos[0]['DOCUMENTACION1']);	
				$despues = str_replace($campos[0]['DOCUMENTACION1'], $despues3, $despues);
				}
				
				}
				fputs($punt,$despues); 
				$saltopag="\par"; 
				//$saltopag="\par"; 
				fputs($punt,$saltopag); 
			}
			
			fputs($punt,"}"); 
			fclose ($punt); 
		}

		echo '<script><!--
				window.open("'.$httpTemp.$nombre_archivo.'", "generado" ,"")
	  --></script>';

				
		return $nombre_archivo; 
	} 
	//funcion que retorna el nombre de un mes enviado como entero
	function mes($Nmes)
	{
		switch ($Nmes) {
			case 1:
				$Nombremes="Enero";
				break;
			case 2:
				$Nombremes="Febrero";
				break;
			case 3:
				$Nombremes="Marzo";
				break;
			case 4:
				$Nombremes="Abril";
				break;
			case 5:
				$Nombremes="Mayo";
				break;
			case 6:
				$Nombremes="Junio";
				break;
			case 7:
				$Nombremes="Julio";
				break;
			case 8:
				$Nombremes="Agosto";
				break;
			case 9:
				$Nombremes="Septiembre";
				break;
			case 10:
				$Nombremes="Octubre";
				break;
			case 11:
				$Nombremes="Noviembre";
				break;
			case 12:
				$Nombremes="Diciembre";
				break;
			//default:
	
		}
		return $Nombremes;
	
	}
	
	//funcion que retorna una fecha en letras
	function fechaLetras($fecha){
		$fecha = explode("/", $fecha);
		$temp = $fecha[0]." de ".mes($fecha[1])." de ".$fecha[2];
		return $temp;
	}
	
	function fechaLetras2($fecha){
		$fecha = explode("/", $fecha);
		$temp = $fecha[0]." días del mes de ".mes($fecha[1])." de ".$fecha[2];
		return $temp;
	}
	
	/*************************************************************************
	*	FUNCION QUE ADMINISTRA EL BLOQUEO DE REGISTRO POR MULTIPLES USUARIOS
	*************************************************************************/	
	function estadoRegistro($radicado=''){
		global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);
		
			if(empty($_SESSION['radicado']) && empty($radicado)){
			return 1;
		}
		
		//cierra los registros bloqueados por mas de 2 horas
		$query = "UPDATE radicado
				  SET id_usuario_en_uso = '',
					  bloqueado_desde = ''
				  WHERE ADDTIME(bloqueado_desde, '0 2:0:0') < NOW()";
		mysql_query($query, $cx) or die(mysql_error()." ".$query);			
		
		//desbloquea los registros
		$query = sprintf("UPDATE radicado
						  SET id_usuario_en_uso = '',
						  	  bloqueado_desde = ''
						  WHERE id_usuario_en_uso = %d", $_SESSION['usuario'][0]['id_usuario']);
		mysql_query($query, $cx) or die(mysql_error()." ".$query);	
		
		//consulta si el radicado deseado esta disponible
		$query = sprintf("SELECT id_usuario_en_uso
						  FROM radicado 
						  WHERE nro_radicado = '%s' AND
						        id_usuario_en_uso != %d", $radicado, $_SESSION['usuario'][0]['id_usuario']);
		//echo $query;						
		$temp = mysql_query($query, $cx) or die(mysql_error()." ".$query);	
		$result = mysql_fetch_assoc($temp);
		//echo "ess: ".$query;
		if($result['id_usuario_en_uso'] != '' && $result['id_usuario_en_uso'] != 'NULL' && $result['id_usuario_en_uso'] != 0){
			//el registro esta bloqueado, se retorna el nombre del usuario que lo esta
			//utilizando
			$query = sprintf("SELECT CONCAT(u.nombres,' ',u.apellidos) as nombre,
									 bloqueado_desde
							  FROM radicado r,
								   usuario u
							  WHERE r.nro_radicado = '%s' AND
							  		u.id_usuario = r.id_usuario_en_uso", $radicado);
			$temp = mysql_query($query, $cx) or die(mysql_error()." ".$query);	
			$result = mysql_fetch_assoc($temp);
			return $result['nombre']." (".$result['bloqueado_desde'].")";
		}else{
			//bloquea el registro actual
			if(isset($_GET['edit'])){
				$query = sprintf("UPDATE radicado
								  SET id_usuario_en_uso = %d,
									  bloqueado_desde = NOW()
								  WHERE nro_radicado = '%s'", $_SESSION['usuario'][0]['id_usuario'], $radicado);
				mysql_query($query, $cx) or die(mysql_error()." ".$query);	
			}
			//echo $query;
			return 1;
		}
	}

	/*************************************************************************
	*	FUNCION QUE TOTALIZA LAS AREAS EN LA GENERACION DE LIQUIDACIONES
	*************************************************************************/	
	function sumar($campo, $v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8){
		$objResponse = new xajaxResponse(); 

		$total = ($v1 + $v2 + $v3 + $v4 + $v5 + $v6 + $v7 + $v8);
		$objResponse->addAssign($campo,"value", $total);
		return $objResponse;
	}
	function sumar2($campo, $v1, $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10){
		$objResponse = new xajaxResponse(); 
		$total = $v1 + $v2 + $v3 + $v4 + $v5 + $v6 + $v7 + $v8 + $v9 + $v10;
		$objResponse->addAssign($campo,"value", $total);
		return $objResponse;
	}
	
		function sumar3($campo, $v1, $v2){
		$objResponse = new xajaxResponse(); 

		$total = ($v1 + $v2);
		$objResponse->addAssign($campo,"value", $total);
		return $objResponse;
	}




	/*************************************************************************
	*	FUNCION QUE CALCULA LA FECHA EN QUE VECE UN RADICADO (ALERTAS)
	*************************************************************************/

function habiles1($fecha, $adicion, $estado, $radicado, $fecha_p, $dias_p, $estado_p){

$data=split("-",$fecha);
$e= $data[1]."-".$data[2]."-".$data[0];

if($estado == 'Acta de Observaciones' || $estado == 'Prorroga' || $estado == 'Acta de Pago' || $estado_p == 'Acta de Pago'){
	$descuenta = 0;
}else{
	$descuenta = dias_cate($radicado);
}


if($descuenta > 0){
	$descuenta = $descuenta;
}
 $fechaInicial           = mktime(0,0,0,$data[1],$data[2],$data[0]);  
 $lapso          =  $adicion - $descuenta;//  dias habiles  
 $diasTrans      = 0; // dias transcurridos  
 $diasHabiles    = 0;
 $feriados       = array("1-1","8-1","19-3","26-3","27-3","28-3","29-3","30-3","1-5","14-5","4-6","11-6","2-7","20-7","7-8","20-8","15-10","5-11","12-11","8-12","25-12");
 //dias festivos.. DIA-MES
 while($diasHabiles<($lapso+1))  
 {    $fecha      = $fechaInicial+($diasTrans*86400);   
    $diaSemana  = getdate($fecha);  
     if($diaSemana["wday"]!=0 && $diaSemana["wday"]!=6 && compruebaActos($radicado) == 0)  
     {   $feriado    = $diaSemana['mday']."-".$diaSemana['mon'];  
         if(!in_array($feriado,$feriados))  
         {   $diasHabiles++; }  
     }  
	 if(compruebaActos($radicado) == 1){
	 	$diasHabiles++;
	 }
      $diasTrans++; 
	  
 } 
  
 $fechaFinal     = $fechaInicial+(($diasTrans-1)*86400); 
 $res = fechaLetras(date("d/m/Y",$fechaFinal));
 

//detecta el numero de dias faltantes para la fecha en que vence el plazo del radicado, teniendo en cuenta si este posee acta de observacion, porroga de acta de observacion o resolucion.
if(date("Y/m/d") > date("Y/m/d",$fechaFinal) ){
	$total = "vencido";

	if(buscar_bloqueado($radicado) == 0){
		if($estado == 'Incompleto' || $estado == 'Acta de Observaciones' || $estado == 'Prorroga' || $estado == 'Acta de Pago' || $estado_p =='Acta de Pago' || $estado == 'ph' || $estado == 'Otras Actuaciones'){
			bloquear_rad($radicado);
		}
	}
}else{	 
	$fecha_fin = date("j/n/Y",$fechaFinal);
	$date = explode("/", $fecha_fin);
	$cuando = mktime(0,0,0,$date[1],$date[0],$date[2]);
	$hoy = time();
	$resta = $hoy - $cuando;
	$fecha = str_replace("-","",$resta);
	$total = floor($fecha/86400);
	$total+= 1;
}
 

if($estado_p == 'Acta de Pago'){
	$f_pago = fecha_acta_pago($dias_p, $estado_p, $fecha_p, $radicado);
}

/*if($estado != 'Incompleto' || $estado != 'Acta de Observaciones' || $estado != 'Prorroga' || $estado != 'Acta de Pago'){
if(!empty($dias_acta)){
$fecha_acta = date("Y/m/d",$fechaFinal);
$new_fecha = date("Y-m-d", strtotime("$fecha_acta -$dias_acta day")); 
//$new_fecha = date("d/m/Y", $new_fecha); 

if(date("Y/m/d") < date("Y/m/d", $new_fecha)){
$dias_res = 'vencido';
}else{
$dias_res = $total - $dias_acta.' Dias'; 
}
}
}*/

if(!empty($dias_acta)){ $posicion = 'align="left"';}else{ $posicion = 'align="center"';}
//genera la tabla en donde se mostraran los resultados de la alerta.
$html ='
<table border="0" '.$posicion.' class="mateTable">
            <tr align="center" style="background:url(../css/images/table_bg.gif)">
              <td width="83" height="17"><strong>Vencimiento</strong>  </td>
              <td width="77"><strong>Faltan</strong></td>';
if($estado != 'Incompleto'){$html .= '<td width="83"><strong>Estado</strong></td>';}
$html .= '<td></td>';
           $html .= '</tr> <tr class="submenubgd" bgcolor="#FFFFFF">
				  <td height="29" align="center">'.$res.'</td> 
				  <td align="center">'.$total.' Dias</td>';
if($estado != 'Incompleto'){$html .= '<td align="center">'.$estado.'</td>';}
				$html .='<td>';
				     if($total <= 5){ $imagen = "rojo.gif";}else{$imagen = "naranja.gif";}
				  $html .= '<img src="../imagenes/'.$imagen.' " width="24" height="24" /></td>';			    
$html .='</tr></table>';

if(!empty($fecha_p)){
$html .='<table width="200" height="56" border="0" align="rigth" class="mateTable">
            <tr align="center" style="background:url(../css/images/table_bg.gif)">
			<td width="46"><strong>Vencimiento</strong></td>';
 $html .=' <td width="46"><strong>Faltan</strong></td>
 			<td width="83"><strong>Estado</strong></td>
			<td></td>';

$html .= '<tr class="submenubgd"><td align="center">'.$f_pago[1].'</td>
				  <td align="center">'.$f_pago[0].' Dias</td>
				  <td align="center">'.$estado_p.'</td>
				  <td>'; 
	if($f_pago[0] <= 5){ $imagen = "rojo.gif";}else{$imagen = "naranja.gif";}
	$html .= '<img src="../imagenes/'.$imagen.' " width="24" height="24" /></td>';
		$html .= '</tr></table>'; 	
				  
				  }		 

 return $html; //se retorna la tabla con la informacion correspondiente de la alerta.
	}

function alertas($id_radicado, $tipo){
global $database_cx, $cx;
mysql_select_db($database_cx, $cx);

$query_c= "select * from alertas where (tipo NOT LIKE '%pago' and tipo NOT LIKE '%comuni%') and nro_radicado LIKE '".$id_radicado."' ";

if($tipo != 'ultimo'){
	$query_c .= sprintf("and tipo LIKE '%s' ", $tipo);
}elseif($tipo == 'ultimo'){
	$query_c .= "order by id desc limit 1";
}

$jg_query_c = mysql_query($query_c, $cx) or die(mysql_error());
$num_query_c = mysql_num_rows($jg_query_c);
$assoc = mysql_fetch_assoc($jg_query_c);
return array($num_query_c, $assoc['fecha'], $assoc['tipo']);
}


function alert($id_radicado, $tipo){
global $database_cx, $cx;
mysql_select_db($database_cx, $cx);

$query_c= "select * from alertas where tipo LIKE '".$tipo."' and nro_radicado LIKE '".$id_radicado."' ";

if($tipo != 'ultimo'){
$query_c .= sprintf("and tipo LIKE '%s' ", $tipo);
}elseif($tipo == 'ultimo'){
$query_c .= "order by id desc limit 1";
}

$jg_query_c = mysql_query($query_c, $cx) or die(mysql_error());
$num_query_c = mysql_num_rows($jg_query_c);
$assoc = mysql_fetch_assoc($jg_query_c);
return array($num_query_c, $assoc['fecha'], $assoc['tipo']);
}

////FUNCION DE ACTA DE PAGO
function acta_pago($id_radicado, $tipo){
global $database_cx, $cx;
mysql_select_db($database_cx, $cx);

$query_c= "select * from alertas where nro_radicado LIKE '".$id_radicado."' ";


if(!empty($tipo)){
$query_c .= "and tipo LIKE '".$tipo."' order by id desc limit 1";
}elseif(empty($tipo)){
$query_c .= "and tipo LIKE '%pago%' order by id desc limit 1";
}

$jg_query_c = mysql_query($query_c, $cx) or die(mysql_error());
$num_query_c = mysql_num_rows($jg_query_c);
$assoc = mysql_fetch_assoc($jg_query_c);
return array($num_query_c, $assoc['fecha'], $assoc['tipo']);
}

//funcion que retorna los dias habiles entre dos fechas.

//The function returns the no. of business days between two dates and it skips the holidays
function getWorkingDays($startDate,$endDate,$holidays){
    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    $days = (strtotime($endDate) - strtotime($startDate)) / 86400 + 1;

    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);

    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N",strtotime($startDate));
    $the_last_day_of_week = date("N",strtotime($endDate));

    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
    if ($the_first_day_of_week <= $the_last_day_of_week){
        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    }
    else{
        if ($the_first_day_of_week <= 6) {
        //In the case when the interval falls in two weeks, there will be a weekend for sure
            $no_remaining_days = $no_remaining_days - 2;
        }
    }

    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
   $workingDays = $no_full_weeks * 5;
    if ($no_remaining_days > 0 )
    {
      $workingDays += $no_remaining_days;
    }

    //We subtract the holidays
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        //If the holiday doesn't fall in weekend
        if (strtotime($startDate) <= $time_stamp && $time_stamp <= strtotime($endDate) && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
    }

    return $workingDays;
}


//esta funcion es para seleccionar la fecha de lo que correponde a las alertas de licencia
//si existe proceso licencia es por que obtubo acta si y se le da la ultima fecha obtenida si no existe proceso licencia no obtubo acta y por lo tanto se le da la primera fecha que se le asigno cuando se completo el radicado.

function fecha_cat($radicado, $tipo){
//global $database_cx, $cx;
switch($tipo){

case 'Acta de observaciones':

$acta = alertas($radicado, $tipo);
if($acta[0] > 0)
$fecha = $acta[1];

break;

case 'prorroga':

$prorroga = alertas($radicado, $tipo);
if($prorroga[0] > 0)
$fecha = $prorroga[1];

break;

case 'acta pago':

$pago = acta_pago($radicado, '');
if($pago[0] > 0)
$fecha = $pago[1];

break;

case 'completo':
$ninguna = alertas($radicado, 'ninguna');
$completo = alertas($radicado, 'completo');
$com_prorroga = alertas($radicado, 'completa prorroga');
$com_pago = acta_pago($radicado, 'completa acta pago');
$com_acta = alertas($radicado, 'completa acta');
$pago = acta_pago($radicado, 'acta pago');
$acta = alertas($radicado, 'Acta de observaciones');

if($com_pago[0] > 0 && $ninguna[0] == 0){
$fecha = $com_pago[1];
}elseif($com_prorroga[0] > 0 && $ninguna[0] == 0){
$fecha = $com_prorroga[1];
}elseif($com_acta[0] > 0 && $ninguna[0] == 0){
$fecha = $com_acta[1];
}elseif(($ninguna[0] > 0 && $pago[0] > 0) || ($ninguna[0] > 0 && $acta[0] > 0)){
$fecha = $ninguna[1];
}elseif(($ninguna[0] > 0 && $com_pago[0] > 0) || ($ninguna[0] > 0 && $com_acta[0] > 0) || ($ninguna[0] > 0 && $com_prorroga[0] > 0)){
$fecha = $ninguna[1];
}elseif($completo[0] > 0 && $pago[0] == 0 && $acta[0] == 0){
$fecha = $completo[1];
}
break;
}//fin del switch
return $fecha;
}

function dias_cate($radicado){

$ninguna = alertas($radicado, 'ninguna');
$com_prorroga = alertas($radicado, 'completa prorroga');
$com_pago = acta_pago($radicado, 'completa acta pago');
$com_acta = alertas($radicado, 'completa acta');
$prorroga = alertas($radicado, 'prorroga');
$pago = acta_pago($radicado, 'acta pago');

$completo = alertas($radicado, 'completo');
if($completo[0] > 0){
$fecha = $completo[1];
}

$acta = alertas($radicado, 'Acta de observaciones');
if($acta[0] > 0)
$fecha2 = $acta[1];

if($acta[0] > 0){
if($com_acta[0] > 0){
$fecha3 = $com_acta[1];
}else{
$fecha3 = $com_prorroga[1];
}
}else{
$fecha3 = $completo[1];
}

if($pago[0] > 0){
$fecha4 = $pago[1];
}

/*if($prorroga[0] > 0){
if($com_prorroga[0] > 0){
$fecha5 = $com_prorroga[1];
}else{
$fecha5 = $ninguna[1];
}
}*/
//}

$año = date('Y');

$ant = $año - 1;
$feriados   = array("'$año'-1-1", "'$año'-11-1", "'$año'-21-3", "'$año'-24-3", "'$año'-25-3", "'$año'-9-5", "'$año'-30-5", "'$año'-6-6", "'$año'-4-7", "'$año'-20-7", "'$año'-15-8", "'$año'-17-10", "'$año'-7-11", "'$año'-14-11", " '$año'-8-12"); 


if(isset($fecha) && isset($fecha2)){

if($acta[0] > 0){
$dias = getWorkingDays($fecha, $fecha2, $feriados);
if($pago[0] > 0 && ($com_acta[0] > 0 || $com_prorroga[0] > 0)){
$dias2 = getWorkingDays($fecha3, $fecha4, $feriados);
}else{
$dias2 = 0;
}
}else{
$dias = 0;
}



if($acta[0] == 0 && $pago[0] > 0){
$dias3 = getWorkingDays($fecha, $fecha4, $feriados);
}else{
$dias3 = 0;
}

//if($com_acta[0] > 0 || $prorroga[0] > 0 || $pago[0] > 0){
//$dias = getWorkingDays($fecha, $fecha2, $feriados);
//$dias3 = getWorkingDays($fecha3, $fecha4, $feriados);
//$dias3 = getWorkingDays($fecha5, $fecha4, $feriados);
//}
}

if($dias > 0)
$dias = $dias - 2;

if($dias3 > 0)
$dias3 = intval($dias3);

if($dias2 > 0)
$dias2 = $dias2;
else
$dias2 = 0;

$total_dias = ($dias + $dias2 + $dias3);
return $total_dias;
}


	
	/**********************************************************************
		FUNCION QUE RETORNA EL VALOR DE UN CAMPO DE LA LIQUIDACION
	**********************************************************************/	
	function getValor($idg, $categoria, $uso, $campo_return){
		global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);
		
		$query = sprintf("SELECT %s
						  FROM liquidaciones 
						  WHERE id_liquidacion_general = %d AND
								categoria = '%s' ",$campo_return,
												   $idg,
												   $categoria);
						   
		if(!empty($uso)){
			$query .= sprintf("AND uso = '%s'", $uso);
		}
		$temp = mysql_query($query) or die("Error ".$query);
		$result = mysql_fetch_assoc($temp);
		//return converNum($result[$campo_return]);										   
		return $result[$campo_return];										   
	}
	
	
		function getValorPre($idg, $categoria, $uso, $campo_return){
		global $database_cx, $cx;
		mysql_select_db($database_cx, $cx);
		
		$query = sprintf("SELECT %s
						  FROM liquidaciones_pre
						  WHERE id_liquidacion_general_pre = %d AND
								categoria = '%s' ",$campo_return,
												   $idg,
												   $categoria);
						   
		if(!empty($uso)){
			$query .= sprintf("AND uso = '%s'", $uso);
		}
		$temp = mysql_query($query) or die("Error ".$query);
		$result = mysql_fetch_assoc($temp);
		//return converNum($result[$campo_return]);										   
		return $result[$campo_return];										   
	}
	
	
	function converNum($num){
		$temp = explode(',', $num);
		//echo "----------> ".count($temp);
		if(count($temp) > 1){
			$total_limpio = str_replace('.', '', $temp[0]);
		}else{
			$total_limpio = str_replace('.', '', $num);
		}
		return $total_limpio;
	}
	/*! 
	  @function num2letras () 
	  @abstract Dado un n?mero lo devuelve escrito. 
	  @param $num number - N?mero a convertir. 
	  @param $fem bool - Forma femenina (true) o no (false). 
	  @param $dec bool - Con decimales (true) o no (false). 
	  @result string - Devuelve el n?mero escrito en letra. 
	
	*/ 
	function num2letras($num, $fem = true, $dec = true) { 
	//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
	   $matuni[2]  = "dos"; 
	   $matuni[3]  = "tres"; 
	   $matuni[4]  = "cuatro"; 
	   $matuni[5]  = "cinco"; 
	   $matuni[6]  = "seis"; 
	   $matuni[7]  = "siete"; 
	   $matuni[8]  = "ocho"; 
	   $matuni[9]  = "nueve"; 
	   $matuni[10] = "diez"; 
	   $matuni[11] = "once"; 
	   $matuni[12] = "doce"; 
	   $matuni[13] = "trece"; 
	   $matuni[14] = "catorce"; 
	   $matuni[15] = "quince"; 
	   $matuni[16] = "dieciseis"; 
	   $matuni[17] = "diecisiete"; 
	   $matuni[18] = "dieciocho"; 
	   $matuni[19] = "diecinueve"; 
	   $matuni[20] = "veinte"; 
	   $matunisub[2] = "dos"; 
	   $matunisub[3] = "tres"; 
	   $matunisub[4] = "cuatro"; 
	   $matunisub[5] = "quin"; 
	   $matunisub[6] = "seis"; 
	   $matunisub[7] = "sete"; 
	   $matunisub[8] = "ocho"; 
	   $matunisub[9] = "nove"; 	
	   $matdec[2] = "veint"; 
	   $matdec[3] = "treinta"; 
	   $matdec[4] = "cuarenta"; 
	   $matdec[5] = "cincuenta"; 
	   $matdec[6] = "sesenta"; 
	   $matdec[7] = "setenta"; 
	   $matdec[8] = "ochenta"; 
	   $matdec[9] = "noventa"; 
	   $matsub[3]  = 'mill'; 
	   $matsub[5]  = 'bill'; 
	   $matsub[7]  = 'mill'; 
	   $matsub[9]  = 'trill'; 
	   $matsub[11] = 'mill'; 
	   $matsub[13] = 'bill'; 
	   $matsub[15] = 'mill'; 
	   $matmil[4]  = 'millones'; 
	   $matmil[6]  = 'billones'; 
	   $matmil[7]  = 'de billones'; 
	   $matmil[8]  = 'millones de billones'; 
	   $matmil[10] = 'trillones'; 
	   $matmil[11] = 'de trillones'; 
	   $matmil[12] = 'millones de trillones'; 
	   $matmil[13] = 'de trillones'; 
	   $matmil[14] = 'billones de trillones'; 
	   $matmil[15] = 'de billones de trillones'; 
	   $matmil[16] = 'millones de billones de trillones'; 
	
	   $num = trim((string)@$num); 
	   if ($num[0] == '-') { 
		  $neg = 'menos '; 
		  $num = substr($num, 1); 
	   }else 
		  $neg = ''; 
	   while ($num[0] == '0') $num = substr($num, 1); 
	   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
	   $zeros = true; 
	   $punt = false; 
	   $ent = ''; 
	   $fra = ''; 
	   for ($c = 0; $c < strlen($num); $c++) { 
		  $n = $num[$c]; 
		  if (! (strpos(".,'''", $n) === false)) { 
			 if ($punt) break; 
			 else{ 
				$punt = true; 
				continue; 
			 } 
	
		  }elseif (! (strpos('0123456789', $n) === false)) { 
			 if ($punt) { 
				if ($n != '0') $zeros = false; 
				$fra .= $n; 
			 }else 
	
				$ent .= $n; 
		  }else 
	
			 break; 
	
	   } 
	   $ent = '     ' . $ent; 
	   if ($dec and $fra and ! $zeros) { 
		  $fin = ' coma'; 
		  for ($n = 0; $n < strlen($fra); $n++) { 
			 if (($s = $fra[$n]) == '0') 
				$fin .= ' cero'; 
			 elseif ($s == '1') 
				$fin .= $fem ? ' una' : ' un'; 
			 else 
				$fin .= ' ' . $matuni[$s]; 
		  } 
	   }else 
		  $fin = ''; 
	   if ((int)$ent === 0) return 'Cero ' . $fin; 
	   $tex = ''; 
	   $sub = 0; 
	   $mils = 0; 
	   $neutro = false; 
	   while ( ($num = substr($ent, -3)) != '   ') { 
		  $ent = substr($ent, 0, -3); 
		  if (++$sub < 3 and $fem) { 
			 $matuni[1] = 'una'; 
			 $subcent = 'os'; 
		  }else{ 
			 $matuni[1] = $neutro ? 'un' : 'uno'; 
			 $subcent = 'os'; 
		  } 
		  $t = ''; 
		  $n2 = substr($num, 1); 
		  if ($n2 == '00') { 
		  }elseif ($n2 < 21) 
			 $t = ' ' . $matuni[(int)$n2]; 
		  elseif ($n2 < 30) { 
			 $n3 = $num[2]; 
			 if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
			 $n2 = $num[1]; 
			 $t = ' ' . $matdec[$n2] . $t; 
		  }else{ 
			 $n3 = $num[2]; 
			 if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
			 $n2 = $num[1]; 
			 $t = ' ' . $matdec[$n2] . $t; 
		  } 
		  $n = $num[0]; 
		  if ($n == 1) { 
			 $t = ' ciento' . $t; 
		  }elseif ($n == 5){ 
			 $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
		  }elseif ($n != 0){ 
			 $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
		  } 
		  if ($sub == 1) { 
		  }elseif (! isset($matsub[$sub])) { 
			 if ($num == 1) { 
				$t = ' mil'; 
			 }elseif ($num > 1){ 
				$t .= ' mil'; 
			 } 
		  }elseif ($num == 1) { 
			 $t .= ' ' . $matsub[$sub] . '?n'; 
		  }elseif ($num > 1){ 
			 $t .= ' ' . $matsub[$sub] . 'ones'; 
		  }   
		  if ($num == '000') $mils ++; 
		  elseif ($mils != 0) { 
			 if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
			 $mils = 0; 
		  } 
		  $neutro = true; 
		  $tex = $t . $tex; 
	   } 
	   $tex = $neg . substr($tex, 1) . $fin; 
	   return ucfirst($tex); 
	} 
?>