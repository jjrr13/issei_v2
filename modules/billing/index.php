<?php 

include_once('../menu.php');
include_once ('../../functions/globales.js');

 ?>

<script>

var cantidadFacturas=1;
var cantidadFacturas2=1;
var cantidadFacturas3=1;
var cantidadFacturas4=1;
var cantidadFacturas5=1;
var cantidadFacturas6=1;
var cantidadFacturas7=1;
var cantidadFacturas8=1;
var cantidadFacturas9=1;
var cantidadFacturas10=1;
var cantidadFacturas11=1;
var cantidadFacturas12=1;


function addFacturacion(facturar) {
  var option = $(facturar).attr('id');
  alert(option);
  var limite;
  if (option == '_1'){
      limite = cantidadFacturas;
      cantidadFacturas++;
  }else if (option == '_2'){
      limite = cantidadFacturas2;
      cantidadFacturas2++;
  }

  if (limite >= 1  && limite <= 9) {
    alert('entro al if');
    var nuevaFactura = "";
    nuevaFactura +="<div class='col-lg-12 input-group borde'>";
    nuevaFactura +="<div class='col-lg-12 input-group'>";
    nuevaFactura   +="<div class='col-lg-12 input-group'>";
    nuevaFactura    +="<input type='text' name='fact"+option+"[]' class='form-control col-lg-11' placeholder='Factura "+(limite+1)+"'>";
    nuevaFactura   +="</div>";
    nuevaFactura  +="</div>";
    nuevaFactura +="</div>";

    $('#fact'+option).append(nuevaFactura);
    // cantidadFacturas++;
  }
  else{
    confirmar('HA SUPERADO EL MAXIMO DE Facturas', 'fa fa-window-close', 'red', 'S')
  }
}




</script>
<style>
  .bottons{
    background-color: #4f5962;
    color: #fff;
  }
  .agregar{
    text-align: left;
    margin-top: 2%;
    margin-bottom: 5%;
    /*border: 1px solid #000;*/
  }
  .borde{
    margin-bottom: 2%;
    border: 1px solid #dad8d8;
    padding-top: 10px;
    padding-bottom: 15px;
  }
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container col-lg-10">
          <div class="card card-danger">
	          <div class="card-header">
	            <center><h3 class="card-title">FACTURACIÓN</h3></center>
	          </div>
          	<div  class="card-body">
							<div class="container">
								<div class="row form-group">
									<div class="col-lg-10 form-group" id="fact_2">
							      <label for="diractual" class="col-form-label col-lg-4">Factura</label>
							      <div class="col-lg-12 input-group borde">
							        <div class="col-lg-12 input-group">
							          <div class="col-lg-12 input-group">
							            <input type="text" name="fact_2[]" class="form-control col-lg-11" placeholder="FACTURA 1">
							          </div>
							        </div>
							      </div>
							    </div>
							    <div class="col-lg-12 input-group" >
							      <div class="col-lg-11"></div>
							      <button type="button" class=" btn btn-success agregar col-lg-1" id="_2" onclick="addFacturacion(this);">
							        <span class="fa fa-plus-circle "></span> 
							      </button>
							    </div>
							    <div class="col-lg-12 input-group" >
							      <button type="button" class=" btn btn-danger col-lg-2 " >
							        Guardar
							      </button>
							    </div>
								</div>
							</div>
            </div>
          </div>
      </div>
    </section>
  </div>