
// $.getScript("../../cx/demo/libs/bundled.css");
// $.getScript("../../cx/demo/demo.css");
// $.getScript("../../cx/jquery-confirm.css");
// $.getScript("../../cx/demo/libs/bundled.js");
// $.getScript("../../cx/jquery-confirm.js");
// $.getScript("");


var Server;

$(document).ready(function() 
{
	// alert('leyo empezo la ejecucion');
	Server = new FancyWebSocket('ws://'+urlPort);

    Server.bind('open', function(){
		alert('opening');
    });
    Server.bind('close', function( data ){
		console.log('closing');
    });
    Server.bind('message', function( payload ){
		//alert('entro al message');
    });
    Server.connect();
});

function send(text) 
{
	// alert('leyo la funcion send');
    Server.send( 'message', text );
}

function FancyWebSocket(url)
{
	// alert('leyo la funcion FancyWebSocket');
	var callbacks = {};
	var ws_url = url;
	var conn;
	
	this.bind = function(event_name, callback)
	{
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;
	};
	
	this.send = function(event_name, event_data)
	{
		this.conn.send( event_data );
		return this;
	};
	
	this.connect = function() 
	{
		if ( typeof(MozWebSocket) == 'function' )
		this.conn = new MozWebSocket(url);
		else
		this.conn = new WebSocket(url);
		
		this.conn.onmessage = function(evt)
		{
			dispatch('message', evt.data);
		};
		
		this.conn.onclose = function(){
          dispatch('close',null);
        };
		this.conn.onopen = function(){
			dispatch('open',null);
        };
	};
	
	this.disconnect = function()
	{
		this.conn.close();
	};
	
	var dispatch = function(event_name, message)
	{
		if(message === null || message === "")//aqui es donde se realiza toda la accion
			{
			}
			else
			{
				/*si comento desde aqui*/
// 				console.log(message);
				var JSONdata    = JSON.parse(message); //parseo la informacion
				var funcionario = JSONdata[0].funcionario;
// 				// alert(JSONdata);

// 				console.log(JSONdata);
// 				var nombre = JSONdata[0].nombre;
// 				var nit = JSONdata[0].nit;
// 				var nro_radicado = JSONdata[0].nro_radicado;
// 				var nrosolicitud = JSONdata[0].nrosolicitud;
// 				var consulta = JSONdata[0].consulta;
// 				var hora = JSONdata[0].hora;
// // saber cual de los dos hay que mostrart
// 				var numeros;
// 					if (nro_radicado != "") {numeros=nro_radicado;}
// 					else if (nrosolicitud != ""){numeros=nrosolicitud;}
// 					else {numeros = 'POR DEFINIR';}

// //saber el tipo de boton que tiene
// 				$("#aviso").remove();
// 				var contenidoDiv  = $("#"+funcionario).html();
// 				var mensajehtml   = '<td width="35%">'+nombre+'</td>';
// 					mensajehtml  += '<td width="25%">'+consulta+'</td>';
// 					mensajehtml  += '<td width="15%">'+numeros+'</td>';
// 					mensajehtml  += '<td width="10%">'+hora+'</td>';
// 					mensajehtml  += '<td width="15%"><p><a class="inline btn btn-danger btn-sm" href="#inline_content">Inline HTML</a></p></td>';
					
// 					// alert('entro poner el tabla2222');
// 				$("#"+funcionario).html(contenidoDiv+mensajehtml);

				/*hasta aqui solo deberia poner el recargar en el otro lado y listo*/



				
				 $("#"+funcionario).trigger('change');	
				// $("#"+funcionario).nuevaCita();
		                
			}
	};
}
var primero =0;
var sonido = new Audio();
sonido.src = "sonido/SD_ALERT_12.mp3";
function nuevaCita(){

	if (primero != 0) {
	
		sonido.play();

	
		$.confirm({
		  icon: 'fa fa-user-circle-o',
		  theme: 'supervan',
		  closeIcon: false,
		  content: 'TIENES UNA NUEVA CITA!',
		  animation: 'scale',
		  type: 'green',
		  buttons: {
		      'ok': {
		          text: 'OK',
		          btnClass: 'btn-blue',
		          action: function () {
		             window.location.replace('../scheduled');
		          }
		      },
		  }
		});
    }else {
    	primero = primero + 1;
    }

}; 

    