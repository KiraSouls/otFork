<?php include '../extend/header.php';
?>
<div class="row" style="padding-top:10px;">
   <div class="col s12">
    <div class="card">
      <div class="card-content">
       <span class="card-title">Crear nueva orden</span>
       <form class="form" action="ins_tech.php" method="post">

       <label for="name">Cliente</label>
               <select class="" name="name" id="client" required>
               <?php 
                     $sel2 = $con->query("SELECT * FROM clients");
                     while ($f = $sel2->fetch_assoc()) {  ?>
                  <option value="<?php echo $f['name'] ?>" selected><?php echo $f['name'] ?></option>
               <?php  } ?>      
                  
                </select>


          
         <button type="=submit"  class="btn light-blue darken-2" name="button" id="btn-guardar">Crear</button>

       </form>
      </div>
   </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>

   </body>
   </html>
