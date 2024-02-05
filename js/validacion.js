$('#correo').change(function(){

    $.post('ajax_validacion_correo.php',{
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
