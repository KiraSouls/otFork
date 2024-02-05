<?php include '../extend/header.php';


$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM users WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $email = $f['email'];
  $rol = $f['rol'];
}
?>

   <div class="row">
      <div class="col s12 ">
      <p style="color:grey;">Detalles de usuario</p>
      <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_user.php" method="post">
               <label for="name">Nombre</label>
               <input type="text" name="name" value="<?php echo $name ?>">

               <label for="email">Email</label>
               <input type="text" name="email" value="<?php  echo $email ?>">

               <input type="text" name="id" value="<?php echo $id ?>" hidden>
               <button type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>

     <div class="row">
      <div class="col s12 ">
      <p style="color:grey;">Cambiar contraseña</p>
      <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_password.php" method="post">

             <div class="input-field">
                  <input type="password" name="pass1" title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass1" required>
                  <label for="pass1">Contraseña:</label>

                  <div class="input-field">
                    <input type="password"  title="Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass2" required>
                    <label for="pass2">Verificar Contraseña:</label>
                </div>

               <input type="text" name="id" value="<?php echo $id ?>" hidden>
               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>


     <?php include '../extend/scripts.php'; ?>
<script>
$('#pass2').change(function(event){
  if ($('#pass1').val() == $('#pass2').val() ) {
    swal('Contraseñas','Las contraseñas coinciden','success');
    $('#btn-guardar').show();
  }else {
    swal('Contraseñas','Las contraseñas no coinciden','error');
    $('#btn-guardar').hide();
  }
});</script>
</body>
</html>
