<form name="frDocs" id="frDocs" method="post">
<script>
  //mostrar y ocultar submenus
    $(function(){
      $('#docCompletos').change(function(){
        // var valor = $(this).val();
        // alert(valor);
        if(!$(this).prop('checked')){
          $('#contenedor1').show();
        }else{
          $('#contenedor1').hide();
        }
      
      });
    });
</script>

<div class="col-lg-6  offset-2 input-group">
  <h5><strong><label for="docCompletos" class="form-check-label izq">Documentacion Completa</label></strong></h5>
  <input type="checkbox"  name="docCompletos" id="docCompletos" class="form-check-input fantasma" value="1" onchange="">
</div>


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<?php 
  $mysqli->set_charset("utf-8");
  $sql="SELECT id_documento, nombre FROM radicado_documentos WHERE tipo ='General'";

  $result =$mysqli->query($sql);
  // $result = mysqli_num_rows($result);


  $sql3="SELECT id_documento, nombre FROM radicado_documentos WHERE tipo ='Adicional'";

  $result3 =$mysqli->query($sql3);
  // $result = mysqli_num_rows($result);
  
 ?>
<!-- <form name="frTipo" id="frTipo" method="post"> -->
  <div class="container row" id="contenedor1">
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Documentos Generales:</u></strong></h5>
      </div>
    </div>
    <?php 
    $arraGenerales = array();
    while($datos = mysqli_fetch_assoc($result)) { 
      array_push($arraGenerales, array(  "1"  => $datos['id_documento'],  "2" => $datos['nombre'] ));
      ?>
      <div class="col-lg-12 input-group">
        <div class="col-lg-10 offset-2 input-group">
          <input type="checkbox"  name="documentos_generales[]" id="doc_<?php echo $datos['id_documento']; ?>" class="form-check-input fantasma" value="<?php echo $datos['id_documento']; ?>" onclick="">
          <label for="doc_<?php echo $datos['id_documento']; ?>" class="form-check-label izq"><?php echo $datos['nombre']; ?></label>
        </div>
      </div>
    <?php }
    $_SESSION['docGenerales'] = $arraGenerales;
    // var_dump($_SESSION['docGenerales']);
     ?>
    
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>  
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Documentos Especificos:</u></strong></h5>
      </div>
    </div>
    <?php 
    $bandera = true;
    if (!empty($_SESSION['licencias'])) {
      $cantLic = sizeof($_SESSION['licencias']);
      $documentos = array();
      for ($j=0; $j < $cantLic; $j++) {

        $idLic = $_SESSION['licencias'][$j];
        // echo $idLic.' / ';

        $sql2="SELECT DISTINCT rd.id_documento, rd.nombre FROM radicado_documentos AS rd
              INNER JOIN lic_doc AS l ON l.id_doc = rd.id_documento
              WHERE l.id_lic ='$idLic'";

        $result2 = $mysqli->query($sql2);

        while($datos2 = mysqli_fetch_assoc($result2)  ) {   
          // var_dump($datos2);
          //capturamos todos los valores con su id dentro de un arraya
          array_push($documentos, $datos2); 
        }
      }
          // var_dump($documentos);
          //quitamos los elementos repetidos del array
          $documentos = array_unique($documentos, SORT_REGULAR  );
          // var_dump($documentos);
      $_SESSION['docEspecificos'] = $documentos;
      // var_dump($_SESSION['docEspecificos']);
          //recorremos el nuevo arraya
      foreach ($documentos as $key => $value) {
        ?>
        <div class="col-lg-12 input-group">
          <div class="col-lg-6 offset-2 input-group">
            <input type="checkbox" name="documentos_especificos[]" id="especifico<?php echo $value['id_documento']; ?>" class="form-check-input" value="<?php echo $value['id_documento']; ?>">
            <label for="especifico<?php echo $value['id_documento']; ?>" class="form-check-label izq"><?php echo $value['nombre']; ?></label>
          </div>
        </div>
      <?php 
      }

$arraFaltantes = array();
$arraEntregados = array();
$entregados='';
$faltantes='';

function documentosFaltantes($array, $array2)
{
  $values="";
  $cant = count($array)-1;

  foreach ($array as $key => $value) {

    $documento = $array[$key];

    if(array_search($documento[2], $array2) !== false){
      if ($cant != $key) {
         $values.= "$documento[1]".'; ';
      }
      else{
         $values.= "$documento[1]".'.';
      }
    }

  }
  return $values;
}
// $_SESSION['documentos_generales']
// $_SESSION['documentos_especificos']
 // $faltantes = documentosFaltantes($_SESSION['docGenerales'], $_SESSION['documentos_generales'], $entregados, $faltantes  );
 $faltantes.=' '. documentosFaltantes($_SESSION['docEspecificos'], $_SESSION['documentos_especificos'], $entregados, $faltantes  );
 echo "<hr>";
 echo $entregados. "<hr>";
 echo $faltantes. "<hr>";
 // echo determinarDocumentos($_SESSION['docEspecificos']);


    } ?>

    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Documentos Adicionales:</u></strong></h5>
      </div>
    </div>
    <?php while($datos3 = mysqli_fetch_assoc($result3)) { ?>
      <div class="col-lg-12 input-group">
        <div class="col-lg-10 offset-2 input-group">
          <input type="checkbox"  name="documentos_adicionales[]" id="doc_<?php echo $datos3['id_documento']; ?>" class="form-check-input" value="<?php echo $datos3['id_documento']; ?>" onclick="">
          <label for="doc_<?php echo $datos3['id_documento']; ?>" class="form-check-label izq"><?php echo $datos3['nombre']; ?></label>
        </div>
      </div>
    <?php } ?>
  </div>
  <br>
  <br>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-6 offset-2">
      <form name="frPredio" id="skdj" method="post">

        <button type="submit" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp"> Cancelar</button>
      </form>
    </div>
    <div class="col-lg-4">
      <input type="text" hidden="" name="btn_docs" value="Docs">
      <button type="button" name="btn_docs" id="btn_docs" value="Docs" class=" btn btn-danger agregar col-lg-6" >
        <span class="fa fa-floppy-o"></span> Finalizar 
      </button>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>