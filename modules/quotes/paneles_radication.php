<div class="container col-lg-10">
  <div class="row">
    <div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">

      <?php 
        $fecha_hoy = date('Y-m-d');
        $asignado = 17;

        $sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
            FROM agendamiento a, terceros t, agendamiento_estado ae
            WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
            ORDER BY a.fecha, a.hora ASC ");
      
        $result = $mysqli->query($sql);
        // var_dump($result);
        $result2 = mysqli_fetch_assoc($result);
        $rows = $result->num_rows;
          
      ?>
      <div class="card-header">
        <center>
          <h3 class="card-title">AGENDA DIANA</h3>
        </center>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table  id="example1" class="table-bordered table-striped">
          <thead>
            <tr>
              <th style="display: none; ">Agendamiento</th>
              <th>Cliente</th>
              <th>Hora</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
            <?php 
            if($rows>0){
              $primera=0;

              do { 

                  $styleCell='';

                  switch ($result2['id_estado']) {
                    case 1:
                      $styleCell="style='background: #2caa47; '";
                      break;
                    case 2:
                      $styleCell="style='background: #eab24b;'";
                      break;
                    case 3:
                      $styleCell="style='background: #438bd3;'";
                      break;
                    case 4:
                      $styleCell="style='background: #ed4e58;'";
                      break;
              }
            ?>
            <tr>
              <td <?php echo $styleCell; ?> width="35%"><?php print_r($result2['cliente']); ?>
              </td>
              <td <?php echo $styleCell; ?> width="10%"><?php print_r($result2['hora']); ?>
              </td>
              <td <?php echo $styleCell; ?> width="15%"><?php echo $result2['estado']; ?>
              </td>
            </tr>
            <?php $primera++; } while ($result2 = mysqli_fetch_assoc($result)); 
            }else{
            echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">
      <?php

        $fecha_hoy = date('Y-m-d');
        $asignado = 18;

        $sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
            FROM agendamiento a, terceros t, agendamiento_estado ae
            WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
            ORDER BY a.fecha, a.hora ASC ");
      
        $result = $mysqli->query($sql);
        // var_dump($result);
        $result2 = mysqli_fetch_assoc($result);
        $rows = $result->num_rows;
        
      ?>
      <div class="card-header">
        <center>
          <h3 class="card-title">AGENDA GLORIA</h3>
        </center>
      </div>
    <!-- /.card-header -->
      <div class="card-body p-0">
        <table  id="example1" class="table-bordered table-striped">
          <thead>
            <tr>
              <th style="display: none; padding: ">Agendamiento</th>
              <th>Cliente</th>
              <th>Hora</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
             <?php 
              if($rows>0){
                $primera=0;

                do { 
                    $styleCell='';
                      switch ($result2['id_estado']) {
                        case 1:
                          $styleCell="style='background: #2caa47; '";
                          break;
                        case 2:
                          $styleCell="style='background: #eab24b;'";
                          break;
                        case 3:
                          $styleCell="style='background: #438bd3;'";
                          break;
                        case 4:
                          $styleCell="style='background: #ed4e58;'";
                          break;
                      }
             ?>
              <tr  height="5px";>
                <td <?php echo $styleCell; ?> width="35%"><?php print_r($result2['cliente']); ?>
                </td>
                <td <?php echo $styleCell; ?> width="10%"><?php print_r($result2['hora']); ?>
                </td>
                <td <?php echo $styleCell; ?> width="15%"><?php echo $result2['estado']; ?>
                </td>
              </tr>
              <?php $primera++; } while ($result2 = mysqli_fetch_assoc($result)); 
              }else{
                echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
              }

              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>