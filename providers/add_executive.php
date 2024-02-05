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
        <h4 class="header">Agregar ejecutivo(a)</h4>
       <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_executive.php" method="post">
                
             <label for="name">Nombre</label>
             <input type="text" name="name" value="" required>
             <label for="email">Correo</label>
             <input type="email" name="email" value="" required>
             <label for="phone">Teléfono</label>
             <input type="text" name="phone" value="" required>
             <input type="text" name="id" value="<?php echo $id ?>" hidden>
              
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
