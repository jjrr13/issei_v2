
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Change Password</title>

<link href="../../css/login.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript">
    function letras(campo){

    campo.value=campo.value.toUpperCase();
    }

</script>

<script>


    var inicio=0;
    var timeout;

    window.onload=function()
    {
        // localStorage.removeItem("inicio");
        if(localStorage.getItem("inicio")!=null)
        {
            // Si al iniciar el navegador, la variable inicio que se guarda
            // en la base de datos del navegador tiene valor, cargamos el valor
            // y iniciamos el proceso.
            inicio=localStorage.getItem("inicio");
            timeout=localStorage.getItem("timeout");

            funcionando();

        }else{

            empezarDetener();
        }
    }

    function empezarDetener()
    {
        timeout=0;
        console.log("entro a la funcion");
            // Obtenemos el valor actual
            inicio = new Date().getTime();

            // Guardamos el valor inicial en la base de datos del navegador
            localStorage.setItem("inicio", inicio);

            localStorage.setItem("timeout", timeout);

            // iniciamos el proceso
            funcionando();
    }

    function funcionando()
    {
        // obteneos la fecha actual
        var actual = new Date();
            
        actual.setUTCMinutes(actual.getUTCMinutes() - 15); // se obtienen los minutos actuales, se le suman 15 minutos y luego se configuran sumandolos
        actual.setUTCSeconds(actual.getUTCSeconds() - 1);

        actual = new Date(actual).getTime();
        
        // obtenemos la diferencia entre la fecha actual y la de inicio
        var diff=new Date(inicio - actual); // se intercambiaron las posisciones de los valores originales 

        // mostramos la diferencia entre la fecha actual y la inicial
        var result=LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
        document.getElementById('crono').innerHTML = result;

        // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
       
        if ((diff.getUTCMinutes() != 0) || (diff.getUTCSeconds() != 0) ) {
            
            setTimeout("funcionando()",1000);
            timeout =  Number(localStorage.getItem("timeout")) + 1;
            localStorage.setItem("timeout", timeout);
            
            console.log(diff);
            console.log(diff.getUTCSeconds());
             console.log(diff.getUTCMinutes());
            
        }else{
            clearTimeout(timeout);
            localStorage.removeItem("inicio");
            var banderaJS = false;

            $.ajax({
                //data:  parametro,
                url:   "../../functions/eliminarCodigo.php",
                type:  "post",
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                },
                complete : function(xhr, status) {
                    
                    alert("se destruyo la sesion");
                    window.location="../../";
                },
            }); 
        }
    }

    /* Funcion que pone un 0 delante de un valor si es necesario */
    function LeadingZero(Time)
    {
        return (Time < 10) ? "0" + Time : + Time;
    }
    
</script>

</head> 

<body>
    <!-- <?php echo sha1('soloJJ');  ?> -->
<form class="login" method="post" action="../../functions/verificaReset.php">
    <h1 class="login-title">Change Password</h1>
    


    <input type="text" class="login-input <?php if(isset($_GET['error1'])) echo "error"; ?>" placeholder="<?php if(isset($_GET['error1'])) echo "Codigo no Valido"; else echo "Acces Code";?>" id="codigoP" name="codigoP"  required>

    <input type="password" class="login-input <?php if(isset($_GET['error2'])) echo "error"; ?>" placeholder="<?php if(isset($_GET['error2'])) echo "No Coinciden"; else echo "New Password";?>" id="nuevaP" name="nuevaP" required>

    <input type="password" class="login-input <?php if(isset($_GET['error2'])) echo "error"; ?>" placeholder="<?php if(isset($_GET['error2'])) echo "No Coinciden"; else echo "Repit Your Password";?>" id="confirmeP" name="confirmeP" required>


    <h3 style="color: #AF2323;" >Su codigo Caducará en:</h3>
    <div class="crono_wrapper login-input">
        
        <h1 id="crono"  style="margin-top: 9px; text-align: center;">00:00</h1>
    </div>
    <input type="submit" value="Guardar" class="login-button">
	
  	
    
  </form>


</body>
</html>
