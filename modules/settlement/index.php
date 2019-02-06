<?php 
  if(file_exists("../../cx/cx.php")){
    $dir="../../";
    $ruta="../";
  }
  include_once ("../../cx/cx.php");
  include_once('../menu.php');
?>

  <title>Liquidaciones</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  

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

    function letras(campo){
      campo.value=campo.value.toUpperCase();
    }

    var bandera = true;
    var reconocimiento = false;

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
          console.log(data);
          bandera = true;

          if (data == 3) {
            confirmar('EL RADICADO NO EXISTE! <br> INTENTA DE NUEVO', 'fa fa-window-close', 'red', 'S');
          }else{
            $('#contenedor').empty();
            $('#ph_check').empty();
            eliminarVariable();
            calcular(0);
            $('#prorroga').prop('checked', false);
            $('#revalidacion').prop('checked', false);
            $('#Subdivision').prop('checked', false);
            $('#cotas').prop('checked', false);
            $('#modificacion_planos').prop('checked', false);

            var JSONdata = JSON.parse(data); //parseo la informacion

            // alert(JSONdata[0].estrato);

            $('#estrato').html(JSONdata[0].estrato);
            $('#nombreProyecto').val(JSONdata[0].nombreProyecto);
            $('#radicado').val(JSONdata[0].radicado);
            $('#fechaRad').val(JSONdata[0].fecha);
            $('#direccion').val(JSONdata[0].dir_act);
            $('#arq').val(JSONdata[0].construRespon);
            $('#propietario').val(JSONdata[0].titulares);

            // alert(JSONdata[0].objetivo_id);
            if (JSONdata[0].objetivo_id == 2) {

              $('#prorroga_2').val(salarioMensual);
              $('#prorroga').prop('checked', true); 
              $('#vis_0').empty();

              bandera = false;
              calcular(parseInt(0));
            }
            else if (JSONdata[0].objetivo_id == 4) {
              $('#revalidacion_2').val(salarioMensual);
              $('#revalidacion').prop('checked', true); 
              $('#vis_0').empty();
              calcular(parseInt(0));
            }

            var vis = false;
            var dot = false;
            for (var r = 0; r < JSONdata[0].tipos_usos.length ; r++) {
              console.log(JSONdata[0].tipos_usos[r][r+1]);
              if (JSONdata[0].tipos_usos[r][r+1] == 'Vivienda') {
                vis=true;
              }
              else if (JSONdata[0].tipos_usos[r][r+1] == 'Institucional') {
                dot=true;
              }
            }
            if (!vis) {
              $('#vis_0').empty();
            }else if (!dot) {
              $('#dot_0').empty();
            }

            
            var cantidadLicencias = JSONdata[0].tipos_licencias.length;

            //para saber si tiene reconocimiento, si es true no se cobraran las licencias de construccion a eccepcion de ampliacion y reconstruccion
            for (var j = 0; j < cantidadLicencias ; j++) {
              if(JSONdata[0].tipos_licencias[j].NOMBRE == 'Reconocimiento'){
                alert('entro al if de Reconocimiento')
                reconocimiento = true;
              }
            }

            for (var j = 0; j < cantidadLicencias ; j++) {
              var licencia = JSONdata[0].tipos_licencias[j].NOMBRE;
              var modalidad = JSONdata[0].tipos_licencias[j].MODALI;
              var id_Modalidad = JSONdata[0].tipos_licencias[j].ID;
              alert(licencia+modalidad);
              if (licencia+modalidad == 'SubdivicionUrbana' || licencia+modalidad == 'SubdivicionRural'  ) {
                // alert('entro al if de SUBDIVISION022222');
                $('#Subdivision_2').val(salarioMensual);
                $('#Subdivision').prop('checked', true); 
                calcular(parseInt(0));
              }
              else if(licencia+modalidad == 'OtrasAjuste de Cotas'){
                var valorCota = ajuste_cotas(JSONdata[0].estrato, salarioMensual);
                $('#cotas_2').val(valorCota);
                $('#cotas').prop('checked', true);
                // $('#cotas').attr("checked", "checked");
                $('#vis_0').empty();
                calcular(parseInt(0));

              }else if(licencia+modalidad == 'Concepto de Norma'){
                var valorConceptoNorma = concepto_norma(salarioMensual);

                $('#concepto_norma_2').val(valorCota);
                $('#concepto_norma').prop('checked', true);
                // $('#concepto_norma').attr("checked", "checked");
                calcular(parseInt(0));

              }else if(licencia+modalidad == 'UrbanizacionModificacion Planos Urbanisticos'){
                // alert('entro A Modificacion');
                $('#modificacion_planos_2').val(salarioMensual);
                $('#modificacion_planos').prop('checked', true);
                calcular(parseInt(0));

              }else if(licencia+modalidad == 'OtrasPropiedad Horizontal' && cantidadLicencias > 1){
                // alert('entro A Modificacion');
                var elemento2 = '';
                elemento2+="<div class='col-lg-2 form-check' id='ph_check'>";
                elemento2+=  "<input name='propiedad_horizontal' type='checkbox' id='propiedad_horizontal' value='1' disabled='' onclick='' checked='checked'> Propiedad Horizontal";
                elemento2+=  "<input class='variable' onchange'' name='propiedad_horizontal_2' type='hidden' id='propiedad_horizontal_2' value='0' >";
                elemento2+="</div>";

                $('#checks').append(elemento2);

              }else{
                if(licencia+modalidad == 'ReconocimientoN-A'){
                  // alert('entro A Modificacion');
                }
                // alert(licencia+modalidad);
                elem = crearElemento(licencia, modalidad, JSONdata[0].tipos_usos);
                // alert(elem);
                $('#contenedor').append(elem);
              }
            }
          }

        }
      });
    }

  </script>
  <script type="text/javascript">
    function ValidNum2(e){
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
      //   calcular(target);
      // }else{

      return patron.test(tecla_final);
    }

    var salarioMensual= 828116;
      
    var cargoFijo= salarioMensual * 0.40;
    var cargoVariable = salarioMensual * 0.80;
    var factor_M = 0.938;
    var estampillas=0;

    function factores(opcion) {
      // console.log($(opcion).attr('type'));

      var tipo = $(opcion).attr('id');
      var tipoUso = tipo.split("_");


      var modo;
        if ($(opcion).val().length == 0) {
          // alert('entro al if');
          $("#"+tipo+ "_2").val('0');
        }
        modo = $("#"+tipo+ "_3").val();

      // var factor_Q = mayorFactor_Q();
      var factor_Q = $(opcion).val();

        // alert(tipoUso[1]);
      if (validar_30(tipoUso[1])) {
        factor_Q = factor_Q * 0.30;
        // alert(tipo);
        $('#'+tipo+'_4').val(factor_Q);
      }


      var totalBasico=0;
      var totalVariable=0;
      var tempExpesas=0;
     
      // alert(factor_Q);
      // alert(modo);

      if (tipoUso[0]=='vivienda') {
        if (factor_Q >= 0.1) {
          var factor_I_v = factor_I_vivienda($('#estrato').html());

          totalBasico = (cargoFijo * factor_I_v) * factor_M ;
          totalVariable = ((cargoVariable * factor_I_v) * factor_J(factor_Q, modo)) * factor_M ;
          // alert(totalBasico);
        }
         // alert(factor_I_v);
      }else {
        if (factor_Q >= 0.1) {
          var factor_I_o = factor_I_otras(factor_Q);
        // alert(factor_I_o);
          totalBasico = ( cargoFijo * factor_I_o) * factor_M ;
          totalVariable = ((cargoVariable * factor_I_o) * factor_J(factor_Q, modo)) * factor_M ;
        }
      }
      if ($('#vivienda_vis').prop('checked')) {
        $("#"+tipo+ "_2").val(totalVariable/2);
        totalBasico = Math.round(totalBasico)
        $("#"+tipo+ "_0").val(totalBasico/2);
      }else{
        $("#"+tipo+ "_2").val(totalVariable);
        totalBasico = Math.round(totalBasico)
        $("#"+tipo+ "_0").val(totalBasico);
      }

      calcular(totalBasico);
      
    }

    function subsidioVIS(check) {
      if ($(check).prop('checked')) {
        // alert('lo esta dividiendo');
        $(".vivienda").each(function(){
          var campo = $(this).attr('id').split("_2");
          var base = $('#'+campo[0]+'_0').val();
          base = base / 2;
          $('#'+campo[0]+'_0').val(base);

          var temp = parseInt($(this).val());
          temp = temp / 2;
          $(this).val(temp);
        });
      }
      else {
        // alert('lo esta multiplicando');
        $(".vivienda").each(function(){
          var campo = $(this).attr('id').split("_2");
          var base = $('#'+campo[0]+'_0').val();
          base = base * 2;
          $('#'+campo[0]+'_0').val(base);

          var temp = parseInt($(this).val());
          temp = temp * 2;
          $(this).val(temp);
        });
      }

      calcular(parseInt(0));
    }

    function cargoBasico() {
      var tempFactor_Q=0;
      var cargoB =0;
      var j=0;
      //quizas toque determinar si la prioridad a vivienda entre los usos en caso de iguales
      $(".cargoBasico").each(function(){
        // alert('entro al ciclo');
          j++;
        var dato = parseInt( $(this).val());
        // alert(dato);
          // console.log(dato + ' es mayor que ? ' + tempFactor_Q);
          // console.log(dato >= tempFactor_Q);
        if (dato >= tempFactor_Q) {
          // console.log(dato);
          // console.log(tempFactor_Q);
          tempFactor_Q = dato;
          var idCampo = $(this).attr('id');
        // alert(idCampo);
          cargoB = $('#'+ idCampo +'_0').val().replace('.', "");
          // console.log('---------/*/---------------/*/----------------');
          // console.log(tempFactor_Q+ ' Nuevo Valor temp');
          // console.log(cargoB)
        }
          // console.log(j + ' Cantidad de Ciclos');
          // console.log('---------//---------------//----------------');
      });
      return cargoB;
    }

    function calcular(total_Basicoss) {

      // alert(total_Basico + ' / '+ total_Variable);
      var total_Variable = sumarVariable();
      var total_Basico = parseInt(cargoBasico());
      if(isNaN(total_Basico)){
        total_Basico=0;
      }
      // alert(cargoBasico());
      var subtotalExpensas = total_Variable + total_Basico;
      // alert(subtotalExpensas);

      var iva = subtotalExpensas * 0.19;
      var total = subtotalExpensas + iva;

      
      if (subtotalExpensas >= 0.1 && bandera == true){ estampillas = 6000;}
      
      var totalExpensas = total + estampillas;

      total_Basico = FormtearNumeros(Math.round(total_Basico));
      total_Variable = FormtearNumeros(Math.round(total_Variable));
      subtotalExpensas = FormtearNumeros(Math.round(subtotalExpensas));
      // console.log(subtotalExpensas);
      iva = FormtearNumeros(Math.round(iva));
      total = FormtearNumeros(Math.round(total));
      estampillas = FormtearNumeros(Math.round(estampillas));
      totalExpensas = FormtearNumeros(Math.round(totalExpensas));

      $('#cargoBasico').val(total_Basico);
      $('#cargoVariable').val(total_Variable);
      $('#subExpen').val(subtotalExpensas);
      $('#iva').val(iva);
      $('#total').val(total);
      $('#estampillas').val(estampillas);
      $('#totalExpensas').val(totalExpensas);
      // totalVariable = parseInt(totalVariable.replace(/\./g,''));
    }

    function mayorFactor_Q() {
      var tempFactor_Q=0;
      //quizas toque determinar si la prioridad a vivienda entre los usos en caso de iguales
      $(".cargoBasico").each(function(){
        // alert('entro al ciclo');
        var dato = $(this).val();
        // alert(dato);
        if (dato >= tempFactor_Q) {
          tempFactor_Q = dato;
          // console.log($(this).attr('id'))
        }
      });
      return tempFactor_Q;
    }

    function sumarVariable() {
      var suma=0;
      $(".variable").each(function(){
        var temp = parseInt($(this).val());
        suma = suma + temp;
      });
      return suma;
    }
    function eliminarVariable() {
      $(".variable").each(function(){
        $(this).val(0);
      });
    }

    function FormtearNumeros(valor) {
      valor+='';
      // console.log(valor);
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
        j= 4 / (0.025 + (2000/factor_q));
      }else{
        if (factor_q >= 0.1 && factor_q <= 100) { 
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
      }
      return jj;
    }

    function ajuste_cotas(estrato, salario) {
      var diario = salario / 30;
      var tempValor=0;
      if (estrato == 1 || estrato == 2) {
        tempValor = diario * 4 ;
      }else if (estrato == 3 || estrato == 4) {
        tempValor = diario * 8;
      }else if (estrato == 5 || estrato == 6) {
        tempValor = diario * 12;
      }
      return tempValor;
    }

    function concepto_norma(salario) {
      var tempValor = (salario /30 ) * 10 ;
      return tempValor;
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

    function valor_Reloteo(elemento, salario) {
      var tempValor=0;
      var factor_qq = $(elemento).val();

      if (factor_qq >= 0.1 && factor_qq <= 1000) {
        tempValor = (salario /30 ) * 2 ;
      }else if (factor_qq >= 1001 && factor_qq <= 5000) {
        tempValor = salario /2;
      }else if (factor_qq >= 5001 && factor_qq <= 10000) {
        tempValor = salario;
      }else if (factor_qq >= 10001 && factor_qq <= 20000) {
        tempValor = salario + (salario /2);
      }else if (factor_qq > 20000) {
        tempValor = salario * 2;
      }
      $('#reloteo_Reloteo_2').val(tempValor);
      calcular(0);
    }

    function valor_ph(elemento, salario) {
      var tempValor=0;
      var factor_qq = $(elemento).val();
      //a la formula se aplica la logica de la abogada en la cual se elimina el primer rango de 5000 y se ponen inferior de 10000
      if (factor_qq >= 0.1 && factor_qq <= 250) {
        tempValor = salario  * 0.25 ;
      }else if (factor_qq >= 251 && factor_qq <= 500) {
        tempValor = salario * 0.5;
      }else if (factor_qq >= 501 && factor_qq <= 1000) {
        tempValor = salario * 1;
      }else if (factor_qq >= 1001 && factor_qq <= 5000) {
        tempValor = salario * 2;
      }else if (factor_qq >= 5001 && factor_qq <= 10000) {
        tempValor = salario * 3;
      }else if (factor_qq >= 10001 && factor_qq <= 20000) {
        tempValor = salario * 4;
      }else if (factor_qq >= 20000) {
        tempValor = salario * 5;
      }
      $('#ph_PropiedadHorizontal_2').val(tempValor);
      calcular(0);
    }

    function valor_tierras_piscinas(elemento, salario) {
      var tempValor=0;
      var factor_qq = $(elemento).val();
      var id = $(elemento).attr('id');
      //a la formula se aplica la logica de la abogada en la cual se elimina el primer rango de 5000 y se ponen inferior de 10000
      if (factor_qq >= 0.1 && factor_qq <= 100) {
        tempValor = (salario/30)  * 2 ;
      }else if (factor_qq >= 101 && factor_qq <= 500) {
        tempValor = (salario/30)  * 4 ;
      }else if (factor_qq >= 501 && factor_qq <= 1000) {
        tempValor = salario * 1;
      }else if (factor_qq >= 1001 && factor_qq <= 5000) {
        tempValor = salario * 2;
      }else if (factor_qq >= 5001 && factor_qq <= 10000) {
        tempValor = salario * 3;
      }else if (factor_qq >= 10001 && factor_qq <= 20000) {
        tempValor = salario * 4;
      }else if (factor_qq >= 20000) {
        tempValor = salario * 5;
      }
      $('#'+id+'_2').val(tempValor);
      calcular(0);
    }

    function valor_aprobacion_proyectos(elemento, salario) {
      var tempValor=0;
      var factor_qq = $(elemento).val();
      //a la formula se aplica la logica de la abogada en la cual se elimina el primer rango de 5000 y se ponen inferior de 10000
      if (factor_qq >= 0.1 && factor_qq <= 10000) {
        tempValor = (salario /30 ) * 10 ;
      }else if (factor_qq >= 10001 && factor_qq <= 15000) {
        tempValor = (salario /30 ) * 20 ;
      }else if (factor_qq >= 15001 && factor_qq <= 20000) {
        tempValor = salario;
      }else if (factor_qq >= 20001 && factor_qq <= 25000) {
        tempValor = salario + ((salario /30 ) * 10) ;
      }else if (factor_qq >= 25001 && factor_qq <= 30000) {
        tempValor = salario + ((salario /30 ) * 20) ;
      }else if (factor_qq >= 30001 && factor_qq <= 35000) {
        tempValor = salario * 2;
      }else if (factor_qq >= 35001 && factor_qq <= 40000) {
        tempValor = salario * 2 + ((salario /30 ) * 10) ;
      }else if (factor_qq >= 40001 && factor_qq <= 45000) {
        tempValor = salario * 2 + ((salario /30 ) * 20) ;
      }else if (factor_qq >= 45001 && factor_qq <= 50000) {
        tempValor = salario * 3;
      }else if (factor_qq >= 50001 && factor_qq <= 55000) {
        tempValor = salario * 3 + ((salario /30 ) * 10) ;
      }else if (factor_qq >= 55001 && factor_qq <= 60000) {
        tempValor = salario * 3 + ((salario /30 ) * 20) ;
      }else if (factor_qq >= 60001 && factor_qq <= 65000) {
        tempValor = salario * 4;
      }else if (factor_qq >= 65001 && factor_qq <= 70000) {
        tempValor = salario * 4 + ((salario /30 ) * 10) ;
      }else if (factor_qq >= 70001 && factor_qq <= 75000) {
        tempValor = salario * 4 + ((salario /30 ) * 20) ;
      }else if (factor_qq >= 75001) {
        tempValor = salario * 5;
      }
      $('#Aprobacion_AprobacionPoryectosUrbanisticos_2').val(tempValor);
      calcular(0);
    }

    function validar_30(modalidades) {
      var resultado = false;

      if (modalidades == 'Modificacion' || modalidades == 'Restauracion' || modalidades == 'Reforzamiento Estructural' || modalidades == 'ReforzamientoEstructural' || modalidades == 'Reconstruccion') {
        resultado = true;
      }
      return resultado;
    }

    function cobro_30(modalidades, tipo) {
      var elemento = '';
        
      elemento+=" <div class='col-lg-3 input-group'>";
      elemento+=" <input class='cargoBasico4' name='"+tipo+"_"+modalidades+"_4' type='text' id='"+tipo+"_"+modalidades+"_4' size='10' value='' disabled='' > ";
      elemento+=" <label for=''>M<sup>2</sup></label>";
      elemento+=" </div>";
     
      return elemento;
    }

    function getUsos(arrayUsos, modLicencia1, lic) {
      var modLicencia='';
      var elemento='';
      var funcion = 'factores(this);';
      alert(reconocimiento);
      if (reconocimiento && (modLicencia !='ConstruccionAmpliacion' || modLicencia !='ConstruccionReconstruccion') ) {
        alert('entro al if de inhabilitar la funcion');
        funcion='';
      }
      alert(modLicencia);
      modLicencia2 = modLicencia1;
      modLicencia1 = modLicencia1.split(' ');

      for (var jr =0; modLicencia1.length-1 >= jr ; jr++) {
        modLicencia+= modLicencia1[jr];
      }
      //TERNER EN CUENTA VALIDAR QUIZAS DESDE AFUERA, YA QUE SE PUEDE REPETIR DEPENDIENDO DE LA CANTIDAD DE USUS QUE TENGA

        
        // console.log(arrayUsos);
        for (var js = 0; js < arrayUsos.length ; js++) {
          console.log(arrayUsos[js]);
          if (arrayUsos[js][1]=='Vivienda') {
            
            elemento+=" <div class='col-lg-12  input-group'>";
              elemento+=" <div class='col-lg-1  input-group'></div>";
              elemento+=" <div class='col-lg-2  input-group'>";
                elemento+=" <h6>Vivienda</h6>";
              elemento+=" </div>";
              elemento+=" <div class='col-lg-3 input-group'>";
                elemento+=" <input class='cargoBasico' name='vivienda_"+modLicencia+"' type='text' id='vivienda_"+modLicencia+"' size='10' onkeyup='"+funcion+" return ValidNum(this);' value='<?php ; ?>' > ";
              elemento+=" <label for=''>M<sup>2</sup></label>";
              elemento+=" </div>";
                // alert('Afuera del if con /*/' + modLicencia2);
              if (validar_30(modLicencia2)) {

                // alert('entro al if con /*/' + modLicencia);

                elemento+= cobro_30(modLicencia, 'vivienda');
              }

              // /////////// datos vivienda_ /////////////
                elemento+=" <input class='cargoBasico1' name='vivienda_"+modLicencia+"_0' type='hidden' id='vivienda_"+modLicencia+"_0' value='0' >";
                elemento+=" <input class='modalidad' name='vivienda_"+modLicencia+"_1' type='hidden' id='vivienda_"+modLicencia+"_1' value='"+modLicencia+"' >";
                elemento+=" <input class='variable vivienda' onchange'' name='vivienda_"+modLicencia+"_2' type='hidden' id='vivienda_"+modLicencia+"_2' value='0' >";
                elemento+=" <input class='licencia' name='vivienda_"+modLicencia+"_3' type='hidden' id='vivienda_"+modLicencia+"_3' value='"+lic+"' >";
              // elemento+=" </div>";
            elemento+=" </div>";
          }
          else if (arrayUsos[js][2]=='Comercio y/o Servicios') {
             
            elemento+=" <div class='col-lg-1  form-group'></div>";
            elemento+=" <div class='col-lg-12  input-group'>";
             elemento+=" <div class='col-lg-1  input-group'></div>";
             elemento+=" <div class='col-lg-2  input-group'>";
               elemento+=" <h6>Comercio</h6>";
             elemento+=" </div>";
             elemento+=" <div class='col-lg-3 input-group'>";
               elemento+=" <input class='cargoBasico' name='comercio_"+modLicencia+"' type='text' id='comercio_"+modLicencia+"' onkeypress='ValidNum2(event); '  onkeyup='"+funcion+"' size='10' >";
               elemento+=" <label for=''>M<sup>2</sup></label>";
             elemento+=" </div>";
             if (validar_30(modLicencia2)) {
                elemento+= cobro_30(modLicencia, 'comercio');
              }

             elemento+=" <div class='col-lg-2  input-group'></div>";

              // /////////// datos comercio_ /////////////
               elemento+=" <input class='cargoBasico1' name='comercio_"+modLicencia+"_0' type='hidden' id='comercio_"+modLicencia+"_0' value='0' >";
                elemento+=" <input class='modalidad' name='comercio_"+modLicencia+"_1' type='hidden' id='comercio_"+modLicencia+"_1' value='"+modLicencia+"' >";
                elemento+=" <input class='variable' onchange'' name='comercio_"+modLicencia+"_2' type='hidden' id='comercio_"+modLicencia+"_2' value='0' >";
                elemento+=" <input class='licencia' name='comercio_"+modLicencia+"_3' type='hidden' id='comercio_"+modLicencia+"_3' value='"+lic+"' >";

            elemento+=" </div>";
          }else if (arrayUsos[js][3]=='Institucional') {
            // alert('entro al institucional_');
            elemento+=" <div class='form-group col-lg-12 '></div>";
            elemento+=" <div class='col-lg-12 input-group'>";
              elemento+=" <div class='col-lg-1 input-group'></div>";
              elemento+=" <div class='col-lg-2 input-group'>";
                elemento+=" <h6>Institucional</h6>";
              elemento+=" </div>";
              elemento+=" <div class='col-lg-3 input-group'>";
                elemento+=" <input class='cargoBasico' name='institucional_"+modLicencia+"' type='text' id='institucional_"+modLicencia+"' onkeyup='"+funcion+" return ValidNum(this);' value='<?php ; ?>' size='10' > ";
                elemento+=" <label for=''>M<sup>2</sup></label>";
              elemento+=" </div>";
              if (validar_30(modLicencia2)) {
                elemento+= cobro_30(modLicencia, 'institucional');
              }
              // elemento+=" <div class='col-lg-2 form-check'>";
              //   elemento+=" <input name='institucional_"+modLicencia+"_dot' type='checkbox' id='institucional_"+modLicencia+"_dot' value='1' onclick='"+funcion+"'  > DOT";

              //   // elemento+=" <input name='institucional_dot_1' type='checkbox' id='institucional_dot_1' value='1' onclick='' >DOT";
              // elemento+=" </div>";

              // /////////// datos institucional_ /////////////
               elemento+=" <input class='cargoBasico1' name='institucional_"+modLicencia+"_0' type='hidden' id='institucional_"+modLicencia+"_0' value='0' >";
              elemento+=" <input class='modalidad' name='institucional_"+modLicencia+"_1' type='hidden' id='institucional_"+modLicencia+"_1' value='"+modLicencia+"' >";
              elemento+=" <input class='variable' onchange'' name='institucional_"+modLicencia+"_2' type='hidden' id='institucional_"+modLicencia+"_2' value='0' >";
                elemento+=" <input class='licencia' name='institucional_"+modLicencia+"_3' type='hidden' id='institucional_"+modLicencia+"_3' value='"+lic+"' >";

            elemento+=" </div>";
          }else if (arrayUsos[js][4]=='Industrial') {
            // alert('entro al Industrial');

            elemento+=" <div class='form-group col-lg-12 '></div>";
            elemento+=" <div class='col-lg-12  input-group'>";
              elemento+=" <div class='col-lg-1  input-group'></div>";
              elemento+=" <div class='col-lg-2  input-group'>";
                elemento+=" <h6>Industria</h6>";
              elemento+=" </div>";
              elemento+=" <div class='col-lg-3 input-group'>";
                elemento+=" <input class='cargoBasico' name='industria_"+modLicencia+"' type='text' id='industria_"+modLicencia+"' onkeyup='"+funcion+" return ValidNum(this);' value='<?php ;?>' size='10' /> ";
                elemento+=" <label for=''>M<sup>2</sup></label>                  ";
              elemento+=" </div>";
              if (validar_30(modLicencia2)) {
                elemento+= cobro_30(modLicencia, 'industria');
              }

              elemento+=" <div class='col-lg-2 input-group'></div>";

              // /////////// datos industria_ /////////////
               elemento+=" <input class='cargoBasico1' name='industria_"+modLicencia+"_0' type='hidden' id='industria_"+modLicencia+"_0' value='0' >";
                 elemento+=" <input class='modalidad' name='industria_"+modLicencia+"_1' type='hidden' id='industria_"+modLicencia+"_1' value='"+modLicencia+"' >";
                elemento+=" <input class='variable' onchange'' name='industria_"+modLicencia+"_2' type='hidden' id='industria_"+modLicencia+"_2' value='0' >";
                elemento+=" <input class='licencia' name='industria_"+modLicencia+"_3' type='hidden' id='industria_"+modLicencia+"_3' value='"+lic+"' >";


            elemento+=" </div>";
            
          }
        }
      // }
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
         if (validar_30(modalidad)) {
          elemento+=" <div class='col-lg-3 input-group'>";
           elemento+=" <h5>";
             elemento+=" <strong>30% de Cantidad</strong>";
           elemento+=" </h5>                      ";
          elemento+=" </div>";
         }
       elemento+=" </div>";
       console.log('-------------------------------------------');
       console.log(modalidad); 
       console.log('-------------------------------------------');

       elemento+=" <div class='form-group col-lg-12 '></div>";

       if (modalidad == 'Reloteo') {
         elemento+=" <div class='col-lg-12  input-group'>";
          elemento+=" <div class='col-lg-1  input-group'></div>";
          elemento+=" <div class='col-lg-2  input-group'>";
            elemento+=" <h6>Reloteo</h6>";
          elemento+=" </div>";
          elemento+=" <div class='col-lg-3 input-group'>";
            elemento+=" <input class='cargoBasico' name='reloteo_"+modalidad+"' type='text' id='reloteo_"+modalidad+"' size='10' onkeyup='valor_Reloteo(this,"+salarioMensual+"); return ValidNum(this);' value='<?php ; ?>' > ";
          elemento+=" <label for=''>M<sup>2</sup></label>";
          elemento+=" </div>";

          // /////////// datos reloteo_ /////////////
            elemento+=" <input class='cargoBasico1' name='reloteo_"+modalidad+"_0' type='hidden' id='reloteo_"+modalidad+"_0' value='0' >";
            elemento+=" <input class='modalidad' name='reloteo_"+modalidad+"_1' type='hidden' id='reloteo_"+modalidad+"_1' value='"+modalidad+"' >";
            elemento+=" <input class='variable' onchange'' name='reloteo_"+modalidad+"_2' type='hidden' id='reloteo_"+modalidad+"_2' value='0' >";
            elemento+=" <input class='licencia' name='reloteo_"+modalidad+"_3' type='hidden' id='reloteo_"+modalidad+"_3' value='"+licencia+"' >";
          // elemento+=" </div>";
        elemento+=" </div>";
       } 
       else if (modalidad == 'Aprobacion Poryectos Urbanisticos') {
         modalidad = modalidad.split(' ');
         // alert(modalidad.length);
         modalidad = modalidad[0]+modalidad[1]+modalidad[2];
         // alert(modalidad);
         elemento+=" <div class='col-lg-12  input-group'>";
          elemento+=" <div class='col-lg-1  input-group'></div>";
          elemento+=" <div class='col-lg-2  input-group'>";
            elemento+=" <h6>Aprobacion Poryectos</h6>";
          elemento+=" </div>";
          elemento+=" <div class='col-lg-3 input-group'>";
            elemento+=" <input class='cargoBasico' name='Aprobacion_"+modalidad+"' type='text' id='Aprobacion_"+modalidad+"' size='10' onkeyup='valor_aprobacion_proyectos(this,"+salarioMensual+"); return ValidNum(this);' value='<?php ; ?>' > ";
          elemento+=" <label for=''>M<sup>2</sup></label>";
          elemento+=" </div>";

          // /////////// datos Aprobacion_ /////////////
            elemento+=" <input class='cargoBasico1' name='Aprobacion_"+modalidad+"_0' type='hidden' id='Aprobacion_"+modalidad+"_0' value='0' >";
            elemento+=" <input class='modalidad' name='Aprobacion_"+modalidad+"_1' type='hidden' id='Aprobacion_"+modalidad+"_1' value='"+modalidad+"' >";
            elemento+=" <input class='variable' onchange'' name='Aprobacion_"+modalidad+"_2' type='hidden' id='Aprobacion_"+modalidad+"_2' value='0' >";
            elemento+=" <input class='licencia' name='Aprobacion_"+modalidad+"_3' type='hidden' id='Aprobacion_"+modalidad+"_3' value='"+licencia+"' >";
          // elemento+=" </div>";
          elemento+=" </div>";
       } else if (modalidad == 'Propiedad Horizontal') {
          // console.log(cantidadLicencias);
          bandera = false;
          console.log(bandera + ' aqui informacion de la bandera');
          modalidad = modalidad.split(' ');
          // alert(modalidad.length);
          modalidad = modalidad[0]+modalidad[1];
          // alert(modalidad);
           elemento+=" <div class='col-lg-12  input-group'>";
            elemento+=" <div class='col-lg-1  input-group'></div>";
            elemento+=" <div class='col-lg-2  input-group'>";
              elemento+=" <h6>Propiedad Horizontal</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='ph_"+modalidad+"' type='text' id='ph_"+modalidad+"' size='10' onkeyup='valor_ph(this,"+salarioMensual+"); return ValidNum(this);' value='<?php ; ?>' > ";
            elemento+=" <label for=''>M<sup>2</sup></label>";
            elemento+=" </div>";

            // /////////// datos ph_ /////////////
              elemento+=" <input class='cargoBasico1' name='ph_"+modalidad+"_0' type='hidden' id='ph_"+modalidad+"_0' value='0' >";
              elemento+=" <input class='modalidad' name='ph_"+modalidad+"_1' type='hidden' id='ph_"+modalidad+"_1' value='"+modalidad+"' >";
              elemento+=" <input class='variable' onchange'' name='ph_"+modalidad+"_2' type='hidden' id='ph_"+modalidad+"_2' value='0' >";
              elemento+=" <input class='licencia' name='ph_"+modalidad+"_3' type='hidden' id='ph_"+modalidad+"_3' value='"+licencia+"' >";
            // elemento+=" </div>";
          elemento+=" </div>";
          
       }else if (modalidad == 'Movimiento de Tierras') {
          // console.log(cantidadLicencias);
          modalidad = modalidad.split(' ');
          // alert(modalidad.length);
          modalidad = modalidad[0]+modalidad[1]+modalidad[2];
          // alert(modalidad);
           elemento+=" <div class='col-lg-12  input-group'>";
            elemento+=" <div class='col-lg-1  input-group'></div>";
            elemento+=" <div class='col-lg-2  input-group'>";
              elemento+=" <h6>Movimiento de Tierras</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='movimiento_Tierras_"+modalidad+"' type='text' id='movimiento_Tierras_"+modalidad+"' size='10' onkeyup='valor_tierras_piscinas(this,"+salarioMensual+"); return ValidNum(this);' value='<?php ; ?>' > ";
            elemento+=" <label for=''>M<sup>3</sup></label>";
            elemento+=" </div>";

            // /////////// datos movimiento_Tierras_ /////////////
              elemento+=" <input class='cargoBasico1' name='movimiento_Tierras_"+modalidad+"_0' type='hidden' id='movimiento_Tierras_"+modalidad+"_0' value='0' >";
              elemento+=" <input class='modalidad' name='movimiento_Tierras_"+modalidad+"_1' type='hidden' id='movimiento_Tierras_"+modalidad+"_1' value='"+modalidad+"' >";
              elemento+=" <input class='variable' onchange'' name='movimiento_Tierras_"+modalidad+"_2' type='hidden' id='movimiento_Tierras_"+modalidad+"_2' value='0' >";
              elemento+=" <input class='licencia' name='movimiento_Tierras_"+modalidad+"_3' type='hidden' id='movimiento_Tierras_"+modalidad+"_3' value='"+licencia+"' >";
            // elemento+=" </div>";
          elemento+=" </div>";
          
       }else if (modalidad == 'Aprobacion de Piscina') {
          // console.log(cantidadLicencias);
          modalidad = modalidad.split(' ');
          // alert(modalidad.length);
          modalidad = modalidad[0]+modalidad[1]+modalidad[2];
          // alert(modalidad);
           elemento+=" <div class='col-lg-12  input-group'>";
            elemento+=" <div class='col-lg-1  input-group'></div>";
            elemento+=" <div class='col-lg-2  input-group'>";
              elemento+=" <h6>Aprobacion de Piscina</h6>";
            elemento+=" </div>";
            elemento+=" <div class='col-lg-3 input-group'>";
              elemento+=" <input class='cargoBasico' name='aprovacion_piscinas_"+modalidad+"' type='text' id='aprovacion_piscinas_"+modalidad+"' size='10' onkeyup='valor_tierras_piscinas(this,"+salarioMensual+"); return ValidNum(this);' value='<?php ; ?>' > ";
            elemento+=" <label for=''>M<sup>3</sup></label>";
            elemento+=" </div>";

            // /////////// datos aprovacion_piscinas_ /////////////
              elemento+=" <input class='cargoBasico1' name='aprovacion_piscinas_"+modalidad+"_0' type='hidden' id='aprovacion_piscinas_"+modalidad+"_0' value='0' >";
              elemento+=" <input class='modalidad' name='aprovacion_piscinas_"+modalidad+"_1' type='hidden' id='aprovacion_piscinas_"+modalidad+"_1' value='"+modalidad+"' >";
              elemento+=" <input class='variable' onchange'' name='aprovacion_piscinas_"+modalidad+"_2' type='hidden' id='aprovacion_piscinas_"+modalidad+"_2' value='0' >";
              elemento+=" <input class='licencia' name='aprovacion_piscinas_"+modalidad+"_3' type='hidden' id='aprovacion_piscinas_"+modalidad+"_3' value='"+licencia+"' >";
            // elemento+=" </div>";
          elemento+=" </div>";
          
       }else{
        elemento+= getUsos(arrayUsos, modalidad, licencia);
       }
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

 <!--  </head>
  <body class="hold-transition sidebar-mini"> -->
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
                          <input class="form-control col-lg-9" type="date" name="fechaRad" id="fechaRad" readonly="" required title="Fecha del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="radicado" class="col-form-label col-lg-3">Radicado</label>
                          <input class="form-control col-lg-9" type="text" name="radicado" id="radicado" readonly="" required title="Numero del Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="arq" class="col-form-label col-lg-3">Arquitecto</label>
                          <input class="form-control col-lg-9" type="text" name="arq" id="arq" readonly="" required title="Ingeniero Responsable de la Obra">
                        </div>
                        <div class="col-lg-12">
                          <label for="propietario" class="col-form-label col-lg-3">Propietarios</label>
                          <input class="form-control col-lg-9" type="text" name="propietario" id="propietario" readonly="" required title="Uno o varios Propietarios">
                        </div>
                        <div class="col-lg-12">
                          <label for="direccion" class="col-form-label col-lg-3">Direccion</label>
                          <input class="form-control col-lg-9" type="text" name="direccion" id="direccion" readonly="" required title="Direcciones asociadas al Radicado">
                        </div>
                        <div class="col-lg-12">
                          <label for="nombreProyecto" class="col-form-label col-lg-6">Nombre Proyecto</label>
                          <input class="form-control col-lg-9" type="text" name="nombreProyecto" id="nombreProyecto" readonly="" required title="Nombre del Proyecto">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 ">
                    <div class="col-lg-12 form-group"></div>
                      <div class="col-lg-12 input-group">
                        <label for="buscaRadicado" class="col-form-label col-lg-3"><strong>Radicado</strong></label>
                        <input value="180011" autofocus="autofocus" type="text" name="buscaRadicado" id="buscaRadicado" required title="Minimo 5 Numeros" maxlength="6" class="form-control col-lg-5" placeholder="Digite el No.">
                        <button  type="button" name="burcar1" value="1" onclick="buscarRad(this)" class="btn btn-danger left col-lg-2">Buscar</button>
                        <!-- <input type="checkbox"> -->
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-12 form-group"></div>
                  <div class="col-lg-12 input-group" id="checks">
                    <div class="col-lg-2 input-group">
                      <h6 class="col-lg-4">Estrato</h6>
                      <label for="" id="estrato">---</label>
                    </div> 
                    <div class='col-lg-2 form-check' id="vis_0">
                      <input name='vivienda_vis' type='checkbox' id='vivienda_vis' value='1' onclick='subsidioVIS(this);'  > V.I.S
                    </div>
                    <div class='col-lg-2 form-check' id="dot_0">
                      <input name='institucional_dot' type='checkbox' id='institucional_dot' value='1' onclick='subsidioVIS(this);'  > DOT
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='prorroga' type='checkbox' id='prorroga' value='1' disabled="" onclick=';'> Prorroga
                      <input class='variable' onchange'' name='prorroga_2' type='hidden' id='prorroga_2' value='0' >
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='revalidacion' type='checkbox' id='revalidacion' value='1' disabled="" onclick=';'> Revalidacion
                      <input class='variable' onchange'' name='revalidacion_2' type='hidden' id='revalidacion_2' value='0' >
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='cotas' type='checkbox' id='cotas' value='1' disabled="" onclick=';'> Ajuste Cotas
                      <input class='variable' onchange'' name='cotas_2' type='hidden' id='cotas_2' value='0' >
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='Subdivision' type='checkbox' id='Subdivision' value='1' disabled="" onclick=''> Subdivision
                      <input class='variable' onchange'' name='Subdivision_2' type='hidden' id='Subdivision_2' value='0' >
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='concepto_norma' type='checkbox' id='concepto_norma' value='1' disabled="" onclick=''> Conceptos de Norma
                      <input class='variable' onchange'' name='concepto_norma_2' type='hidden' id='concepto_norma_2' value='0' >
                    </div>
                    <div class='col-lg-2 form-check'>
                      <input name='modificacion_planos' type='checkbox' id='modificacion_planos' value='1' disabled="" onclick=''> Modificacion de Planos
                      <input class='variable' onchange'' name='modificacion_planos_2' type='hidden' id='modificacion_planos_2' value='0' >
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
              <!-- <div class="col-lg-12  input-group">
                <div class="col-lg-6  input-group">
                  <label class="col-form-label col-lg-12 requerido">&nbsp;&nbsp;&nbsp;&nbsp;Los campos con (*) son obligatorios</label>
                </div>
              </div> -->
                  <!-- /.card-body -->
              <div class="card-footer input-group">
                <div class="form-group col-lg-12 "></div>
                <div class="col-lg-12  input-group">
                  <div class="col-lg-3"></div>  
                  <button class="btn btn-danger col-lg-2" type="button" name="submit" id="submit" >Generar</button>
                  <div class="col-lg-1"></div>              
                  <button class="btn btn-default col-lg-2" type="button" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">Cancelar</button>
                </div>
                <div class="form-group col-lg-12 "></div>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </section>
    </div>
<!--   </body>
</html> -->

 <!-- Este SCRIPT ejecuta todos los alerts -->
<link rel='stylesheet' href='../../cx/demo/demo.css'>
<link rel='stylesheet' type='text/css' href='../../cx/jquery-confirm.css'>
<script src='../../cx/demo/libs/bundled.js'></script>
<script src='../../cx/demo/demo.js'></script>
<script type='text/javascript' src='../../cx/jquery-confirm.js'></script>
