<?php 
	function lista($nombre, $numero){
		$contador = 163;
		$j = 0;
		$elemento = "<select name='".$nombre."' id='".$nombre.$numero."'>";
		$elemento.= "<option value='0'>N/A</option>";
		$elemento.= "<option value='170'>OK</option>";
		while ($contador > $j) {
			$j++;
			$elemento.= "<option value='".($j)."'>".($j)."</option>";
		}
		$elemento.= "</select>";
		echo $elemento;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Revisión</title>
	<style>
		table {
		   border: 1px solid #AEA7A7;
		   border-spacing: 0px;
		}
		th, td {
		   text-align: center;
		   vertical-align: top;
		   border: 1px solid #AEA7A7;
		}
		.text-left{
		   text-align: left !important;
		}
		.negro{
			background-color: #000000;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td class="text-left">
				<label for="" >ITEMS</label>
			</td>
			<td>
				<label for="" style="width: 40px;">C.A</label>
			</td>
			<td>
				<label for="" style="width: 40px;">P.L</label>
			</td>
			<td>
				<label for="" style="width: 40px;">P.1</label>
			</td>
			<td>
				<label for="" style="width: 40px;">P.R</label>
			</td>
			<td>
				<label for="" style="width: 40px;">P.C</label>
			</td>
			<td>
				<label for="" style="width: 40px;">C</label>
			</td>
			<td>
				<label for="" style="width: 40px;">F</label>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Uso</label>
			</td>
			<td>
				<?php lista("usos",1); ?>
			</td>
			<td>
				<?php lista("usos",2); ?>
			</td>
			<td>
				<?php lista("usos",3); ?>
			</td>
			<td>
				<?php lista("usos",4); ?>
			</td>
			<td>
				<?php lista("usos",5); ?>
			</td>
			<td>
				<?php lista("usos",6); ?>
			</td>
			<td>
				<?php lista("usos",7); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Indice de Ocupación</label>
			</td>
			<td>
				<?php lista("ocupacion",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("ocupacion",2); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Indice de Construcción Base</label>
			</td>
			<td>
				<?php lista("base",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("base",2); ?>
			</td>
			<td>
				<?php lista("base",3); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Indice de Construcción Adicional</label>
			</td>
			<td>
				<?php lista("adicional",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("adicional",2); ?>
			</td>
			<td>
				<?php lista("adicional",3); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Indice de Construcción Tope</label>
			</td>
			<td>
				<?php lista("tope",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("tope",2); ?>
			</td>
			<td>
				<?php lista("tope",3); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Andén</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Aislamiento Posterior</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Aislamiento Lateral</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Antejardín</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Voladizo</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Cerramiento Antejardín</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Aislamiento contra predios</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Semisótano</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Parqueadero Privados</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Parqueadero Visitantes</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		<tr>
			<td class="text-left">
				<label for="" >UAR</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Area Comunal de Uso Privado</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Area de Cesión de zonas verdes</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Area Cesión de Equipamiento</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Frente de Lote</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimensiones del Lote</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área del Lote</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Terreno Inclinado</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área construida primer piso</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área libre primer piso</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área construida pisos restantes</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área total construida</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Concordancia planos PH Vs ARQ.</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Concordancia planos PH Vs Cuadro A.</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimension de patios</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Habitabilidad</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Iluminación</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Ventilación /Buitrones Baños</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Unidades</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Empates</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Espacio Público Vía</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Altura entre pisos</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Servidumbre de vista</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Sotano</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Parqueadero Motos/Bicicletas</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimensión de parqueaderos</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Minusvalidos</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Pendiente Rampa</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Servidumbre de paso</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Escaleras ancho abanícos</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Escaleras Huella y Contrahuella</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimensíon de Habitaciones</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Otros cerramientos</label>
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
			<td>
				<input type="checkbox">
			</td>
		</tr>
	</table>
</body>
</html>