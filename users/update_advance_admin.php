<?php include '../extend/header.php';



$id = $_GET['id'];

$sel = $con->query("SELECT comment FROM advances WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $comment = $f['comment'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de servicio</p>
      <div class="card horizontal">
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_advance_admin.php" method="post">
             <label for="name">Comentario de avance</label>
             <textarea name="comment" class="materialize-textarea" data-length="410"><?php echo $comment ?></textarea>

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
