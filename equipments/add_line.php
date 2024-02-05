<?php include '../extend/header.php';
$id = htmlentities($_GET['id']);

?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Agregar linea</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_line.php" method="post">
               <label for="line_name">Nombre</label>
              <input type="text" name="line_name" value="">
    

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
