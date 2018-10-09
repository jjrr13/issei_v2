<?php

	$msg = "";
	if ($_FILES) {

		$fecha_actual = date('Y-m-d H:i:s');
		$ano_actual = date('Y');
		$mes_actual = date('m');

		$dir_subida = "../../upload/ivc/";

		$infoarchivo = new finfo(FILEINFO_MIME_TYPE);
		$tipoarchivo = file_get_contents($_FILES["file_to_upload"]["tmp_name"]);
		$mimetype = $infoarchivo->buffer($tipoarchivo);


		


		$type = "";

		if ($mimetype == "image/png") {
			$type = ".png";
		}elseif ($mimetype == "image/jpg") {
			$type = ".jpg";
		}elseif ($mimetype == "image/jpeg") {
			$type = ".jpeg";
		}elseif ($mimetype == "image/tif") {
			$type = ".tif";
		}elseif ($mimetype == "image/bmp") {
			$type = ".bmp";
		}elseif ($mimetype == "application/pdf") {
			$type = ".pdf";
		}



		$fichero_subido = $dir_subida . "proyecto".$ano_actual.$mes_actual.$type;
		$fichero_subido_final = $dir_subida . "METAL_1542".$ano_actual.$mes_actual.$type;


		if ( $mimetype == "image/png" || $mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/tif" || $mimetype == "image/bmp" || $mimetype == "application/pdf" ) {

			$ancho_nuevo=500;
    		$alto_nuevo=500;

			// redim ($_FILES["file_to_upload"]["tmp_name"], $fichero_subido_final,	$ancho_nuevo,$alto_nuevo);

			// if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], "$fichero_subido_final")) {

			if (redim ($_FILES["file_to_upload"]["tmp_name"], $fichero_subido_final,	$ancho_nuevo,$alto_nuevo)) {
				$msg = "Carga Correcta";
				echo $msg;
				echo $fichero_subido_final;
				unset($_FILES);
			}else{

				$msg = "Error al intentar cargar el archivo";
				echo $msg;
			}

		}else{

			$msg = "Error! resultado false";
			echo $msg;
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
</head>
<body>
	<form enctype="multipart/form-data" action="" method="POST">
	    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
	    Enviar este fichero: <input name="file_to_upload" id="files" type="file" />
	    <input type="submit" value="Enviar fichero" />
		<br>
		<!-- Este codigo sirve para mostrar una vista previa de las imagenes antes de ser cargadas --- AQUI INICIA 1730 -->
	    <output id="list"></output>
		<!-- AQUI TERMINA 1730 -->

	<!-- Este codigo sirve para mostrar una vista previa del archivo que se subio --- AQUI INICIA 1730 -->
       	<?php if ($type == ".pdf" && !empty($_FILES)) { ?>
    		<div style="width:40%;" ><iframe src="<?php echo $fichero_subido; ?>" width="500" height="500" frameborder="1"></iframe></div>
    	<?php }elseif ($type == ".jpg" || $type = ".jpeg" && !empty($_FILES)) {	?>
    		<img src="<?php echo $fichero_subido; ?>" width="500" height="500">
    	<?php }else{
    		echo "";
    	}  ?>
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
	                  }else{
	                 	document.getElementById("list").innerHTML = ['<div style="width:40%;" ><img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"></div>'].join('');
	                  }
	                };
	            })(f);
	     
	            reader.readAsDataURL(f);
	          }
	      }
	     
	      document.getElementById('files').addEventListener('change', archivo, false);
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


 ?>