<?php include '../extend/header.php';
$id_line = htmlentities($_GET['id']);

?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar marca</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_brand.php" method="post">
               <label for="brand_name">Nombre</label>
              <input type="text" name="brand_name" value="">

              <input type="text" name="id_line" value="<?php echo $id_line ?>" hidden>

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
