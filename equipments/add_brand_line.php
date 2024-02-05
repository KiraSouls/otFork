<?php include '../extend/header.php';
$id_subline = $_GET['id'];

?>
   <div class="row">
      <div class="col s12">
        <h4 class="header">Relacionar con marcas</h4>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_brand_line.php" method="post">
             <label for="brand">Marcas</label>
             <select class="browser-default" name="brand[]" id="brand" multiple style="min-height: 180px;">
                     <?php
                           $sel2 = $con->query("SELECT * FROM brands");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                        <option value='<?php echo $f['id'] ?>' > <?php echo $f['name'] ?></option>
                     <?php  } ?>
               </select>

               <input type="text" name="id_subline" value="<?php echo $id_subline ?>" hidden>


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
