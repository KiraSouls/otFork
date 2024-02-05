<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);


?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar sucursal</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_branch.php" method="post">
               <label for="branch_name">Nombre</label>
              <input type="text" name="branch_name" value="">
                <label for="branch_location">Ubicación</label>
               <input type="text" name="branch_location" value="">
               <input type="text" name="id" value="<?php echo $id ?>" hidden>
               <label for="branch_phone">Teléfono</label>
               <input type="text" name="branch_phone" value="">
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
