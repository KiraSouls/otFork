<?php include '../extend/header.php';
$id = $_GET['id'];
$id_linea = $_GET['id_linea'];
$id_sublinea = $_GET['id_sublinea'];

?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar modelo</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_model.php" method="post">
               <label for="model_name">Nombre</label>
              <input type="text" name="model_name" value="">

              <label for="pal_number">Número de parte</label>
              <input type="text" name="pal_number" value="">

              <label for="short_desc">Descripción corta</label>
               <input type="text" name="short_desc" value="">

               <label for="long_desc">Descripción larga</label>
               <input type="text" name="long_desc" value="">

              <input type="text" name="id" value="<?php echo $id ?>" hidden>
              <input type="text" name="id_linea" value="<?php echo $id_linea ?>" hidden>
              <input type="text" name="id_sublinea" value="<?php echo $id_sublinea ?>" hidden>

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
