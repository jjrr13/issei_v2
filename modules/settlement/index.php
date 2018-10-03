<?php
  
include('../../include/validator/libs/xajax/xajax.inc.php');
include('../../include/validator/validator.common.php');
include('../menu.php');
ob_start();
error_reporting(0);
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// $_SESSION['radicado']= 1;

if (!$_SESSION['SALARIO_MIN']) {

    //Initialize a MySQL object
    $mysqli = mysqli_init();
    if (!$mysqli) {
      die('Falló mysqli_init');
    }

    //Process of connection to the database
    if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
      die('Error de conexión (' . mysqli_connect_errno() . ') '
          . mysqli_connect_error());
    }
    //consulta el salario minimo mensual vigente
    $query = "SELECT valor
          FROM configuracion
          WHERE estado = 1 AND
              descripcion = 'SALARIO_MIN_MENSUAL'
          ORDER BY fecha_registro DESC
          LIMIT 1";
    $temp =$mysqli->query($query);
    $result = mysqli_fetch_assoc($temp);
    
    $_SESSION['SALARIO_MIN']="";
    $_SESSION['CV']="";
    $_SESSION['CF']="";
    $_SESSION['SALARIO_MIN_DIA']="";
    
    $_SESSION['SALARIO_MIN'] = $result['valor'];
    $_SESSION['SALARIO_MIN_DIA'] = number_format(($_SESSION['SALARIO_MIN'] / 30), 2, '.', '');
    
    //consulta el porcentaje de CV
    $query = "SELECT valor
          FROM configuracion
          WHERE estado = 1 AND
              descripcion = 'PORCENTAJE_CV'
          ORDER BY fecha_registro DESC
          LIMIT 1";
    $temp =$mysqli->query($query);
    $result = mysqli_fetch_assoc($temp);
    
    $_SESSION['CV'] = number_format(($_SESSION['SALARIO_MIN'] * $result['valor']), 2, '.', '');
    
    //consulta el porcentaje de CF
    $query = "SELECT valor
          FROM configuracion
          WHERE estado = 1 AND
              descripcion = 'PORCENTAJE_CF'
          ORDER BY fecha_registro DESC
          LIMIT 1";
    $temp =$mysqli->query($query);
    $result = mysqli_fetch_assoc($temp);
    
    $_SESSION['CF'] = number_format(($_SESSION['SALARIO_MIN'] * $result['valor']), 2, '.', '');
    
    //consulta el cargo fijo de la ciudad (m)
    $query = "SELECT valor
          FROM configuracion
          WHERE estado = 1 AND
              descripcion = 'CARGO_FIJO_CIUDAD'
          ORDER BY fecha_registro DESC
          LIMIT 1";
    $temp =$mysqli->query($query);
    $result = mysqli_fetch_assoc($temp);
    
    $_SESSION['M'] = $result['valor'];
}


  /********************************************************************************/
  // Funcion que verifica que no existan dos cargos fijos en la generacion del oficio
  /********************************************************************************/
  function verificacion_cf($formulario){
    $objResponse = new xajaxResponse();
    
    $array_tipos = array('VIVIENDA', 'VIVIENDA_VIS', 'COMERCIO', 'INDUSTRIA', 'INSTITUCIONAL');
    
    for($cont_p = 1; $cont_p <= 10; $cont_p++){
      for($cont = 0; $cont < count($array_tipos); $cont++){
        $name_campo = strtolower($array_tipos[$cont])."_".$cont_p;
        if($formulario[$name_campo] != '' && $formulario[$name_campo] != '0,00' && $formulario[$name_campo] != strtolower($array_tipos[$cont])."_1"){
          $totalCf++;
        }
      }
    } 
    
    if($totalCf > 1){
      $objResponse->addAlert('No debe existir mas de un cargo fijo al tiempo'); 
    }else{
      $objResponse->addScript("document.form1.submit();");
    }
    return $objResponse;    
  }
  /***************************************************************************/
  // Funcion que recive le numero de vecinos que se van a digitar
  /****************************************************************************/
  function liquidacion($formulario){
    //Initialize a MySQL object
      $objResponse = new xajaxResponse();

      $mysqli = mysqli_init();
      if (!$mysqli) {
        die('Falló mysqli_init');
      }

      //Process of connection to the database
      if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
        die('Error de conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
      }
      
      $array_tipos = array('VIVIENDA', 'VIVIENDA_VIS', 'COMERCIO', 'INDUSTRIA', 'INSTITUCIONAL');
      
      for($cont_p = 1; $cont_p <= 11; $cont_p++){
        for($cont = 0; $cont < count($array_tipos); $cont++){
          
          $name_campo = strtolower($array_tipos[$cont])."_cant_".$cont_p; //vivienda_cant_1
          $name = strtolower($array_tipos[$cont])."_".$cont_p; //vivienda_1
          $metro = strtolower($array_tipos[$cont])."_metros_".$cont_p; //vivienda_metros_1
 
          if($cont_p == 10 || $cont_p == 5 || $cont_p == 7 || $cont_p == 8 || $cont_p == 9  || $cont_p == 11){
            $round = round($formulario[$name_campo]);
            $metros = $round * 0.3;
          }else{                  
            $metros = $formulario[$name_campo]; //vivienda_cant_1 el valor input
          }

          if($metros <= 0){
            $objResponse->addAssign($name, "value", "");
            $objResponse->addAssign($metro, "value", "");
            $objResponse->addAssign(strtolower($array_tipos[$cont])."_total_".$cont_p, "value", "");
            $objResponse->addAssign("d_".strtolower($array_tipos[$cont])."_total_".$cont_p, "innerHTML", ""); //d_vivienda_total_1 
            continue;
          }
          // echo "<script>
          //         alert('$cont_p');
          //       </script>";
          switch($array_tipos[$cont]){
            case 'VIVIENDA':
              $david =$formulario['estrato'];

              //consulta el factor i
              $query = sprintf("SELECT valor
                        FROM configuracion
                        WHERE estado = 1 AND
                          descripcion = 'I_VIVIENDA_%s'
                        ORDER BY fecha_registro DESC
                        LIMIT 1", $david);

              $temp = $mysqli->query($query);
              $result = mysqli_fetch_assoc($temp);  
            
              if($temp){
                $total = $_SESSION['CF'] * $result['valor'] *  $_SESSION['M'];
                $total2 = $_SESSION['CF'] * $result['valor'] *  $_SESSION['M'];
                  
              }else{
                $total = 0;
                $total2 = 0;
                
              }
              
              if($formulario['vivienda_VISD_'.$cont_p] == 1){
                $total2 = ((($_SESSION['CF'] * $result['valor']) *  $_SESSION['M'])/2);
                $descuento_b = 1;
              }
              
              //descuenta la VIS (si aplica)
              if($formulario['vivienda_VISD_'.$cont_p] == 1){
                $descuento = 1;
              }
              
              if($formulario['mitad_'.strtolower($array_tipos[$cont]).'_'.$cont_p] == 1){
                $total2 = ((($_SESSION['CF'] * $result['valor']) *  $_SESSION['M'])/2);
                $descuento = 1;
              }
              
              $total = number_format($total, 2, '.', '');
              $total2 = number_format($total2, 2, '.', '');
              
              $tipo_j = 'CONSTRUCCION';
              
              break;
            case 'VIVIENDA_VIS':

              $total = ((($_SESSION['SALARIO_MIN_DIA'] * 10) * 0.5) * $metros);
              $total2 = ((($_SESSION['SALARIO_MIN_DIA'] * 10) * 0.5) * $metros);
              $total = number_format($total, 2, '.', '');
              $total2 = number_format($total2, 2, '.', '');

              $tipo_j = 'CONSTRUCCION';
              break;                    
            case 'INSTITUCIONAL':
            case 'COMERCIO'   :
            case 'INDUSTRIA'  :
              //consulta el factor i
              $query = sprintf("SELECT valor
                        FROM configuracion
                        WHERE estado = 1 AND
                          descripcion = 'OTRO_USOS_%s' AND
                          rango1 <= %s AND
                          rango2 >= %s
                        ORDER BY fecha_registro DESC
                        LIMIT 1", $array_tipos[$cont], $metros, $metros);
              $temp =$mysqli->query($query);
              $result = mysqli_fetch_assoc($temp);     
              
              if($temp){
                $total = $_SESSION['CF'] * $result['valor'] *  $_SESSION['M'];
                $total2 = $_SESSION['CF'] * $result['valor'] *  $_SESSION['M'];
              }else{
                $total = 0;
                $total2 = 0;
              }
                
              if($array_tipos[$cont] == 'INSTITUCIONAL'){
              if($formulario['institucional_dot_'.$cont_p] == 1){
                $total2 = ((($_SESSION['CF'] * $result['valor']) *  $_SESSION['M'])/2);
                $descuento_b = 1;
              }
              //descuenta la DOT (si aplica)
              if($formulario['institucional_dot_'.$cont_p] == 1){
                $descuento = 1;}
              }
                
              if($formulario['mitad_'.strtolower($array_tipos[$cont]).'_'.$cont_p] == 1){
                  $total2 = ((($_SESSION['CF'] * $result['valor']) *  $_SESSION['M'])/2);
                  $descuento = 1;
              }
                
              $total = number_format($total, 2, '.', '');
              $total2 = number_format($total2, 2, '.', '');
              
              $tipo_j = 'CONSTRUCCION';
              
              break;
          }//fin del switch
          
          if($cont_p == 3 || $cont_p == 11){
            $tipo_j = 'URBANISMO_PARCELACION';
          }
          
          if($formulario[strtolower($array_tipos[$cont]).'_ref_est_1'] == 1){
            $descuento_ref = 1;
          }
          //verifica si el cargo fijo lo setearon en CERO
          if($formulario['cero_'.$name] == 1 ){
            $total = 0;
            $total2 = 0;
          }
          //asigna el cargo fijo
          for($cont_a = 0; $cont_a < 5; $cont_a++){
            if($name == strtolower($array_tipos[$cont])."_10" && !empty($formulario[strtolower($array_tipos[$cont_a]).'_cant_2'])){
              $total2 = 0;
              $total = 0;
            }else{
              $total2 = $total2;
              $total = $total;
            }
          }

          for($cont_b = 0; $cont_b < 5; $cont_b++){
            if($name == strtolower($array_tipos[$cont])."_5" && !empty($formulario[strtolower($array_tipos[$cont_b]).'_cant_2'])){
              $total2 = 0;
              $total = 0;
            }else{
              $total2 = $total2;
              $total = $total;
            }
          }

          for($cont_c = 0; $cont_c < 5; $cont_c++){
            if($name == strtolower($array_tipos[$cont])."_4" && !empty($formulario[strtolower($array_tipos[$cont_c]).'_cant_2'])){
              $total2 = 0;
              $total = 0;
            }else{
              $total2 = $total2;
              $total = $total;
            }
          }

          for($cont_d = 0; $cont_d < 5; $cont_d++){
            if($name == strtolower($array_tipos[$cont])."_6" && !empty($formulario[strtolower($array_tipos[$cont_d]).'_cant_2'])){
              $total2 = 0;
              $total = 0;
            }else{
              $total2 = $total2;
              $total = $total;
            }
          }

          for($cont_e = 0; $cont_e < 5; $cont_e++){
            if($name == strtolower($array_tipos[$cont])."_9" && !empty($formulario[strtolower($array_tipos[$cont_e]).'_cant_2'])){
              $total2 = 0;
              $total = 0;
            }else{
              $total2 = $total2;
              $total = $total;
            }
          }

          $objResponse->addAssign($metro, "value", $metros);
          $objResponse->addAssign($name, "value", number_format(floor($total2), 2, ',', '.'));
          $cargo_fijo = $total2;
          $cargo_fijo_total += $cargo_fijo;
          
          $I = $result['valor'];
          
          //consulta el factor J
          if($metros > 0){
            if($tipo_j == 'URBANISMO_PARCELACION'){
              $query = sprintf("SELECT *
                        FROM configuracion
                        WHERE estado = 1 AND
                          descripcion = 'J_%s' 
                        ORDER BY fecha_registro DESC
                        LIMIT 1", $tipo_j);
            }else{
              $query = sprintf("SELECT *
                      FROM configuracion
                      WHERE estado = 1 AND
                        descripcion = 'J_%s' AND
                        rango1 <= %s AND
                        rango2 > %s
                      ORDER BY fecha_registro DESC
                      LIMIT 1", $tipo_j, $metros, $metros);
              $result =$mysqli->query($query);
              $result = mysqli_fetch_assoc($result);   
            
              if(mysqli_num_rows($result) == 1){
                if($result['comentario'] == NULL || $result['comentario'] == 'NULL'){
                  $J = $result['valor'];
                }else{
                  $J = $result['valor'] / ($result['comentario'] + ($result['valor2'] / $metros));
                }
                
              }
            }
          }

          $cargo_variable = number_format(($_SESSION['CV'] * $I * $_SESSION['M'] * $J), 2, '.', '');

          if($cont_p == 10){
            for($cont_1 = 0; $cont_1 <= 5; $cont_1++){
              if(!empty($formulario[strtolower($array_tipos[$cont]).'_cant_10']) && !empty($formulario[strtolower($array_tipos[$cont_1]).'_cant_2'])){
              $cargo_variable = 0;
              }
            }
          }

          //PARA NO COBRAR REFORZAMIENTO ESTRUCTURAL CUANDO HAY RECONOCIMIENTO
          if($cont_p == 5){
            for($cont_2 = 0; $cont_2 <= 5; $cont_2++){
              if(!empty($formulario[strtolower($array_tipos[$cont]).'_cant_5']) && !empty($formulario[strtolower($array_tipos[$cont_2]).'_cant_2'])){
                $cargo_variable = 0;
              }
            }
          }

          //PARA NO COBRAR ADECUACION CUANDO HAY RECONOCIMIENTO
          if($cont_p == 4){
            for($cont_3 = 0; $cont_3 <= 5; $cont_3++){
              if(!empty($formulario[strtolower($array_tipos[$cont]).'_cant_4']) && !empty($formulario[strtolower($array_tipos[$cont_3]).'_cant_2'])){
                $cargo_variable = 0;
              }
            }
          }

          //PARA NO COBRAR DEMOLICION CUANDO HAY RECONOCIMIENTO
          if($cont_p == 6){
            for($cont_4 = 0; $cont_4 <= 5; $cont_4++){
              if(!empty($formulario[strtolower($array_tipos[$cont]).'_cant_6']) && !empty($formulario[strtolower($array_tipos[$cont_4]).'_cant_2'])){
                $cargo_variable = 0;
              }
            }
          }

          //PARA NO COBRAR RESTAURACION CUANDO HAY RECONOCIMIENTO
          if($cont_p == 9){
            for($cont_5 = 0; $cont_5 <= 5; $cont_5++){
              if(!empty($formulario[strtolower($array_tipos[$cont]).'_cant_9']) && !empty($formulario[strtolower($array_tipos[$cont_5]).'_cant_2'])){
                $cargo_variable = 0;
              }
            }
          }

          if(isset($formulario['mitad_'.strtolower($array_tipos[$cont]).'_'.$cont_p])){
            $cargo_variable = 0;
          }

          $cargo_variable_total += $cargo_variable;         
          //carga el total en el campo oculto
          $rvalor = $total + $cargo_variable;
          
          if(isset($descuento)){
            $rvalor = $rvalor / 2;
            unset($descuento);
          }
          
          if(isset($descuento_ref)){
            //$objResponse->addAlert($rvalor);
            $rvalor = ($rvalor * 0.3);
            //$objResponse->addAlert($rvalor ." - ". ($rvalor * 0.3));
            unset($descuento_ref);
          }
          
          $totales_ocultos += $rvalor;
          
          $objResponse->addAssign(strtolower($array_tipos[$cont])."_total_".$cont_p, "value", $rvalor);
          $objResponse->addAssign("d_".strtolower($array_tipos[$cont])."_total_".$cont_p, "innerHTML", $rvalor);
          
        }//fin del for de tipos 
      }//fin del for de cont_p
  
      $subtotal = $totales_ocultos;
      
      //aplica el valor del ajuste de cotas (si aplica)
      if($formulario['ajuste_cotas'] > 0){
          $query = sprintf("SELECT *
                  FROM configuracion
                  WHERE estado = 1 AND
                    descripcion = 'AJUSTE_COTAS' AND
                    valor = %d
                  ORDER BY fecha_registro DESC
                  LIMIT 1", $formulario['ajuste_cotas']);
          $result =$mysqli->query($query);
          $result = mysqli_fetch_assoc($result);
        
          $subtotal += number_format(($_SESSION['SALARIO_MIN_DIA'] * $result['valor2']), 2, '.', '');
          $objResponse->addAssign("ajuste_cotas_total", "value", $_SESSION['SALARIO_MIN_DIA'] * $result['valor2']);
      }
      
      //suma el valor por copia de planos
      $subtotal += number_format(($_SESSION['SALARIO_MIN_DIA'] * $formulario['copia_planos']), 2, '.', '');
      $objResponse->addAssign("copia_planos_total", "value", $_SESSION['SALARIO_MIN_DIA'] * $formulario['copia_planos']);
      
      //suma el valor de la propiedad horizontal
      if($formulario['propiedad_horizontal'] > 0){
        $query = sprintf("SELECT *
                  FROM configuracion
                  WHERE estado = 1 AND
                    descripcion = 'PROPIEDAD_HORIZONTAL' AND
                    rango1 <= %s AND
                    rango2 >= %s
                  ORDER BY fecha_registro DESC
                  LIMIT 1", round($formulario['propiedad_horizontal']), round($formulario['propiedad_horizontal']));
        $result =$mysqli->query($query);
        $result = mysqli_fetch_assoc($result);
        
        $subtotal += number_format(($_SESSION['SALARIO_MIN'] * $result['valor']), 2, '.', '');
        $objResponse->addAssign("propiedad_horizontal_total", "value", $_SESSION['SALARIO_MIN'] * $result['valor']);
      }     

      //suma el valor del movimiento de tierras
      if($formulario['movimiento_tierras'] > 0){
        $query = sprintf("SELECT *
                  FROM configuracion
                  WHERE estado = 1 AND
                    descripcion = 'MOVIMIENTO_TIERRAS' AND
                    rango1 <= %s AND
                    rango2 >= %s
                  ORDER BY fecha_registro DESC
                  LIMIT 1", $formulario['movimiento_tierras'], $formulario['movimiento_tierras']);
        $result =$mysqli->query($query);
        $result = mysqli_fetch_assoc($result);     
        
        if($result['valor2'] == 1){
          $base = $_SESSION['SALARIO_MIN'];
        }else{
          $base = $_SESSION['SALARIO_MIN_DIA'];
        }
        
        $subtotal += number_format(($base * $result['valor']), 2, '.', '');
        $objResponse->addAssign("movimiento_tierras_total", "value", $base * $result['valor']);
      } 
      
      
      //aprobacion
      if(!empty($formulario['apro'])){
        $a = 10;
        $b = 5001;

        if($formulario['apro'] <= 5000){
          $a=10;
        }elseif($formulario['apro'] > 75000){
          $a = 150;
        }else {

          while($formulario['apro'] >= $b){
          $a+=10;
          $b+=5000;
          }
        }

        $subtotal += number_format(($_SESSION['SALARIO_MIN_DIA'] * $a), 2, '.', '');
        $objResponse->addAssign("apro_total", "value", number_format(($_SESSION['SALARIO_MIN_DIA'] * $a), 2, '.', ''));
      }
            
      //suma el valor del reloteo
      if($formulario['reloteos'] > 0){
        $query = sprintf("SELECT *
                  FROM configuracion
                  WHERE estado = 1 AND
                    descripcion = 'RELOTEO' AND
                    rango1 <= %s AND
                    rango2 >= %s
                  ORDER BY fecha_registro DESC
                  LIMIT 1", $formulario['reloteos'], $formulario['reloteos']);
        $result =$mysqli->query($query);
        $result = mysqli_fetch_assoc($result);     
        
        if($result['valor2'] == 1){
          $base = $_SESSION['SALARIO_MIN'];
        }else{
          $base = $_SESSION['SALARIO_MIN_DIA'];
        }
        
        $subtotal += number_format(($base * $result['valor']), 2, '.', '');
        $objResponse->addAssign("reloteos_total", "value", $base * $result['valor']);
      }       
      
      //suma el valor de la subdivision (si aplica)
      if($formulario['subdivision'] == 1){
        $subtotal += $_SESSION['SALARIO_MIN'];
        $objResponse->addAssign("subdivision_total", "value", $_SESSION['SALARIO_MIN']);
      }
      //suma el valor de la prorroga (si aplica)
      if($formulario['prorroga'] == 1){
        $subtotal += $_SESSION['SALARIO_MIN'];
        $objResponse->addAssign("prorroga_total", "value", $_SESSION['SALARIO_MIN']);
      }
      //suma el valor de la prorroga vis (si aplica)
      if($formulario['prorroga_vis'] == 1){
        $prorroga_vis = $_SESSION['SALARIO_MIN_DIA'] * 2;
        $subtotal += $prorroga_vis;
        $objResponse->addAssign("prorroga_vis_total", "value", $prorroga_vis);
      }
      //suma el valor de la revalidacion (si aplica)
      if($formulario['revalidacion'] == 1){
        $subtotal += $_SESSION['SALARIO_MIN'];
        $objResponse->addAssign("revalidacion_total", "value", $_SESSION['SALARIO_MIN']);
      }
      //suma el valor de la revalidacion V.I.S (si aplica)
      if($formulario['revalidacion_vis'] == 1){
        $revalida_vis = $_SESSION['SALARIO_MIN_DIA'] * 2;
        $subtotal += $revalida_vis;
        $objResponse->addAssign("revalidacion_vis_total", "value", $revalida_vis);
      }
      //suma el valor de la modificacion de los planos urbanisticos
      if($formulario['mod'] == 1){
        $subtotal += $_SESSION['SALARIO_MIN'];
        $objResponse->addAssign("mod_total", "value", $_SESSION['SALARIO_MIN']);
      }
      
      //suma el valor de los conceptos (si aplica)
      if($formulario['concepto'] == 1){
        $subtotal += ($_SESSION['SALARIO_MIN_DIA'] * 10);
        $objResponse->addAssign("concepto_total", "value", $_SESSION['SALARIO_MIN_DIA'] * 10);
      }
      
      $objResponse->addAssign("subtotal","value", number_format(floor($subtotal), 2, ',', '.')); 
      $objResponse->addAssign("cargo_fijo_total","value", number_format(floor($cargo_fijo_total), 2, ',', '.')); 
      $objResponse->addAssign("cargo_varible_total","value", number_format(floor($cargo_variable_total), 2, ',', '.')); 
      
      $iva = floor($subtotal * 0.16);
      $objResponse->addAssign("iva","value", number_format($iva, 2, ',', '.')); 
      $objResponse->addAssign("total","value", number_format(floor($iva + $subtotal), 2, ',', '.')); 
      $objResponse->addAssign("expensas","value", number_format(floor($iva + $subtotal + $formulario['estampillas']), 2, ',', '.')); 
      
      return $objResponse;
  }
  

  //selecciona los requisitos 

  //Initialize a MySQL object
  $mysqli = mysqli_init();
  if (!$mysqli) {
    die('Falló mysqli_init');
  }

  //Process of connection to the database
  if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
    die('Error de conexión (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
  }

  $query_jg_requisitos = "SELECT * FROM configuracion WHERE descripcion = 'REQUISITO_EXPENSA' ORDER BY descripcion ASC";
  $jg_requisitos = $mysqli->query($query_jg_requisitos);
  $row_jg_requisitos = mysqli_fetch_assoc($jg_requisitos);
  $totalRows_jg_requisitos = mysqli_num_rows($jg_requisitos);


  /*********************************************************************************************
  * FUNCION XAJAX QUE CARGA UN RADICADO BUSCADO
  *********************************************************************************************/
  function buscarRadicado($radicado){

    global $database_cx, $cx;
    $objResponse = new xajaxResponse(); 
    
    //Initialize a MySQL object
    $mysqli = mysqli_init();
    if (!$mysqli) {
      die('Falló mysqli_init');
    }

    //Process of connection to the database
    if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
      die('Error de conexión (' . mysqli_connect_errno() . ') '
          . mysqli_connect_error());
    }

    $radicado_original = $radicado;   
    $radicado = $_SESSION['conse'].$radicado;
    
    $query_jg_info_radicado = sprintf("SELECT * 
                      FROM radicado 
                      WHERE nro_radicado = %s", $radicado);
    $jg_info_radicado = $mysqli->query($query_jg_info_radicado);
    
    //echo $query_jg_info_radicado;
    $row_jg_info_radicado = mysqli_fetch_assoc($jg_info_radicado);
    //$totalRows_jg_info_radicado = mysqli_num_rows($jg_info_radicado);
    $objResponse->addAssign("radicado","value", $row_jg_info_radicado['nro_radicado']);
    if(mysqli_num_rows($jg_info_radicado) > 0){
      $objResponse->addAssign("radicado","value", $row_jg_info_radicado['nro_radicado']);
      $objResponse->addAssign("arquitecto","value", $row_jg_info_radicado['profesional']);
      $objResponse->addAssign("propietario","value", $row_jg_info_radicado['propietario']);
      $objResponse->addAssign("proyecto","value", $row_jg_info_radicado['proyecto']);
      $objResponse->addAssign("direccion","value", limpiar_direccion($row_jg_info_radicado['direccion1']));
      $objResponse->addAssign("descripcion","value", $row_jg_info_radicado['observaciones']);
      
      $objResponse->addAssign("nombre_tramitador","value", $row_jg_info_radicado['nombre_tramitador']);
      $objResponse->addAssign("cc_tramitador","value", $row_jg_info_radicado['cc_tramitador']);
      $objResponse->addAssign("tel_tramitador","value", $row_jg_info_radicado['tel_tramitador']);
      $objResponse->addAssign("dir_tramitador","value", $row_jg_info_radicado['direccion_tramitador']);
      
      $_SESSION['radicado'] = "";
      $_SESSION['radicado'] = $row_jg_info_radicado['nro_radicado'];
      
      //carga el historial
      $query_jg_historia = sprintf("SELECT lg.*,
                         lg.fecha_registro as fecha_historia,
                         r.*, 
                         u.*
                      FROM liquidaciones_general lg,
                         radicado r,
                         usuario u
                      WHERE r.nro_radicado = '%s' AND

                        r.id_radicado = lg.id_radicado AND
                        u.id_usuario = lg.id_usuario 
                      ORDER BY lg.fecha_registro DESC LIMIT 5", $row_jg_info_radicado['nro_radicado']);
  
      $jg_historia = $mysqli->query($query_jg_historia);
      $row_jg_historia = mysqli_fetch_assoc($jg_historia);
      $totalRows_jg_historia = mysqli_num_rows($jg_historia);
  
  
      $tabla = '<table width="512" border="0" align="center">
          <tr bgcolor="#f1f1f1">
          <td width="212" class="texto_mitad_titleazul">Fecha registro </td>
          <td width="121" class="texto_mitad_titleazul">Archivo generado </td>
          <td width="165" class="texto_mitad_titleazul">Usuario</td>
          </tr>';
       do{ 
        $tabla .= '<tr>
          <td class="texto2"><a href="'.$_SERVER['PHP_SELF']."?idg=".$row_jg_historia['id_liquidacion_general'].'">'.$row_jg_historia['fecha_historia'].'</a></td>
          <td><a href="../registro/temp/'.$row_jg_historia['archivo_generado'].'">Ver</a></td>
          <td class="texto2">'.$row_jg_historia['nombres']." ".$row_jg_historia['apellidos'].'</td>
          </tr>';
       }while($row_jg_historia = mysqli_fetch_assoc($jg_historia)); 
       
       $tabla .= '</table>';
      
      
      $objResponse->addAssign("slickbox","innerHTML", $tabla);
      
    }else{
      $objResponse->addAlert("El radicado {$radicado} no existe!!");
    }
    
        
    return $objResponse;
  }
  
  /*********************************************************************************************
  * GENERACION DE DOCUMENTOS
  *********************************************************************************************/
  if(!empty($_POST['documento'])){
  
    $tipo = array('vivienda', 'vivienda_vis', 'comercio', 'industria', 'institucional'); 
    $categoria = array(1 => "UNO",
               2 => "REC",
               3 => "URBANISTICO",
               4 => "ADECUACION",
               5 => "REF._ESTRUCTURAL",
               6 => "DEMOLICION",
               7 => "RECONSTRUCCION",
               8 => "MODIFICACION DE LICENCIA VIGENTE LIC. CONSTRUCCION",
               9 => "RESTAURACIÓN",
               10 => "MODIFICACION",
               11 => "MODIFICACION DE LICENCIA VIGENTE URBANISMO / PARCELACION");       
    $categoria_nomb = array(1 => "",
                  2 => "Reconocimiento",
                  3 => "Urbanistico",
                4 => "Adecuacion",
                5 => "Ref._Estructural",
                6 => "Demolicion",
                7 => "Reconstruccion",
                8 => "Modificacion De Licencia Vigente Lic. Construccion",
                9 => "RESTAURACIÓN",
                10 => "Modificacion",
                11 => "Modificacion De Licencia Vigente Urbanismo / Parcelacion");
          
    if(!empty($_POST['radicado']) && $_POST['documento'] != 'expensas_preliminar'){
        //consulta el id del radicado
        $query_temp = sprintf("SELECT id_radicado 
                     FROM radicado  
                     WHERE nro_radicado = '%s'", $_POST['radicado']);
        $temp_result = $mysqli->query($query_temp);
        $result = mysqli_fetch_assoc($temp_result);
        
        $id_radicado = $result['id_radicado'];
        $id_usuario  = $_SESSION['usuario'][0]['id_usuario'];
    
        //inserta la liquidacion general
        $insert = sprintf("INSERT INTO liquidaciones_general (id_radicado,
                                    id_usuario,
                                    fecha_registro) VALUES
                                    (%d, %d, NOW())",
                                    $id_radicado,
                                    $id_usuario);
        $r = $mysqli->query($insert);    
        $id_liquidacion_general = mysqli_insert_id();

        //inserta la liquidacion - inicio
        for($cont = 1; $cont <= 11; $cont++){ 
          for($cont_tipo = 0; $cont_tipo < count($tipo); $cont_tipo++){
            if($_POST[$tipo[$cont_tipo].'_'.$cont] != ''){  

              $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                      id_radicado,
                                      id_usuario,
                                      categoria,
                                      uso,
                                      estrato,
                                      cantidad_m2,
                                      vis,
                                      ref_est,
                                      dot,
                                      total,
                                      subtotal,
                                      fecha_registro) VALUES
                                      (%s, %d, %d, '%s', '%s', %d, '%s', %d, %d, %d, '%s', '%s', NOW())",
                                      $id_liquidacion_general,
                                      $id_radicado,
                                      $id_usuario,
                                      $categoria[$cont],
                                      strtoupper($tipo[$cont_tipo]),
                                      (empty($_POST['estrato'])) ? 'NULL' : $_POST['estrato'],
                                      $_POST[$tipo[$cont_tipo].'_cant_'.$cont],
                                      (!isset($_POST[$tipo[$cont_tipo].'_VISD_'.$cont])) ? 'NULL' : $_POST[$tipo[$cont_tipo].'_VISD_'.$cont],
                                      (!isset($_POST[$tipo[$cont_tipo].'_ref_est_'.$cont])) ? 'NULL' : $_POST[$tipo[$cont_tipo].'_ref_est_'.$cont],
                                      (!isset($_POST[$tipo[$cont_tipo].'_dot_'.$cont])) ? 'NULL' : $_POST[$tipo[$cont_tipo].'_dot_'.$cont],
                                      (empty($_POST[$tipo[$cont_tipo].'_'.$cont])) ? 'NULL' : $_POST[$tipo[$cont_tipo].'_'.$cont],
                                      (empty($_POST[$tipo[$cont_tipo].'_total_'.$cont])) ? 'NULL' : $_POST[$tipo[$cont_tipo].'_'.$cont]
                                      );
              $r = $mysqli->query($insert); 
              
            }
          }
        }

        //cargo fijo total
        if(trim($_POST['cargo_fijo_total']) != '' && $_POST['documento'] != 'expensas_preliminar'){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('cargo_fijo_total'),
                                  $_POST['cargo_fijo_total']);
          $r = $mysqli->query($insert);     
        }
        //cargo variable total
        if(trim($_POST['cargo_variable_total']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('cargo_variable_total'),
                                  $_POST['cargo_variable_total']);
          $r = $mysqli->query($insert);  
        }               
        //propiedad horizontal
        if(trim($_POST['propiedad_horizontal']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('propiedad_horizontal'),
                                  $_POST['propiedad_horizontal'],
                                  $_POST['propiedad_horizontal_total']);
          $r = $mysqli->query($insert);   
        }
        
        //reloteos
        if(trim($_POST['reloteos']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('reloteos'),
                                  $_POST['reloteos'],
                                  $_POST['reloteos_total']);
          $r = $mysqli->query($insert);     
        }   
    
        //movimiento_tierras
        if(trim($_POST['movimiento_tierras']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado, 
                                  $id_usuario,
                                  strtoupper('movimiento_tierras'),
                                  $_POST['movimiento_tierras'],
                                  $_POST['movimiento_tierras_total']);
          $r = $mysqli->query($insert);     
        } 
        
        //aprobacion
        if(trim($_POST['apro']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado, 
                                  $id_usuario,
                                  strtoupper('aprobacion'),
                                  $_POST['apro'],
                                  $_POST['apro_total']);
          $r = $mysqli->query($insert);     
        } 
        
    
        //copia_planos
        if(trim($_POST['copia_planos']) != ''){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('copia_planos'),
                                  $_POST['copia_planos'],
                                  $_POST['copia_planos_total']);
          $r = $mysqli->query($insert);     
        }   
        
        //concepto
        if(isset($_POST['concepto'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('concepto'),
                                  $_POST['concepto'],
                                  $_POST['concepto_total']);
          $r = $mysqli->query($insert);     
        } 
        
        //subdivision
        if(isset($_POST['subdivision'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('subdivision'),
                                  $_POST['subdivision'],
                                  $_POST['subdivision_total']);
          $r = $mysqli->query($insert);     
        } 
        
          //prorroga
        if(isset($_POST['prorroga'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('prorroga'),
                                  $_POST['prorroga'],
                                  $_POST['prorroga_total']);
          $r = $mysqli->query($insert);     
        } 
        
          //prorroga vis
        if(isset($_POST['prorroga'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('PRORROGA_VIS'),
                                  $_POST['prorroga'],
                                  $_POST['prorroga_total']);
          $r = $mysqli->query($insert);     
        }
        
        //revalidacion
        if(isset($_POST['revalidacion'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('REVALIDACION'),
                                  $_POST['revalidacion'],
                                  $_POST['revalidacion_total']);
          $r = $mysqli->query($insert);     
        } 
        
        
        //revalidacion V.I.S
        if(isset($_POST['revalidacion_vis'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('REVALIDACION_VIS'),
                                  $_POST['revalidacion_vis'],
                                  $_POST['revalidacion_vis_total']);
          $r = $mysqli->query($insert);     
        } 
        
      
        //modificacion planos urbanisticos
        if(isset($_POST['mod'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro,
                                  subtotal) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW(), '%s')",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('planos_urb'),
                                  $_POST['mod'],
                                  $_POST['mod']);
          $r = $mysqli->query($insert);     
        } 
        
        //subtotal
        if(isset($_POST['subtotal'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('subtotal'),
                                  $_POST['subtotal']);
          $r = $mysqli->query($insert);     
        }         
        
        //iva
        if(isset($_POST['iva'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('iva'),
                                  $_POST['iva']);
          $r = $mysqli->query($insert);     
        }
        
        //total
        if(isset($_POST['total'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('total'),
                                  $_POST['total']);
          $r = $mysqli->query($insert);     
        }
        
        //estampillas
        if(isset($_POST['estampillas'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('estampillas'),
                                  $_POST['estampillas']);
          $r = $mysqli->query($insert);     
        }
        
        //expensas
        if(isset($_POST['expensas'])){
          $insert = sprintf("INSERT INTO liquidaciones (id_liquidacion_general,
                                  id_radicado,
                                  id_usuario,
                                  categoria,
                                  cantidad_m2,
                                  fecha_registro) VALUES
                                  (%d, %d, %d, '%s', '%s', NOW())",
                                  $id_liquidacion_general,
                                  $id_radicado,
                                  $id_usuario,
                                  strtoupper('expensas'),
                                  $_POST['expensas']);
          $r = $mysqli->query($insert);     
        }           
                            
        //inserta los requisitos
        for($cont = 0; $cont < count($_POST['requisito']); $cont++){
          $insert = sprintf("INSERT INTO liquidaciones_requisitos  (id_liquidacion_general,
                                        id_requisito) VALUES (%d, %d)",
                                  $id_liquidacion_general,
                                  $_POST['requisito'][$cont]);
          $r = $mysqli->query($insert);     
        }
    }//fin del if
    //                          
    //inserta la liquidacion - fin      
    //      
      
    $labels[0]['RADICADO']          = $_POST['radicado'];
    $labels[0]['FECHA']           = fechaLetras(date("d/m/Y"));
    $labels[0]['SOLICITANTE']     = strtoupper($_POST['propietario']);
    $labels[0]['ARQUITECTO']      = strtoupper($_POST['arquitecto']); 
    $labels[0]['DIRECCION'] = strtoupper(limpiar_direccion($_POST['direccion']));
    $labels[0]['PROYECTO']            = strtoupper($_POST['proyecto']); 
    $labels[0]['DESCRIPCION']         = strtoupper($_POST['descripcion']);
    
    
     
  //   $cont_c = 1;

    $tipob = array('vivienda', 'vivienda_vis', 'comercio', 'industria', 'institucional'); 
    //for($cont_tipob = 0; $cont_tipob < count($tipob); $cont_tipob++){   
    if(!empty($_POST["vivienda_1"]) && !empty($_POST["vivienda_10"])){
      $limit = 9;
    }elseif(!empty($_POST["comercio_1"]) && !empty($_POST["comercio_10"])){
      $limit = 9;
    }elseif(!empty($_POST["industria_1"]) && !empty($_POST["industria_10"])){
      $limit = 9;
    }elseif(!empty($_POST["institucional_1"]) && !empty($_POST["institucional_10"])){
      $limit = 9;
    }else{
      $limit = 10;
    }
//} 
    for($cont = 1; $cont <= 11; $cont++){ 
      for($cont_tipo = 0; $cont_tipo < count($tipo); $cont_tipo++){
        if($_POST[$tipo[$cont_tipo].'_'.$cont] != ''){

          $labels[0]['C'.$cont_c] = $categoria_nomb[$cont].' '.$tipo[$cont_tipo]." ";
          
          //concatena el estrato si es vivienda
          if($cont_tipo == 0){
            $labels[0]['C'.$cont_c] .= "Estrato ".$_POST['estrato_'.$cont];
          }
          //vivienda de interes social
          if(isset($_POST[$tipo[$cont_tipo].'_VISD_'.$cont])){
            $labels[0]['C'.$cont_c] .= " V.I.S";
          }
          
          //reforzamiento
          if(isset($_POST[$tipo[$cont_tipo].'_ref_est_'.$cont])){
            $labels[0]['C'.$cont_c] .= " Reforzamiento estructural";
          }
          
          //DOT
          if(isset($_POST[$tipo[$cont_tipo].'_dot_'.$cont])){
            $labels[0]['C'.$cont_c] .= " DOT";
          } 
          //cargo fijo
          
          //for($contb = 0; $contb <= 5; $contb++){ 

          $labels[0]['CF'.$cont_c] = "$ ".$_POST[$tipo[$cont_tipo]."_".$cont];
          
          //}
          
          //cantidad 
          if($cont == 5 && ($_POST['estrato_'.$cont] == 1 || $_POST['estrato_'.$cont] == 2 || $_POST['estrato_'.$cont] == 3)){

            $labels[0]['CANT'.$cont_c] =  round($_POST[$tipo[$cont_tipo]."_cant_".$cont] * 0.3);
            }else{
            $labels[0]['CANT'.$cont_c] = $_POST[$tipo[$cont_tipo]."_cant_".$cont];
          }

          $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST[$tipo[$cont_tipo]."_total_".$cont], 2, ',', '.');
          
          $expensas += $_POST[$tipo[$cont_tipo]."_total_".$cont] ;
          
          $cont_c++;
        }
      } 
    }
    
    //propiedad horizontal
    if(trim($_POST['propiedad_horizontal']) != ''){
      $labels[0]['C'.$cont_c] = "Propiedad Horizontal";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['propiedad_horizontal'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['propiedad_horizontal_total'], 2, ',', '.');
      $expensas += $_POST['propiedad_horizontal_total'];
      $cont_c++;
    }
    //reloteos
    if(trim($_POST['reloteos']) != ''){
      $labels[0]['C'.$cont_c] = "Proyecto de Reloteo";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['reloteos'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['reloteos_total'], 2, ',', '.');
      $expensas += $_POST['reloteos_total'];
      $cont_c++;
    }
    //movimiento de tierras
    if(trim($_POST['movimiento_tierras']) != ''){
      $labels[0]['C'.$cont_c] = "Movimiento de Tierras";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['movimiento_tierras'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['movimiento_tierras_total'], 2, ',', '.');
      $expenas += $_POST['movimiento_tierras_total'];
      $cont_c++;
    }
    
        //aprobacion
    if(trim($_POST['apro']) != ''){
      $labels[0]['C'.$cont_c] = "Aprobación Proyecto Urbanístico";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['apro'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['apro_total'], 2, ',', '.');
      $expensas += $_POST['apro_total'];
      $cont_c++;
    }
        
    //copia de planos
    if(trim($_POST['copia_planos']) != ''){
      $labels[0]['C'.$cont_c] = "Copia de Planos";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['copia_planos'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['copia_planos_total'], 2, ',', '.');
      $expensas += $_POST['copia_planos_total'];
      $cont_c++;
    }
    //concepto
    if(isset($_POST['concepto'])){
      $labels[0]['C'.$cont_c] = "Concepto Escrito";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['concepto'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['concepto_total'], 2, ',', '.');
      $expensas += $_POST['concepto_total'];
      $cont_c++;
    }

    //prorroga
    if(isset($_POST['prorroga'])){
      $labels[0]['C'.$cont_c] = "Prorroga";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['prorroga'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['prorroga_total'], 2, ',', '.');
      $expensas += $_POST['prorroga_total'];
      $cont_c++;
    }
    
    //prorroga VIS
    if(isset($_POST['prorroga_vis'])){
      $labels[0]['C'.$cont_c] = "Prorroga V.I.S.";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['prorroga_vis'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['prorroga_vis_total'], 2, ',', '.');
      $expensas += $_POST['prorroga_vis_total'];
      $cont_c++;
    } 
    
    //revalidacion
    if(isset($_POST['revalidacion'])){
      $labels[0]['C'.$cont_c] = "Revalidacion";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['revalidacion'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['revalidacion_total'], 2, ',', '.');
      $expensas += $_POST['revalidacion_total'];
      $cont_c++;
    } 
    
      //revalidacion V.I.S
    if(isset($_POST['revalidacion_vis'])){
      $labels[0]['C'.$cont_c] = "Revalidacion V.I.S.";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['revalidacion_vis'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['revalidacion_vis_total'], 2, ',', '.');
      $expensas += $_POST['revalidacion_vis_total'];
      $cont_c++;
    }
    
    //modificacion planos urbanisticos
    if(isset($_POST['mod'])){
      $labels[0]['C'.$cont_c] = "Modificación Planos Urbanisticos";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['mod'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['mod_total'], 2, ',', '.');
      $expensas += $_POST['mod_total'];
      $cont_c++;
    }   
    
    //subdivision
    if(isset($_POST['subdivision'])){
      $labels[0]['C'.$cont_c] = "Proyecto de Subdivisión";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['subdivision'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['subdivision_total'], 2, ',', '.');
      $expensas += $_POST['subdivision_total'];
      $cont_c++;
    } 
    //ajuste_cotas
    if($_POST['ajuste_cotas'] != '0'){
      $labels[0]['C'.$cont_c] = "Ajuste de Cotas";
      $labels[0]['CF'.$cont_c] = "$ 0";
      $labels[0]['CANT'.$cont_c] = $_POST['ajuste_cotas'];
      $labels[0]['VA'.$cont_c] = "$ ".number_format($_POST['ajuste_cotas_total'], 2, ',', '.');
      $expensas += $_POST['ajuste_cotas_total'];
      $cont_c++;
    } 
                    
    //$labels[0]['CANT1'] = '40';
    //limpia las etiquetas sobrantes
    for($inicio = $cont_c; $inicio <= 18; $inicio++){
      $labels[0]['C'.$inicio] = " ";
      $labels[0]['CF'.$inicio] = " ";
      $labels[0]['CANT'.$inicio] = " ";
      $labels[0]['VA'.$inicio] = " ";
    }
    
    $expensa_t = $expensas;
    $labels[0]['EXPENSA']     = "$ ".number_format($expensa_t, 2, ',', '.');
    $labels[0]['IVA']         = "$ ".number_format($expensa_t * 0.16, 2, ',', '.');
    $labels[0]['SUBTOTAL']    = "$ ".$_POST['total'];
    $labels[0]['ESTAMPILLAS'] = $_POST['estampillas'];
    $labels[0]['TOTAL']       = "$ ".$_POST['expensas'];
    $labels[0]['USUARIO']     = $_SESSION['usuario'][0]['nombre'];
    
    if($_SESSION['usuario'][0]['id_usuario'] == 2 || $_SESSION['usuario'][0]['id_usuario'] == 25){
      $labels[0]['CARG']     = 'Radicador';
    }else{
      $labels[0]['CARG']     = 'Arquitecto Revisor';
    }
    
    $labels[0]['TRAMITADOR']   = ($_POST['nombre_tramitador'] != '') ? $_POST['nombre_tramitador'] : '';
    $labels[0]['CEDTRAMIT']    = ($_POST['nombre_tramitador'] != '') ? $_POST['cc_tramitador'] : '';
    $labels[0]['TELTRAMIT']    = ($_POST['nombre_tramitador'] != '') ? $_POST['tel_tramitador'] : '';
    $labels[0]['DIRTRAMIT']    = ($_POST['nombre_tramitador'] != '') ? $_POST['dir_tramitador'] : '';
    
    
    //categorizaciones
    
      if(!empty($_POST['buscaradicado'])){
        $nro_radicado = $_SESSION['conse'].$_POST['buscaradicado'];
        $_SESSION['radicado'] = $nro_radicado;
      }elseif(isset($_SESSION['radicado'])){
        $nro_radicado = $_SESSION['radicado'];
      }
    
    if(!empty($nro_radicado)){
      $SelectRadicado = sprintf( "Select tipo_lic, categoria 
                                   From radicado 
                                   Where nro_radicado = %s", $nro_radicado); 
      $Result1Radicado = $mysqli->query($SelectRadicado); 
      $row_radicado = mysqli_fetch_assoc($Result1Radicado);
    }
    
    
    if($row_radicado['categoria'] == "categoria 1"){
    $labels[0]['CAT']   = strtoupper(", ".$row_radicado['categoria']);
    $labels[0]['ORACION']   = strtoupper("Categoria 1. Tiempo de tramite Veinte (20) días contados a partir de la fecha de radicación de la solicitud en legal y debida forma (decreto 1469 de 30 de abril de 2010 art. 35).");
    }elseif($row_radicado['categoria'] == "categoria 2"){
    $labels[0]['CAT']   = strtoupper(", ".$row_radicado['categoria']);
    $labels[0]['ORACION']   = strtoupper("Categoria 2. Tiempo de tramite Veinticinco (25) días contados a partir de la fecha de radicación de la solicitud en legal y debida forma (decreto 1469 de 30 de abril de 2010 art. 35).");
    }elseif($row_radicado['categoria'] == "categoria 3"){
    $labels[0]['CAT']   = strtoupper(", ".$row_radicado['categoria']);
    $labels[0]['ORACION']   = strtoupper("Categoria 3. Tiempo de tramite Treinta y cinco (35) días contados a partir de la fecha de radicación de la solicitud en legal y debida forma (decreto 1469 de 30 de abril de 2010 art. 35).");
    }elseif($row_radicado['categoria'] == "categoria 4"){
    $labels[0]['CAT']   = strtoupper(", ".$row_radicado['categoria']);
    $labels[0]['ORACION']   = strtoupper("Categoria 4. Tiempo de tramite Cuarenta y cinco (45) días contados a partir de la fecha de radicación de la solicitud en legal y debida forma (decreto 1469 de 30 de abril de 2010 art. 35).");
    }elseif($row_radicado['categoria'] == "ninguna"){
    $labels[0]['CAT']   = "";
    $labels[0]['ORACION']   = "";
    }
      
    
      //requisitos
      //Initialize a MySQL object
      $mysqli = mysqli_init();
      if (!$mysqli) {
        die('Falló mysqli_init');
      }

      //Process of connection to the database
      if (!$mysqli->real_connect("localhost", "issei", "DAGtgbnhy65", "issei")) {
        die('Error de conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
      }

      //se consulta los documentos faltantes de la tabla de documento_radicado
      $query_temp = sprintf("SELECT d.* 
                   FROM documento d,
                        radicado r,
                    documento_radicado dr  
                   WHERE d.id_documento = dr.id_documento AND
                       dr.id_radicado = r.id_radicado AND
                     dr.estado = 1 AND d.documentacion LIKE 'completar' and
                     r.nro_radicado = '%s'", $_SESSION['radicado']);
      $temp_result = $mysqli->query($query_temp);
      $num_result = mysqli_num_rows($temp_result);
      
      $query_liq = sprintf("SELECT d.* 
                   FROM documento d,
                        radicado r,
                    documento_radicado dr  
                   WHERE d.id_documento = dr.id_documento AND
                       dr.id_radicado = r.id_radicado AND
                     dr.estado = 1 AND d.documentacion LIKE 'completo' and
                     r.nro_radicado = '%s'", $_SESSION['radicado']);
      $temp_liq = $mysqli->query($query_liq);
      $num_liq = mysqli_num_rows($temp_liq);
      //echo $query_temp;
      
      
      while($result_requisitos = mysqli_fetch_assoc($temp_result)){
      $labels[0]['REQUISITOS'] .= $result_requisitos['nombre_documento'].", ";
      $labels[0]['ENTREGAR'] = '•  Documentación Faltante: ';
      }
       if(($num_result > 0) &&  (!empty($row_radicado['tipo_lic'])) && ($row_radicado['tipo_lic'] =! 'ph' || $row_radicado['tipo_lic'] =! 'otras actuaciones' || $row_radicado['tipo_lic'] =! 'prorroga de licencia' || $row_radicado['tipo_lic'] =! 'revalidacion')){
     $labels[0]['PLAZO']   =  '•  DEBE COMPLETAR LA DOCUMENTACIÓN REQUERIDA OBLIGATORIAMENTE EN UN PLAZO MÁXIMO DE 30 DÍAS HÁBILES (ART. 16 DECRETO NACIONAL 1469 DE 2010), PARA CONSIDERARSE EL PROYECTO EN LEGAL Y DEBIDA FORMA, SO PENA DE ENTENDERSE POR DESISTIDA LA SOLICITUD.'; 
       }else{
       $labels[0]['PLAZO']   =  ''; 
       
      // $labels[0]['PLAZO']   =  ''; 
       }
       
       if($num_result == 0){
       $labels[0]['ENTREGAR'] = '';
       }
       
       while($requisitos_liq = mysqli_fetch_assoc($temp_liq)){
       $labels[0]['REQUISITOS_L'] .=   $requisitos_liq['nombre_documento'].", ";
       }
       if($num_liq > 0){
       $labels[0]['PLAZO_L']   =  'Documentación a Entregar: '; 
       }else{
       $labels[0]['PLAZO_L']   =  ''; 
       }
       
      if(trim($labels[0]['REQUISITOS_L']) == '' || !isset($labels[0]['REQUISITOS_L'])){
      $labels[0]['REQUISITOS_L'] = '';
    } 
    
    if(trim($labels[0]['REQUISITOS']) == '' || !isset($labels[0]['REQUISITOS'])){
      $labels[0]['REQUISITOS'] = '';
    }
    
    if($_POST['documento'] == 'oficio'){
      $nombre_archivo = rtf($labels, "expensas_v3", $_POST['radicado']."_EXPENSAS_", $pathExpensas, $pathLiquidaciones);
      
      //registra el nombre del archivo generado
      if(!empty($_POST['radicado'])){
        $insert = sprintf("UPDATE liquidaciones_general SET archivo_generado = '%s'
                                WHERE id_liquidacion_general = %d",
                                    $nombre_archivo,
                                    $id_liquidacion_general);
        $r = $mysqli->query($insert);     
      }
    }elseif($_POST['documento'] == 'expensas_preliminar'){
      $nombre_archivo = rtf($labels, "expensas_preliminar", $_POST['radicado']."_EXPENSAS_PRELIMINAR_", $pathTemp);
    }
  
  } 
  
//si existe un radicado en session pero es un liquidacion preliminar lo elimina

// if(!empty($_SESSION['radicado'])){
//   $query_jg_historia = sprintf("SELECT lg.*,
//                      lg.fecha_registro as fecha_historia,
//                      r.*, 
//                      u.*
//                   FROM liquidaciones_general lg,
//                      radicado r,
//                      usuario u
//                   WHERE r.nro_radicado = '%s' AND
//                     r.id_radicado = lg.id_radicado AND
//                     u.id_usuario = lg.id_usuario
//                   ORDER BY lg.fecha_registro DESC limit 5", $_SESSION['radicado']);
// }
// else{
//   $j = (isset($_GET['idg'])) ? $_GET['idg'] : 0;
//   $query_jg_historia = sprintf("SELECT id_radicado
//                   FROM liquidaciones_general lg
//                   WHERE lg.id_liquidacion_general = %d", $j );
//   $jg_historia = $mysqli->query($query_jg_historia);
//   $row_jg_historia = mysqli_fetch_assoc($jg_historia); 
            
//   $query_jg_historia = sprintf("SELECT lg.*,
//                      lg.fecha_registro as fecha_historia,
//                      r.*, 
//                      u.*
//                   FROM liquidaciones_general lg,
//                      radicado r,
//                      usuario u
//                   WHERE lg.id_radicado = %d AND
//                     r.id_radicado = lg.id_radicado AND
//                     u.id_usuario = lg.id_usuario
//                   ORDER BY lg.fecha_registro DESC", $row_jg_historia['id_radicado']);
// }

// if (!empty($query_jg_historia)) {
//   $jg_historia = $mysqli->query($query_jg_historia);
//   $row_jg_historia = mysqli_fetch_assoc($jg_historia);
// $totalRows_jg_historia = mysqli_num_rows($jg_historia);
// }

//selecciona los requisitos
// $query_r = sprintf("SELECT id_requisito
//           FROM liquidaciones_requisitos
//           WHERE id_liquidacion_general = %d", $_GET['idg']);

// $temp = $mysqli->query($query_r);
// $result_r = mysqli_fetch_assoc($temp);

//selecciona la informacion general del radicado

// if(!empty($_GET['idg'])){
//   $query_rad = sprintf("  SELECT r.*
//               FROM radicado r,
//                  liquidaciones_general lg
//               WHERE lg.id_liquidacion_general = %d AND
//                   r.id_radicado = lg.id_radicado", $_GET['idg']);
//   $temp_rad = $mysqli->query($query_rad);
//   $result_rad = mysqli_fetch_assoc($temp_rad);
// }elseif(!isset($_POST['cargo_fijo_total']) && !empty($_SESSION['radicado'])){
//   $query_rad = sprintf("  SELECT r.*
//               FROM radicado r
//               WHERE r.nro_radicado = '%s'", $_SESSION['radicado']);
//   $temp_rad = $mysqli->query($query_rad);
//   $result_rad = mysqli_fetch_assoc($temp_rad);             
// }

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
    <title>Liquidaciones</title>
    <?php 
       $objAjax->printJavascript('../../include/validator/libs/xajax'); 
       include('../../include/validator/js.inc.php');
    ?>

    <!-- <link href="../plugins/jquery/jquery.min.js" rel="stylesheet" type="text/javascript" /> -->
    <!-- 
    <link href="../css/arquitectonico.css" rel="stylesheet" type="text/css" /> -->
    <style type="text/css">
    
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

    <!-- <script src="<?php $httpInclude ?>/jtip/js/jtip.js" type="text/javascript"></script>  -->

    <script type="text/javascript">
    <!--
    <!--
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

    //-->

    function validate(campo){
        var result="";
        var str = campo.value.split('');
        for(i=0; i<=str.length-1; i++) {
            str[i] = str[i].toUpperCase();
            result+=str[i];
        }
      campo.value = result;
        //return result; //return(result);
    }//-->
    </script>

    <script language="JavaScript">
      <!--
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
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-1 input-group"></div>
                    <div class="col-lg-6 input-group">
                      <h5 class="col-lg-2">Estrato</h5>
                      <select name="estrato" onchange="xajax_liquidacion(xajax.getFormValues('form1'))">
                        <option value="0" <?php if($_POST['estrato'] == 0) echo "selected"; ?> >Vivienda</option>
                        <option value="1" <?php if($_POST['estrato'] == 1) echo "selected"; ?> >Estrato 1</option>
                        <option value="2" <?php if($_POST['estrato'] == 2) echo "selected"; ?> >Estrato 2</option>
                        <option value="3" <?php if($_POST['estrato'] == 3) echo "selected"; ?> >Estrato 3</option>
                        <option value="4" <?php if($_POST['estrato'] == 4) echo "selected"; ?> >Estrato 4</option>
                        <option value="5" <?php if($_POST['estrato'] == 5) echo "selected"; ?> >Estrato 5</option>
                        <option value="6" <?php if($_POST['estrato'] == 6) echo "selected"; ?> >Estrato 6</option>
                      </select>                    
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Adecuación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 form-check">
                        <h5>
                          <strong>Solo Adecuación</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_4" type="text" id="vivienda_cant_4" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_4']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="mitad_vivienda_4" type="checkbox" id="mitad_vivienda_4" value="1"  onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_4" type="text" id="vivienda_4" value="<?php $_POST['vivienda_4']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_4';" readonly  >
                        <input name="cero_vivienda_4" type="checkbox" id="cero_vivienda_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_4" type="hidden" id="vivienda_total_4" value="<?php $_POST['vivienda_total_4']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_4" type="text" id="comercio_cant_4" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_4'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="mitad_comercio_4" type="checkbox" id="mitad_comercio_4" value="1"  onclick="xajax_liquidacion(xajax.getFormValues('form1'))">
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_4" type="text" id="comercio_4" value="<?php $_POST['comercio_4']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_4';" readonly >
                        <input name="cero_comercio_4" type="checkbox" id="cero_comercio_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_4" type="hidden" id="comercio_total_4" value="<?php $_POST['comercio_total_4']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_4" type="text" id="industria_cant_4" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_4'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="mitad_industria_4" type="checkbox" id="mitad_industria_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_4" type="text" id="industria_4" value="<?php $_POST['industria_4']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_4';" readonly >
                        <input name="cero_industria_4" type="checkbox" id="cero_industria_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_4" type="hidden" id="industria_total_4" value="<?php $_POST['industria_total_4']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_4" type="text" id="institucional_cant_4" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_4']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="mitad_institucional_4" type="checkbox" id="mitad_institucional_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))">
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_4" type="text" id="institucional_4" value="<?php $_POST['institucional_4']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_4';" readonly >
                        <input name="cero_institucional_4" type="checkbox" id="cero_institucional_4" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_4" type="hidden" id="institucional_total_4" value="<?php $_POST['institucional_total_4']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Construcción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_1" type="text" id="vivienda_cant_1" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_1']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="vivienda_VISD_1" type="checkbox" id="vivienda_VISD_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_1']) echo "checked"; ?> > V.I.S
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_1" type="text" id="vivienda_1" value="<?php $_POST['vivienda_1']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_1';" readonly="readonly"  >
                        <input name="cero_vivienda_1" type="checkbox" id="cero_vivienda_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_1" type="hidden" id="vivienda_total_1" value="<?php $_POST['vivienda_total_1']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_vis_cant_1" type="text" id="vivienda_vis_cant_1" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_vis_cant_1']; ?>" size="15" >
                        <label>U/d</label>                      
                      </div>
                      <div class="col-lg-2  input-group"></div>
                      <div class="col-lg-2 form-check">
                        <input name="vivienda_vis_1" type="text" id="vivienda_vis_1" value="<?php $_POST['vivienda_vis_1']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_vis_2';" readonly="readonly" >
                        <input name="cero_vivienda_vis_1" type="checkbox" id="cero_vivienda_vis_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_vis_total_1" type="hidden" id="vivienda_vis_total_1" value="<?php $_POST['vivienda_vis_total_1']; ?>" >                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_1" type="text" id="comercio_cant_1" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_1'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2  input-group"></div>
                      <div class="col-lg-2 form-check">
                        <input name="comercio_1" type="text" id="comercio_1" value="<?php $_POST['comercio_1']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_1';" readonly >
                        <input name="cero_comercio_1" type="checkbox" id="cero_comercio_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_1" type="hidden" id="comercio_total_1" value="<?php $_POST['comercio_total_1']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_1" type="text" id="industria_cant_1" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_1'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 input-group"></div>
                      <div class="col-lg-2 form-check">
                        <input name="industria_1" type="text" id="industria_1" value="<?php $_POST['industria_1']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_1';" readonly >
                        <input name="cero_industria_1" type="checkbox" id="cero_industria_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_1" type="hidden" id="industria_total_1" value="<?php $_POST['industria_total_1']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_1" type="text" id="institucional_cant_1" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_1']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="institucional_dot_1" type="checkbox" id="institucional_dot_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_1']) echo "checked"; ?> >DOT                
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_1" type="text" id="institucional_1" value="<?php $_POST['institucional_1']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_1';" readonly >
                        <input name="cero_institucional_1" type="checkbox" id="cero_institucional_1" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_1" type="hidden" id="institucional_total_1" value="<?php $_POST['institucional_total_1']; ?>" >                   
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Demolición</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_6" type="text" id="vivienda_cant_6" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_6']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="vivienda_6" type="text" id="vivienda_6" value="<?php $_POST['vivienda_6']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_6';" readonly  >
                        <input name="cero_vivienda_6" type="checkbox" id="cero_vivienda_6" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_6" type="hidden" id="vivienda_total_6" value="<?php $_POST['vivienda_total_6']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_6" type="text" id="comercio_cant_6" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_6'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="comercio_6" type="text" id="comercio_6" value="<?php $_POST['comercio_6']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_6';" readonly >
                        <input name="cero_comercio_6" type="checkbox" id="cero_comercio_6" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_6" type="hidden" id="comercio_total_6" value="<?php $_POST['comercio_total_6']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_6" type="text" id="industria_cant_6" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_6'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="industria_6" type="text" id="industria_6" value="<?php $_POST['industria_6']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_6';" readonly >
                        <input name="cero_industria_6" type="checkbox" id="cero_industria_6" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_6" type="hidden" id="industria_total_6" value="<?php $_POST['industria_total_6']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_6" type="text" id="institucional_cant_6" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_6']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="institucional_dot_6" type="checkbox" id="institucional_dot_6" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_6']) echo "checked"; ?> >DOT                
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_6" type="text" id="institucional_6" value="<?php $_POST['institucional_6']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_6';" readonly >
                        <input name="cero_institucional_6" type="checkbox" id="cero_institucional_6" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_6" type="hidden" id="institucional_total_6" value="<?php $_POST['institucional_total_6']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Reconocimiento</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_2" type="text" id="vivienda_cant_2" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_2']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="vivienda_VISD_2" type="checkbox" id="vivienda_VISD_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_2']) echo "checked"; ?> > V.I.S
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_2" type="text" id="vivienda_2" value="<?php $_POST['vivienda_2']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_2';" readonly  >
                        <input name="cero_vivienda_2" type="checkbox" id="cero_vivienda_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_2" type="hidden" id="vivienda_total_2" value="<?php $_POST['vivienda_total_2']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_vis_cant_2" type="text" id="vivienda_vis_cant_2" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_vis_cant_2']; ?>" size="15" >
                        <label>U/d</label>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="vivienda_vis_2" type="text" id="vivienda_vis_2" value="<?php $_POST['vivienda_vis_2']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_vis_2';" readonly="readonly" >
                        <input name="cero_vivienda_vis_2" type="checkbox" id="cero_vivienda_vis_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_vis_total_2" type="hidden" id="vivienda_vis_total_2" value="<?php $_POST['vivienda_vis_total_2']; ?>" >                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_2" type="text" id="comercio_cant_2" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_2'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="comercio_2" type="text" id="comercio_2" value="<?php $_POST['comercio_2']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_2';" readonly >
                        <input name="cero_comercio_2" type="checkbox" id="cero_comercio_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_2" type="hidden" id="comercio_total_2" value="<?php $_POST['comercio_total_2']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_2" type="text" id="industria_cant_2" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_2'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="industria_2" type="text" id="industria_2" value="<?php $_POST['industria_2']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_2';" readonly >
                        <input name="cero_industria_2" type="checkbox" id="cero_industria_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_2" type="hidden" id="industria_total_2" value="<?php $_POST['industria_total_2']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_2" type="text" id="institucional_cant_2" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_2']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="institucional_dot_2" type="checkbox" id="institucional_dot_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_2']) echo "checked"; ?> >DOT                
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_2" type="text" id="institucional_2" value="<?php $_POST['institucional_2']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_2';" readonly >
                        <input name="cero_institucional_2" type="checkbox" id="cero_institucional_2" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_2" type="hidden" id="institucional_total_2" value="<?php $_POST['institucional_total_2']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Urbanistico</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_3" type="text" id="vivienda_cant_3" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_3']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="vivienda_VISD_3" type="checkbox" id="vivienda_VISD_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_3']) echo "checked"; ?> > V.I.S
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_3" type="text" id="vivienda_3" value="<?php $_POST['vivienda_3']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_3';" readonly  >
                        <input name="cero_vivienda_3" type="checkbox" id="cero_vivienda_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_3" type="hidden" id="vivienda_total_3" value="<?php $_POST['vivienda_total_3']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda VIS</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_vis_cant_3" type="text" id="vivienda_vis_cant_3" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_vis_cant_3']; ?>" size="15" >
                        <label>U/d</label>                      
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="vivienda_vis_3" type="text" id="vivienda_vis_3" value="<?php $_POST['vivienda_vis_3']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_vis_3';" readonly="readonly" >
                        <input name="cero_vivienda_vis_3" type="checkbox" id="cero_vivienda_vis_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_vis_total_3" type="hidden" id="vivienda_vis_total_3" value="<?php $_POST['vivienda_vis_total_3']; ?>" >                  
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_3" type="text" id="comercio_cant_3" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_3'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="comercio_3" type="text" id="comercio_3" value="<?php $_POST['comercio_3']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_3';" readonly >
                        <input name="cero_comercio_3" type="checkbox" id="cero_comercio_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_3" type="hidden" id="comercio_total_3" value="<?php $_POST['comercio_total_3']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_3" type="text" id="industria_cant_3" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_3'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 form-check"></div>
                      <div class="col-lg-2">
                        <input name="industria_3" type="text" id="industria_3" value="<?php $_POST['industria_3']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_3';" readonly >
                        <input name="cero_industria_3" type="checkbox" id="cero_industria_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_3" type="hidden" id="industria_total_3" value="<?php $_POST['industria_total_3']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_3" type="text" id="institucional_cant_3" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_3']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 form-check">
                        <input name="institucional_dot_3" type="checkbox" id="institucional_dot_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_3']) echo "checked"; ?> >DOT                
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_3" type="text" id="institucional_3" value="<?php $_POST['institucional_3']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_3';" readonly >
                        <input name="cero_institucional_3" type="checkbox" id="cero_institucional_3" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_3" type="hidden" id="institucional_total_3" value="<?php $_POST['institucional_total_3']; ?>" >                   
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Modificación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>
                      </div>
                      <div class="col-lg-1 form-check"></div>
                      <div class="col-lg-2 ">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="vivienda_cant_10" type="text" id="vivienda_cant_10" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_10']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="vivienda_metros_10" type="text" id="vivienda_metros_10" value="<?= $_POST['vivienda_metros_10']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-1 form-check">
                        <input name="vivienda_VISD_10" type="checkbox" id="vivienda_VISD_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['vivienda_VISD_10']) echo "checked"; ?> > V.I.S
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_10" type="text" id="vivienda_10" value="<?php $_POST['vivienda_10']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_10';" readonly  >
                        <input name="cero_vivienda_10" type="checkbox" id="cero_vivienda_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_10" type="hidden" id="vivienda_total_10" value="<?php $_POST['vivienda_total_10']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="comercio_cant_10" type="text" id="comercio_cant_10" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_10'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2  input-group">
                        <input name="comercio_metros_10" type="text" id="comercio_metros_10" value="<?= $_POST['comercio_metros_10']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>         
                      </div>
                      <div class="col-lg-1 form-check"></div>
                      <div class="col-lg-2">
                        <input name="comercio_10" type="text" id="comercio_10" value="<?php $_POST['comercio_10']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_10';" readonly >
                        <input name="cero_comercio_10" type="checkbox" id="cero_comercio_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_10" type="hidden" id="comercio_total_10" value="<?php $_POST['comercio_total_10']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="industria_cant_10" type="text" id="industria_cant_10" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_10'];?>" size="15">    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="industria_metros_10" type="text" id="industria_metros_10" value="<?= $_POST['industria_metros_10']; ?>" size="13"  readonly>
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-1 form-check"></div>
                      <div class="col-lg-2">
                        <input name="industria_10" type="text" id="industria_10" value="<?php $_POST['industria_10']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_10';" readonly >
                        <input name="cero_industria_10" type="checkbox" id="cero_industria_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_10" type="hidden" id="industria_total_10" value="<?php $_POST['industria_total_10']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="institucional_cant_10" type="text" id="institucional_cant_10" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_10']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="institucional_metros_10" type="text" id="institucional_metros_10" value="<?= $_POST['institucional_metros_10']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-1 form-check">
                        <input name="institucional_dot_10" type="checkbox" id="institucional_dot_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['institucional_dot_10']) echo "checked"; ?> >DOT                
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_10" type="text" id="institucional_10" value="<?php $_POST['institucional_10']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_10';" readonly >
                        <input name="cero_institucional_10" type="checkbox" id="cero_institucional_10" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_10" type="hidden" id="institucional_total_10" value="<?php $_POST['institucional_total_10']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Reconstrucción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_7" type="text" id="vivienda_cant_7" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_7']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_metros_7" type="text" id="vivienda_metros_7" value="<?= $_POST['vivienda_metros_7']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_7" type="text" id="vivienda_7" value="<?php $_POST['vivienda_7']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_7';" readonly  >
                        <input name="cero_vivienda_7" type="checkbox" id="cero_vivienda_7" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_7" type="hidden" id="vivienda_total_7" value="<?php $_POST['vivienda_total_7']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_7" type="text" id="comercio_cant_7" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_7'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_metros_7" type="text" id="comercio_metros_7" value="<?= $_POST['comercio_metros_7']; ?>" size="13" readonly />
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_7" type="text" id="comercio_7" value="<?php $_POST['comercio_7']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_7';" readonly >
                        <input name="cero_comercio_7" type="checkbox" id="cero_comercio_7" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_7" type="hidden" id="comercio_total_7" value="<?php $_POST['comercio_total_7']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_7" type="text" id="industria_cant_7" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_7'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_metros_7" type="text" id="industria_metros_7" value="<?= $_POST['industria_metros_7']; ?>" size="13" readonly />
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_7" type="text" id="industria_7" value="<?php $_POST['industria_7']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_7';" readonly >
                        <input name="cero_industria_7" type="checkbox" id="cero_industria_7" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_7" type="hidden" id="industria_total_7" value="<?php $_POST['industria_total_7']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_7" type="text" id="institucional_cant_7" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_7']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_metros_7" type="text" id="institucional_metros_7" value="<?= $_POST['institucional_metros_7']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_7" type="text" id="institucional_7" value="<?php $_POST['institucional_7']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_7';" readonly >
                        <input name="cero_institucional_7" type="checkbox" id="cero_institucional_7" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_7" type="hidden" id="institucional_total_7" value="<?php $_POST['institucional_total_7']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-6 input-group">
                        <h4><strong>Reforzamiento Estructural</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_5" type="text" id="vivienda_cant_5" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_5']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_metros_5" type="text" id="vivienda_metros_5" value="<?= $_POST['vivienda_metros_5']; ?>" size="13" readonly>
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_5" type="text" id="vivienda_5" value="<?php $_POST['vivienda_5']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_5';" readonly  >
                        <input name="cero_vivienda_5" type="checkbox" id="cero_vivienda_5" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_5" type="hidden" id="vivienda_total_5" value="<?php $_POST['vivienda_total_5']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_5" type="text" id="comercio_cant_5" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_5'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_metros_5" type="text" id="comercio_metros_5" value="<?= $_POST['comercio_metros_5']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_5" type="text" id="comercio_5" value="<?php $_POST['comercio_5']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_5';" readonly >
                        <input name="cero_comercio_5" type="checkbox" id="cero_comercio_5" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_5" type="hidden" id="comercio_total_5" value="<?php $_POST['comercio_total_5']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_5" type="text" id="industria_cant_5" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_5'];?>" size="15">    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_metros_5" type="text" id="industria_metros_5" value="<?= $_POST['industria_metros_5']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_5" type="text" id="industria_5" value="<?php $_POST['industria_5']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_5';" readonly >
                        <input name="cero_industria_5" type="checkbox" id="cero_industria_5" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_5" type="hidden" id="industria_total_5" value="<?php $_POST['industria_total_5']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_5" type="text" id="institucional_cant_5" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_5']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_metros_5" type="text" id="institucional_metros_5" value="<?= $_POST['institucional_metros_5']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_5" type="text" id="institucional_5" value="<?php $_POST['institucional_5']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_5';" readonly >
                        <input name="cero_institucional_5" type="checkbox" id="cero_institucional_5" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_5" type="hidden" id="institucional_total_5" value="<?php $_POST['institucional_total_5']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Restauración</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_9" type="text" id="vivienda_cant_9" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_9']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_metros_9" type="text" id="vivienda_metros_9" value="<?= $_POST['vivienda_metros_9']; ?>" size="13" readonly>
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_9" type="text" id="vivienda_9" value="<?php $_POST['vivienda_9']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_9';" readonly  >
                        <input name="cero_vivienda_9" type="checkbox" id="cero_vivienda_9" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_9" type="hidden" id="vivienda_total_9" value="<?php $_POST['vivienda_total_9']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_9" type="text" id="comercio_cant_9" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_9'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_metros_9" type="text" id="comercio_metros_9" value="<?= $_POST['comercio_metros_9']; ?>" size="13" readonly />
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_9" type="text" id="comercio_9" value="<?php $_POST['comercio_9']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_9';" readonly >
                        <input name="cero_comercio_9" type="checkbox" id="cero_comercio_9" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_9" type="hidden" id="comercio_total_9" value="<?php $_POST['comercio_total_9']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_9" type="text" id="industria_cant_9" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_9'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_metros_9" type="text" id="industria_metros_9" value="<?= $_POST['industria_metros_9']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_9" type="text" id="industria_9" value="<?php $_POST['industria_9']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_9';" readonly >
                        <input name="cero_industria_9" type="checkbox" id="cero_industria_9" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_9" type="hidden" id="industria_total_9" value="<?php $_POST['industria_total_9']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_9" type="text" id="institucional_cant_9" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_9']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_metros_9" type="text" id="institucional_metros_9" value="<?= $_POST['institucional_metros_9']; ?>" size="13" readonly>          
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_9" type="text" id="institucional_9" value="<?php $_POST['institucional_9']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_9';" readonly >
                        <input name="cero_institucional_9" type="checkbox" id="cero_institucional_9" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_9" type="hidden" id="institucional_total_9" value="<?php $_POST['institucional_total_9']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-4 input-group"></div>
                    <div class="col-lg-6 input-group">
                      <h4><strong>Modificación de Licencia Vigente</strong></h4>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-2 input-group">
                        <h4><strong>Construcción</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2 input-group">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_8" type="text" id="vivienda_cant_8" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_8']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_metros_8" type="text" id="vivienda_metros_8" value="<?= $_POST['vivienda_metros_8']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2">
                        <input name="vivienda_8" type="text" id="vivienda_8" value="<?php $_POST['vivienda_8']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_8';" readonly  >
                        <input name="cero_vivienda_8" type="checkbox" id="cero_vivienda_8" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_8" type="hidden" id="vivienda_total_8" value="<?php $_POST['vivienda_total_8']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_8" type="text" id="comercio_cant_8" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_8'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-3  input-group">
                        <input name="comercio_metros_8" type="text" id="comercio_metros_8" value="<?= $_POST['comercio_metros_8']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_8" type="text" id="comercio_8" value="<?php $_POST['comercio_8']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_8';" readonly >
                        <input name="cero_comercio_8" type="checkbox" id="cero_comercio_8" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_8" type="hidden" id="comercio_total_8" value="<?php $_POST['comercio_total_8']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_8" type="text" id="industria_cant_8" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_8'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_metros_8" type="text" id="industria_metros_8" value="<?= $_POST['industria_metros_8']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_8" type="text" id="industria_8" value="<?php $_POST['industria_8']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_8';" readonly >
                        <input name="cero_industria_8" type="checkbox" id="cero_industria_8" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_8" type="hidden" id="industria_total_8" value="<?php $_POST['industria_total_8']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_8" type="text" id="institucional_cant_8" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_8']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-3">
                        <input name="institucional_metros_8" type="text" id="institucional_metros_8" value="<?= $_POST['institucional_metros_8']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_8" type="text" id="institucional_8" value="<?php $_POST['institucional_8']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_8';" readonly >
                        <input name="cero_institucional_8" type="checkbox" id="cero_institucional_8" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_8" type="hidden" id="institucional_total_8" value="<?php $_POST['institucional_total_8']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-6 input-group">
                        <h4><strong>Urbanismo / Parcelación</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad (30%)</strong>
                        </h5>
                      </div>
                      <div class="col-lg-2">
                        <h5>
                          <strong>Valor</strong>
                        </h5>                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Vivienda</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_cant_11" type="text" id="vivienda_cant_11" size="15" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['vivienda_cant_11']; ?>" > 
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="vivienda_metros_11" type="text" id="vivienda_metros_11" value="<?= $_POST['vivienda_metros_11']; ?>" size="13" readonly />
                        <label for="">M<sup>2</sup></label>
                      </div>
                      <div class="col-lg-2 ">
                        <input name="vivienda_11" type="text" id="vivienda_11" value="<?php $_POST['vivienda_11']; ?>" size="13" onkeypress="document.form1.modificado.value='vivienda_11';" readonly  >
                        <input name="cero_vivienda_11" type="checkbox" id="cero_vivienda_11" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="vivienda_total_11" type="hidden" id="vivienda_total_11" value="<?php $_POST['vivienda_total_11']; ?>" >                      
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Comercio</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_cant_11" type="text" id="comercio_cant_11" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['comercio_cant_11'];?>" size="15" >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="comercio_metros_11" type="text" id="comercio_metros_11" value="<?= $_POST['comercio_metros_11']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>               
                      </div>
                      <div class="col-lg-2">
                        <input name="comercio_11" type="text" id="comercio_11" value="<?php $_POST['comercio_11']; ?>" size="13" onkeypress="document.form1.modificado.value='comercio_11';" readonly >
                        <input name="cero_comercio_11" type="checkbox" id="cero_comercio_11" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="comercio_total_11" type="hidden" id="comercio_total_11" value="<?php $_POST['comercio_total_11']; ?>" >                    
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12  input-group">
                      <div class="col-lg-1  input-group"></div>
                      <div class="col-lg-2  input-group">
                        <h6>Industria</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_cant_11" type="text" id="industria_cant_11" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['industria_cant_11'];?>" size="15" />    
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="industria_metros_11" type="text" id="industria_metros_11" value="<?= $_POST['industria_metros_11']; ?>" size="13" readonly >
                        <label for="">M<sup>2</sup></label>                  
                      </div>
                      <div class="col-lg-2">
                        <input name="industria_11" type="text" id="industria_11" value="<?php $_POST['industria_11']; ?>" size="13" onkeypress="document.form1.modificado.value='industria_11';" readonly >
                        <input name="cero_industria_11" type="checkbox" id="cero_industria_11" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="industria_total_11" type="hidden" id="industria_total_11" value="<?php $_POST['industria_total_11']; ?>" >                 
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2 input-group">
                        <h6>Institucional </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_cant_11" type="text" id="institucional_cant_11" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?php $_POST['institucional_cant_11']; ?>" size="15" > 
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="institucional_metros_11" type="text" id="institucional_metros_11" value="<?= $_POST['institucional_metros_11']; ?>" size="13" readonly>
                        <label for="">M<sup>2</sup></label>                    
                      </div>
                      <div class="col-lg-2">
                        <input name="institucional_11" type="text" id="institucional_11" value="<?php $_POST['institucional_11']; ?>" size="13" onkeypress="document.form1.modificado.value='institucional_11';" readonly >
                        <input name="cero_institucional_11" type="checkbox" id="cero_institucional_11" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" >
                        <input name="institucional_total_11" type="hidden" id="institucional_total_11" value="<?php $_POST['institucional_total_11']; ?>" >                   
                      </div>
                      <div class="col-lg-1 form-check"></div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-1 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h4>
                        <strong>
                          <label for="subdivision" class="form-check-label">Subdivision</label>
                        </strong>
                      </h4>
                    </div>
                    <div class="col-lg-1 input-group">
                      <input name="subdivision" type="checkbox" class="form-check-input" id="subdivision" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['subdivision']){ echo 'checked'; } ?> >
                      <input name="subdivision_total" type="hidden" id="subdivision_total" value="<? echo $_POST['subdivision_total']; ?>" >
                    </div>
                    <div class="col-lg-1 input-group"></div>
                    <div class="col-lg-2 input-group">
                      <h4>
                        <strong>
                          Ajuste Cotas
                        </strong>
                      </h4>
                    </div>
                    <div class="col-lg-2 input-group">
                      <select name="ajuste_cotas" id="ajuste_cotas" class="input-group" onchange="xajax_liquidacion(xajax.getFormValues('form1'))">
                          <option value="0" <?php if($_POST['ajuste_cotas'] == 0) echo "selected";?> >Ninguno</option>
                          <option value="1" <?php if($_POST['ajuste_cotas'] == 1) echo "selected";?> >Estrato 1</option>
                          <option value="2" <?php if($_POST['ajuste_cotas'] == 2) echo "selected";?> >Estrato 2</option>
                          <option value="3" <?php if($_POST['ajuste_cotas'] == 3) echo "selected";?> >Estrato 3</option>
                          <option value="4" <?php if($_POST['ajuste_cotas'] == 4) echo "selected";?> >Estrato 4</option>
                          <option value="5" <?php if($_POST['ajuste_cotas'] == 5) echo "selected";?> >Estrato 5</option>
                          <option value="6" <?php if($_POST['ajuste_cotas'] == 6) echo "selected";?> >Estrato 6</option>
                      </select>
                      <input name="ajuste_cotas_total" type="hidden" id="ajuste_cotas_total" value="<?php echo $_POST['ajuste_cotas_total']; ?>" />
                    </div>
                  </div>

                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="borde input-group col-lg-11">
                    <div class="input-group col-lg-12 ">
                      <div class="input-group col-lg-1 "></div>
                      <div class="col-lg-6 input-group">
                        <h4><strong>Otras Actuaciones</strong></h4>
                      </div>
                    </div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3  input-group">
                        <h5>
                          <strong>Usos</strong>
                        </h5>
                      </div>
                      <div class="col-lg-3 input-group">
                        <h5>
                          <strong>Cantidad</strong>
                        </h5>                      
                      </div>
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-2"></div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h6>Aprobación Proyecto Urbano</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="apro" type="text" id="apro" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?= $_POST['apro']; ?>" size="15"/>
                        <label for="">M<sup>2</sup></label>
                        <input name="apro_total" type="hidden" id="apro_total" value="<?= $_POST['apro_total']; ?>" />
                      </div>
                      <div class="col-lg-3 input-group">
                        <h6>Conceptos</h6>
                      </div>
                      <div class="col-lg-1 input-group">
                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input name="concepto" type="checkbox" id="concepto" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['concepto']) echo "checked"; ?> >
                        <input name="concepto_total" type="hidden" id="concepto_total" value="<?php echo $_POST['concepto_total']; ?>" />
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h6>Movimiento Tierras/Piscinas </h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="movimiento_tierras" type="text" id="movimiento_tierras" onKeyUp="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?= $_POST['movimiento_tierras']; ?>" size="15" />
                        <label for="">M<sup>2</sup></label>
                        <input name="movimiento_tierras_total" type="hidden" id="movimiento_tierras_total" value="<?= $_POST['movimiento_tierras_total']; ?>" />
                      </div>
                      <div class="col-lg-3 input-group">
                        <h6>Modificacion Planos Urbanos</h6>
                      </div>
                      <div class="col-lg-1 input-group">
                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  
                        <input name="mod" type="checkbox" id="mod" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" onkeypress="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['mod']) echo "checked" ?> >
                        <input name="mod_total" type="hidden" id="mod_total" value="<?php echo $_POST['mod_total']; ?>" />
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h6>Propiedad horizontal</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="propiedad_horizontal" type="text" id="propiedad_horizontal" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?= $_POST['propiedad_horizontal']; ?>" size="15" >
                        <label for="">M<sup>2</sup></label>
                        <input name="propiedad_horizontal_total" type="hidden" id="propiedad_horizontal_total" value="<?= $_POST['propiedad_horizontal_total']; ?>">
                      </div>
                      <div class="col-lg-2 input-group">
                        <h6>Prórroga</h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="prorroga" type="checkbox" id="prorroga" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['prorroga']) echo "checked"; ?> >
                        <input name="prorroga_total" type="hidden" id="prorroga_total" value="<?php echo $_POST['prorroga_total']; ?>" name="prorroga_total">
                        <div class="col-lg-3"></div>
                        <label for="prorroga_vis" class="form-check-label">V.I.S&nbsp;</label> 
                        <input name="prorroga_vis" type="checkbox" id="prorroga_vis" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['prorroga_vis']) echo "checked";?> />
                        <input name="prorroga_vis_total" type="hidden" id="prorroga_vis_total" value="<?php echo $_POST['prorroga_vis_total']; ?>" >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h6>Reloteos</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="reloteos" type="text" id="reloteos" onKeyUp="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?= $_POST['reloteos']; ?>" size="15" />
                        <label for="">M<sup>2</sup></label>
                        <input name="reloteos_total" type="hidden" id="reloteos_total" value="<?= $_POST['reloteos_total']; ?>" />
                      </div>
                      <div class="col-lg-2 input-group">
                        <h6>Revalidación</h6>
                      </div>
                      <div class="col-lg-2 input-group">
                        <input name="revalidacion" type="checkbox" id="revalidacion" value="1" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['revalidacion']){ ?>checked <?php } ?> />
                        <input name="revalidacion_total" type="hidden" id="revalidacion_total" value="<?php echo $_POST['revalidacion_total']; ?>" >
                        <div class="col-lg-3 "></div>
                        <label for="revalidacion_vis" class="form-check-label">V.I.S&nbsp;</label>
                        <input name="revalidacion_vis" type="checkbox" id="revalidacion_vis" value="1" onchange="xajax_liquidacion(xajax.getFormValues('form1'))" onclick="xajax_liquidacion(xajax.getFormValues('form1'))" onkeypress="xajax_liquidacion(xajax.getFormValues('form1'))" <?php if($_POST['revalidacion_vis']) echo "checked"; ?> >
                        <input name="revalidacion_vis_total" type="hidden" id="revalidacion_vis_total" value="<?php echo $_POST['revalidacion_vis_total']; ?>" >
                      </div>
                    </div>
                    <div class="form-group col-lg-12 "></div>
                    <div class="col-lg-12 input-group">
                      <div class="col-lg-1 input-group"></div>
                      <div class="col-lg-3 input-group">
                        <h6>Sello de Planos</h6>
                      </div>
                      <div class="col-lg-3 input-group">
                        <input name="copia_planos" type="text" id="copia_planos" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);" value="<?= $_POST['copia_planos']; ?>" size="15" >
                        <label for="">U/d</label>
                        <input name="copia_planos_total" type="hidden" id="copia_planos_total" value="<?= $_POST['copia_planos_total']; ?>" >
                      </div>
                      <div class="col-lg-1 input-group">
                      </div>
                      <div class="col-lg-2 ">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12 input-group">
                    <div class="col-lg-3 input-group"></div>
                    <div class="col-lg-3 input-group">
                      <h5 class="col-lg-10">Subtotal</h5>
                    </div>
                    <div class="col-lg-5  input-group">
                      <input name="subtotal" type="text" id="subtotal" value="<?= $_POST['subtotal']; ?>" size="17" readonly="readonly" >
                      <input name="cargo_fijo_total" type="hidden" id="cargo_fijo_total" value="<?= $_POST['cargo_fijo_total']; ?>" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-3  input-group"></div>
                    <div class="col-lg-3  input-group">
                      <h5 class="col-lg-10">Iva 19%</h5>
                    </div>
                    <div class="col-lg-5  input-group">
                      <input name="iva" type="text" id="iva" value="<?= $_POST['iva']; ?>" size="17" readonly="readonly" >
                      <input name="cargo_variable_total" type="hidden" id="cargo_variable_total" value="<?= $_POST['cargo_variable_total']; ?>" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-3  input-group"></div>
                    <div class="col-lg-3  input-group">
                      <h5 class="col-lg-10">Total</h5>
                    </div>
                    <div class="col-lg-5  input-group">
                      <input name="total" type="text" id="total" value="<?= $_POST['total']; ?>" size="17" readonly="readonly" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-3  input-group"></div>
                    <div class="col-lg-3  input-group">
                      <h5 class="col-lg-10">Estampillas</h5>
                    </div>
                    <div class="col-lg-5  input-group">
                      <input name="estampillas" type="text" id="estampillas" value="<?php if (empty($_POST['estampillas'])) echo '5600'; else echo $_POST['estampillas']; ?>" size="17" onchange="xajax_liquidacion(xajax.getFormValues('form1'))" onkeyup="xajax_liquidacion(xajax.getFormValues('form1'))" >
                    </div>
                  </div>
                  <div class="form-group col-lg-12 "></div>
                  <div class="col-lg-12  input-group">
                    <div class="col-lg-3  input-group"></div>
                    <div class="col-lg-3  input-group">
                      <h5 class="col-lg-10">Expensas</h5>
                    </div>
                    <div class="col-lg-5 input-group">
                      <input name="expensas" type="text" id="expensas" value="<?= $_POST['expensas']; ?>" size="17" readonly="readonly" >
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
                <div class="col-lg-4 offset-3">
                  <button class="btn btn-danger" type="submit" name="submit" id="submit" >Crear</button>
                </div>
                <div class="col-lg-2">
                  <input type="hidden" name="cancelar">
                  <button type="submit" class="btn btn-default" id="cancelar" name="cancelar" value="9" formaction="../../functions/routes.php">cancelar</button>
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
<?php ob_flush(); ?>