<style type="text/css">
  .requerido{
    color: #dc3545;
    display: inline;
  }
</style>
<script type="text/javascript">

</script>

  <div class="container">
    <section class="content-header">
      <div class="container col-lg-11">
          <div class="card card-danger">
              <div class="card-header">
                <center><h3 class="card-title">SEGUIMIENTO</h3></center>
              </div>
              <form class="form-horizontal" id="form1" name="form1" action="../../controller/scheduled_estado_controller.php" method="post" >
                <div class="card-body">
                  <div class="row form-group">
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-6  input-group">
                        <input type="text" class="form-control col-lg-8" hidden="" name="nit" id="nit">
                        <label for="nombre" class="col-form-label col-lg-3">Cliente</label>
                        <input type="text" class="form-control col-lg-8"  id="nombre" name="nombre">
                      </div>
                      <div class="col-lg-5  input-group">
                        <label for="nroradicado" class="col-form-label col-lg-3 ">Radicado</label>
                        <input type="text" class="form-control col-lg-9"  id="nroradicado" name="nroradicado" placeholder="Nro Radicado" >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-6  input-group">
                        <label for="mconsulta" class="col-form-label col-lg-3 ">Consulta</label>
                        <input type="text" class="form-control col-lg-8"  id="mconsulta" name="mconsulta">
                      </div>
                      <div class="col-lg-5 input-group">
                        <label for="estado" class="col-form-label col-lg-3">Estado <p class="requerido">*</p></label>
                        <select name="estado" class="form-control col-lg-9" id="estado">
                          <?php 
                          $query = $mysqli -> query ("SELECT * FROM agendamiento_estado WHERE id_estado NOT IN (1, 2)");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores[id_estado].'">'.$valores[estado].'</option>';
                            } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-6 input-group">
                        <label for="obs" class="col-form-label col-lg-4">Observación<p class="requerido">*</p></label>
                        <textarea name="obs" id="obs" class="col-lg-7 form-control" rows="1"></textarea>
                      </div>
                      <div class="col-lg-5  input-group" style="display: none;" id="traslado_radicacion">
                        <div class="col-lg-6  offset-6">
                          <button class="btn btn-primary btn-lg" type="submit" name="submit2" id="submit2">Pasar a Radicacion</button>
                        </div>
                      </div><div class="col-lg-5  input-group" style="display: none;" id="traslado_pago">
                        <div class="col-lg-6  offset-6">
                          <button class="btn btn-primary btn-lg" type="submit" name="submit3" id="submit3">Pasar a Pago</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12  input-group">
                  <div class="col-lg-6  input-group">
                    <label class="col-form-label col-lg-12 requerido">&nbsp;&nbsp;&nbsp;&nbsp;Los campos con (*) son obligatorios</label>
                  </div>
                </div>
                <div class="card-footer input-group">
                  <div class="form-group col-lg-12"></div>
                  <div class="col-lg-6 offset-6">
                    <button class="btn btn-danger btn-lg" type="submit" name="submit1" id="submit1" >Guardar</button>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>



 