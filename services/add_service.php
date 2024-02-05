<?php include '../extend/header.php'; ?>




   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar Servicio</h4>
       <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_service.php" method="post">
                
             <label for="name">Nombre del servicio</label>
             <input type="text" name="service_name" value="" required>

              
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
