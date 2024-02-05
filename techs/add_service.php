<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM clients WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $email = $f['email'];
  $rut = $f['rut'];
  $location = $f['location'];
  $phone = $f['phone'];
  $web = $f['web'];
}
?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar servicio</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_service_tech.php" method="post">

             <label for="name">Servicios</label>
               <select class="browser-default" name="name" required>
               <?php
                     $sel2 = $con->query("SELECT * FROM services");
                     while ($f = $sel2->fetch_assoc()) {  ?>
                  <option value="<?php echo $f['id'] ?>" selected><?php echo $f['service_name'] ?></option>
               <?php  } ?>

                </select>

                <label for="level">Nivel</label>
               <select class="browser-default" name="level" required>
                  <option value="basico" selected>Básico</option>
                  <option value="medio" selected>Medio</option>
                  <option value="avanzado" selected>Avanzado</option>
                </select>



               <input type="text" name="id" value="<?php echo $id ?>" hidden>
<br>  
               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
</div>

   <?php include '../extend/scripts.php'; ?>
   </body>
   </html>
