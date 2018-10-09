<?php
    error_reporting(0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$msg = "";

    $_SESSION['file'] = $_FILES["file_to_upload"];
    $_SESSION['file2'] = $_FILES["file_to_upload2"];
    $_SESSION['file3'] = $_FILES["file_to_upload3"];


    if ( isset($_SESSION['file']) && !empty($_SESSION['file']) ) {

        $infoarchivo = new finfo(FILEINFO_MIME_TYPE);
        $tipoarchivo = file_get_contents($_SESSION['file']["tmp_name"]);
        $mimetype = $infoarchivo->buffer($tipoarchivo);


        $infoarchivo2 = new finfo(FILEINFO_MIME_TYPE);
        $tipoarchivo2 = file_get_contents($_SESSION['file2']["tmp_name"]);
        $mimetype2 = $infoarchivo2->buffer($tipoarchivo2);

        $infoarchivo3 = new finfo(FILEINFO_MIME_TYPE);
        $tipoarchivo3 = file_get_contents($_SESSION['file3']["tmp_name"]);
        $mimetype3 = $infoarchivo3->buffer($tipoarchivo3);

        $type = "";

        if ($mimetype == "image/png" || $mimetype2 == "image/png") {
            $type = ".png";
        }elseif ($mimetype == "image/jpg" || $mimetype2 == "image/jpg") {
            $type = ".jpg";
        }elseif ($mimetype == "image/jpeg" || $mimetype2 == "image/jpeg") {
            $type = ".jpeg";
        }elseif ($mimetype == "image/tif" || $mimetype2 == "image/tif") {
            $type = ".tif";
        }elseif ($mimetype == "image/bmp" || $mimetype2 == "image/bmp") {
            $type = ".bmp";
        }else{
            echo '<script  type="text/javascript">
                    alert("ERROR NO SE PUEDE CARGAR EL ARCHIVO");
                    // window.location="\ivc.php"
                  </script>';
        }

        $type2 = "";

        if ($mimetype3 == "application/pdf") {
            $type2 = ".pdf";
        }else{
            echo '<script  type="text/javascript">
                    alert("ERROR NO SE PUEDE CARGAR EL ARCHIVO");
                    // window.location="\ivc.php"
                  </script>';
        }


        $fecha_actual = date('Y-m-d H:i:s');
        $ano_actual = date('Y');
        $mes_actual = date('m');

        $dir_subida = "../upload/ivc/";

        $fichero_subido_final = $dir_subida . "proyecto".$ano_actual.$mes_actual.$type;
        $fichero_subido_final2 = $dir_subida . "proyecto2".$ano_actual.$mes_actual.$type;
        $fichero_subido_final3 = $dir_subida . "proyecto3".$ano_actual.$mes_actual.$type2;

        switch ($type) {

            case '.png':
            case '.jpg':
            case '.jpeg':
            case '.tif':
            case '.bmp':

                $ancho_nuevo=900;
                $alto_nuevo=900;

                redim ($_SESSION['file']["tmp_name"], $fichero_subido_final,    $ancho_nuevo,$alto_nuevo); 
                            $msg = "Carga Correcta img";
                            echo $msg;
                            echo $fichero_subido_final." // // ";
                            unset($_SESSION['file']); 

                redim2($_SESSION['file2']["tmp_name"], $fichero_subido_final2,   $ancho_nuevo,$alto_nuevo);
                            $msg = "Carga Correcta img";
                            echo $msg;
                            echo $fichero_subido_final2."";
                            unset($_SESSION['file2']); 

                break;

             default:
                echo '<script  type="text/javascript">
                        alert("ERROR AL INTENTAR CARGAR EL ARCHIVO");
                        // window.location="\ivc.php"
                      </script>';

                break;
            
        }


        switch ($type2) {

            case '.pdf':

                move_uploaded_file($_SESSION['file3']["tmp_name"], "$fichero_subido_final3");
                $msg = "Carga Correcta pdf";
                echo $msg;
                echo $fichero_subido_final." // // ";
                unset($_SESSION['file3']);

                break;

             default:
                echo '<script  type="text/javascript">
                        alert("ERROR AL INTENTAR CARGAR EL ARCHIVO");
                        // window.location="\ivc.php"
                      </script>';

                break;
        }


    }else{
        echo '<script  type="text/javascript">
                alert("NO HA SELECCIONADO NINGUN ARCHIVO");
                // window.location="\ivc.php"
                </script>';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <script src="../plugins/jquery/jquery.min.js"></script>
	 <style>
          .thumb {
            height: 300px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }

          img{
          	 max-width: 100% !important;
   			 height: auto !important;
          }

          .iframe{
          	width: 500px !important;
          	height: 500px !important;
          	border: 1px;
          }
     </style>
     <script>
        var contador = 0;
        // $(document).on('ready', function(){

         function agregar2(){
            contador++;

            var contenido = "";

                contenido += "<div class='col-lg-12'>";
                contenido   += "<label '>Imagen</label>";
                contenido   += "<input name='file_to_upload"+contador+"' id='files"+contador+"' type='file' />";
                contenido += "</div>";

            $('#david').append(contenido);
            $('#nombre').val(contador);



         }
        // });
            
            
     </script>
</head>
<body>
	<form enctype="multipart/form-data" action="" method="POST">
	    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
        <div id="david">
            <div class="col-lg-12">
                <label for="">Imagen</label>
                <input name="file_to_upload0" id="files" type="file" />
            </div>
        </div>
        
        <input type="text" hidden name="nombre" id="nombre" value="0">
        <button type="button" name="imagen" onclick="agregar2();" >+</button>

        <div class="col-lg-12">
            <label for="">Informe del Acta</label>            
            <input name="file_to_uploadx0" id="files3" type="file" />
        </div>
	    <input type="submit" value="Enviar fichero" />
		<br>
		<!-- Este codigo sirve para mostrar una vista previa de las imagenes antes de ser cargadas --- AQUI INICIA 1730 -->
        <output id="list"></output>
        <output id="list2"></output>
	    <output id="list3"></output>
		<!-- AQUI TERMINA 1730 -->
	</form>

	<!-- Este codigo sirve para mostrar una vista previa de las imagenes antes de ser cargadas --- AQUI INICIA 0212 -->
	<script>
	      function archivo(evt) {
	          var files = evt.target.files; // FileList object
	     
	          // Obtenemos la imagen del campo "file".
	          for (var i = 0, f; f = files[i]; i++) {
	            //Solo admitimos imágenes.
	            // if (!f.type.match('image.*') ) {
	            //     continue;
	            // }
	            var reader = new FileReader();

	            reader.onload = (function(theFile) {
	                return function(e) {
	                  // Insertamos la imagen
	                  console.log(theFile.type);

	                  if (theFile.type == "application/pdf") {
	                 	document.getElementById("list").innerHTML = ['<div style="width:40%;" ><iframe class="iframe" src="', e.target.result,'" title="', escape(theFile.name), '"></iframe></div>'].join('');
	                  }else if(theFile.type == "image/jpeg" || theFile.type == "image/png" || theFile.type == "image/jpg"  || theFile.type == "image/tif" || theFile.type == "image/bmp"){
	                 	document.getElementById("list").innerHTML = ['<div style="width:40%;" ><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"></div>'].join('');
	                  }else{
                        alert("ERROR NO SE PUEDE CARGAR EL ARCHIVO");
                      }
	                };
	            })(f);
	     
	            reader.readAsDataURL(f);
	          }
	      }

          document.getElementById('files').addEventListener('change', archivo, false);
	     
          function archivo2(evt) {
              var files = evt.target.files; // FileList object
         
              // Obtenemos la imagen del campo "file".
              for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                // if (!f.type.match('image.*') ) {
                //     continue;
                // }
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                      // Insertamos la imagen
                      console.log(theFile.type);

                      if (theFile.type == "application/pdf") {
                        document.getElementById("list2").innerHTML = ['<div style="width:40%;" ><iframe class="iframe" src="', e.target.result,'" title="', escape(theFile.name), '"></iframe></div>'].join('');
                      }else if(theFile.type == "image/jpeg" || theFile.type == "image/png" || theFile.type == "image/jpg"  || theFile.type == "image/tif" || theFile.type == "image/bmp"){
                        document.getElementById("list2").innerHTML = ['<div style="width:40%;" ><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"></div>'].join('');
                      }else{
                        alert("ERROR NO SE PUEDE CARGAR EL ARCHIVO");
                      }
                    };
                })(f);
         
                reader.readAsDataURL(f);
              }
          }

	      document.getElementById('files2').addEventListener('change', archivo2, false);

          function archivo3(evt) {
              var files = evt.target.files; // FileList object
         
              // Obtenemos la imagen del campo "file".
              for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                // if (!f.type.match('image.*') ) {
                //     continue;
                // }
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                      // Insertamos la imagen
                      console.log(theFile.type);

                      if (theFile.type == "application/pdf") {
                        document.getElementById("list3").innerHTML = ['<div style="width:40%;" ><iframe class="iframe" src="', e.target.result,'" title="', escape(theFile.name), '"></iframe></div>'].join('');
                      }else if(theFile.type == "image/jpeg" || theFile.type == "image/png" || theFile.type == "image/jpg"  || theFile.type == "image/tif" || theFile.type == "image/bmp"){
                        document.getElementById("list3").innerHTML = ['<div style="width:40%;" ><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"></div>'].join('');
                      }else{
                        alert("ERROR NO SE PUEDE CARGAR EL ARCHIVO");
                      }
                    };
                })(f);
         
                reader.readAsDataURL(f);
              }
          }

          document.getElementById('files3').addEventListener('change', archivo3, false);
      </script>
      <iframe src="" frameborder="0"></iframe>
	<!-- AQUI TERMINA 0212 -->

</body>
</html>
<?php 
function redim($ruta1,$ruta2,$ancho,$alto)
    {
    # se obtene la dimension y tipo de imagen
    $datos=getimagesize ($ruta1);
    
    $ancho_orig = $datos[0]; # Anchura de la imagen original
    $alto_orig = $datos[1];    # Altura de la imagen original
    $tipo = $datos[2];
    
    if ($tipo==1){ # GIF
        if (function_exists("imagecreatefromgif")){
            $img = imagecreatefromgif($ruta1);
            echo "<script>
				alert('entro a gif');
				</script>";
        }else{
            return false;
        }
    }
    else if ($tipo==2){ # JPG
        if (function_exists("imagecreatefromjpeg")){
            $img = imagecreatefromjpeg($ruta1);

        }else{
            return false;
        }
    }
    else if ($tipo==3){ # PNG
        if (function_exists("imagecreatefrompng")){
            $img = imagecreatefrompng($ruta1);
        
        }else{
            return false;
        }
    }
    
    # Se calculan las nuevas dimensiones de la imagen
    if ($ancho_orig>$alto_orig)
    {
        $ancho_dest=$ancho;
        $alto_dest=($ancho_dest/$ancho_orig)*$alto_orig;
    }
    else
    {
        $alto_dest=$alto;
        $ancho_dest=($alto_dest/$alto_orig)*$ancho_orig;
    }

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    $img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest);

    // Redimensionar
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    @imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig);

    // Crear fichero nuevo, según extensión.
    if ($tipo==1) // GIF
        if (function_exists("imagegif"))
            imagegif($img2, $ruta2);
        else
            return false;

    if ($tipo==2) // JPG
        if (function_exists("imagejpeg"))
            imagejpeg($img2, $ruta2);
        else
            return false;

    if ($tipo==3)  // PNG
        if (function_exists("imagepng"))
            imagepng($img2, $ruta2);
        else
            return false;
    
    return true;
} 

function redim2($ruta1,$ruta2,$ancho,$alto)
    {
    # se obtene la dimension y tipo de imagen
    $datos=getimagesize ($ruta1);
    
    $ancho_orig = $datos[0]; # Anchura de la imagen original
    $alto_orig = $datos[1];    # Altura de la imagen original
    $tipo = $datos[2];
    
    if ($tipo==1){ # GIF
        if (function_exists("imagecreatefromgif")){
            $img = imagecreatefromgif($ruta1);
            echo "<script>
                alert('entro a gif');
                </script>";
        }else{
            return false;
        }
    }
    else if ($tipo==2){ # JPG
        if (function_exists("imagecreatefromjpeg")){
            $img = imagecreatefromjpeg($ruta1);

        }else{
            return false;
        }
    }
    else if ($tipo==3){ # PNG
        if (function_exists("imagecreatefrompng")){
            $img = imagecreatefrompng($ruta1);
        
        }else{
            return false;
        }
    }
    
    # Se calculan las nuevas dimensiones de la imagen
    if ($ancho_orig>$alto_orig)
    {
        $ancho_dest=$ancho;
        $alto_dest=($ancho_dest/$ancho_orig)*$alto_orig;
    }
    else
    {
        $alto_dest=$alto;
        $ancho_dest=($alto_dest/$alto_orig)*$ancho_orig;
    }

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    $img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest);

    // Redimensionar
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    @imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig);

    // Crear fichero nuevo, según extensión.
    if ($tipo==1) // GIF
        if (function_exists("imagegif"))
            imagegif($img2, $ruta2);
        else
            return false;

    if ($tipo==2) // JPG
        if (function_exists("imagejpeg"))
            imagejpeg($img2, $ruta2);
        else
            return false;

    if ($tipo==3)  // PNG
        if (function_exists("imagepng"))
            imagepng($img2, $ruta2);
        else
            return false;
    
    return true;
}


 ?>
