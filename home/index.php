<?php include '../extend/header.php'; ?>
<div class="row" style="padding-top:10px;">
   <div class="col s12">
    <div class="card">
      <div class="card-content">
       <span class="card-title">Crear usuario</span>
       <form class="form" action="add_user.php" method="post">
                  
                  <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required autofocus id="nombre"  title="Nombre">
                
                  
                  <label for="correo">Correo:</label>
                <input id="correo" type="email" name="correo" required    title="Correo electronico">
                <div class="validacion"></div>

              
                  
                  <label for="pass1">Contraseña:</label>
                  <input type="password" name="pass1" title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass1">
                  
                    
                    <label for="pass2">Verificar Contraseña:</label>
                    <input type="password"  title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass2">
                

                
                <select class="browser-default" name="nivel" required>
                    <option value="" disabled selected>Tipo de usuario</option>
                    <option value="ADMINISTRADOR">Administrador</option>
                    <option value="SUPERVISOR">Supervisor</option>
                    <option value="ESPECIALISTA">Técnico</option>
                </select>
             
                <br>
                <button type="=submit"  class="btn black" name="button" style="display: flex; align-items: center;">Guardar<i style="margin-left:10px" class="material-icons">send</i></button>
       
 

          

       </form>
      </div>
   </div>
  </div>
</div>

 <div id="estudiantes" class="col s12" style="padding-top:10px;">
       <div class="row">
         <div class="col s12">
           <nav class="bg-dark">
             <div class="nav-wrapper">
               <div class="input-field">
                 <input type="search" id="buscar" autocomplete="off">
                 <label for="buscar"><i class="material-icons">search</i></label>
                 <i class="material-icons">close</i>
               </div>
             </div>
           </nav>
         </div>
       </div>




       <?php $sel = $con->query("SELECT * FROM users");
        $row = mysqli_num_rows($sel);
        ?>

           <div class="row">
              <div class="col s12">
               <div class="card">
                 <div class="card-content">
                  <span class="card-title">Usuarios(<?php echo $row ?>)</span>
                  <table class="striped responsive-table">
                    <thead>
                      <th>Nombre</th>
                      <th>email</th>
                      <th>rol</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td><?php echo $f['email'] ?></td>
                        <td><?php if ($f['rol'] == ESPECIALISTA) {
                          echo 'TÉCNICO';
                        }else {
                         echo $f['rol'];
                        } ?></td>
                        <td><a href="update_user.php?id=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar al usuario?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_user.php?id=<?php echo     $f['id'] ?>'; } else { location.href='index.php';} })"><i class="material-icons">clear</i></a></td>
                      </tr>
                    <?php } ?>
                  </table>
                 </div>
              </div>
             </div>
           </div>
</div>

</div>

<?php include '../extend/scripts.php'; ?>
<script>
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

</script>
</body>
</html>
