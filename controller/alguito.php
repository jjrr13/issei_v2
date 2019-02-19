/////////// comercio

 elemento+=" <div class='col-lg-12  input-group'>";
       elemento+=" <div class='col-lg-1  input-group'></div>";
       elemento+=" <div class='col-lg-2  input-group'>";
         elemento+=" <h6>Comercio</h6>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-3 input-group'>";
         elemento+=" <input class='cargoBasico' name='comercio_cant_1' type='text' id='comercio_cant_1' onkeyup='xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);' value='<?php ;?>' size='10' >";
         elemento+=" <label for=''>M<sup>2</sup></label>";
       elemento+=" </div>";

       elemento+=" <div class='col-lg-2  input-group'></div>";

       elemento+=" <div class='col-lg-2 form-check'>";
         elemento+=" <input name='comercio_1' type='text' id='comercio_1' value='<?php ; ?>' size='10' onkeypress='document.form1.modificado.value='comercio_1';' readonly >";
         elemento+=" <input name='cero_comercio_1' type='checkbox' id='cero_comercio_1' value='1' onclick='xajax_liquidacion(xajax.getFormValues('form1'))' >";
         elemento+=" <input name='comercio_total_1' type='hidden' id='comercio_total_1' value='<?php ; ?>' >";
       elemento+=" </div>";
     elemento+=" </div>";

////////vienvienda vis uds 

 elemento+=" <div class='form-group col-lg-12 '></div>";
     elemento+=" <div class='col-lg-12  input-group'>";
       elemento+=" <div class='col-lg-1  input-group'></div>";
       elemento+=" <div class='col-lg-2  input-group'>";
         elemento+=" <h6>Vivienda VIS</h6>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-3 input-group'>";
         elemento+=" <input name='vivienda_vis_cant_1' type='text' id='vivienda_vis_cant_1' onkeyup='xajax_liquidacion(xajax.getFormValues('form1'));return acceptNum(event);' value='<?php ; ?>' size='10' >";
         elemento+=" <label>U/d</label>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-2  input-group'></div>";
       elemento+=" <div class='col-lg-2 form-check'>";
         elemento+=" <input name='vivienda_vis_1' type='text' id='vivienda_vis_1' value='<?php ; ?>' size='10' onkeypress='document.form1.modificado.value='vivienda_vis_2';' readonly='readonly' >";
         elemento+=" <input name='cero_vivienda_vis_1' type='checkbox' id='cero_vivienda_vis_1' value='1' onclick='xajax_liquidacion(xajax.getFormValues('form1'))' >";
         elemento+=" <input name='vivienda_vis_total_1' type='hidden' id='vivienda_vis_total_1' value='<?php ; ?>' >";
       elemento+=" </div>";
     elemento+=" </div>";

//////////// vivienda 

elemento+=" <div class='col-lg-12  input-group'>";
       elemento+=" <div class='col-lg-1  input-group'></div>";
       elemento+=" <div class='col-lg-2  input-group'>";
         elemento+=" <h6>Vivienda</h6>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-3 input-group'>";
         elemento+=" <input name='vivienda_cant_1' type='text' id='vivienda_cant_1' size='10' onkeyup='' value='<?php ; ?>' > ";
         elemento+=" <label for=''>M<sup>2</sup></label>";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-2 form-check'>";
         elemento+=" <input name='vivienda_VISD_1' type='checkbox' id='vivienda_VISD_1' value='1' onclick='xajax_liquidacion(xajax.getFormValues('form1'))'  > V.I.S";
       elemento+=" </div>";
       elemento+=" <div class='col-lg-2'>";
         elemento+=" <input name='vivienda_1' type='text' id='vivienda_1' value='<?php ; ?>' size='10' onkeypress='document.form1.modificado.value='vivienda_1';' readonly='readonly'  >";
         elemento+=" <input name='cero_vivienda_1' type='checkbox' id='cero_vivienda_1' value='1' onclick='xajax_liquidacion(xajax.getFormValues('form1'))' >";
         elemento+=" <input name='vivienda_total_1' type='hidden' id='vivienda_total_1' value='<?php ; ?>' >";
       elemento+=" </div>";
     elemento+=" </div>";