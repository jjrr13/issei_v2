<?php 

error_reporting(E_ALL); 
ini_set('display_errors', 'On');

session_start();
$men= 'IMPRIMIO CON LA P';
$id_sessionJ= 44;
$primer_acceso = array(8, 63, 40, 65, 3, 29, 19, 69, 66, 62, 64, 18, 44, 32, 34, 37, 47, 56);
// $primer_acceso = array(3);
		
		if(in_array($id_sessionJ, $primer_acceso)){
			  
			echo "$id_sessionJ<hr>";
		
}

$id_sessionJ= $_SESSION['usuario'][0]['id_usuario'];
 $sexto_acceso= array(29, 8, 64, 40, 65, 35, 48, 3, 56, 53, 18, 19, 69, 62, 64, 66, 41, 55, 50, 70, 57); ?>
<div style="padding-top:12px; width:530px;"> 
	<? if(in_array($id_sessionJ, $sexto_acceso) || $id_sessionJ == $Row_Result1Radicado['revisor']){ ?>
  <input name="bot" type="button" class="boton" id="acta" onclick="window.open('comentarios/actas.php','width=1000,height=550,toolbar=yes')" value="Acta de Observaciones" /><? echo $id_sessionJ; } //}?><? echo categoria();?>
</div>
<? echo "$men";?><br/>