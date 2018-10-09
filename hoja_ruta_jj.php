<?php
mb_http_input("iso-8859-1");
mb_http_output("iso-8859-1");

ob_start();
require_once("../include/validator/libs/xajax/xajax.inc.php");
require_once('../include/validator/validator.common.php');
require_once('../Connections/cx.php');
include('menu.php');
session_set_cookie_params('0');
ini_set("session.cookie_lifetime","46600");
	ini_set("session.gc_maxlifetime","46600");
	session_start();
$id_sessionJ = $_SESSION['usuario'][0]['id_usuario'];

echo "<script>alert($id_sessionJ);</script>";
	
//*****************************************************************************
//		Funcion para seleccionar los documentos relacionados con el radicado
//*****************************************************************************
function documentos($id_radicado, $tipo)
{
	global $database_cx, $cx, $totalRow_documentos; 
	mysql_select_db($database_cx, $cx);
	$selectdocumentos=sprintf("SELECT * 
							   FROM `documento_radicado`, 
							   		 `documento`
	 						   WHERE `documento_radicado`.id_documento=`documento`.id_documento 
							   AND   `documento_radicado`.estado=1 AND documento.tipo = '$tipo'
							   AND  `documento_radicado`.id_radicado = %s
							   ORDER BY nombre_corto ASC",
														 GetSQLValueString($id_radicado, "text"));
							  
	$Result1documentos = mysql_query($selectdocumentos, $cx) or die(mysql_error()." ".$selectdocumentos);
	
	$totalRow_documentos = mysql_num_rows($Result1documentos);
	while($Row_SQLdocumentos = mysql_fetch_array($Result1documentos)){
	$arr_temp[] = $Row_SQLdocumentos['id_documento'];
	}
	return $arr_temp;
}

if(!empty($_POST['buscaradicado'])){
	$nro_radicado = $_SESSION['conse'].$_POST['buscaradicado'];
	$_SESSION['radicado'] = $nro_radicado;
}else if(!empty($_SESSION['radicado'])){
	$nro_radicado = $_SESSION['radicado'];
}


$fecha_radi=date("Y/m/d");//fecha actual.
//fue reemplazada por $id_sessionJ por notivos de optimizacion del codigo
$id_usuario = $_SESSION['usuario'][0]['id_usuario']; // id de usuario.

//seleccion la informacion del radicado actual
if(isset($nro_radicado)){

$alert_com1 = alertas($_SESSION['radicado'], 'completa acta');
$alert_com2 = alertas($_SESSION['radicado'], 'borrador ok');
$alert_com3 = alertas($_SESSION['radicado'], 'completa acta pago');
$alert_com4 = alertas($_SESSION['radicado'], 'prorroga');
$alert_com5 = alertas($_SESSION['radicado'], 'Acta de observaciones');
$ultimo = alertas($_SESSION['radicado'], 'ultimo');
$last_pago = alertas($_SESSION['radicado'], 'acta pago');

	$query_jg_radicado_actual = sprintf("SELECT r.fecha_radicado, r.id_usuario, r.folios, r.id_radicado, r.id_usuario, r.fecha_radicado, l.estado, r.telefono_propietario,
												CONCAT(u.nombres,' ',u.apellidos) as radicador 
										 FROM radicado r,
											  usuario u, licencias l
										 WHERE nro_radicado = '%s' AND l.id_radicado = r.id_radicado and
											   r.id_usuario = u.id_usuario ", $nro_radicado);
	$jg_radicado_actual = mysql_query($query_jg_radicado_actual, $cx) or die(mysql_error().$query_jg_radicado_actual);
	$row_jg_radicado_actual = mysql_fetch_assoc($jg_radicado_actual);
	$totalRows_jg_radicado_actual = mysql_num_rows($jg_radicado_actual);	
	
	
	
/*$est= sprintf("select l.estado from licencias l, radicado r where r.id_radciado = %s and l.id_radicado = r.id_radicado", $row_jg_radicado_actual['id_radicado']);
$est2 = mysql_query($est, $cx) or die(mysql_error());*/


}
		
if(!empty($row_jg_radicado_actual['id_radicado'])){	

///////////////////////////////////////////////////////
// carga las fechas de todas las licencias para mostrar la fecha de las que estan en proceso.
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'RECONOCIMIENTO' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_reconocimiento = $row_jg_cargar['fecha_licencia'];
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'CONSTRUCCION' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_construccion = $row_jg_cargar['fecha_licencia'];
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia 
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'PH' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_ph = $row_jg_cargar['fecha_licencia'];
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'SUBDIVISION' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_subdivision = $row_jg_cargar['fecha_licencia'];
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'URB_ARQUITECTONICA' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_urb_arquitectonica = $row_jg_cargar['fecha_licencia'];
	
	$query_jg_cargar = sprintf("SELECT l.fecha_licencia
								FROM licencias l,
									 radicado r 
								WHERE l.id_radicado = %s AND
									  l.tipo_licencia = 'URBANISTICA' AND
									  r.id_radicado = l.id_radicado
								ORDER BY id_licencia DESC
								LIMIT 1", addslashes($row_jg_radicado_actual['id_radicado']));
	$jg_cargar = mysql_query($query_jg_cargar, $cx) or die(mysql_error().$query_jg_cargar);	
	$row_jg_cargar = mysql_fetch_assoc($jg_cargar);
	
	$lic_urbanistica = $row_jg_cargar['fecha_licencia'];
}

	
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if(isset($nro_radicado)){
	// consultas para las alertas.
	mysql_select_db($database_cx, $cx);

	$query_jg_radicado = sprintf("SELECT r.id_radicado, r.nro_radicado, r.id_usuario, r.revisor, r.formulario, r.estado_pro, r.proyecto, r.observaciones, r.propietario, r.profesional, r.fecha_radicado, r.telefono_propietario, r.ingeniero, r.constructor, r.direccion1, r.direccion2, r.direccion3, r.barrio, r.folios, r.tipo_lic FROM radicado r, usuario u WHERE r.id_usuario = u.id_usuario and nro_radicado = '%s' ", $nro_radicado);
	$jg_radicado = mysql_query($query_jg_radicado, $cx) or die(mysql_error());
	$row_jg_radicado = mysql_fetch_assoc($jg_radicado);
	$totalRows_jg_radicado = mysql_num_rows($jg_radicado);

	$query_acta = sprintf("SELECT hr.acta_observacion, hr.ubicacion_proyect FROM radicado r, hoja_ruta hr WHERE hr.id_radicado = r.id_radicado and nro_radicado = '%s' order by hr.fecha_registro desc limit 1", 
	$nro_radicado);
	$jg_acta = mysql_query($query_acta, $cx) or die(mysql_error());
	$row_acta = mysql_fetch_assoc($jg_acta);
	$ubicaciones_per = ubicacion($row_acta['ubicacion_proyect']);

	$query_acta2 = sprintf("SELECT hr.acta_observacion, hr.ubicacion_proyect FROM radicado r, hoja_ruta hr WHERE hr.id_radicado = r.id_radicado and nro_radicado = '%s' order by hr.fecha_registro desc limit 1", 
	$nro_radicado);
	$jg_acta2 = mysql_query($query_acta2, $cx) or die(mysql_error());
	$row_acta2 = mysql_fetch_assoc($jg_acta2);

	$query_acta3 = sprintf("SELECT hr.acta_observacion, hr.ubicacion_proyect FROM radicado r, hoja_ruta hr WHERE hr.id_radicado = r.id_radicado and nro_radicado = '%s' order by hr.fecha_registro desc limit 1", 
	$nro_radicado);
	$jg_acta3 = mysql_query($query_acta3, $cx) or die(mysql_error());
	$row_acta3 = mysql_fetch_assoc($jg_acta3);

	$query_busqueda = sprintf("SELECT CONCAT(u.nombres,' ',u.apellidos) as revisor 
										  FROM radicado r,
										  	   usuario u
										  WHERE r.nro_radicado = '%s' AND
										  		u.id_usuario = r.revisor", $nro_radicado);
			$jg_busqueda = mysql_query($query_busqueda, $cx) or die(mysql_error()." ".$query_busqueda);
			$Row_Result1Radicado = mysql_fetch_assoc($jg_busqueda);
		
	if(isset($row_jg_radicado['id_radicado'])){	
		$est = sprintf("select estado from licencias where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_est = mysql_query($est, $cx) or die(mysql_error());
		$jg_est = mysql_fetch_assoc($qu_est);	
	}

	if(isset($row_jg_radicado['id_radicado'])){	
		$bok = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('BORRADOR OK')",$row_jg_radicado['id_radicado']);
		$qu_bok = mysql_query($bok, $cx) or die(mysql_error());
		$jg_bok = mysql_fetch_assoc($qu_bok);	
	}

	if(isset($row_jg_radicado['id_radicado'])){	
		$pasalicencia = sprintf("select pasalicencia from radicado where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_pasalicencia = mysql_query($pasalicencia, $cx) or die(mysql_error());
		$jg_pasalicencia = mysql_fetch_assoc($qu_pasalicencia);	
	}

	if(isset($row_jg_radicado['id_radicado'])){	
		$pasadesistido = sprintf("select pasadesistido from radicado where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_pasadesistido = mysql_query($pasadesistido, $cx) or die(mysql_error());
		$jg_pasadesistido = mysql_fetch_assoc($qu_pasadesistido);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$obscoment = sprintf("select obscoment from radicado where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_obscoment = mysql_query($obscoment, $cx) or die(mysql_error());
		$jg_obscoment = mysql_fetch_assoc($qu_obscoment);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$actaobs = sprintf("select actaobservaciones from radicado where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_actaobs = mysql_query($actaobs, $cx) or die(mysql_error());
		$jg_actaobs = mysql_fetch_assoc($qu_actaobs);	
	}

	if(isset($row_jg_radicado['id_radicado'])){	
		$firmado = sprintf("select firmado from licencias where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_firmado = mysql_query($firmado, $cx) or die(mysql_error());
		$jg_firmado = mysql_fetch_assoc($qu_firmado);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$actapago = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA')", $row_jg_radicado['id_radicado']);
		$qu_actapago = mysql_query($actapago, $cx) or die(mysql_error());
		$jg_actapago = mysql_fetch_assoc($qu_actapago);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$apagosi = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario = 'COMPLETAN ACTA DE PAGO'", $row_jg_radicado['id_radicado']);
		$qu_apagosi = mysql_query($apagosi, $cx) or die(mysql_error());
		$jg_apagosi = mysql_fetch_assoc($qu_apagosi);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$apagono = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario = 'NO COMPLETAN ACTA DE PAGO'", $row_jg_radicado['id_radicado']);
		$qu_apagono = mysql_query($apagono, $cx) or die(mysql_error());
		$jg_apagono = mysql_fetch_assoc($qu_apagono);
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario7 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('PASA A DESISTIMIENTO')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario7 = mysql_query($hjcomentario7, $cx) or die(mysql_error());
		$jg_hjcomentario7 = mysql_fetch_assoc($qu_hjcomentario7);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario6 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('COMPLETAN ACTA DE OBSERVACIONES')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario6 = mysql_query($hjcomentario6, $cx) or die(mysql_error());
		$jg_hjcomentario6 = mysql_fetch_assoc($qu_hjcomentario6);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario5 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('NO COMPLETA ACTA')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario5 = mysql_query($hjcomentario5, $cx) or die(mysql_error());
		$jg_hjcomentario5 = mysql_fetch_assoc($qu_hjcomentario5);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario4 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('SE REALIZA PRORROGA')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario4 = mysql_query($hjcomentario4, $cx) or die(mysql_error());
		$jg_hjcomentario4 = mysql_fetch_assoc($qu_hjcomentario4);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario3 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('SE NOTIFICA ACTA DE OBSERVACIONES, PASA A INCOMPLETOS')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario3 = mysql_query($hjcomentario3, $cx) or die(mysql_error());
		$jg_hjcomentario3 = mysql_fetch_assoc($qu_hjcomentario3);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario2 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('SE REALIZA ACTA DE OBSERVACIONES')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario2 = mysql_query($hjcomentario2, $cx) or die(mysql_error());
		$jg_hjcomentario2 = mysql_fetch_assoc($qu_hjcomentario2);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('FIRMADO-CAROLINA')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario = mysql_query($hjcomentario, $cx) or die(mysql_error());
		$jg_hjcomentario = mysql_fetch_assoc($qu_hjcomentario);	
	}
	if(isset($row_jg_radicado['id_radicado'])){	
		$firma_d = sprintf("select firma_desistido from licencias where id_radicado = %s", $row_jg_radicado['id_radicado']);
		$qu_firma_d = mysql_query($firma_d, $cx) or die(mysql_error());
		$jg_firma_d = mysql_fetch_assoc($qu_firma_d);	
	}

	if(isset($row_jg_radicado['id_radicado'])){	
		$hjcomentario1 = sprintf("select comentario from hoja_ruta where id_radicado = %s and comentario in ('FIRMADO DESISTIMIENTO-CAROLINA')", $row_jg_radicado['id_radicado']);
		$qu_hjcomentario1 = mysql_query($hjcomentario1, $cx) or die(mysql_error());
		$jg_hjcomentario1 = mysql_fetch_assoc($qu_hjcomentario1);	
	}
}

if(isset($_POST['ubicacion_b'])){
	if($_POST['ubicacion_b'] == 'Comunicacion-Carolina'){
		$ubic = str_replace('Comunicacion-Carolina', 'comunicacion', $_POST['ubicacion_b']);
	}else if($_POST['ubicacion_b'] == 'Secretaria-Carolina'){
		$ubic = str_replace('Secretaria-Carolina', 'secretaria', $_POST['ubicacion_b']);
	}else{
		$ubic = $_POST['ubicacion_b'];
	}
}else{
	$ubic = $_POST['ubicacion'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}	

//inserta el comentario a la hoja de ruta
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2") && isset($_POST['enviado_hr'])){

	$alert = alertas($_SESSION['radicado'], $_POST['acta']);
	$alert_pago = acta_pago($_SESSION['radicado'], $_POST['acta']);

	$alert_com = alertas($_SESSION['radicado'], $_POST['completado']);
	$alert_com_pago = acta_pago($_SESSION['radicado'], $_POST['completado']);	

	if(!empty($_POST['comentario'])){
		 $insertSQL = sprintf("INSERT INTO hoja_ruta (id_radicado, comentario, id_usuario, acta_observacion, ubicacion_proyect) VALUES (%s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['id_radicado'], "int"),
							   GetSQLValueString($_POST['comentario'], "text"),
							   GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"),
							   GetSQLValueString($_POST['acta'], "text"),
							   GetSQLValueString($ubic, "text"));
		  mysql_select_db($database_cx, $cx);  
		  $Result1 = mysql_query($insertSQL, $cx) or die(mysql_error()); 

	$primer_acceso = array(8, 63, 40, 65, 3, 29, 19, 69, 66, 62, 64, 18, 44, 32, 34, 37, 47, 56);
		
		if(in_array($id_sessionJ, $primer_acceso)){
			  echo "$id_sessionJ";
			if(!empty($_POST['acta']) && $alert[0] == 0 && $alert_pago[0] == 0){  
				$categ2 = sprintf("insert into alertas (nro_radicado, id_usuario, fecha, tipo) values (%s, %s, NOW(), %s)",	GetSQLValueString($_SESSION['radicado'], "text"),
					// GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"), 
					GetSQLValueString($id_sessionJ, "int"), 
					GetSQLValueString($_POST['acta'], "text"));
					mysql_select_db($database_cx, $cx);  
					$jg_categ2 = mysql_query($categ2, $cx) or die(mysql_error());
			}
		}

		$segundo_acceso = array(27, 68, 14, 3, 29, 8, 63, 19, 69, 66, 62, 64, 18, 44, 32, 40, 65, 34, 37, 47, 56);
			
		if(in_array($id_sessionJ, $segundo_acceso)){
			  
			
			if(!empty($_POST['completado']) && $alert_com[0] == 0 && $alert_com_pago[0] == 0){  
				$categ3 = sprintf("insert into alertas (nro_radicado, id_usuario, fecha, tipo) values (%s, %s, NOW(), %s)", GetSQLValueString($_SESSION['radicado'], "text"),
					// GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"), 
					GetSQLValueString($id_sessionJ, "int"),
					GetSQLValueString($_POST['completado'], "text"));
					mysql_select_db($database_cx, $cx);  
					$jg_categ3 = mysql_query($categ3, $cx) or die(mysql_error());
			}						
		}		
	}
	  
	if(!empty($_POST['cweb'])){
		$insertSQL = sprintf("INSERT INTO hoja_ruta (id_radicado, comentario, id_usuario, web, acta_observacion, 			ubicacion_proyect) VALUES (%s, %s, %s, 1, %s, %s)",
				GetSQLValueString($_POST['id_radicado'], "int"),
				GetSQLValueString($_POST['cweb'], "text"),
				// GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"),
				GetSQLValueString($id_sessionJ, "int"),
				GetSQLValueString($_POST['acta'], "text"),
				GetSQLValueString($ubic, "text"));
	  mysql_select_db($database_cx, $cx);
	  $Result1 = mysql_query($insertSQL, $cx) or die(mysql_error());
	  
	}
	  
	//cambia de estado los registros de documentos relacionados para volverlos a crear
	$query = sprintf("UPDATE documento_radicado SET estado = 0, fecha_actualizacion = NOW()
						WHERE id_radicado = %d AND estado = 1", $_POST['id_radicado']);
		mysql_query($query , $cx) or die(mysql_error()."<br /><br />".$query);


	$tercer_acceso = array(18, 3, 50, 70, 58, 71, 71, 29, 56, 8, 63, 19, 69, 66, 62,  64, 29, 34, 47);
			
	if(in_array($id_sessionJ, $tercer_acceso)){	
		
		if(!empty($_POST['licencia'])){
			$licencia= sprintf("update licencias set estado = %s where id_radicado = %s ", $_POST['licencia'], $_POST['id_radicado']);
			$q_licencia = mysql_query($licencia, $cx) or die(mysql_error());
		}

		if(!empty($_POST['pasalicencia'])){
			$pasalicencia= sprintf("update radicado set pasalicencia = %s where id_radicado = %s ", $_POST['pasalicencia'], $_POST['id_radicado']);
			$q_pasalicencia = mysql_query($pasalicencia, $cx) or die(mysql_error());
		}

		if(!empty($_POST['pasadesistido'])){
			$pasadesistido= sprintf("update radicado set pasadesistido = %s where id_radicado = %s ", $_POST['pasadesistido'], $_POST['id_radicado']);
			$q_pasadesistido = mysql_query($pasadesistido, $cx) or die(mysql_error());
		}

		if(!empty($_POST['obscoment'])){
			$obscoment= sprintf("update radicado set obscoment = %s where id_radicado = %s ", $_POST['obscoment'], $_POST['id_radicado']);
			$q_obscoment = mysql_query($obscoment, $cx) or die(mysql_error());
		}

		if(!empty($_POST['actaobservaciones'])){
			$actaobs= sprintf("update radicado set actaobservaciones = %s where id_radicado = %s ", $_POST['actaobservaciones'], $_POST['id_radicado']);
			$q_actaobs = mysql_query($actaobs, $cx) or die(mysql_error());
		}

		if(!empty($_POST['firmado'])){
			$firmado= sprintf("update licencias set firmado = %s where id_radicado = %s ", $_POST['firmado'], $_POST['id_radicado']);
			$q_firmado = mysql_query($firmado, $cx) or die(mysql_error());
		}

		if(!empty($_POST['firma_d'])){
			$firma_d= sprintf("update licencias set firma_desistido = %s where id_radicado = %s ", $_POST['firma_d'], $_POST['id_radicado']);
			$q_firma_d = mysql_query($firma_d, $cx) or die(mysql_error());
		}

		if(!empty($_POST['folios'])){
			$folios= sprintf("update radicado set folios = %s where id_radicado = %s ", $_POST['folios'], $_POST['id_radicado']);
			$q_folios = mysql_query($folios, $cx) or die(mysql_error());
		}

	}
		 
	//condicional para definir el esta del radicado y actualizar el dato en la tabla de radicado
	if($_POST['formulario'] == 'comunicado'){
		$bformulario = 'comunicado';
	}else if($_POST['formulario'] == 'incompleto'){
		$bformulario = 'incompleto';
	}else if($_POST['formulario'] == 'a comunicar'){
		$bformulario = 'a comunicar';
	}else{
		$bformulario = 'desistido';
	}

	$alert2 = alert($_SESSION['radicado'], $bformulario);			
				 

	// si el usuario en el sistema contiene el id igual a 40(abogado) entonces tiene los privilegios para editar el estado de la radicacion.
	$cuarto_acceso = array(3, 20, 37, 18, 40, 65, 50, 70, 58, 71, 29, 56);
			
	if(in_array($id_sessionJ, $cuarto_acceso)){	

		if($bformulario != 'desistido'){
			$actualiza = sprintf("UPDATE radicado set estado_pro = '$bformulario', id_usuario_modifico = %s	
									where estado = 1 and id_radicado = %s", 
					     		// GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"),
					     		GetSQLValueString($id_sessionJ, "int"),
									$_POST['id_radicado']);
			mysql_query($actualiza , $cx) or die(mysql_error()."<br /><br />".$actualiza);
		
		}else if($bformulario == 'desistido'){
			$actualiza_b = sprintf("UPDATE radicado set formulario = 'desistido', estado_pro = 'desistido',									 		id_usuario_modifico = %s	
										where estado = 1 and id_radicado = %s", 
		                            // GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"),
					     			GetSQLValueString($id_sessionJ, "int"),
		                            	$_POST['id_radicado']);
			mysql_query($actualiza_b , $cx) or die(mysql_error()."<br /><br />".$actualiza_b);
		}
		
		if($alert2[0] == 0 && $bformulario != 'incompleto'){
			$categ = sprintf("INSER INTO alertas (nro_radicado, id_usuario, fecha, tipo) values (%s, %s, NOW(), %s)",			GetSQLValueString($_SESSION['radicado'], "text"),
							// GetSQLValueString($_SESSION['usuario'][0]['id_usuario'], "int"), 
					     	GetSQLValueString($id_sessionJ, "int"),
			 				GetSQLValueString($bformulario, "text"));
			$jg_categ = mysql_query($categ, $cx) or die(mysql_error());				
		}
	}
		
	for($cont = 0; $cont < count($_POST['documento']); $cont++){
			 $insertSQL = sprintf("INSERT INTO documento_radicado (id_radicado, id_documento, id_usuario, 									fecha_registro) VALUES (%d, %d, %d, NOW())",
									$_POST['id_radicado'],
									$_POST['documento'][$cont],
									// $_SESSION['usuario'][0]['id_usuario']);
									$id_sessionJ);
			$Result1 = mysql_query($insertSQL, $cx) or die(mysql_error()."<br /><br />".$insertSQL);
	}	

    header("Location: {$_SERVER['PHP_SELF']}");
}

if(!empty($row_jg_radicado['id_radicado'])){

///////////////////////////////////////////////////////
//carga la informacion que se muestra en los comentario de la hoja de ruta (seccion hoja de ruta).
	mysql_select_db($database_cx, $cx);

	$quinto_acceso = array(3, 8, 14, 19, 20, 29, 18, 40, 33, 34, 46, 47, 48, 49, 50, 51, 52, 53, 54, 56, 57, 58, 71, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70);
	
	if(in_array($id_sessionJ, $quinto_acceso)){
	$usuario_per = "";
	//Se agrega el usuario 55 por orden del curador
	// }else if($_SESSION['usuario'][0]['id_usuario'] == 55 ){
	}else if($id_sessionJ == 55 ){
		$usuario_per = "limit 1";
	// }else if($_SESSION['usuario'][0]['id_usuario'] == 43 ){
	}else if($id_sessionJ == 43 ){
		$usuario_per = "limit 0";
	}else{
		$usuario_per = "and hr.id_usuario = ".$id_sessionJ;
	}
	
	$query_jg_historia = sprintf("SELECT hr.fecha_registro, comentario, web,
								 CONCAT(u.nombres,' ',u.apellidos) as usuario, hr.acta_observacion, hr.ubicacion_proyect
								  FROM hoja_ruta hr,
									   usuario u
								  WHERE hr.comentario <> '' and
								  		hr.id_radicado = %s
								    	AND hr.id_usuario   = u.id_usuario 
										and hr.id_usuario = u.id_usuario
								  ORDER BY hr.fecha_registro DESC ".$usuario_per." ", $row_jg_radicado['id_radicado']);
	//echo $query_jg_historia;
	$jg_historia = mysql_query($query_jg_historia, $cx) or die(mysql_error());
	$row_jg_historia = mysql_fetch_assoc($jg_historia);
	$totalRows_jg_historia = mysql_num_rows($jg_historia);
	
	//carga los documentos
	$documentos_reg = documentos($row_jg_radicado['id_radicado'], 'GENERAL');
	$documentos_reg2 = documentos($row_jg_radicado['id_radicado'], 'CONSTRUCCION');
	$documentos_reg3 = documentos($row_jg_radicado['id_radicado'], 'RECONOCIMIENTO');
	$documentos_reg4 = documentos($row_jg_radicado['id_radicado'], 'ADICIONAL');
	$documentos_reg5 = documentos($row_jg_radicado['id_radicado'], 'MUNICIPAL');
	$documentos_reg6 = documentos($row_jg_radicado['id_radicado'], 'URBANIZACION');
	$documentos_reg7 = documentos($row_jg_radicado['id_radicado'], 'PARCELACION');
}

//listado de documentos generales
$query_jg_documento = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'GENERAL' ORDER BY nombre_corto ASC";
$jg_documento = mysql_query($query_jg_documento, $cx) or die(mysql_error());
$row_jg_documento = mysql_fetch_assoc($jg_documento);
$totalRows_jg_documento = mysql_num_rows($jg_documento);

//listado de documentos adicionales para licencias de construccion
$query_jg_documento2 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'CONSTRUCCION' ORDER BY nombre_corto ASC";
$jg_documento2 = mysql_query($query_jg_documento2, $cx) or die(mysql_error());
$row_jg_documento2 = mysql_fetch_assoc($jg_documento2);
$totalRows_jg_documento2 = mysql_num_rows($jg_documento2);

//listado de documentos adicionales para licencias de reconocimiento de edificaciones
$query_jg_documento3 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'RECONOCIMIENTO' ORDER BY nombre_corto ASC";
$jg_documento3 = mysql_query($query_jg_documento3, $cx) or die(mysql_error());
$row_jg_documento3 = mysql_fetch_assoc($jg_documento3);
$totalRows_jg_documento3 = mysql_num_rows($jg_documento3);

//listado de documentos adicionales GENERALES
$query_jg_documento4 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'ADICIONAL' ORDER BY nombre_corto ASC";
$jg_documento4 = mysql_query($query_jg_documento4, $cx) or die(mysql_error());
$row_jg_documento4 = mysql_fetch_assoc($jg_documento4);
$totalRows_jg_documento4 = mysql_num_rows($jg_documento4);

//listado de documentos adicionales municipales
$query_jg_documento5 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'MUNICIPAL' ORDER BY nombre_corto ASC";
$jg_documento5 = mysql_query($query_jg_documento5, $cx) or die(mysql_error());
$row_jg_documento5 = mysql_fetch_assoc($jg_documento5);
$totalRows_jg_documento5 = mysql_num_rows($jg_documento5);

//listado de documentos adicionales para licencias de urbanizacion
$query_jg_documento6 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'URBANIZACION' ORDER BY nombre_corto ASC";
$jg_documento6 = mysql_query($query_jg_documento6, $cx) or die(mysql_error());
$row_jg_documento6 = mysql_fetch_assoc($jg_documento6);
$totalRows_jg_documento6 = mysql_num_rows($jg_documento6);

//listado de documentos adicionales para licencias de parcelacion
$query_jg_documento7 = "SELECT id_documento, nombre_corto FROM documento WHERE estado = 1 and tipo = 'PARCELACION' ORDER BY nombre_corto ASC";
$jg_documento7 = mysql_query($query_jg_documento7, $cx) or die(mysql_error());
$row_jg_documento7 = mysql_fetch_assoc($jg_documento7);
$totalRows_jg_documento7 = mysql_num_rows($jg_documento7);

//no estaba haciendo nada y fue reemplazada por $id_sessionJ
// $id = $_SESSION['usuario'][0]['id_usuario'];

error_reporting(E_ALL);
error_reporting(-1);
// ini_set('display_errors', 'On');

?>

<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="UTF-8"> -->
	<script type="text/javascript">
function letras(campo){

campo.value=campo.value.toUpperCase();
}
</script>
<script type="text/javascript" src="../include/easynotification/easy.notification.js"></script>

<link media="screen" rel="stylesheet" href="colorbox/colorbox/colorbox.css" />
<script src='../js/jquery-1.7.2.min.js' type='text/javascript'></script>
<script src='../js/jquery.blockUI.js' type='text/javascript'></script>
<script src='../js/jquery.functions.js' type='text/javascript'></script>
<script src="colorbox/colorbox/jquery.colorbox.js"></script>
<script>
function cumplimiento(archivo)
{
	$.fn.colorbox({
		href:archivo+".php?tipo_cumplimiento=acta_cumplimiento", width:"78%", height:"82%", iframe:true
	});
}
</script>

<script>
function muestra_oculta(id){
	if (document.getElementById){ //se obtiene el id
		var div = document.getElementById(id); //se define la variable "el" igual a nuestro div
		div.style.display = (div.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
	}
}

function verifica_a(){
	if(confirm("Verifique el cumplimiento del Acta. \n \n Esta seguro del cumplimiento del Acta?")){
		document.getElementById("acta_p").checked = 'checked';
		document.form2.comentario.value='COMPLETAN ACTA DE OBSERVACIONES';
	}else{
		document.getElementById("acta_p").checked = '';
		document.form2.comentario.value='';
	}
}

function verifica_p(){
	if(confirm("Verifique el cumplimiento de la Prorroga. \n \n Esta seguro del cumplimiento de la prorroga?")){
		document.getElementById("prorroga_p").checked = 'checked';
		document.form2.comentario.value='COMPLETAN PRORROGA';
	}else{
		document.getElementById("prorroga_p").checked = '';
		document.form2.comentario.value='';
	}
}


function comentJuridico(){
	document.getElementById('comentario').value='RADICADO EN LEGAL Y DEBIDA FORMA, PASA A COMUNICAR';
	document.getElementById('ubicacion').value = 'comunicacion';
}
</script>

<style type="text/css">
.tituloCuadro2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #003366;
}

#flota{
	width:35%;
	margin:2px;
	
	position: fixed;
	bottom: 0;
	z-index: 0;
}


<!--
.Estilo7 {font-family: "Times New Roman", Times, serif; font-weight: bold; }
.Estilo8 {font-family: "Times New Roman", Times, serif}
-->

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoja de Ruta</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/icon_styles.css" rel="stylesheet" type="text/css" />
<link href="../css/table_styles.css" rel="stylesheet" type="text/css" />

<link href="../css/arquitectonico.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo2 {font-size: 12px}
.Estilo9 {color: #000000}
.Estilo10 {font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>
<center>
 
<?php
$id_sessionJ= $_SESSION['usuario'][0]['id_usuario'];
 $sexto_acceso= array(29, 8, 64, 40, 65, 35, 48, 3, 56, 53, 18, 19, 69, 62, 64, 66, 41, 55, 50, 70, 57); ?>

<div style="padding-top:12px; width:530px;"> 
	<?php if(in_array($id_sessionJ, $sexto_acceso) || $id_sessionJ == $Row_Result1Radicado['revisor']){ ?>
  <input name="bot" type="button" class="boton" id="acta" onclick="window.open('comentarios/actas.php','width=1000,height=550,toolbar=yes')" value="Acta de Observaciones" />
	<?php } echo categoria();?>
</div>
<!--  <script>
  onclick="mje_nuevo();"
  function mje_nuevo(){alert('Error de sistemas');}
  </script>-->
  <!-- window.open('comentarios/actas.php','width=1000,height=550,toolbar=yes') -->
</center><br/>

<?php echo "$men";?></p><br/>
	<div align="center"><?php echo anulados($nro_radicado, 'consulta'); ?>
	</div><center></center>
	<div align="center" style="background: #FFCC66" >	<?php echo desistidos($nro_radicado, 'consulta'); ?>
	</div>
	<br />
<table width="905" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="1" height="19"></td>
    <td width="920"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="1"></td>
  </tr>
  <tr>
    <td height="19"></td>
    <td valign="top">
    <form id="form1" name="form1" method="post" action="">
      <div align="right"><span class="submenubgd"> Radicado:</span> <span class="submenubgd">
        <input name="consecutivo" type="text" disabled="disabled" id="consecutivo" value="<?php echo $_SESSION['conse']; ?>" size="6" maxlength="6"/>
        </span>
		    <input name="buscaradicado" type="text" id="buscaradicado"  size="6" maxlength="6" autofocus/>
            <input name="buscar" type="submit" class="boton" id="buscar" value="Buscar"/>
        &nbsp;&nbsp; </div>
    </form></td>
    <td></td>
  </tr>
  <tr>
    <td height="19"></td>
    <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td height="323"></td>
    <td valign="top">
    <form id="form2" name="form2" method="POST" action="<?php echo $editFormAction; ?>">
<!-- DENTRO ERROR HA DE SER DE LLAVES -->
      <table width="929" border="0">
        <tr>
          <td width="432" valign="top">
          	<fieldset class="fondoArea01">
            <legend class="tituloCuadro"><strong>Informaci&oacute;n Radicado</strong></legend>
<!-- REVISADA -->
            <table width="413" height="586" border="0">
            <tr>
              <td class="texto2">
<!-- REVISADA -->
              	<table width="413" height="586" border="0">
                <tr>
                  <td width="94" height="21" align="right" class="texto2"><div align="left"><strong>Radicado:</strong></div></td>
                  <td width="213" class="texto2"> <?php echo $row_jg_radicado['nro_radicado']; ?>
                    <input value="<?php echo $row_jg_radicado['nro_radicado']; ?>" type="hidden" id="nro_radicado" name="nro_radicado" />
                  </td>
                </tr>
                <tr>
                  <td height="23" valign="top" class="texto2"><strong>Fecha Radicado </strong></td>
                  <td class="texto2"> <?php echo $row_jg_radicado['fecha_radicado']; ?> </td>
                </tr>
                <tr>
                  <td height="23" valign="top" class="texto2"><div align="left"><strong>Proyecto:</strong></div></td>
                  <td class="texto2"> <?php echo $row_jg_radicado['proyecto']; ?></td>
                </tr>
                <tr>
                  <td height="21" valign="top" class="texto2"><div align="left"><strong>Descripci&oacute;n:</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['observaciones']; ?></td>
                </tr>
                <tr>
                  <td height="19" class="texto2"><strong>Propietario:</strong></td>
                  <td class="texto2"><?php echo $row_jg_radicado['propietario']; ?></td>
                </tr>
                <tr>
                  <td height="19" class="texto2"><div align="left"><strong>telefono propietario</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['telefono_propietario']; ?></td>
                </tr>
                <tr>
                  <td height="20" class="texto2"><strong>Arq. Revisor </strong></td>
                  <td class="texto2">
                  	<?php if(empty($Row_Result1Radicado['revisor'])){ echo ' <label class="texto_mitad_titlerojo Estilo1">NO ASIGNADO</label>';}else if(empty($_SESSION['radicado']))
                  		{ echo '';}
                  		else{echo '<label class="texto_mitad_titlerojo Estilo1"> '.$Row_Result1Radicado['revisor'].' </label>';} ?>
          		  </td>
                </tr>
                <tr>
                  <td height="20" class="texto2"><div align="left"><strong>Profesional:</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['profesional']; ?></td>
                </tr>
                <tr>
                  <td height="20" class="texto2"><div align="left"><strong>Ingeniero:</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['ingeniero']; ?></td>
                </tr>
                <tr>
                  <td height="18" class="texto2"><div align="left"><strong>Constructor:</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['constructor']; ?></td>
                </tr>
                <tr>
                  <td height="34" class="texto2"><div align="left"><strong>Direcci&oacute;n:</strong></div></td>
                  <td class="texto2">
                  	<?php echo limpiar_direccion($row_jg_radicado['direccion1']); ?>&nbsp; <?php echo limpiar_direccion($row_jg_radicado['direccion2']); ?>&nbsp; <?php echo limpiar_direccion($row_jg_radicado['direccion3']); ?>
                  </td>
                </tr>
                <tr>
                  <td height="23" align="right" class="texto2"><div align="left"><strong>Barrio:</strong></div></td>
                  <td class="texto2"><?php echo $row_jg_radicado['barrio']; ?></td>
                </tr>
                <tr>
                  <td height="21" colspan="3" valign="top" class="texto2"><div id="ejecutorias">
                    <?php include('muestra_ejecutorias.php'); ?>
                  </div></td>
                </tr>
                <tr>
                  <td height="21" valign="top" class="texto2"><strong>Nro. folios Carolina: </strong></td>
                  
                  <?php $septimo_acceso= array(18, 20, 50, 70, 58, 71, 29); ?>
                  <td>
                  	<?php if(in_array($id_sessionJ, $septimo_acceso)){ ?>
                    <input type="text" name="folios" value="<?php echo $row_jg_radicado['folios']; ?>" />
                    <?php }else{ echo $row_jg_radicado['folios']; } ?>
                  </td>
                </tr>
                <tr>
                  <td height="64" valign="top" class="texto2"><p align="left"><strong>Observaci&oacute;n:</strong></p></td>
                  <td><textarea name="comentario" onchange="letras(this)" cols="27" rows="3"  id="comentario"></textarea>
                    <input name="id_radicado" type="hidden" id="id_radicado" value="<?php echo $row_jg_radicado['id_radicado']; ?>" />
                    <input type="hidden" name="MM_insert" value="form2" /></td>
                </tr>
                 <?php $octavo_acceso= array(29, 20, 18, 37, 50, 70);
                 if(in_array($id_sessionJ, $octavo_acceso)){
				  echo '<tr>
                      	<td height="61" valign="top" bgcolor="#CCFFFF" class="texto2">
                      		<div align="left"><strong>Observaci&oacute;nes/  Web:</strong></div>
                      	</td>
                        <td bgcolor="#CCFFFF">
                        	<textarea name="cweb" cols="27" rows="3" onchange="letras(this)" class="fondoWeb" id="cweb"></textarea>
                        </td>'; 
                 }

                 $noveno_acceso= array(29, 8, 64, 19, 69, 66, 62, 64, 3, 34, 47, 48, 55, 53);

                 if(in_array($id_sessionJ, $noveno_acceso)){ 
                 	?>
                <tr>
                	
                    <span class="texto_mitad_titleazul Estilo1">ACTA DE OBSERVACIONES</span></td>
                    <?php }
                	
                	$decimo_acceso= array(29, 8, 64, 19, 69, 66, 62, 64, 3, 34, 47); ?>
                  <td height="21" colspan="3" align="left">
                  	<input name="actaobservaciones" 
                  		<?php if(in_array($id_sessionJ, $decimo_acceso)){ ?> fonchange="document.form2.comentario.value='SE REALIZA ACTA DE OBSERVACIONES' "<?php } ?>  type="radio" value="1" 
                  		<?php if($jg_actaobs['actaobservaciones'] == 1 and $jg_hjcomentario2['comentario'] == 'SE REALIZA ACTA DE OBSERVACIONES' ){ echo "checked";}  ?> />
                    <span class="texto_mitad_titleazul Estilo1">ACTA DE OBSERVACIONES</span></td>
                    <?php }else{ // evaluar si este else esta haciendo algo para eliminarlo?>
                  <?php } ?>
                  </tr>
                  <?php 
                  $onceavo_acceso= array(3, 8, 19, 69, 66, 29, 34, 47, 48, 50, 70, 53, 55, 57, 62, 63, 64);

                 if(in_array($id_sessionJ, $onceavo_acceso)){ 
                 	?>
                  <tr>
                  	<?php $doceavo_acceso= array(3, 8, 19, 69, 66, 29, 34, 47, 48, 50, 70, 53, 55, 57, 62, 63, 64); ?>
                  	 <td height="21" colspan="3" align="left">
                  	 	<input name="obscoment" 
                  	 	<?php if(in_array($id_sessionJ, $doceavo_acceso)){ ?> 
                  	 		onclick="cumplimiento('actas_cumplimiento/acta_cumplimiento');document.getElementById('cboxClose').style.display='block';" 
                  	 		<?php } ?>  type="radio" value="" 
              	 		<?php if($jg_obscoment['obscoment'] == 1){ echo "checked";}  ?> />
                    <span class="texto_mitad_titleazul Estilo1">OBSERVACIONES</span>
                     </td>
                     <?php } else { ?>
                  <?php } ?>
                  </tr>
                  <tr>
                
                <?php if( $id_sessionJ== 29 ) {?>
                <tr>
                  <td height="28" colspan="2" align="left">
                  	<input name="firmado" 
                  	<?php if( $id_sessionJ== 29 ) { ?>
                  		onchange="document.form2.comentario.value='FIRMADO-CAROLINA' "
                  	<?php } ?>  type="radio" value="1" 
                  	<?php if($jg_firmado['firmado'] == 1 and $jg_hjcomentario['comentario'] == 'FIRMADO-CAROLINA' ){ echo "checked"; } ?> />
                    <span class="texto_mitad_titleazul Estilo1">FIRMADO</span></td>
                  <?php } else { ?>
                  <?php } ?>
                  <td width="92" rowspan="2" align="center"><?php ?>
                    <?if( $id_sessionJ== 29 ) { ?>
                    <input name="Submit" type="submit" class="boton" onclick="xmlhttp=new XMLHttpRequest(); xmlhttp.open('GET', 'http://192.168.0.4:8080/saul/app_dev.php/integracion/crear_licencia/<?php echo $row_jg_radicado['nro_radicado'];?>', true);xmlhttp.send();" value="Guardar" 
                    	<?php echo ($row_jg_radicado['id_radicado'] == '') ? 'disabled' : ''; ?> /></td>
                  <?php } else { ?>
                  <td width="92" rowspan="2" align="center">
                  	<input name="Submit" type="submit" class="boton" value="Guardar" <?php echo ($row_jg_radicado['id_radicado'] == '') ? 'disabled' : ''; ?> />
                  </td>
                  <?php } ?>
                  <input name="enviado_hr" type="hidden" id="enviado_hr" value="1" />
                </tr>
                
                <?if( $id_sessionJ== 29 ) { ?>
                <tr>
                  <td height="39" colspan="2" align="left">
                  	<input name="firma_d" 
                  	<?if( $id_sessionJ== 29 ) { ?>
                  		onchange="document.form2.comentario.value='FIRMADO DESISTIMIENTO-CAROLINA' "
                  	<?php } ?>  type="radio" value="1" 
                  	<?php if($jg_firma_d['firma_d'] == 1 and $jg_hjcomentario1['comentario'] == 'FIRMADO DESISTIMIENTO-CAROLINA' ){ echo "checked"; } ?> />
                    <span class="texto_mitad_titleazul Estilo1">FIRMADO DESISTIMIENTO</span></td>
                </tr>
                <?php } else { ?>
                <?php } ?>
<!-- REVISADA -->
              </table>
            </td>
            </tr>
<!-- REVISADA -->
            </table>
          </fieldset>
                <?php 
                $treceavo_acceso= array(3, 56, 18, 50, 70, 58, 71, 29);

                 if(in_array($id_sessionJ, $treceavo_acceso)){ 
                ?>
            <fieldset class="fondoArea01">
                <legend class="tituloCuadro"><strong>Estado Licencia <?php echo $alert[0]; ?> </strong>
                </legend>
<!-- REVISADA -->
              <table width="410" border="0">
                  <tr>
                    <td width="134" height="24" class="texto2" >
                    	<label>
                    	<?php 
                    	
                    	$catorceavo_acceso= array(3, 18, 50, 70, 58, 71); ?>

                      	<input name="licencia" 
                      	<?php if(in_array($id_sessionJ, $catorceavo_acceso)){ ?>
                      		onchange="document.form2.comentario.value='ORIGINAL OK' "
                      	<?php } ?>  type="radio" value="1" 
                      	<?php if($jg_est['estado'] == 1){ echo "checked"; } ?> />
                      	</label>
                    	<label class="texto_mitad_titlerojo Estilo1">ORIGINAL</label>
                	</td>
                    <td width="131" class="texto2">
                    	<input name="Licencia" type="radio" value="0" 
                    	<?php if($jg_est['estado'] == 0){ echo "checked"; } ?>  
                    	<?php if($jg_est['estado'] == 1){ echo "disabled = 'disabled'"; } ?>/>
                        <label class="texto_mitad_titlerojo Estilo1">BORRADOR </label>
                    &nbsp;</td>
                  </tr>
<!-- REVISADA -->
            </table>
            </fieldset>
            <?php }?>
<!-- REVISADA -->
            <table width="442">
                  <tr>
                    <td width="434"><fieldset class="fondoArea01">
                      <legend class="tituloCuadro"><strong>Estado Radicaci&oacute;n </strong></legend>
<!-- REVISADA -->
                      <table width="431" border="0">
                        <tr>
                        	<?php 
	                        	$quinceavo_acceso= array(40, 65, 33, 3, 56);
                        	 ?>
                          <td width="104" height="24" class="texto2" >
                          	<input name="formulario" 
                          	<?php 
//verificar este if que no esta haciendo nada por ahora
                          	if(in_array($id_sessionJ, $quinceavo_acceso) || $id_sessionJ == $row_jg_radicado_actual['id_usuario']){echo "";
                          	}else{echo "";}?> 
                          	<?php if($row_jg_radicado['estado_pro'] == 'completo' || $row_jg_radicado['estado_pro'] == 'comunicado'){echo 'disabled = "disabled"';} ?> type="radio" 
                          	<?php if($row_jg_radicado['estado_pro'] == 'a comunicar'){ echo "checked"; } ?> value="a comunicar" onclick="comentJuridico();" />
                              <span class="texto_mitad_titlerojo">A COMUNICAR </span> 
                          </td>
                          <td width="103" class="texto2" >
                          	<label>
	                            <input name="formulario"
								<?
								$diesiesvo_acceso= array(40, 65, 33, 3, 56, 18, 50, 70, 58, 71, 29);
	//verificar este itf que no esta haciendo nada por ahora
								 if(in_array($id_sessionJ, $diesiesvo_acceso)){ echo "";}
								 else{echo "";}?> type="radio" value="comunicado" 
								 <?php if($row_jg_radicado['estado_pro'] == 'completo' || $row_jg_radicado['estado_pro'] == 'comunicado'){ echo "checked"; } ?> />
                            </label>
                            <label class="texto_mitad_titlerojo Estilo2">COMUNICADO</label>
                          </td>
                          <td width="122" class="texto2">
                          	<input name="formulario" 
                          	<?php 
                      		$diesieteavo_acceso= array(40, 65, 33, 3, 56);
	//verificar este itf que no esta haciendo nada por ahora
                      		if(in_array($id_sessionJ, $diesieteavo_acceso) || $id_sessionJ == $row_jg_radicado_actual['id_usuario']){echo "";
                      		}else{echo "";}?> type="radio" onclick="document.form2.acta.disabled = true" 
                      		<?php if($row_jg_radicado['estado_pro'] == 'completo' || $row_jg_radicado['estado_pro'] == 'comunicado'){echo 'disabled = "disabled"';} ?>  value="incompleto"  
                      		<?php if($row_jg_radicado['estado_pro'] == 'incompleto' || empty($row_jg_radicado['estado_pro'])){ echo "checked"; } ?> />
                              <label class="texto_mitad_titlerojo">NO COMUNICADO </label>
                           </td>
                          <?php 
                          	$diesiochoavo_acceso= array(40, 65, 33, 18, 50, 70, 58, 71, 3, 56, 29);
                          	  if(in_array($id_sessionJ, $diesiochoavo_acceso)){
                          	?>
                          <td width="84" class="texto2">
                          	<input name="formulario" type="radio" value="desistido"  
                          	<?php if($row_jg_radicado['estado_pro'] == 'desistido'){ echo "checked"; } ?>
                          	<?php if($jg_est['estado'] == 1){ echo "disabled = 'disabled'"; } ?> />
                              <label class="texto_mitad_titlerojo Estilo2">DESISTIDO</label>
                          </td>
                          <?php }?>
                        </tr>
                      </table>
<!-- REVISADA -->
                      </fieldset>
                        <fieldset class="fondoArea01">
                        <legend class="tituloCuadro"><strong style="cursor:pointer" onclick="muestra_oculta('desplegable')">Mostrar/Ocultar Licencias</strong></legend>
                          <div id="desplegable" style="display:none">
<!-- REVISADA -->
                          <table width="413" border="0">
                            <tr>
                              <td width="107" class="texto2">
                              	<div align="right"> Reconocimiento: </div>
                              </td>
                              <td width="60">
                              	<input name="textfield" type="text" readonly value="<?= $lic_reconocimiento ?>" size="10" maxlength="10" />
                              </td>
                              <td width="168" class="texto2">
                              	<div align="right">Lic. Urb. Construcci&oacute;n</div>
                              </td>
                              <td width="60">
                              	<input name="textfield4" type="text" readonly value="<?= $lic_urb_arquitectonica ?>" size="10" maxlength="10" />
                              </td>
                            </tr>
                            <tr>
                              <td class="texto2">
                              	<div align="right">Lic. Construcci&oacute;n: </div>
                              </td>
                              <td>
                              	<input name="textfield2" type="text" readonly value="<?= $lic_construccion ?>" size="10" maxlength="10" />
                              </td>
                              <td class="texto2">
                              	<div align="right">Lic. Subdivisi&oacute;n:</div>
                              </td>
                              <td>
                              	<input name="textfield5" type="text" readonly value="<?= $lic_subdivision ?>" size="10" maxlength="10" />
                              </td>
                            </tr>
                            <tr>
                              <td height="24" class="texto2">
                              	<div align="right">Lic. Urbanizaci&oacute;n: </div>
                              </td>
                              <td>
                              	<input name="textfield3" type="text" readonly value="<?= $lic_urbanistica ?>" size="10" maxlength="10" />
                              </td>
                              <td class="texto2">
                              	<div align="right">Lic. PH:</div>
                              </td>
                              <td>
                              	<input name="textfield6" type="text" readonly value="<?= $lic_ph ?>" size="10" maxlength="10" />
                              </td>
                            </tr>
<!-- REVISADA -->
                          </table>
                          </div>
                        </fieldset></td>
                  </tr>
<!-- REVISADA -->
            </table>           
          </td>
          <td width="10" height="569">
          </td>
          <td width="457" valign="top">
          	<fieldset class="fondoArea01">
            <legend class="tituloCuadro"><strong>Requisitos Generales </strong>
            </legend>
            <!-- #container -->
            <div id="contenido_scroll2">
              <!-- #contenido_scroll -->
<!-- REVISADA -->
              <table  border="0" width="100%">
                <?php $contTemp = 0;
               $diesinueveavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 56 68);
				  do { ?>
                <tr>
                  <td width="22"><input name="documento[]" type="checkbox" id="documento[]" 
                  	<?php 
            //evaluar este itf que al parecer no esta haciendo nada
					if(in_array($id_sessionJ, $diesinueveavo_acceso)){echo "";
					}else{echo "";}?> value="<?php echo $row_jg_documento['id_documento']; ?>" 
					<?php if($row_jg_documento['id_documento'] == $documentos_reg[$contTemp]){ echo "checked"; $contTemp++; }  ?>  />
				  </td>
                  <td width="401" class="submenubgd"><?php echo $row_jg_documento['nombre_corto']; ?>
                  </td>
                </tr>
                <?php } while ($row_jg_documento = mysql_fetch_assoc($jg_documento)); ?>
<!-- REVISADA -->
              </table>
              <div>
                <label></label>
              </div>
            </div>
            <!-- /#container -->
            </fieldset>
                <fieldset class="fondoArea01">
                <legend class="tituloCuadro"><strong>Documentos Adicionales Licencias </strong></legend>
                  <div id="contenido_scroll">
                    <!-- #contenido_scroll -->
<!-- REVISADA -->
                  <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" /></td>
                      <td width="80" class="tituloCuadro2"><div align="center">Construccion</div></td>
                      <td width="196"><hr size="3" align="left" width="100%" /></td>
                    </tr>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                    <table width="100%" border="0">
                    <?php $contTempp = 0;
                      	$veinteavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 68);
				  do { ?>
                    <tr>
                      <td width="22"><input name="documento[]" type="checkbox" id="documento[]" 
                      	<?php 
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veinteavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento2['id_documento']; ?>" 
						<?php if($row_jg_documento2['id_documento'] == $documentos_reg2[$contTempp]){ echo "checked"; $contTempp++; }  ?>  />
					  </td>
                      <td width="398" class="submenubgd"><?php echo $row_jg_documento2['nombre_corto']; ?></td>
                    </tr>
                    <?php } while ($row_jg_documento2 = mysql_fetch_assoc($jg_documento2)); ?>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                    <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" /></td>
                      <td width="97" class="tituloCuadro2"><div align="center">Reconocimiento</div></td>
                      <td width="179"><hr size="3" align="left" width="100%" /></td>
                    </tr>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                    <table width="100%" border="0">
                    <?php $contTempp2 = 0;
                      	$veintiunoavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 68);
				  do { ?>
                    <tr>
                      <td width="25"><input name="documento[]" type="checkbox" id="documento[]" 
                      	<?php 
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veintiunoavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento3['id_documento']; ?>" 
						<?php if($row_jg_documento3['id_documento'] == $documentos_reg3[$contTempp2]){ echo "checked"; $contTempp2++; }  ?>  />
					  </td>
                      <td width="395" class="submenubgd"><?php echo $row_jg_documento3['nombre_corto']; ?>
                      </td>
                    </tr>
                    <?php } while ($row_jg_documento3 = mysql_fetch_assoc($jg_documento3)); ?>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                  <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" />
                      </td>
                      <td width="80" class="tituloCuadro2">
                      	<div align="center">Urbanizacion</div>
                      </td>
                      <td width="196"><hr size="3" align="left" width="100%" />
                      </td>
                    </tr>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                    <table width="100%" border="0">
                    <?php $contTempp = 0;
                      	$veintidosavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 68);
				  do { ?>
                    <tr>
                      <td width="22"><input name="documento[]" type="checkbox" id="documento[]" 
                      	<?php 
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veintidosavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento6['id_documento']; ?>" 
						<?php if($row_jg_documento6['id_documento'] == $documentos_reg6[$contTempp])
							{ echo "checked"; $contTempp++; }  ?>  />
					  </td>
                      <td width="398" class="submenubgd"><?php echo $row_jg_documento6['nombre_corto']; ?>
                      </td>
                    </tr>
                    <?php } while ($row_jg_documento6 = mysql_fetch_assoc($jg_documento6)); ?>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                  <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" /></td>
                      <td width="80" class="tituloCuadro2"><div align="center">Parcelacion</div></td>
                      <td width="196"><hr size="3" align="left" width="100%" /></td>
                    </tr>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                    <table width="100%" border="0">
                    <?php $contTempp = 0;
                      $veinticuatroavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 68);
				  do { ?>
                    <tr>
                      <td width="22"><input name="documento[]" type="checkbox" id="documento[]" 
                      	<?php 
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veinticuatroavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento7['id_documento']; ?>" 
						<?php if($row_jg_documento7['id_documento'] == $documentos_reg7[$contTempp])
						{ echo "checked"; $contTempp++; }  ?>  />
					  </td>
                      <td width="398" class="submenubgd"><?php echo $row_jg_documento7['nombre_corto']; ?>
                      </td>
                    </tr>
                    <?php } while ($row_jg_documento7 = mysql_fetch_assoc($jg_documento7)); ?>
<!-- REVISADA -->
                  </table>
                  </div>
                  <!-- /#container -->
              </fieldset>
            <!-- /#container -->
            <fieldset class="fondoArea01">
                <legend class="tituloCuadro"><strong>Documentacion Adicionales </strong>
                </legend>
              <div id="contenido_scroll">
                <!-- #contenido_scroll -->
<!-- REVISADA -->
                  <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" />
                      </td>
                      <td width="60" class="tituloCuadro2"><div align="center">Generales</div>
                      </td>
                      <td width="216"><hr size="3" align="left" width="100%" />
                      </td>
                    </tr>
<!-- REVISADA -->
                  </table>
<!-- REVISADA -->
                <table width="100%" border="0">
                    <?php $contTempp3 = 0;
                      	$veinticincoavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 19, 69, 66, 62, 64, 34, 47, 68);
				  			do { 
					?>
                    <tr>
                      <td width="25"><input name="documento[]2" type="checkbox" id="documento[]2" 
                      	<?
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veinticincoavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento4['id_documento']; ?>" 
						<?php if($row_jg_documento4['id_documento'] == $documentos_reg4[$contTempp3])
							{ echo "checked"; $contTempp3++; }  ?>  />
					  </td>
                      <td width="395" class="submenubgd">
                      	<?php if($row_jg_documento4['id_documento'] ==49){ echo '<b>'.$row_jg_documento4['nombre_corto'].'</b>';
                      		}else{echo $row_jg_documento4['nombre_corto'];} ?>
                	  </td>
                    </tr>
                    <?php } while ($row_jg_documento4 = mysql_fetch_assoc($jg_documento4)); 
					?>
<!-- REVISADA -->
                </table>
<!-- REVISADA -->
                <table width="100%" border="0" align="center">
                    <tr>
                      <td width="160" class="tituloCuadro2"><hr size="3" align="right" width="100%" /></td>
                      <td width="80" class="tituloCuadro2"><div align="center">Municipales</div></td>
                      <td width="196"><hr size="3" align="left" width="100%" /></td>
                    </tr>
<!-- REVISADA -->
                </table>
<!-- REVISADA -->
                <table width="102%" border="0">
                    <?php $contTempp4 = 0; 
                  $veintiseisavo_acceso= array(14, 40, 65, 33, 29, 8, 64, 3, 8, 64, 19, 69, 66, 62, 64, 34, 47, 68);
		  					do{ 
					?>
                    <tr>
                      <td width="25"><input name="documento[]" type="checkbox" id="documento[]" 
                      	<?php 
                 //evaluar este itf que al parecer no esta haciendo nada
						if(in_array($id_sessionJ, $veintiseisavo_acceso)){echo "";
						}else{echo "";}?> value="<?php echo $row_jg_documento5['id_documento']; ?>" 
						<?php if($row_jg_documento5['id_documento'] == $documentos_reg5[$contTempp4])
							{ echo "checked"; $contTempp4++; }  ?>  />
                      </td>
                      <td width="395" class="submenubgd"><?php echo $row_jg_documento5['nombre_corto']; ?>
                      </td>
                      
                    </tr>
                    <?php } while ($row_jg_documento5 = mysql_fetch_assoc($jg_documento5));
					?>
<!-- REVISADA -->
                </table>
              </div>
              
            </fieldset> <!--Se Actualizan los usuarios att: David Sandoval 02/Agosto/2016-->
            <?php $muestra = array(3, 8, 18, 19, 29, 33, 34, 40, 46, 47, 48, 53, 55, 62, 63, 64, 65, 66, 69); 
/*condicon*/		  if(($row_jg_radicado['formulario'] == 'completo' && compruebaActos($radicado) == 0) || compruebaActos($radicado) == 1){
			?>
            
            <fieldset class="fondoArea01" 
            	<?php if(!in_array($id, $muestra)){ echo "style='display:none'";
 /*REVISAR LLAVE DE CIEREE*/}else{ echo "style='display:block'";?>>
                <legend class="tituloCuadro"><strong>Actos de suspensi&oacute;n de T&eacute;rminos </strong>
                </legend>
                
             <div style="float:left; ">
<!-- REVISADA -->
             	<table width="181" border="0" >
 <!--abre1-->  	 <tr>	
 						<?php if($alert_com1[0] > 0){ echo '<td width="20px"></td>';}
						else if($alert_com1[0] == 0 && $ultimo[2] == 'ninguna' ){ echo "<td width='20px'></td>";
						}else{
				 	?>
                       
                    	<td width="20" height="26" bordercolor="#99FFFF" align="center" bgcolor="#D5FFFF">
                    		<input id="radio" name="acta" 
                    		<?php if($row_acta['acta_observacion'] == 'ninguna' || $row_acta['acta_observacion'] == 'ninguna2'){echo 'disabled = "disabled"';
                    		} ?>  type="radio" onchange="document.form2.comentario.value='SE NOTIFICA ACTA DE OBSERVACIONES, PASA A INCOMPLETOS'" value="Acta de observaciones"
                    		<?php if($jg_hjcomentario3['comentario'] == 'SE NOTIFICA ACTA DE OBSERVACIONES, PASA A INCOMPLETOS'){ echo "checked"; }?> 
                    		<?php if($jg_actapago ['comentario'] == 'SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA'){ echo "disabled = 'disabled'"; } ?>  
                    		<?php if($jg_hjcomentario4['comentario'] == 'SE REALIZA PRORROGA'){ echo "disabled = 'disabled'"; } ?>
                    
                    />
                    </td>
                    
                    <td colspan="2" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2">ActaObs
                    </td>
 <!--cierra1-->   <?php }?>
 
 <!--abre2-->      <?php if($alert_com1[0] > 0 || $ultimo[2] == 'ninguna' ){ echo '<td class="texto2" width="20px"></td>';}
						else{
				 	?>
                    <td width="26" bordercolor="#99FFFF" align="center" bgcolor="#D5FFFF">
                    	<input name="acta" type="radio" id="radio2" onchange="document.form2.comentario.value='SE REALIZA PRORROGA'" value="prorroga" 
                    	<?php if($row_acta2['acta_observacion'] == 'ninguna' || $row_acta2['acta_observacion'] == 'ninguna2' || $jg_apagono['comentario'] == 'NO COMPLETAN ACTA DE PAGO' || $jg_hjcomentario5['comentario'] == 'NO COMPLETA ACTA')
                    		{echo 'disabled = "disabled"';} 
                    	if($jg_hjcomentario4['comentario'] == 'SE REALIZA PRORROGA'){ echo "checked = '1'"; } 
                    	?>/>
                    </td>
                    
                    <td colspan="2" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2 Estilo9">Prorroga
                    </td>
 <!--cierra2-->    <?php } ?>
              </tr>
              <tr>
 <!--abre3-->  <?php if($alert_com1[0] > 0 && $alert_com4[2] !== 'prorroga' && $alert_com1[2] == 'completa acta')
 				{ echo '<td style="border:solid 1px #80A5FD" bgcolor="#E6F1FF" class="texto2" rowspan="4" width="25px"><a style="cursor:pointer;" onclick="cumplimiento(\'actas_cumplimiento/acta_cumplimiento\');document.getElementById(\'cboxClose\').style.display=\'block\';"><center><strong>Acta de Observaciones Cumplida</strong></center></a></td>';}
				else if($alert_com1[0] > 0 && $alert_com4[2] === 'prorroga' && $alert_com1[2] == 'completa acta' )
				{ echo '<td style="border:solid 1px #80A5FD" bgcolor="#E6F1FF" class="texto2" rowspan="4" width="25px"><center><strong>Acta de Observaciones Cumplida en Prorroga</strong></center></td>';
				}else{
				 	?>
                    <td height="26" colspan="3" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2">
                    	<div align="center"><strong>Aprobada</strong>
                    	</div>                      
                    	<div align="center" class="Estilo9"></div>
                    </td>
                    <td height="26" bordercolor="#99FFFF" bgcolor="#D5FFFF" align="center" class="texto2">
                    	<span class="Estilo10">
	                      <input name="completado" id="prorroga_p" type="radio" class="prorroga" onchange="" onclick="verifica_p();" value="completa prorroga" 
	                      <?php if($row_acta['acta_observacion'] == 'ninguna' || $row_acta['acta_observacion'] == 'ninguna2'){echo 'disabled = "disabled"';}
	                      if($ultimo[2] == 'completa prorroga'){ echo "checked"; } ?> />
                    	</span>
                    </td>
                    <td height="26" colspan="2" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2"><div align="center"><strong>Entregada</strong></div>
                    </td>
 <!--cierra3--><?php } ?>
                                        				
               </tr>
 <!--abre4-->  <tr> 
 				<?php if($alert_com1[0] > 0){ echo '<td width="20px"></td>';}
					else if($alert_com1[0] == 0 && $ultimo[2] == 'ninguna' ){ echo "<td width='20px'></td>";}
					else{
				?>
                    <td height="26" colspan="2" bordercolor="#99FFFF" align="center" bgcolor="#D5FFFF">
                    	<input class="acta" id="acta_p" name="completado" type="radio"  onchange="document.form2.comentario.value='COMPLETAN ACTA DE OBSERVACIONES'"  onclick="verifica_a();  document.getElementById('pasa_lic').checked = true " value="completa acta" 
                    	<?php if($ultimo[2] == 'ninguna' || $ultimo[2] == 'ninguna2' || $jg_hjcomentario5['comentario'] == 'NO COMPLETA ACTA'){echo 'disabled = "disabled"';} if($ultimo[2] == 'completa acta'){ echo "checked"; }
                    	?>/>
                    </td>
                    
                    <td width="48" align="center" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2">Si
                    </td>
                    
 <!--cierra4-->   <?php } ?>
                    
 <!--abre5-->		<?php if($alert_com1[0] > 0 || $ultimo[2] == 'ninguna' )
 						{ echo '<td class="texto2" width="20px"></td>';}
					 else{
				 	?>
                    <td colspan="2" bordercolor="#99FFFF" align="center" bgcolor="#D5FFFF">
                    	<input name="completado"  type="radio" 
                    <?php 
                    		$veintisitesavo_acceso= array(29, 8, 64, 19, 69, 66, 62, 64, 3, 34, 47);
        //revisar funcionalidad de y gerarqui de las comillas 
						if(in_array($id_sessionJ, $veintisitesavo_acceso)){?>
							onchange="document.form2.comentario.value='NO COMPLETA ACTA'"; <?php }?> class="Estilo7" value="no completa prorroga" 
						<?php 

						$veintiochoavo_acceso= array(35, 48, 53, 3, 29, 8, 64, 19, 69, 66, 62, 64, 29, 34, 47);

						if((!in_array($id_sessionJ, $veintiochoavo_acceso) && ($row_acta['acta_observacion'] == 'ninguna' || $row_acta['acta_observacion'] == 'ninguna2' || $alert_com2[0] > 0) ) || $jg_hjcomentario6['comentario'] == 'COMPLETAN ACTA DE OBSERVACIONES' || $jg_apagono['comentario'] == 'NO COMPLETAN ACTA DE PAGO')
							{echo 'disabled = "disabled"';}
		//revisar este condicional a ver si se mete en el mismo
						if($jg_apagosi['comentario'] == 'COMPLETAN ACTA DE PAGO'){ echo "disabled = '1'"; }
						if($ultimo[2] == 'no completa prorroga' || ($jg_hjcomentario3 ['comentario'] ==   'SE NOTIFICA ACTA DE OBSERVACIONES, PASA A INCOMPLETOS' && $jg_hjcomentario6['comentario'] !== 'COMPLETAN ACTA DE OBSERVACIONES' && $jg_hjcomentario5['comentario'] == 'NO COMPLETAN ACTA DE OBSERVACIONES')){ echo "checked"; }
						   ?>/>
					</td>
                    
                    <td width="65" align="center" bordercolor="#99FFFF" bgcolor="#D5FFFF" class="texto2">  
                    	No
                    </td>
                    
 <!--cierra5-->   <?php } 
                     // REVISAR ESTE CONDICIONAL, PARECE ESTAR VACIO 
 /*abre6*/     $act = alertas($_SESSION['radicado'], 'Acta de observaciones');	
				 	if($act[0] > 0){?>
 <!--cierra6-->   <?php } ?>
                                   
                    
                    
               </tr>
<!-- REVISADA -->
              </table>
          </div>
 <!--abre7-->   
 			<div style="float:left; "><span class="texto2">
			 </span>
<!-- REVISADA -->
			   <table width="106" height="86" border="0">
      			  <tr>	
                    <td class="texto2" bgcolor="#fbe2e2">
                    	<input id="radio3" name="acta" type="radio" onchange="document.form2.comentario.value='SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA'" value="acta pago" 
                    	<?php if($last_pago[2] == 'acta pago' || $jg_actapago ['comentario'] == 'SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA'){ echo "checked"; } 
/*REVISAR LOGICA AQUI*/if($id_sessionJ == 40 || $id_sessionJ == 65 ||  $id_sessionJ == 33 || $id_sessionJ == 3 || 						$id_sessionJ == 29){ ?>
                    		/>
	                    <?php }
                    	$veintinueveavo_acceso= array(40, 65, 33, 19, 69, 66, 62, 64, 44, 8, 29, 34, 47);
						else if(!in_array($id_sessionJ, $veintinueveavo_acceso) && $row_acta3['acta_observacion'] == 'acta pago'){?>
                    	<input name="acta2" type="hidden" value="<?php echo $row_acta3['acta_observacion']; ?>" />
                    <?php }?>
 <!--cierra7-->        <td colspan="3" bgcolor="#fbe2e2" class="texto2">
 							Acto tramite
 						</td>          
                  </tr>
                  <tr>
                    <td colspan="4" bgcolor="#fbe2e2" class="texto2">
                    	<div align="center" class="Estilo9"><strong>Cumplida</strong>
                    	</div>
                    </td>
                  </tr>
                  <tr>
                    <td width="20" bgcolor="#fbe2e2" class="texto2">
                    	<input name="completado" type="radio" onchange="document.form2.comentario.value='COMPLETAN ACTA DE PAGO'" onclick="document.getElementById('pasa_lic').checked = true" value="completa acta pago" 
                    	<?php if($jg_actapago ['comentario'] == 'SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA' && $jg_apagosi['comentario'] == 'COMPLETAN ACTA DE PAGO' && $jg_apagono['comentario'] !== 'NO COMPLETAN ACTA DE PAGO'){ echo "checked"; } 
                    	if($jg_apagono['comentario'] == 'NO COMPLETAN ACTA DE PAGO'){ echo "disabled = 'disabled'"; } 
                    	?> />
                    </td>
                    <td width="12" bgcolor="#fbe2e2" class="texto2">Si
                    </td>
                    <td width="20" bgcolor="#fbe2e2" class="texto2">
                    	<input name="completado" type="radio" onchange="document.form2.comentario.value='NO COMPLETAN ACTA DE PAGO'" onclick="document.getElementById('pasa_des').checked = true" value="no completa acta pago" 
                    	<?php if($jg_actapago ['comentario'] == 'SE REALIZA ACTA DE PAGO POR EXPENSAS E IMPUESTO, PASA A ARCHIVO INCOMPLETO Y EL DOCUMENTO A FIRMA' && $jg_apagosi['comentario'] !== 'COMPLETAN ACTA DE PAGO' && $jg_apagono['comentario'] == 'NO COMPLETAN ACTA DE PAGO'){ echo "checked"; }
                    	if($jg_apagosi['comentario'] == 'COMPLETAN ACTA DE PAGO'){ echo "disabled = 'disabled'"; } ?>/>
                    </td>
                    <td width="27" bgcolor="#fbe2e2" class="texto2">No
                    </td> 
 <!--abre8-->       <?php if($id_sessionJ == 40 || $id_sessionJ == 65){ ?>
 	<!-- REVISAR QUE ESTA VACIO -->
                    <?php }else if($id_sessionJ != 40 && $id_sessionJ !=65 && $id_sessionJ != 33 && $id_sessionJ == 37 && $row_acta3['acta_observacion'] == 'acta pago'){?>
                    	<input name="completado2" type="hidden" value="<?php if($alert_com3[0] > 0){ echo "completa acta pago"; } ?>" />
 <!--cierra8-->     <?php }?>
 <!--abre9-->       <?php $act = alertas($_SESSION['radicado'], 'Acta de observaciones');	
						 if($act[0] > 0){
					?>
 	<!-- REVISAR QUE ESTA VACIO -->
 <!--cierra9-->     <?php } ?>
                  </tr>
              </table>
          </div>    
<!-- REVISADA -->
                <table width="157" height="86"  border="0">
                  <tr>
        			<td width="159">
        				<input name="pasalicencia" type="radio"onchange="document.form2.comentario.value='PASA A LICENCIA'" value="1" 
        				<?php if($jg_pasalicencia['pasalicencia'] == 1){ echo "checked"; }
        				if($jg_hjcomentario7 ['comentario'] == 'PASA A DESISTIMIENTO'){ echo "disabled = 'disabled'"; } ?>/>
        				<span class="texto2">Pasa a  Licencia</span>
                    </td>
                  </tr>
                  <tr>
                  	<td>
                  		<input name="formulario" type="radio" onchange="document.form2.comentario.value='PASA A DESISTIMIENTO'" value="desistido" 
                  		<?php if($jg_hjcomentario7 ['comentario'] == 'PASA A DESISTIMIENTO'){ echo "checked"; } ?> />
                  		<span class="texto2">Pasa a Desistimiento</span>
                    </td>
      			  </tr>
                  <tr> 
                  	<?php if($id_sessionJ == 18 || $id_sessionJ == 3){?> 
                  	<td  width="159" class="texto2">
                  		<input name="completado" id="inicia_expedicion" type="radio" 
                  		<?php //REVISAR CONDICIONAL ES AMBIGUO
	                  		if($id_sessionJ == 18 || $id_sessionJ == 3){ ?> class="prorroga" onchange="" onclick="verifica_p();" <?php } ?> value="borrador ok"  
	                  		<?php if($jg_bok['comentario'] == 'BORRADOR OK'){  echo "checked";} ?>
                  		/>Inicia Expedici&oacute;n
                    </td>
        			<?php } ?>
      			  </tr>
                     
                  <?php } ?>
<!-- REVISADA -->
       		    </table>    
                <?php } ?>
            </fieldset>
          	  
             
                <fieldset class="fondoArea01">
                  <legend class="tituloCuadro"><strong>Ubicaci&oacute;n del Proyecto </strong>
                  </legend>
<!-- REVISADA -->
                  <table width="451" border="0">
                  <tr>
                    <td width="445" height="27" class="texto_mitad_titlerojo" >
                    	<?php if(in_array($id_sessionJ, $ubicaciones_per)){?>
                        <select name="ubicacion"  class="texto_mitad_titlerojo" id="ubicacion">
                          <option class="texto_mitad_titlerojo" value="ninguna" <?php echo ($row_acta['ubicacion_proyect'] == "Ninguna" || empty($query_jg_historia['ubicacion_proyect'])) ? "selected" : ""; ?> >Ninguna</option>
                          <option class="texto_mitad_titlerojo" value="archivo incompleto" <?php echo ($row_acta['ubicacion_proyect'] == "archivo incompleto") ? "selected" : ""; ?>>Archivo Incompleto</option>
                          <option class="texto_mitad_titlerojo" value="adrianita perdomo" <?php echo ($row_acta['ubicacion_proyect'] == "adrianita perdomo") ? "selected" : ""; ?>>Arq. Adrianita Perdomo</option>
                          <option class="texto_mitad_titlerojo" value="alex rodriguez" <?php echo ($row_acta['ubicacion_proyect'] == "alex rodriguez") ? "selected" : ""; ?>>Arq. Alex Rodriguez</option>
                          <option class="texto_mitad_titlerojo" value="carlos angulo" <?php echo ($row_acta['ubicacion_proyect'] == "carlos angulo") ? "selected" : ""; ?>>Arq. Carlos Angulo</option>
                          <option class="texto_mitad_titlerojo" value="dario lopez" <?php echo ($row_acta['ubicacion_proyect'] == "dario lopez") ? "selected" : ""; ?>>Arq. Dario Lopez Maya</option>
                          <option class="texto_mitad_titlerojo" value="felman tabares" <?php echo ($row_acta['ubicacion_proyect'] == "felman tabares") ? "selected" : ""; ?>>Arq. Felman Tabares</option>
                          <option class="texto_mitad_titlerojo" value="fernando torres" <?php echo ($row_acta['ubicacion_proyect'] == "fernando torres") ? "selected" : ""; ?>>Arq. Fernando Torres</option>
                          <option class="texto_mitad_titlerojo" value="ines hoyos" <?php echo ($row_acta['ubicacion_proyect'] == "ines hoyos") ? "selected" : ""; ?>>Arq. Ines Hoyos</option>
                          <option class="texto_mitad_titlerojo" value="kristhian salinas" <?php echo ($row_acta['ubicacion_proyect'] == "kristhian salinas") ? "selected" : ""; ?>>Arq. Kristhian Salinas</option>
                          <option class="texto_mitad_titlerojo" value="lina delgado" <?php echo ($row_acta['ubicacion_proyect'] == "lina delgado") ? "selected" : ""; ?>>Arq. Lina Delgado</option>
                          <option class="texto_mitad_titlerojo" value="gloria victoria" <?php echo ($row_acta['ubicacion_proyect'] == "gloria victoria") ? "selected" : ""; ?>>Arq. Gloria Patricia Victoria</option>
                          <option class="texto_mitad_titlerojo" value="yeiner soto" <?php echo ($row_acta['ubicacion_proyect'] == "yeiner soto") ? "selected" : ""; ?>>Arq. Yeiner Soto</option>
                          <option class="texto_mitad_titlerojo" value="juridico" <?php echo ($row_acta['ubicacion_proyect'] == "juridico") ? "selected" : ""; ?>>Margarita Rosa Banguero</option>
                          <option class="texto_mitad_titlerojo" value="juridico2" <?php echo ($row_acta['ubicacion_proyect'] == "juridico2") ? "selected" : ""; ?>>Valentina Valencia Rodriguez</option>
                          <option class="texto_mitad_titlerojo" value="revision estructural" <?php echo ($row_acta['ubicacion_proyect'] == "revision estructural") ? "selected" : ""; ?>>Revision Estructural Ingrid Gomez</option> 
                          <option class="texto_mitad_titlerojo" value="pago" <?php echo ($row_acta['ubicacion_proyect'] == "pago") ? "selected" : ""; ?>>Pago</option>
                          <option class="texto_mitad_titlerojo" value="revision estructural2" <?php echo ($row_acta['ubicacion_proyect'] == "revision estructural2") ? "selected" : ""; ?>>Revision Estructural Leonardo Ochoa</option>
						  <option class="texto_mitad_titlerojo" value="recepcion" <?php echo ($row_acta['ubicacion_proyect'] == "recepcion") ? "selected" : ""; ?>>Recepcion</option>
                          <option class="texto_mitad_titlerojo" value="comunicacion" <?php echo ($row_acta['ubicacion_proyect'] == "comunicacion") ? "selected" : ""; ?>>Comunicacion-Carolina</option>
                          <option class="texto_mitad_titlerojo" value="secretaria" <?php echo ($row_acta['ubicacion_proyect'] == "secretaria") ? "selected" : ""; ?>>Secretaria-Carolina</option>
                          <option class="texto_mitad_titlerojo" value="aux licencia" <?php echo ($row_acta['ubicacion_proyect'] == "aux licencia") ? "selected" : ""; ?>>Aux Licencia-Claudia</option>
                          <option class="texto_mitad_titlerojo" value="licencia" <?php echo ($row_acta['ubicacion_proyect'] == "licencia") ? "selected" : ""; ?>>Licencia</option>
                          <option class="texto_mitad_titlerojo" value="curador" <?php echo ($row_acta['ubicacion_proyect'] == "curador") ? "selected" : ""; ?>>Curador</option>
						  <option class="texto_mitad_titlerojo" value="radicacion" <?php echo ($row_acta['ubicacion_proyect'] == "radicacion") ? "selected" : ""; ?>>Radicacion</option>
                          <option class="texto_mitad_titlerojo" value="entrega" <?php echo ($row_acta['ubicacion_proyect'] == "entrega") ? "selected" : ""; ?>>Entrega</option>
                          <option class="texto_mitad_titlerojo" value="archivo central" <?php echo ($row_acta['ubicacion_proyect'] == "archivo central") ? "selected" : ""; ?>>Archivo Central</option>
                        </select>
                      <?php }else{?>
                        <input name="ubicacion_b" type="text" class="texto_mitad_titlerojo" 
                        	value="<?php if(!empty($row_acta['ubicacion_proyect'])){
									if($row_acta['ubicacion_proyect'] == 'comunicacion'){
										echo str_replace('comunicacion', 'Comunicacion-Carolina', $row_acta['ubicacion_proyect']); 
									}else if($row_acta['ubicacion_proyect'] == 'secretaria'){
										echo str_replace('secretaria', 'Secretaria-Carolina', $row_acta['ubicacion_proyect']); 
									}else{
										echo $row_acta['ubicacion_proyect'];
									}
									}else{
									echo 'Ninguna';}
 							?>" readonly />
                    <?php }?>*Debe Incluir Comentario en Hoja de Ruta
                	</td>
                        
                  </tr>
<!-- REVISADA -->
                </table>
              </fieldset>
            <div id="capa"> 
                <fieldset class="fondoArea01"> 
                  <legend class="tituloCuadro"><strong>Vigencia Resoluci&oacute;n </strong></legend>
<!-- REVISADA -->
                    <table width="455" border="0"> 
	                    <tr>
	                       <td width="449" height="27" class="texto2" >
	                       	<div id="consulta"><?php include('consulta_vigencia.php') ?>
	                       	</div>
	                       	<div id="formulario"></div>
	                       </td>
	  					</tr>
<!-- REVISADA -->
					</table>
		    	</fieldset>    
		    </div>
       
<!-- DENTRO ERROR -->
      </table>
      
    </form>
  </td>
  <td>
  </td>
</tr>
<tr>
    <td height="54">
    </td>
    <?php if($totalRows_jg_historia > 0){ ?>
    <td colspan="2" valign="top">
    	<fieldset class="fondoArea01">
                <legend class="tituloCuadro"><strong>Hoja de Ruta</strong>
                </legend>
<!-- REVISADA -->
	        <table width="826" border="0" align="center">
	        <tr bgcolor="#f1f1f1">
	          <td width="171" class="titulosfont">Fecha</td>
	          <td width="189" class="titulosfont">Usuario</td>
	          <td width="335" class="titulosfont">Comentario/Observaci&oacute;n</td>
	          <td width="107" class="titulosfont">Web</td>
	        </tr>
	        <?php do { ?>
	          <tr bgcolor="<?php echo ($cont++%2!=0) ? '#CCFFFF' : '#FFFFFF'; ?>">
	            <td height="21" class="texto2"><?php echo $row_jg_historia['fecha_registro']; ?></td>
	            <td class="texto2"><?php echo $row_jg_historia['usuario']; ?></td>
	            <td class="texto2"><?php echo $row_jg_historia['comentario']; ?></td>
	            <td class="texto2"><?php echo ($row_jg_historia['web'] == 0) ? 'No' : 'Si' ; ?></td>
	          </tr>
	          <?php } while ($row_jg_historia = mysql_fetch_assoc($jg_historia)); ?>
<!-- REVISADA -->
	        </table>
    	</fieldset>
    </td>
	<?php } ?>
</tr>
<tr>
    <td height="2"></td>
    <td></td>
    <td></td>
</tr>	
</table>
</body>
</html>
<?php ob_flush(); ?>