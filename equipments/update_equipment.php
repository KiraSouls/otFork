<?php include '../extend/header.php';


$id_line = htmlentities($_GET['id']);
$id_brand = htmlentities($_GET['id_brand']);
$id_equipment = htmlentities($_GET['id_equipment']);

$sel = $con->query("SELECT * FROM equipment WHERE id = '$id_equipment' ");

while ($f = $sel->fetch_assoc()) {
  $equipment_name = $f['equipment_name'];
  $id_branches = $f['id_branches'];
  $id_model = $f['id_model'];
  $pal_number = $f['pal_number'];
  $series_number = $f['series_number'];
}

$sel_id_brand = $con->query("SELECT id_brand FROM model WHERE id = '$id_model' ");
while ($h = $sel_id_brand->fetch_assoc()) {
  $id_brand = $h['id_brand'];

}

$sel_client = $con->query("SELECT id_clients FROM branches WHERE id = '$id_branches' ");

while ($x = $sel_client->fetch_assoc()) {
  $id_client = $x['id_clients'];

}

?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles del equipo</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
           <form  action="up_equipment.php" method="post">
               <div class="row modal-form-row">
               <div class = "row">
               <div class = "col s6">
               <label for = "client">Cliente</label>

               <select class="browser-default" name="client" id="client" required>
                     <option value="0" selected>Selecciona un cliente</option>

                     <?php
                           $sel2 = $con->query("SELECT * FROM clients");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                        <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_client) { echo 'selected'; } ?> > <?php echo $f['name'] ?></option>
                     <?php  } ?>

                     </select>

               </div>

               <div class = "col s6">
                  <label for="branch">Sucursal</label>
                  <select class="browser-default" name="branch" id="branch" required>
                    <?php
                          $sel2 = $con->query("SELECT * FROM branches");
                          while ($f = $sel2->fetch_assoc()) {  ?>
                       <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_branches) { echo 'selected'; } ?> > <?php echo $f['branch_name'] ?>-<?php echo $f['location'] ?></option>
                    <?php  } ?>
                  </select>

               </div>

               
       </div> <br>
                 <label for="name">Marca</label>
                   <select class="browser-default" name="brand_name" id="brand_name" required>
                     <option value='0' selected>Selecciona una marca</option>
                     <?php
                          $sel2 = $con->query("SELECT * FROM brands");
                          while ($f = $sel2->fetch_assoc()) {  ?>
                       <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_brand) { echo 'selected'; } ?> > <?php echo $f['name'] ?></option>
                    <?php  } ?>

                    </select>
               </div>

               <div class="row modal-form-row">
                 <label for="model_name">Modelo</label>
                   <select class="browser-default" name="model_name" id="model_name" required>
                   <?php
                          $sel2 = $con->query("SELECT * FROM model");
                          while ($f = $sel2->fetch_assoc()) {  ?>
                       <option value='<?php echo $f['id'] ?>' <?php if($f['id']==$id_model) { echo 'selected'; } ?> > <?php echo $f['name'] ?></option>
                    <?php  } ?>
                    </select>
               </div>


               




               <div class="row">
                 <div class="input-field col s12">
                   <input id="serie_number" type="text" class="validate" name="serie_number" value="<?php echo $series_number ?>">
                   <label for="serie_number">número de serie</label>
                 </div>
               </div>
               

               <input type="text" name="id_equipment" value="<?php echo $id_equipment ?>" hidden>
               <input type="text" name="id_linea" value="<?php echo $id_line ?>" hidden>

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
