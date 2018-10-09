<?php
	$js = "<script type='text/javascript'>
	
	/******************************************************************/
	function isForm(form)
	{
		//alert('hello');
		var inputs   = form.getElementsByTagName('INPUT');
		var textarea = form.getElementsByTagName('TEXTAREA');
	
		var inputFields = new Array();
		
		for(var no=0; no < textarea.length; no++){
			inputFields[no] = textarea[no];
		}
		
		/* TEXTAREA */
		
		for(var no=0; no < textarea.length; no++){
			//inputFields[inputFields.length] = textarea[no];
			
			var nombre_div = textarea[no].getAttribute('name');
			//alert(nombre_div);
			if( inputFields[no].getAttribute('value') == '' &&
				inputFields[no].getAttribute('required') == '0' ){
				
				nombre_div = nombre_div + '_e';
				var div = document.getElementById(nombre_div);
				div.className = 'bien_campo';
				//alert('No obligatorio');					
			}

		}	
		
		var inputFields = new Array();
		/*
		for(var no=0; no < inputs.length; no++){
			inputFields[inputFields.length + no] = inputs[no];
		}
		*/
		//alert('porkle '+inputs.length);
		var noTemp = 0;
		
		for(var noi=0; noi < inputs.length; noi++){
			
			temp = inputs[no].getAttribute('name') + '_e';
			//alert(form.getElementById(temp).getAttribute('className'));
			if(document.getElementById(temp)){
				inputFields[noTemp] = inputs[noi];
				noTemp++;
			}
		}
		
		/*for(var no=0; no < inputFields.length; no++){
				alert('De ' + inputFields[no].getAttribute('name') );
		}*/
					
		/* INPUTS */
		//cambia el estado de los campos no obligatorios
		for(var no=0; no < inputFields.length; no++){
			var nombre_div = inputFields[no].getAttribute('name');

			if( inputFields[no].getAttribute('value') == '' &&
				inputFields[no].getAttribute('required') == '0' ){
				
				nombre_campo    = nombre_div;
				nombre_div      = nombre_div + '_e';
				var div         = document.getElementById(nombre_div);
				var campo       = document.getElementById(nombre_campo);
				div.className   = 'bien_campo';
				campo.className = '';
			}
			
		}
		
		var divs = document.getElementsByTagName('SPAN');
		
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='error_campo_mjs'){
				//alert('El campo ' + inputFields[no].getElementsName + ' contiene errores');
				//inputFields[no].getAttribute('className') = 'error_campo';
				return false;
			}
		}
		
		return true;
	}
	</script>";
	
	$js .= "
	<!-- <script type='text/javascript' src='{$httpJs}/libs/jquery.js'></script>  -->
	<script type='text/javascript' src='{$httpJs}/libs/thickBox/thickbox.js'></script>
	<link rel='stylesheet' href='{$httpJs}/libs/thickBox/thickbox.css' type='text/css' media='screen' />
	
	";
	
	
	
	echo $js;
?>