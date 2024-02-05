<?php include '../extend/header.php';
?>
<div class="row" style="padding-top:10px;">
   <div class="col s12">
    <div class="card">
      <div class="card-content">
       <span class="card-title">Agregar especialista</span>
       <form class="form" action="ins_tech.php" method="post">
         <div class="input-field">
                   <input type="text" name="name" required  id="name" title="Nombre" required>
                   <label for="name">Nombre:</label>
         </div>
         <div class="input-field">
                  <input type="text" name="rut" required  id="rut" oninput="checkRut(this)" title="rut" required>
                  <label for="rut">Rut:</label>
          </div>
        
         <div class="input-field">
                  <input type="text" name="phone" required  id="phone" title="telefono" required>
                  <label for="phone">Teléfono:</label>
          </div>

          <div class="input-field">
                   <input type="text" name="email" required  id="email" title="email" required>
                   <label for="email">Correo:</label>

         </div>
                            <div class="validacion"></div>

          <div class="input-field">
                  <input type="text" name="hour_price" required >
                  <label for="hour_price">Precio/Hora</label>
          </div>       
          
         <button type="=submit"  class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>

       </form>
      </div>
   </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>

<script>
$('#email').change(function(){
  $.post('../users/ajax_validacion_correo.php',{
    correo:$('#correo').val(),

    beforeSend: function(){
      $('.validacion').html("Comprobando...");
    }

  }, function(respuesta){
    $('.validacion').html(respuesta);
  });
});
$('#btn-guardar').hide();
$('#pass2').change(function(event){
  if ($('#pass1').val() == $('#pass2').val() ) {
    swal('Contraseñas','Las contraseñas coinciden','success');
    $('#btn-guardar').show();
  }else {
    swal('Contraseñas','Las contraseñas no coinciden','error');
    $('#btn-guardar').hide();
  }
});

$('.form').keypress(function(e){
  if (e.which == 13) {
    return false;
  }
});

</script>
<script>
function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}




</script>
   </body>
   </html>
