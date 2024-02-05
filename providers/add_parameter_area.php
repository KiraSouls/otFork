<?php include '../extend/header.php'; ?>
<div class="row">
      <div class="col s12">
      <p style="color:grey;">Agregar nueva area al sistema</p>
      <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_parameter_area.php" method="post">
             
               <label for="nueva_area">Nombre de area</label>
               <input type="text" name="nueva_area" value="" required>

               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
     </div>