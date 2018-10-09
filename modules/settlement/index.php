<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
include_once $dir."cx/cx.php";
 error_reporting(E_ERROR | E_WARNING | E_PARSE);
$_SESSION['fechaactual'];
$_SESSION['id_usuario']; // id de usuario.
$_SESSION['id_tipo_usuario']; 
$_SESSION['id_area'];

include ('../menu.php');
?>
<!DOCTYPE html>
<html>
  <head>
 
  <title>LIQUIDACION</title>

  <style type="text/css">

    .requerido{
      color: #dc3545;
      display: inline;
    }

    .form-check {
    position: relative;
    display: block;
    padding-left: 0.5rem !important;;
    } 

    .borde{
    margin-bottom: 2%;
    border: 1px solid #dad8d8;
    padding-top: 10px;
    padding-bottom: 15px;
    }

  </style>

  <noscript>
    <meta http-equiv="Refresh" content="0;URL=http://localhost/issei/cx/destroy_session.php">
  </noscript>

  <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
  </script>
  </head>
  <body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container col-lg-10">
          <div class="card card-danger">
            <div class="card-header">
              <center><h3 class="card-title">LIQUIDACIÓN</h3></center>
            </div>
            <form class="form-horizontal" action="../../controller/settlement_controller.php" method="post" >
              <div class="card-body">
                <div class="row form-group">
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-1  input-group"></div>
                    <div class="col-lg-6  input-group">
                      <h5 class="col-lg-2">Estrato</h5>
                      <select class="form-control col-lg-3" id="tdocumento" name="tdocumento" >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                      </select>                      
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Construcción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Modificación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Reconocimiento</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Urbanistico</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Adecuación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-5 input-group">
                        <h4><strong>Reforzamiento Estructural</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Demolición</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Reconstrucción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Restauración</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="input-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-3 input-group"></div>
                    <div class="col-lg-6 input-group">
                      <h4><strong>Modificación de Licencia Vigente</strong></h4>
                    </div>
                  </div>
                  <div class="input-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Contrucción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-5 input-group">
                        <h4><strong>Urbanismo / Parcelación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5><strong>Usos</strong></h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Cantidad M<sup>2</sup></strong></h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h5><strong>Valor</strong></h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                       
                      </div>
                      <div class="col-lg-1 form-check">
                        <input  type="checkbox" id="vivienda_VISD_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> name="vivienda_VISD_1" >
                        <label class="form-check-label" for="vivienda_VISD_1">V.I.S</label>
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?= $_POST['vivienda_total_1']; ?>" /></td>                       
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">
                        <input name="cero_vivienda_vis_1"  type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?= $_POST['vivienda_vis_total_1']; ?>" />                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text"> 
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?= $_POST['comercio_total_1']; ?>" /></td>                     
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 form-check">
                        <input type="text">    
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?= $_POST['industria_total_1']; ?>" /></td>                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input type="text">                      
                      </div>
                      <div class="col-lg-1 form-check">
                        <input type="checkbox" id="institucional_dot_1" class="form-check-input" value="1" onClick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> name="institucional_dot_1"  >
                        <label class="form-check-label" for="vivienda_VISD_1">DOT</label>                
                      </div>
                      <div class="col-lg-3 form-check">
                        <input type="text">  
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" />
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?= $_POST['institucional_total_1']; ?>" /></td>                    
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12  input-group">
                <div class="col-lg-6  input-group">
                  <label class="col-form-label col-lg-12 requerido">&nbsp;&nbsp;&nbsp;&nbsp;Los campos con (*) son obligatorios</label>
                </div>
              </div>
                  <!-- /.card-body -->
              <div class="card-footer input-group">
                <div class="form-group col-lg-12 "></div>
                <div class="col-lg-4 offset-3">
                  <button class="btn btn-danger" type="submit" name="submit" id="submit" >Crear</button>
                </div>
                <div class="col-lg-2">
                  <input type="hidden" name="cancelar">
                  <button type="submit" class="btn btn-default" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">cancelar</button>
                </div>
                <div class="form-group col-lg-12 "></div>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2018 Computer Services.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.2.1
        </div>
      </footer>
    <!-- /.control-sidebar -->

    <script language="javascript">
      //var opciones = document.getElementsByName("barrio"),
      $("#barrio").on('change', function(){
        var estado = $("#barrio").val() == "487" ? true : false;
        if (estado) {
         $('#selectestado').removeAttr("hidden").focus();
        }
        else{
         $('#selectestado').attr("hidden", "hidden");
        }
        
      });
      
    </script>
  </body>
</html>