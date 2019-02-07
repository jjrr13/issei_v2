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
    }
  });
  return cargoB;
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

  return patron.test(tecla_final);
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

var nav4 = window.Event ? true : false;
function acceptNum(evt){
  // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
  var key = nav4 ? evt.which : evt.keyCode;
  return (key <= 13 || key <= 46 || (key >= 48 && key <= 57));
}