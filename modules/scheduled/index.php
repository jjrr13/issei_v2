<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
  include_once ("../../cx/cx.php");

include('../menu.php');
include_once('../../functions/globales.js');
include_once('../../functions/ruta.php');
   // scripts($dir);

  $_SESSION['fechaactual'];
  $_SESSION['id_usuario']; // id de usuario.
  $_SESSION['id_tipo_usuario']; 
  $_SESSION['id_area'];


  //If the variable does not exist, destroy the session
  if (empty($_SESSION['id_usuario'])) {
       header("location: ../../cx/destroy_session.php");
    }

  
  if(isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])){
    
    $fecha_hoy = date('Y-m-d');
    $asignado = $_SESSION['id_usuario'];

    $sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, c.consulta, 
        CASE 
          WHEN a.nro_radicado is null THEN ( 
              CASE
                WHEN a.nro_solicitud is null THEN 'POR DEFINIR' 
                ELSE a.nro_solicitud 
              END)
          ELSE a.nro_radicado
        END as numero, a.hora, ae.estado, t.nit
        FROM agendamiento a, terceros t, agendamiento_estado ae, consultas c 
        WHERE a.nit = t.nit AND a.id_estado = ae.id_estado AND a.id_consulta = c.id_consulta AND ae.id_estado = 1 AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
        
        ORDER BY a.fecha, a.hora ASC
                                  ");
  
    $result = $mysqli->query($sql);
    $result2 = mysqli_fetch_assoc($result);
    $rows = $result->num_rows;
  
  }

?>

<!DOCTYPE html>
<html >
<head>
  <title>ISSEI</title>
  <noscript>
    <meta http-equiv="Refresh" content="0;URL=http://localhost/issei/cx/destroy_session.php">
  </noscript>
  <script type="text/javascript">
    var urlPort = '<?=SOCKET_FRONTEND;?>';
  </script>
  <!-- libreria del servidor socket -->
  <link rel='stylesheet' href='../../plugins/colorbox/colorbox.css'>
  <script src='../../functions/jquery-1.7.2.min.js'></script>
  <script src="../../functions/fancywebsocket.js"></script>
  <script src="../../plugins/colorbox/jquery.colorbox.js"></script>

  <link rel='stylesheet' href='../../cx/demo/demo.css'>
  <link rel='stylesheet' type='text/css' href='../../cx/jquery-confirm.css'>
  <script src='../../cx/demo/demo.js'></script>
  <script type='text/javascript' src='../../cx/jquery-confirm.js'></script>

 
  <script>

    $(document).ready(function() {
      var estado;
      //localStorage.setItem("cita", null);
          //se verifica si existe la variable en el navegador
          if(localStorage.getItem("cita")!='null'){
              estado = 1;
              $.confirm({
                        icon: 'fa fa-user-circle-o',
                        theme: 'supervan',
                        closeIcon: false,
                        content: 'HUBO UNA CITA SIN TERMINAR',
                        animation: 'scale',
                        type: 'RED',
                        buttons: {
                            'ok': {
                                text: 'COMPLETAR!',
                                btnClass: 'btn-blue',
                                action: function () {
                                    // hacemos la peticion a jax y que recargue la pagina
                                    estados(localStorage.getItem("cita"), estado);
                                }
                            },
                        }
                    });
          }else{
            $(".inline").colorbox({
              inline:true, width:"80%", escKey:false, overlayClose:false, closeButton:false, speed:1000,
              onComplete:function(){ 
                var cita =$('#cita').val();
                  //se crea la variable en el navegador
                  localStorage.setItem("cita", cita);
                  estado = 2;
                    // hacemos la peticion a jax y que recargue la pagina
                    estados(cita, estado);
                    
                
                // var solicitud = $('#mconsulta').val();
                // if (solicitud == "PROYECTO A RADICAR") {
                //   $('#traslado').show();
                // }
              }
              // onCleanup:function(){ 
              //     alert('onCleanup: colorbox has begun the close process'); 
              //     alert($('#obs').length);
              //     alert($('#estado').val());
              // }

              
            });
          }


    function estados(cita, estado){
        $.ajax({
                type: "POST",
                url: "../../controller/scheduled_estado_controller.php",
                data: "cita="+ cita+"&estado="+estado,
                dataType:"html",
                success: function(data) 
                {
                  var JSONdata    = JSON.parse(data); //parseo la informacion
                  var estado = JSONdata[0].estado;
                  if (estado==1) {
                    localStorage.setItem("cita", null);
                    window.location.replace('../scheduled');
                  }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    console.log(textStatus);
                    alert(textStatus);
                }
              });
    }


      // var primero = 0; 

    $('#example1').on('change', nuevaCita());


    });


  </script>
  <script>
    $(document).ready(function(){
        $(".inline").click(function(){
 
            var valores = new Array();
            var j =0;
            
            // Obtenemos todos los valores contenidos en los <td> de la fila
            // seleccionada
            $(this).parents("tr").find("td").each(function(){
                valores[j]=$(this).html();
                j++;
                // valores[0]=$(this).val();
            });
            // alert(valores[0]);

            $('#nit').val(valores[0]);
            $('#nombre').val(valores[1]);
            $('#mconsulta').val(valores[2]);
            $('#nroradicado').val(valores[3]);
 
        });

        $('#estado').on('change', function(){
          var seleccion = $('#estado').val();
          // alert(seleccion);
          var texto='';
          if (seleccion == 4) {
            texto = "Se hicieron los dos llamados correspondientes a la cita, los cuales no fueron atendidos. NO ASISTIO";
          }
          
          var contendio = $('#obs').val();
          if (contendio<1) $('#obs').val(contendio+texto);
          else $('#obs').val(contendio+'\n '+texto);
        });

        $("#submit2").click(function(){

        });

    });
    </script>
</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <div class="container col-lg-10">
    <div class="card card-danger">
      <div class="card-header">
        <center><h3 class="card-title">MI AGENDA</h3></center>
      </div>
    <!-- /.card-header -->
    <!-- form start -->
        <div class="card-body p-0">
        <?php  ?>
          <table  id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="display: none; ">Nit Agendado</th>
                <th>Cliente</th>
                <th>Motivo Consulta</th>
                <th>Numero</th>
                <th>Agendada</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
              <?php 
              if($rows>0){
                $primera=0;
                do { ?>
                  <tr>
                    <td style="display: none;"><?php print_r($result2['nit']); ?></td>

                    <td width="35%"><?php print_r($result2['cliente']); ?></td>
                    <td width="25%"><?php print_r($result2['consulta']); ?></td>
                    <td width="15%"><?php print_r($result2['numero']); ?></td>
                    <td width="10%"><?php print_r($result2['hora']); ?></td>
                    <td width="15%">
                      <!-- <button class="btn btn-danger btn-sm" onclick="cumplimiento('/commentary/index');document.getElementById('cboxClose').style.display='block';">EN ESPERA</button> -->
                      <p><a <?php echo ($primera != 0) ? "href='#' disabled class='btn btn-danger btn-sm' title='Hay citas previas'" : "href='#inline_content' class='inline btn btn-success btn-sm'"; ?> class='inline btn btn-danger btn-sm'  >En Espera</a></p>
                    </td>
                  </tr>
                <?php $primera++; } while ($result2 = mysqli_fetch_assoc($result)); 
              }else{
              echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
              }
              ?>
            </tbody>
          <?php  ?>
          </table>
        </div>
    </div>
  </div>
<!-- This contains the hidden content for inline calls -->
    <div style='display:none'>
      <div id='inline_content' style='padding:10px; background:#fff;'>
       <!-- <iframe src="commentary/index.php"></iframe> -->
       <?php include_once('commentary/index.php'); ?>
      </div>
    </div>
</div>


  <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2018 Computer Services.</strong>
      All rights reserved.
      <div class="float-center d-none d-sm-inline-block">
        <b style="text-align: center;">Desing By:</b> srJJ
      </div><div class="float-right d-none d-sm-inline-block">

        <b>Version</b> 1.2.3
      </div>
    </footer>

    
  <!-- /.control-sidebar -->
 
</body>
</html>