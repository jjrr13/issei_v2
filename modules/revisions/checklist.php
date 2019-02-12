<?php 
	function lista($nombre, $numero){
		$contador = 163;
		$j = 1;
		$elemento = "<select class='listas' name='".$nombre.$numero."' id='".$nombre.$numero."' onchange='enumerar(this);'>";
		$elemento.= "<option value='0'>N/A</option>";
		$elemento.= "<option value='170'>OK</option>";
		// while ($contador > $j) {
		// 	$j++;
			$elemento.= "<option value='".($j)."'>".($j)."</option>";
		// }
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
			background-color: #585858;
		}

/*3351, 	'760011180995', 	'bloqueado', 	'2018-12-13 14:58:03'
64500, 	'760011180995', 	50 ,	'2019-00002', 	'desistido'
64598, 	'760011180995', 	50 ,	'2019-00002' ,	*/
	</style>
	<script>
		function asignar(elemento, ids, oldE, newE) {
			$("#"+ids+" option[value='"+old+"']").remove();
  		var o = new Option("option text", newE);
			$(o).html(newE);
			$(elemento).append(o);

    	$("#"+ids+" option[value='"+(newE)+"']").attr("selected", true);
		}
		function sumar(elemento, ids, oldE, newE) {
			// alert(j);
			// alert(j+1);
			$("#"+ids+" option[value='"+oldE+"']").remove();
  		var o = new Option("option text", newE+1);
			$(o).html(newE+1);
			$(elemento).append(o);

    	$("#"+ids+" option[value='0']").attr("selected", true);
		}
		var j=1;
		function enumerar(selec) {
			var elemento = $(selec).val();
			console.log($(selec).val());

			if (elemento == '170' || elemento == '0') {
				// alert('entro al if');
				var idElemento = $(selec).attr('id');
				var numero = parseInt( $('#'+idElemento+" option:last-child").val() );
				// alert(numero);
				if (numero <= j) {// eveluar este if si cabe posibilidades de que haya numero mayo que j
					// j= j-1;
					var temp = numero - (j-1) ;
					$(".listas").each(function(){
		        var valor = $(this).val();
		        // console.log(valor);
		        var id = $(this).attr('id');
		        // alert(id);
		        var oldNumero = parseInt(  $('#'+id+" option:last-child").val() );

		        if (temp == oldNumero) {
		        	temp = temp + 1;
		        	j = j -1;
		        }

		        if (valor == '0' || valor == '170') {
		        	// alert('entros por el otro valor');
		        	
		        	// alert(oldNumero +' oldNumero');
		        	// alert(numero +' numero'); 
		        	// alert(j +' valor de J'); 
				    	var jr = (oldNumero == numero) ? oldNumero : j;
				    	// alert(jr);
		        	$("#"+id+" option[value='"+(jr)+"']").remove();
			    		// $(this).remove();
			    		var o = new Option("option text", j);
							$(o).html(j);
							$(this).append(o);
		        	// console.log((j+1) + ' entro al if');

		        	$("#"+id+" option[value='0']").attr("selected", true);

			        // $(this).val(j+1);
		        }
		        else{
		        	// alert('Entro al ese');
		        	// alert(oldNumero +' oldNumero');

		        	// alert(numero +' numero');
		        	// alert(oldNumero +' oldNumero');

		        	// alert(numero +' numero');
		        	if (oldNumero >= numero) {
		        		
				        asignar(this, id, oldNumero, oldNumero-1);
				    //     $("#"+ids+" option[value='"+oldNumero+"']").remove();
					  	// 	var o = new Option("option text", oldNumero-1);
								// $(o).html(oldNumero-1);
								// $(elemento).append(o);

					   //  	$("#"+ids+" option[value='"+(oldNumero-1)+"']").attr("selected", true);
		        	}
		     //    	function asignar(elemento, ids, oldE, newE) {
							// 	$("#"+ids+" option[value='"+old+"']").remove();
					  // 		var o = new Option("option text", newE);
							// 	$(o).html(newE);
							// 	$(elemento).append(o);

					  //   	$("#"+ids+" option[value='"+(newE)+"']").attr("selected", true);
							// }

		        }
					});
				}
			}
			else{
				var suma=0;
	      $(".listas").each(function(){
	        var valor = $(this).val();
	        // console.log(valor);
	        if (valor == '0' || valor == '170') {
	        	var id = $(this).attr('id');
	        	sumar(this, id, j, j);
	        }
				});
	        
					j++;
			}
			
      console.log('......................');
      console.log(j);
      console.log('......................');
		}
	</script>
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
				<?php lista("anden",1); ?>
			</td>
			<td>
				<?php lista("anden",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("anden",3); ?>
			</td>
			<td>
				<?php lista("anden",4); ?>
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
				<?php lista("aislamientopost",1); ?>
			</td>
			<td>
				<?php lista("aislamientopost",2); ?>
			</td>
			<td>
				<?php lista("aislamientopost",3); ?>
			</td>
			<td>
				<?php lista("aislamientopost",4); ?>
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
				<?php lista("aislamientolat",1); ?>
			</td>
			<td>
				<?php lista("aislamientolat",2); ?>
			</td>
			<td>
				<?php lista("aislamientolat",3); ?>
			</td>
			<td>
				<?php lista("aislamientolat",4); ?>
			</td>
			<td>
				<?php lista("aislamientolat",5); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Antejardín</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("antejardin",1); ?>
			</td>
			<td>
				<?php lista("antejardin",2); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("antejardin",3); ?>
			</td>
			<td>
				<?php lista("antejardin",4); ?>
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
				<?php lista("voladizo",1); ?>
			</td>
			<td>
				<?php lista("voladizo",2); ?>
			</td>
			<td>
				<?php lista("voladizo",3); ?>
			</td>
			<td>
				<?php lista("voladizo",4); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Cerramiento Antejardín</label>
			</td>
			<td>
				<?php lista("cerramientoantej",1); ?>
			</td>
			<td>
				<?php lista("cerramientoantej",2); ?>
			</td>
			<td>
				<?php lista("cerramientoantej",3); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("cerramientoantej",4); ?>
			</td>
			<td>
				<?php lista("cerramientoantej",5); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Aislamiento contra predios</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("aislmientcpredios",1); ?>
			</td>
			<td>
				<?php lista("aislmientcpredios",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("aislmientcpredios",3); ?>
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
				<?php lista("semisotano",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("semisotano",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("semisotano",3); ?>
			</td>
			<td>
				<?php lista("semisotano",4); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Parqueadero Privados</label>
			</td>
			<td>
				<?php lista("parqueaderopriv",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("parqueaderopriv",2); ?>
			</td>
			<td>
				<?php lista("parqueaderopriv",3); ?>
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
				<?php lista("parqueaderovisi",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("parqueaderovisi",2); ?>
			</td>
			<td>
				<?php lista("parqueaderovisi",3); ?>
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
				<?php lista("uar",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("uar",2); ?>
			</td>
			<td>
				<?php lista("uar",3); ?>
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
				<?php lista("areacusoprovado",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("areacusoprovado",2); ?>
			</td>
			<td>
				<?php lista("areacusoprovado",3); ?>
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
				<?php lista("areacesionzverdes",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("areacesionzverdes",2); ?>
			</td>
			<td>
				<?php lista("areacesionzverdes",3); ?>
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
				<?php lista("areacesione",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("areacesione",2); ?>
			</td>
			<td>
				<?php lista("areacesione",3); ?>
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
			<td class="negro">
			</td>
			<td>
				<?php lista("flote",1); ?>
			</td>
			<td>
				<?php lista("flote",2); ?>
			</td>
			<td>
				<?php lista("flote",3); ?>
			</td>
			<td>
				<?php lista("flote",4); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimensiones del Lote</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("dlote",1); ?>
			</td>
			<td>
				<?php lista("dlote",2); ?>
			</td>
			<td>
				<?php lista("dlote",3); ?>
			</td>
			<td>
				<?php lista("dlote",4); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área del Lote</label>
			</td>
			<td>
				<?php lista("arealote",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
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
				<label for="" >Terreno Inclinado</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("terrenoincl",1); ?>
			</td>
			<td>
				<?php lista("terrenoincl",2); ?>
			</td>
			<td>
				<?php lista("terrenoincl",3); ?>
			</td>
			<td>
				<?php lista("terrenoincl",4); ?>
			</td>
			<td>
				<?php lista("terrenoincl",5); ?>
			</td>
			<td>
				<?php lista("terrenoincl",6); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Área construida primer piso</label>
			</td>
			<td>
				<?php lista("areaconsprimerp",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
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
				<label for="" >Área libre primer piso</label>
			</td>
			<td>
				<?php lista("arealibre",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
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
				<label for="" >Área construida pisos restantes</label>
			</td>
			<td>
				<?php lista("areaconsres",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
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
				<label for="" >Área total construida</label>
			</td>
			<td>
				<?php lista("areatcons",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
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
				<label for="" >Concordancia planos PH Vs ARQ.</label>
			</td>
			<td>
				<?php lista("concordanciapharq",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("concordanciapharq",2); ?>
			</td>
			<td>
				<?php lista("concordanciapharq",3); ?>
			</td>
			<td>
				<?php lista("concordanciapharq",4); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Concordancia planos PH Vs Cuadro A.</label>
			</td>
			<td>
				<?php lista("concordanciaphca",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("concordanciaphca",2); ?>
			</td>
			<td>
				<?php lista("concordanciaphca",3); ?>
			</td>
			<td>
				<?php lista("concordanciaphca",4); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimension de patios</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("dpatios",1); ?>
			</td>
			<td>
				<?php lista("dpatios",2); ?>
			</td>
			<td>
				<?php lista("dpatios",3); ?>
			</td>
			<td>
				<?php lista("dpatios",4); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Habitabilidad</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("habitabilidad",1); ?>
			</td>
			<td>
				<?php lista("habitabilidad",2); ?>
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
				<label for="" >Iluminación</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("iluminacion",1); ?>
			</td>
			<td>
				<?php lista("iluminacion",2); ?>
			</td>
			<td>
				<?php lista("iluminacion",3); ?>
			</td>
			<td>
				<?php lista("iluminacion",4); ?>
			</td>
			<td>
				<?php lista("iluminacion",5); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Ventilación /Buitrones Baños</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("ventilacionba",1); ?>
			</td>
			<td>
				<?php lista("ventilacionba",2); ?>
			</td>
			<td>
				<?php lista("ventilacionba",3); ?>
			</td>
			<td>
				<?php lista("ventilacionba",4); ?>
			</td>
			<td>
				<?php lista("ventilacionba",5); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Unidades</label>
			</td>
			<td>
				<?php lista("unidades",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("unidades",2); ?>
			</td>
			<td>
				<?php lista("unidades",3); ?>
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
				<label for="" >Empates</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("empates",1); ?>
			</td>
			<td>
				<?php lista("empates",2); ?>
			</td>
			<td>
				<?php lista("empates",3); ?>
			</td>
			<td>
				<?php lista("empates",4); ?>
			</td>
			<td>
				<?php lista("empates",5); ?>
			</td>
			<td>
				<?php lista("empates",6); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Espacio Público Vía</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("espaciopvia",1); ?>
			</td>
			<td>
				<?php lista("espaciopvia",2); ?>
			</td>
			<td>
				<?php lista("espaciopvia",3); ?>
			</td>
			<td>
				<?php lista("espaciopvia",4); ?>
			</td>
			<td>
				<?php lista("espaciopvia",5); ?>
			</td>
			<td>
				<?php lista("espaciopvia",6); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Altura entre pisos</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("alturaentrep",1); ?>
			</td>
			<td>
				<?php lista("alturaentrep",2); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Servidumbre de vista</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("servidumbrev",1); ?>
			</td>
			<td>
				<?php lista("servidumbrev",2); ?>
			</td>
			<td>
				<?php lista("servidumbrev",3); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("servidumbrev",4); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Sotano</label>
			</td>
			<td>
				<?php lista("sotano",1); ?>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("sotano",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("sotano",3); ?>
			</td>
			<td>
				<?php lista("sotano",4); ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Parqueadero Motos/Bicicletas</label>
			</td>
			<td>
				<?php lista("parqmotos",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("parqmotos",2); ?>
			</td>
			<td>
				<?php lista("parqmotos",3); ?>
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
				<label for="" >Dimensión de parqueaderos</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("dparqueadero",1); ?>
			</td>
			<td>
				<?php lista("dparqueadero",2); ?>
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
				<label for="" >Minusvalidos</label>
			</td>
			<td>
				<?php lista("minusvalido",1); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("minusvalido",2); ?>
			</td>
			<td>
				<?php lista("minusvalido",3); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("minusvalido",4); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Pendiente Rampa</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("prampa",1); ?>
			</td>
			<td>
				<?php lista("prampa",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("prampa",3); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Servidumbre de paso</label>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("servidumbrep",1); ?>
			</td>
			<td>
				<?php lista("servidumbrep",2); ?>
			</td>
			<td>
				<?php lista("servidumbrep",3); ?>
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
				<label for="" >Escaleras ancho abanícos</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("escaleraaa",1); ?>
			</td>
			<td>
				<?php lista("escaleraaa",2); ?>
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
				<label for="" >Escaleras Huella y Contrahuella</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("escalerahych",1); ?>
			</td>
			<td>
				<?php lista("escalerahych",2); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("escalerahych",3); ?>
			</td>
			<td class="negro">
			</td>
		</tr>
		<tr>
			<td class="text-left">
				<label for="" >Dimensíon de Habitaciones</label>
			</td>
			<td class="negro">
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("dimensionh",1); ?>
			</td>
			<td>
				<?php lista("dimensionh",2); ?>
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
				<label for="" >Otros cerramientos</label>
			</td>
			<td>
				<?php lista("ocerramiento",1); ?>
			</td>
			<td>
				<?php lista("ocerramiento",2); ?>
			</td>
			<td>
				<?php lista("ocerramiento",3); ?>
			</td>
			<td>
				<?php lista("ocerramiento",4); ?>
			</td>
			<td class="negro">
			</td>
			<td>
				<?php lista("ocerramiento",5); ?>
			</td>
			<td>
				<?php lista("ocerramiento",6); ?>
			</td>
		</tr>
	</table>
</body>
</html>