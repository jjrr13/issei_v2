<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Resset Password</title>

<link href="../../css/login.css" rel="stylesheet" type="text/css">
<noscript>
    <meta http-equiv="Refresh" content="0;URL=http://localhost/issei/cx/destroy_session.php">
    </noscript>
    <script type="text/javascript">
        //Function that blocks the right click
        document.oncontextmenu= function(){
            return false;
        };
        //Function that blocks the F12 key
        document.onkeydown=function() { 
            if (window.event) {
                if((window.event.keyCode >= 117) && (window.event.keyCode <= 123)){
                    window.event.cancelBubble = true;
                    // window.event.keyCode = 8;
                    window.event.returnValue = false;
                    return false;
                }
            }

            if(event.altLeft) {
                if((window.event.keyCode == 37) || (window.event.keyCode == 39)) {
                //Bloquear Alt + Cursor Izq/Der.
                return false;
                }
            }
            if(event.ctrlKey) {
                //Bloquear Ctrl
                return false;
            }
                return true;
        }

        function letras(campo){

        campo.value=campo.value.toUpperCase();
        }

        function ValidNum(e){
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }
                
            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
</script>

</head>

<body>
 
   
<form class="login" method="post" action="../../functions/datosReset.php">
    <h1 class="login-title">Resset Password</h1>
    
    <input type="text"  min="0" class="login-input" placeholder="Numero Documento de Identidad" onkeypress="return ValidNum(event)" id="cedula" name="cedula" autofocus required>
    <input type="email" id="email" name="email" class="login-input" placeholder="Em@il" required>
    <input type="submit" value="Restaurar" class="login-button">
	
  	<h4 class="login-title" style="color: #AF2323; ">El codigo de acceso será enviado al correo electronico registrado en la base de datos.</h4>

</form>   


</body>
</html>




