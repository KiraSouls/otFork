<?php include '../extend/header.php';
?>
<div class="row" style="padding-top:10px;">
   <div class="col s12">
    <div class="card">
      <div class="card-content">
       <span class="card-title">Agregar repuesto</span>
       <form class="form" action="ins_replacement.php" method="post">

    
             
       <label for="name">Nombre</label>
       <input type="text" name="name" value="" required>

       <label for="brand">Marca</label>
               <select class="" name="brand" id="" required>
               <?php 
                     $sel2 = $con->query("SELECT * FROM parameter_brand");
                     while ($f = $sel2->fetch_assoc()) {  ?>
                  <option value="<?php echo $f['name'] ?>" selected><?php echo $f['name'] ?></option>
               <?php  } ?>      
                  
                </select> <br>
       <label for="price">Precio</label>
       <input type="text" name="price" value="" required>
       <label for="description">Descripción</label>
       <input type="text" name="description" value="" required>
          
         <button type="=submit"  class="btn light-blue darken-2" name="button" id="btn-guardar">Crear</button>

       </form>
      </div>
   </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>

   </body>
   </html>
