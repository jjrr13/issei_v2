<?php 
//$ruta="cx";
include ('../menu.php');
include_once ('../../functions/globales.js');
include_once('../../functions/ruta.php');
include_once ("../../cx/cx.php");

 	$_SESSION['fechaactual'];
	$_SESSION['id_usuario']; // id de usuario.
	$_SESSION['id_tipo_usuario']; 
	$_SESSION['id_area'];

$fecha_hoy = date('Y-m-d');

function estados($estado)
{
	$styleCell='';
    switch ($estado) {
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
    return $styleCell;
}


?>

<!DOCTYPE html>
<html>
<head>
 <title>ISSEI</title>
 <script src='../../functions/jquery-1.7.2.min.js'></script>

 <style>
	table {
		border: 1px solid #000;
		border-collapse: collapse;
		text-align: center; height: 5px;
		width: 100%;
	}
 </style> 
</head>
<body class="hold-transition sidebar-mini" onload="inicio()" onkeypress="reset()" onclick="reset()" onmousemove="reset()" >
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container col-lg-10">
          <div class="card card-danger">
	          <div class="card-header">
	            <center><h3 class="card-title">CITA AGENDADAS</h3></center>
	          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <!-- <form method="post" content="../quotes"> -->
          	<div  class="card-body">
				<!-- Paneles de control -->
				<div class="container">
					<div class="row form-group">
						<!-- Panel 	1 -->
						<div class="col-lg-12 input-group">
							<!-- Panel de Ines -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">

								<?php 
								$asignado = 12;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC ");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" >
									<center><h3 class="card-title">AGENDA INES</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
								<?php  ?>
									<table  id="example1" class="table-bordered table-striped" >
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
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
												<td  width="35%"><?php print_r($result2['cliente']); ?></td>
												<td  width="10%"><?php print_r($result2['hora']); ?></td>
												<td  width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Ines -->
							<div class="col-lg-1"></div>
							<!-- Panel de Patricia -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">
								<?php 
								$asignado = 11;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" whit>
									<center><h3 class="card-title">AGENDA PATRICIA</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
									<?php  ?>
									<table  id="example1" class="table-bordered table-striped">
										<thead>
											<tr>
												<th style="  display: none; padding: ">Agendamiento</th>
												<th>Cliente</th>
												<th>Hora</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
											<?php 
											if($rows>0){
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
													<td width="35%"><?php print_r($result2['cliente']); ?></td>
													<td width="10%"><?php print_r($result2['hora']); ?></td>
													<td width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Patricia -->
						</div>
						<!-- /Panel 	1 -->
						<!-- Panel 	2 -->
						<div class="col-lg-12 input-group">
							<!-- Panel de Alex -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">

								<?php 
								$asignado = 10;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC ");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" >
									<center><h3 class="card-title">AGENDA ALEX</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
								<?php  ?>
									<table  id="example1" class="table-bordered table-striped" >
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
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
												<td  width="35%"><?php print_r($result2['cliente']); ?></td>
												<td  width="10%"><?php print_r($result2['hora']); ?></td>
												<td  width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Alex -->
							<div class="col-lg-1"></div>
							<!-- Panel de Kristian -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">
								<?php 
								$asignado = 9;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" whit>
									<center><h3 class="card-title">AGENDA KRISTIAN</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
									<?php  ?>
									<table  id="example1" class="table-bordered table-striped">
										<thead>
											<tr>
												<th style="  display: none; padding: ">Agendamiento</th>
												<th>Cliente</th>
												<th>Hora</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
											<?php 
											if($rows>0){
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
													<td width="35%"><?php print_r($result2['cliente']); ?></td>
													<td width="10%"><?php print_r($result2['hora']); ?></td>
													<td width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Kristian -->
						</div>
						<!-- /Panel 	2 -->
						<!-- Panel 	3 -->
						<div class="col-lg-12 input-group">
							<!-- Panel de Yeiner -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">

								<?php 
								$asignado = 8;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC ");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" >
									<center><h3 class="card-title">AGENDA YEINER</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
								<?php  ?>
									<table  id="example1" class="table-bordered table-striped" >
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
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
												<td  width="35%"><?php print_r($result2['cliente']); ?></td>
												<td  width="10%"><?php print_r($result2['hora']); ?></td>
												<td  width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Yeiner -->
							<div class="col-lg-1"></div>
							<!-- Panel de Lina -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">
								<?php 
								$asignado = 7;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" whit>
									<center><h3 class="card-title">AGENDA LINA</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
									<?php  ?>
									<table  id="example1" class="table-bordered table-striped">
										<thead>
											<tr>
												<th style="  display: none; padding: ">Agendamiento</th>
												<th>Cliente</th>
												<th>Hora</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
											<?php 
											if($rows>0){
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
													<td width="35%"><?php print_r($result2['cliente']); ?></td>
													<td width="10%"><?php print_r($result2['hora']); ?></td>
													<td width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Lina -->
						</div>
						<!-- /Panel 	3 -->
						<!-- Panel 	4 -->
						<div class="col-lg-12 input-group">
							<!-- Panel de Claudia -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">

								<?php 
								$asignado = 23;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC ");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" >
									<center><h3 class="card-title">AGENDA CLAUDIA</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
								<?php  ?>
									<table  id="example1" class="table-bordered table-striped" >
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
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
												<td  width="35%"><?php print_r($result2['cliente']); ?></td>
												<td  width="10%"><?php print_r($result2['hora']); ?></td>
												<td  width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Claudia -->
							<div class="col-lg-1"></div>
							<!-- Panel de Carolina -->
							<div class="col-lg-5" style="width:100%; height:300px; overflow: scroll;">
								<?php 
								$asignado = 15;

								$sql = sprintf("SELECT a.id_agendamiento, CONCAT(t.nombre, ' ', t.apellido) AS cliente, a.hora, ae.id_estado, ae.estado
								FROM agendamiento a, terceros t, agendamiento_estado ae
								WHERE a.nit = t.nit AND a.id_estado = ae.id_estado  AND a.fecha >= '$fecha_hoy' AND a.Id_asignado = '$asignado'
								ORDER BY a.fecha, a.hora DESC");

								$result = $mysqli->query($sql);
								// var_dump($result);
								$result2 = mysqli_fetch_assoc($result);
								$rows = $result->num_rows;

								?>
								<div class="card-header" whit>
									<center><h3 class="card-title">AGENDA CAROLINA</h3></center>
								</div>
								<!-- /.card-header -->
								<div class="card-body p-0">
									<?php  ?>
									<table  id="example1" class="table-bordered table-striped">
										<thead>
											<tr>
												<th style="  display: none; padding: ">Agendamiento</th>
												<th>Cliente</th>
												<th>Hora</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody onChange="nuevaCita()" id="<?php if(!empty($_SESSION['id_usuario'])) echo $_SESSION['id_usuario']; ?>">
											<?php 
											if($rows>0){
												do { 
												?>
												<tr <?php echo estados($result2['id_estado']); ?> >
													<td width="35%"><?php print_r($result2['cliente']); ?></td>
													<td width="10%"><?php print_r($result2['hora']); ?></td>
													<td width="15%"><?php echo $result2['estado']; ?></td>
												</tr>
												<?php  } while ($result2 = mysqli_fetch_assoc($result)); 
											}else{
											echo "<tr><td colspan='5'><center><strong id='aviso' style='color: #dc3545; font-size: 30px; text-decoration: underline; padding-bottom: 5%; padding-top: 5%;'><br>NO HAY CITAS AGENDADAS!<br></strong></center></td></tr>";
											}
											?>
										</tbody>
										<?php  ?>
									</table>
								</div>
							</div>
							<!-- /Panel de Carolina -->
						</div>
						<!-- /Panel 	4 -->
					</div>
				</div>
				<!-- /Panel de control -->
            </div>
            <!-- /.card-body -->
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
	<strong>Copyright &copy; 2018 Computer Services.</strong>
	  All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
	  <b>Version</b> 1.4.0
	</div>
  </footer>
<!-- /.control-sidebar -->
</body>
</html>




 