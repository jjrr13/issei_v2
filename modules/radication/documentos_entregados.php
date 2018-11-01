<form name="frDocs" id="frDocs" method="post">


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
<form name="frTipo" id="frTipo" method="post">
  <div class="container row">
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Documentos Generales:</u></strong></h5>
      </div>
    </div>
    <?php while($datos = mysqli_fetch_assoc($result)) { ?>
      <div class="col-lg-12 input-group">
        <div class="col-lg-10 offset-2 input-group">
          <input type="checkbox"  name="documentos_generales[]" id="doc_<?php echo $datos['id_documento']; ?>" class="form-check-input fantasma" value="<?php echo $datos['id_documento']; ?>" onclick="">
          <label for="doc_<?php echo $datos['id_documento']; ?>" class="form-check-label izq"><?php echo $datos['nombre']; ?></label>
        </div>
      </div>
    <?php } ?>
    
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
    <div class="col-lg-6">
      <input type="text" hidden="" name="btn_docs" value="Docs">
      <button type="button" name="btn_docs" id="btn_docs" value="Docs" class=" btn btn-danger agregar col-lg-2" >
        <span class="fa fa-floppy-o"></span> Finalizar 
      </button>
    </div>
  
    <div class="col-lg-6">
      <form name="frPredio" id="skdj" method="post">

        <button type="submit" class="btn btn-primary agregar col-lg-4" formaction="../../controller/radication_controller.php" name="limpia" value="limp"> Cancelar</button>
      </form>
    </div>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>