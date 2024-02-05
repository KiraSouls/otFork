<?php include '../extend/header.php';
$id = $con-> real_escape_string(htmlentities($_GET['id']));
$id_service = $con-> real_escape_string(htmlentities($_GET['id_service']));

?>
<div class="row">
      <div class="col s12">
      <p style="color:grey;">Agregar nueva actividad a la orden</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_activity.php" method="post">
             
             <label for="service">Tarea</label>

                <select class="browser-default" name="service" id="service" required>
                <option value="" disabled selected>Selecciona una tarea</option>

                <?php
                      $sel2 = $con->query("SELECT * FROM tasks WHERE id_service='$id_service'");
                      while ($f = $sel2->fetch_assoc()) {  ?>
                  <option value='<?php echo $f['id'] ?>' > <?php echo $f['name'] ?></option>
                <?php  } ?>
                </select>

               <label for="hours">Horas</label>
               <input  type="number" min="0" name="hours">

               <input type="text" name="id" value="<?php echo $id ?>" hidden>


               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
     </div>
