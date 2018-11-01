<form name="frDocs" id="frDocs" method="post">


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<?php 
  $mysqli->set_charset("utf-8");
  $sql="SELECT id_documento, nombre FROM radicado_documentos WHERE tipo ='General'";

  $result =$mysqli->query($sql);
  // $result = mysqli_num_rows($result);

  

  //   
  
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
      // var_dump($cantLic);
      // var_dump($_SESSION['licencias'][0]);
      $docuemntos;
      for ($j=0; $j < $cantLic; $j++) {

        $idLic = $_SESSION['licencias'][$j];
        echo $_SESSION['licencias'][$j];
        $sql2="";

        if ($idLic >= 10 && $idLic <= 18 ) {
          if ($bandera == true) {
            $sql2="SELECT DISTINCT rd.id_documento, rd.nombre FROM radicado_documentos AS rd
                INNER JOIN lic_doc AS l ON l.id_doc = rd.id_documento
                WHERE l.id_lic ='$idLic'";
          }

          $bandera = false;
        }
        else{
          $sql2="SELECT DISTINCT rd.id_documento, rd.nombre FROM radicado_documentos AS rd
              INNER JOIN lic_doc AS l ON l.id_doc = rd.id_documento
              WHERE l.id_lic ='$idLic'";
        }

        if (!empty($sql2)) {
        $result2 = $mysqli->query($sql2);
        }


        while($datos2 = mysqli_fetch_assoc($result2)  ) { 
          $docuemntos = array_push($docuemntos, $datos2);
        }
      }
      array_unique($docuemntos);
      for ($r=0; $r < sizeof($docuemntos); $r++) { ?>
          <div class="col-lg-12 input-group">
            <div class="col-lg-6 offset-2 input-group">
              <input type="checkbox" name="documentos_especificos[]" id="especifico<?php echo $datos2['id_documento']; ?>" class="form-check-input" value="<?php echo $datos2['id_documento']; ?>">
              <label for="especifico<?php echo $datos2['id_documento']; ?>" class="form-check-label izq"><?php echo $datos2['nombre']; ?></label>
            </div>
          </div>
     <?php }
    } ?>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 form-group"></div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-7 offset-1  input-group">
        <h5><strong><u>Documentos Adicionales:</u></strong></h5>
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-10 offset-2 input-group">
        <input type="checkbox" name="documentos_adicionales[]" id="adicional1" class="form-check-input" value="0" onclick="">
        <label for="adicional1" class="form-check-label izq">Adicional # 1</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-10 offset-2 input-group">
        <input type="checkbox" name="documentos_adicionales[]" id="adicional2" class="form-check-input" value="1">
        <label for="adicional2" class="form-check-label izq">Adicional # 2</label>
      </div> 
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-10 offset-2 input-group">
        <input type="checkbox" name="documentos_adicionales[]" id="adicional3" class="form-check-input" value="2">
        <label for="adicional3" class="form-check-label izq">Adicional # 3</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>
    <div class="col-lg-12 input-group">
      <div class="col-lg-10 offset-2 input-group">
        <input type="checkbox" name="documentos_adicionales[]" id="adicional4" class="form-check-input" value="3" onclick="">
        <label for="adicional4" class="form-check-label izq">Adicional # 4</label>
      </div> 
      <div class="col-lg-10 input-group">
      </div>
    </div>

  </div>
  <br>
  <br>
  <hr>
  <div class="col-lg-12 input-group" >
    <div class="col-lg-5"></div>
    <input type="text" hidden="" name="btn_docs" value="Docs">
    <button type="button" name="btn_docs" id="btn_docs" value="Docs" class=" btn btn-danger agregar col-lg-2" >
      <span class="fa fa-floppy-o"></span> Finalizar 
    </button>
  </div>
</form>
<div class="col-lg-12"></div>
<div class="col-lg-12"></div>