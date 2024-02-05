<?php include '../extend/header.php';
$id_linea = $_GET['id'];

?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar sub linea</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_subline.php" method="post">
               <label for="subline_name">Nombre</label>
              <input type="text" name="subline_name" value="">
    
              <input type="text" name="id_linea" value="<?php echo $id_linea ?>" hidden>

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
