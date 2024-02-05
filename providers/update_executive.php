<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$id_provider = htmlentities($_GET['id_provider']);

$sel = $con->query("SELECT * FROM executives WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $email = $f['email'];
  $phone = $f['phone'];
  $idx = $f['id'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de ejecutivo(a)</p>
      <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_executive.php" method="post">
             <label for="name">Nombre</label>
             <input type="text" name="name" value="<?php echo $name ?>" required>


             <label for="phone">Teléfono</label>
             <input type="text" name="phone" value="<?php echo $phone ?>" required>
             <input type="text" name="idx" value="<?php echo $idx ?>" hidden>
             <label for="email">Correo</label>
             <input type="text" name="email" value="<?php echo $email ?>" required>

             <input type="text" name="id_provider" value="<?php echo $id_provider ?>" hidden>


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


