<?php 
if(file_exists("../../cx/cx.php")){
  $dir="../../";
  $ruta="../";
}
  include_once ("../../cx/cx.php");
  include_once('../menu.php');



 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Liquidaciones</title>
    

    <style type="text/css">
      .numeros{
        text-align:right;
        /*color: black;*/
        font-size: 20px;
        padding-right: 5px;
      }
      .red{
        color: red;
        font-weight: bold;
        /*font-size: 25px;*/
      }
      .tituloCuadro2 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: bold;
        color: #003366;
      }
      .Estilo2 {
        color: #FFFFFF
      }

  </style>

  <script type="text/javascript">
    function letras(campo){

    campo.value=campo.value.toUpperCase();
    }

  </script>


  <script type="text/javascript">
    $(document).ready(function() {
     // hides the slickbox as soon as the DOM is ready
     // (a little sooner than page load)
      $('#slickbox').hide();
     // shows the slickbox on clicking the noted link
      $('a#slick-show').click(function() {
      $('#slickbox').slideDown('fast');
      return false;
      });
     // hides the slickbox on clicking the noted link
      $('a#slick-hide').click(function() {
      $('#slickbox').slideUp('fast');
      return false;
      });
     // toggles the slickbox on clicking the noted link
      $('a#slick-toggle').click(function() {
      $('#slickbox').SlideToggle('fast');
      return false;
      });
    });

    

    function buscarRad(valor) {
      var radicado = '760011' + $('#buscaRadicado').val();
      // alert(radicado);
      $.ajax({   
        cache: false,                     
        type: "POST",                 
        url: "../../controller/liquidacion_controller.php",                    
        data: 'buscaRad='+radicado,
        error: function(request, status, error)
        {
          console.log(error);
          alert("ocurrio un error "+request.responseText);
        },
        success: function(data)            
        {
          alert(data);
          console.log(data);
          var JSONdata    = JSON.parse(data); //parseo la informacion
// tipos_licencias
// tipos_usos
          $('#estrato').html(JSONdata[0].estrato);
          $('#radicado').val(JSONdata[0].radicado);
          $('#fechaRad').val(JSONdata[0].fecha);
          $('#direccion').val(JSONdata[0].dir_act);
          $('#arq').val(JSONdata[0].construRespon);
          $('#propietario').val(JSONdata[0].titulares);


            // console.log(JSONdata[0].tipos_usos[0][1]);
            // console.log(JSONdata[0].tipos_usos[1][2]);
            // console.log(JSONdata[0].tipos_usos[2][3]);

          for (var r = 0; r < JSONdata[0].tipos_usos.length ; r++) {
            // console.log(JSONdata[0].tipos_usos[r][r+1]);
          }

          var bandera = true;

          for (var j = 0; j < JSONdata[0].tipos_licencias.length ; j++) {
            var licencia = JSONdata[0].tipos_licencias[j].NOMBRE;
            var modalidad = JSONdata[0].tipos_licencias[j].MODALI;
            var id_Modalidad = JSONdata[0].tipos_licencias[j].ID;
            // console.log(licencia);
            // console.log(modalidad);

           
            elem = crearElemento(licencia, modalidad, JSONdata[0].tipos_usos );
            // alert(elem);
            $('#contenedor').append(elem);
          }

          // var tipos_licencias = JSONdata[0].tipos_licencias[0]
          // alert(JSONdata[0].tipos_licencias);
          // verificar(data);
          // confirmar('Haciendo pruebas', 'fa fa-check-square', 'blue', 'window');
        }
      });
    }

    function validate(campo){
        var result="";
        var str = campo.value.split('');
        for(i=0; i<=str.length-1; i++) {
            str[i] = str[i].toUpperCase();
            result+=str[i];
        }
      campo.value = result;
        //return result; //return(result);
    }

  </script>
  <script type="text/javascript">
     function ValidNum2(e){
      // console.log(e.currentTarget);
      // console.log(e.data);
      // console.log(e.target);
      var target = e.currentTarget;
      // alert('entro a los numeros ');
      tecla = (document.all) ? e.keyCode : e.which;
      //Tecla de retroceso para borrar, siempre la permite
      if (tecla==8 || tecla==0){
      //console.log('entro al if, deberia devolver un true');
          return true;
      }
          
      // Patron de entrada, en este caso solo acepta numeros
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      // if (patron.test(tecla_final)) {
      //   // $(target).val(tecla_final);
      //   cargoBasico2(target);
      // }else{

      return patron.test(tecla_final);
      
    }

    function cargoBasico2(opcion) {
      // console.log(ValidNum(opcion));
      // if (!evento2(opcion)) {
      //   alert('Sevento2olo se permiten numeros');
      // }
      // alert($(opcion).val()+' valor de llagada');
       console.log("key pressed ",  String.fromCharCode(event.keyCode));

      var tipo = $(opcion).attr('id');

      if ($(opcion).val().length == 0) {
        // alert('entro al if');
        $("#"+tipo+ "_2").val('0');
      }
        
      var tipoUso = tipo.split("_");
      
      var cargoFijo= 781242 * 0.40;
      var cargoVariable = 781242 * 0.80;

      var factor_Q=0;
      var totalBasico=0;
      var totalVariable=0;
      var tempExpesas=0;
      // alert(totalVariable);
      $(".cargoBasico").each(function(){
      // alert('entro al ciclo');
            var dato = $(this).val();
            // alert(dato);
            if (dato >= factor_Q) {
              factor_Q = dato;
            }
      });
      // alert(factor_Q + ' del factor q');

      if (tipoUso[0]=='vivienda') {
        var factor_I_v = factor_I_vivienda($('#estrato').html());
        // alert(factor_I_v);
        totalBasico = (cargoFijo * factor_I_v) * 0.938 ;
        // alert(781242*0.40 * factor_I_vivienda($('#factor_I_v').val()));
        totalVariable = ((cargoVariable * factor_I_v) * factor_J(factor_Q)) * 0.938 ;
        tempExpesas = totalBasico + totalVariable;
      }else {
        var factor_I_o = factor_I_otras(factor_Q);
      // alert(factor_I_o);
        totalBasico = ((781242*0.40) * factor_I_o) * 0.938 ;
        // alert(temp3);
        totalVariable = (((781242*0.80) * factor_I_o) * factor_J(factor_Q, '')) * 0.938 ;
      // alert(factor_J(factor_Q, ''));
        tempExpesas = totalBasico + totalVariable;
      }

      // alert(tempExpesas+ ' valor de expensas');
      $("#"+tipo+ "_2").val(tempExpesas);
      
      // alert($("#"+tipo+ "_2").val()+ ' despues de asignar valor');

      subtotalExpensas = sumarVariable();
      // alert(subtotalExpensas);

      var iva = subtotalExpensas * 0.19;
      var total = subtotalExpensas + iva;
      var estampillas = 5800;
      var totalExpensas = total + estampillas;

      totalBasico = FormtearNumeros(Math.round(totalBasico));
      totalVariable = FormtearNumeros(Math.round(totalVariable));
      subtotalExpensas = FormtearNumeros(Math.round(subtotalExpensas));
      console.log(subtotalExpensas);
      iva = FormtearNumeros(Math.round(iva));
      total = FormtearNumeros(Math.round(total));
      estampillas = FormtearNumeros(Math.round(estampillas));
      totalExpensas = FormtearNumeros(Math.round(totalExpensas));

      $('#cargoBasico').val(totalBasico);
      $('#cargoVariable').val(totalVariable);
      $('#subExpen').val(subtotalExpensas);
      $('#iva').val(iva);
      $('#total').val(total);
      $('#estampillas').val(estampillas);
      $('#totalExpensas').val(totalExpensas);
      totalVariable = parseInt(totalVariable.replace(/\./g,''));
    //   }else{
    //   $("#"+tipo+ "_2").val(0);
    // }
    }

    function sumarVariable() {
      var suma=0;
      $(".variable").each(function(){
            var temp = parseInt($(this).val());
            suma = suma + temp;
      });

      return suma;

    }

    function FormtearNumeros(valor) {
      valor+='';
      console.log(valor);
      var num = valor.replace(/\./g,'');
      if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return num;

      }
      else if(isNaN(num) || num==0){ 
        alert('Solo se permiten numeros');
        // input.value = input.value.replace(/[^\d\.]*/g,'');
      }
    }

    function factor_J(factor_q, modalidad='') {
      var j=0;
      if (modalidad== 'Urbanizacion' || modalidad== 'Parcelación') {
        j= 4 / (0.023 + (2000/factor_q));
      }else{
        if (factor_q <= 100) { 
          j= 0.45;
        }else if (factor_q > 100 && factor_q <= 11000) {
          j= 3.8 / (0.12 + (800/factor_q));
        }else if (factor_q > 11000) {
          j= 2.2 / (0.018 + (800/factor_q));
        }
      }
      return j;
    }

    function factor_I_otras(factor_Qq) {
      var jj=0;
      if (factor_Qq >= 0.1 && factor_Qq <= 300) { 
        jj= 2.9;
      }else if (factor_Qq > 300 && factor_Qq <= 1000) {
        jj= 3.2 ;
      }else if (factor_Qq > 1000) {
        jj= 4 ;
      }else{
        jj=0;
      }
      return jj;
      }

    function factor_I_vivienda(estrato) {
      var valor=0;
      switch (estrato) {
        case '1':
        case '2':
          valor = 0.5;
          break;
        case '3':
          valor = 1.0;
          break;
        case '4':
          valor = 1.5;
          break;
        case '5':
          valor = 2.0;
          break;
        case '6':
          valor = 2.5; // verificar este valor ya que aparece en 205
          break;
      }
      return valor;
    }


    function getUsos(arrayUsos, modLicencia) {
      var elemento='';
      for (var js = 0; js < arrayUsos.length ; js++) {
        console.log(arrayUsos[js][js+1]);
        if (arrayUsos[js][js+1]=='Vivienda') {
          
          elemento+=" <div class='col-lg-12  input-group'>";
            elemento+=" <div class='col-lg-1  input-group'></div>";
            elemento+=" <div class='col-lg-2  input-group'>";
              elemento+=" <h6>Vivienda</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='vivienda_"+modLicencia+"' type='text' id='vivienda_"+modLicencia+"' size='10' onkeyup='cargoBasico2(this); return ValidNum(this);' value='<?php ; ?>' > ";
            elemento+=" <label for=''>M<sup>2</sup></label>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-2 form-check'>";
              elemento+=" <input name='vivienda"+modLicencia+"vs' type='checkbox' id='vivienda"+modLicencia+"vs' value='1' onclick=''  > V.I.S";
            elemento+=" </div>";
            // /////////// datos vivienda_ /////////////
              elemento+=" <input class='modalidad' name='vivienda_"+modLicencia+"_1' type='hidden' id='vivienda_"+modLicencia+"_1' value='"+modLicencia+"' >";
              elemento+=" <input class='variable' onchange'' name='vivienda_"+modLicencia+"_2' type='hidden' id='vivienda_"+modLicencia+"_2' value='0' >";
            // elemento+=" </div>";
          elemento+=" </div>";
        }
        else if (arrayUsos[js][js+1]=='Comercio y/o Servicios') {

           elemento+=" <div class='col-lg-1  form-group'></div>";
         elemento+=" <div class='col-lg-12  input-group'>";
           elemento+=" <div class='col-lg-1  input-group'></div>";
           elemento+=" <div class='col-lg-2  input-group'>";
             elemento+=" <h6>Comercio</h6>";
           elemento+=" </div>";
           elemento+=" <div class='col-lg-3 input-group'>";
             elemento+=" <input class='cargoBasico' name='comercio_"+modLicencia+"' type='text' id='comercio_"+modLicencia+"' onkeypress='ValidNum2(event); '  onchange='cargoBasico2(this);' size='10' >";
             elemento+=" <label for=''>M<sup>2</sup></label>";
           elemento+=" </div>";

           elemento+=" <div class='col-lg-2  input-group'></div>";

            // /////////// datos comercio_ /////////////
              elemento+=" <input class='modalidad' name='comercio_"+modLicencia+"_1' type='hidden' id='comercio_"+modLicencia+"_1' value='"+modLicencia+"' >";
              elemento+=" <input class='variable' onchange'' name='comercio_"+modLicencia+"_2' type='hidden' id='comercio_"+modLicencia+"_2' value='0' >";
         elemento+=" </div>";

        }else if (arrayUsos[js][js+1]=='Industrial') {

          elemento+=" <div class='form-group col-lg-12 '></div>";
          elemento+=" <div class='col-lg-12  input-group'>";
            elemento+=" <div class='col-lg-1  input-group'></div>";
            elemento+=" <div class='col-lg-2  input-group'>";
              elemento+=" <h6>Industria</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='industria_"+modLicencia+"' type='text' id='industria_"+modLicencia+"' onkeyup='cargoBasico2(this); return ValidNum(this);' value='<?php ;?>' size='10' /> ";
              elemento+=" <label for=''>M<sup>2</sup></label>                  ";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-2 input-group'></div>";

            // /////////// datos industria_ /////////////
               elemento+=" <input class='modalidad' name='industria_"+modLicencia+"_1' type='hidden' id='industria_"+modLicencia+"_1' value='"+modLicencia+"' >";
              elemento+=" <input class='variable' onchange'' name='industria_"+modLicencia+"_2' type='hidden' id='industria_"+modLicencia+"_2' value='0' >";
          elemento+=" </div>";
          
        }else if (arrayUsos[js][js+1]=='Institucional') {

          elemento+=" <div class='form-group col-lg-12 '></div>";
          elemento+=" <div class='col-lg-12 input-group'>";
            elemento+=" <div class='col-lg-1 input-group'></div>";
            elemento+=" <div class='col-lg-2 input-group'>";
              elemento+=" <h6>Institucional</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='institucional_"+modLicencia+"' type='text' id='institucional_"+modLicencia+"' onkeyup='cargoBasico2(this); return ValidNum(this);' value='<?php ; ?>' size='10' > ";
              elemento+=" <label for=''>M<sup>2</sup></label>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-2 form-check'>";
              elemento+=" <input name='institucional_dot_1' type='checkbox' id='institucional_dot_1' value='1' onclick='' >DOT";
            elemento+=" </div>";

            // /////////// datos institucional_ /////////////
            elemento+=" <input class='modalidad' name='institucional_"+modLicencia+"_1' type='hidden' id='institucional_"+modLicencia+"_1' value='"+modLicencia+"' >";
            elemento+=" <input class='variable' onchange'' name='institucional_"+modLicencia+"_2' type='hidden' id='institucional_"+modLicencia+"_2' value='0' >";
          elemento+=" </div>";
        }
      }
      return elemento;
    }
  </script>
  <script type="text/javascript">
    
    function crearElemento(licencia, modalidad, arrayUsos) {
      var elemento='';

      elemento+=" <div class='form-group col-lg-12 '></div>";
      elemento+=" <div class='borde input-group col-lg-11' style='border: 1px solid #000'>";
       elemento+=" <div class='input-group col-lg-12 '>";
         elemento+=" <div class='form-group col-lg-12 '></div>";
         elemento+=" <div class='input-group col-lg-1 '></div>";
         elemento+=" <div class='col-lg-2 input-group'>";
           elemento+=" <h6><strong>"+licencia+" - "+modalidad+"</strong></h6>";
         elemento+=" </div>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-12  input-group'>";
         elemento+=" <div class='col-lg-1 input-group'></div>";
         elemento+=" <div class='col-lg-2  input-group'>";
           elemento+=" <h5>";
             elemento+=" <strong>Usos</strong>";
           elemento+=" </h5>";
         elemento+=" </div>";
         elemento+=" <div class='col-lg-3 input-group'>";
           elemento+=" <h5>";
             elemento+=" <strong>Cantidad</strong>";
           elemento+=" </h5>                      ";
         elemento+=" </div>";
         elemento+=" <div class='col-lg-2 form-check'>";
         // elemento+=" <div class='col-lg-2'>";
           elemento+=" <h5>";
             elemento+=" <strong>Subsidio</strong>";
           elemento+=" </h5>                      ";
         elemento+=" </div>";
       elemento+=" </div>";

       elemento+=" <div class='form-group col-lg-12 '></div>";
       elemento+= getUsos(arrayUsos, modalidad);
       elemento+=" <div class='form-group col-lg-12 '></div>";
       
     elemento+=" </div>";

      return elemento;
    }


  </script>
  <script language="JavaScript">
    var nav4 = window.Event ? true : false;
    function acceptNum(evt){
    // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || key <= 46 || (key >= 48 && key <= 57));
    }
    //-->
  </script>
  <style>
    /*Soluciona Problema de barra inferior del div principal*/
    .card-footer {
      padding: .75rem .1rem !important;
    }
  </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container col-lg-10">
          <div class="card card-danger">
            <div class="card-header">
              <center>
                <h3 class="card-title">LIQUIDACIÓN</h3>
              </center>
            </div>
            <form id="form1" name="form1" method="post" action="">
              <div class="card-body">
                <div class="row form-group">
                  <div class="borde" style="border: 1px solid #000">
                  <div class="col-lg-1 input-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 form-group">
                      <div class="col-lg-12 input-group">
                        <div class="col-lg-12">
                          <label for="fechaRad" class="col-form-label col-lg-3">Fecha</label>
                          <input class="form-control col-lg-9" type="date" name="fechaRad" id="fechaRad" required title="Fecha del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="radicado" class="col-form-label col-lg-3">Radicado</label>
                          <input class="form-control col-lg-9" type="text" name="radicado" id="radicado" required title="Numero del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="arq" class="col-form-label col-lg-3">Arquitecto</label>
                          <input class="form-control col-lg-9" type="text" name="arq" id="arq" required title="Numero del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="propietario" class="col-form-label col-lg-3">Propietarios</label>
                          <input class="form-control col-lg-9" type="text" name="propietario" id="propietario" required title="Numero del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="direccion" class="col-form-label col-lg-3">Direccion</label>
                          <input class="form-control col-lg-9" type="text" name="direccion" id="direccion" required title="Numero del Radicado">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 ">
                    <div class="col-lg-12 form-group"></div>
                      <div class="col-lg-12 input-group">
                        <label for="buscaRadicado" class="col-form-label col-lg-3"><strong>Radicado</strong></label>
                        <input value="180124" autofocus="autofocus" type="text" name="buscaRadicado" id="buscaRadicado" required title="Minimo 5 Numeros" maxlength="6" class="form-control col-lg-5" placeholder="Digite el No.">
                        <button  type="button" name="burcar1" value="1" onclick="buscarRad(this)" class="btn btn-danger left col-lg-2">Buscar</button>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-12 form-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group">
                      <h5 class="col-lg-2">Estrato</h5>
                      <label name="estrato" id="estrato" class="col-form-label col-lg-3"><strong>----</strong></label>                  
                    </div>
                  </div>
                  <div class="col-lg-12 form-group"></div>
                  <div class="col-lg-12 borde" id="contenedor" >
                    
                  </div>

                  <div class="col-lg-6 form-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Cargo Basico</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros" name="cargoBasico" type="text" id="cargoBasico" value="0" size="10" >
                    </div>
                  </div>
                  <div class="col-lg-6 form-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Cargo Variable</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros" name="cargoVariable" type="text" id="cargoVariable" value="0" size="10" >
                    </div>
                  </div>
                  <div class="col-lg-6 form-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Subtotal</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros" class="numeros" name="subExpen" type="text" id="subExpen" value="0" size="10" >
                    </div>
                  </div>
                  <div class="col-lg-6 form-group"></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Iva 19%</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros" name="iva" type="text" id="iva" value="0" size="10" readonly="readonly" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Total</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros red" name="total" type="text" id="total" value="0" size="10" readonly="readonly" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Estampillas</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros" name="estampillas" type="text" id="estampillas" value="0" size="10" onchange="" onkeyup="" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-6 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h5 class="col-lg-12">Expensas</h5>
                    </div>
                    <div class="col-lg-3 input-group">
                      <input class="numeros red" name="totalExpensas" type="text" id="totalExpensas" value="0" size="10" readonly="readonly" >
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
                <div class="col-lg-12  input-group">
                  <div class="col-lg-3"></div>  
                  <button class="btn btn-danger col-lg-2" type="submit" name="submit" id="submit" >Generar</button>
                  <div class="col-lg-1"></div>              
                  <button class="btn btn-default col-lg-2" type="submit" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">Cancelar</button>
                </div>
                <div class="form-group col-lg-12 "></div>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
