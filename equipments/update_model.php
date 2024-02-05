<?php include '../extend/header.php';


$id = $_GET['id'];
$id_linea = $_GET['id_linea'];
$id_sublinea = $_GET['id_sublinea'];


$sel = $con->query("SELECT * FROM model WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $idx = $f['id_brand'];
  $pal_number = $f['pal_number'];
  $short_desc = $f['short_desc'];
  $long_desc = $f['long_desc'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles del modelo</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_model.php" method="post">
               <label for="model_name">Nombre</label>
               <input type="text" name="model_name" value="<?php echo $name ?>">

               <label for="model_name">Número de parte</label>
               <input type="text" name="pal_number" value="<?php echo $pal_number ?>">

               <label for="short_desc">Descripción corta</label>
               <input type="text" name="short_desc" value="<?php echo $short_desc ?>">

               <label for="long_desc">Descripción larga</label>
               <input type="text" name="long_desc" value="<?php echo $long_desc ?>">

               <input type="text" name="id" value="<?php echo $id ?>" hidden>

               <input type="text" name="idX" value="<?php echo $idx ?>" hidden>

               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>

     <div class="row" style="PADDING-TOP: 14PX;">
         <div class="col s12">
           <nav class="bg-dark">
             <div class="nav-wrapper">
               <div class="input-field">
                 <input type="search" id="buscar" autocomplete="off">
                 <label for="buscar"><i class="material-icons">search</i></label>
                 <i class="material-icons">close</i>
               </div>
             </div>
           </nav>
         </div>
       </div>



<div class="row">
<div class=" col s12">
<p style="color:grey;">Equipos</p>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_client.php" method="post">
             <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Número de serie</th>
                      <th>Sucursal</th>
                      <th>Editar</th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                   <?php
                     $sel2 = $con->query("SELECT * FROM equipment WHERE id_model = '$id' AND id_linea='$id_sublinea'");


                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                        <td><?php echo $f['series_number'] ?></td>
                        <td><?php 
                        
                        $id_branch=  $f['id_branches'];
                        
                        $sel3 = $con->query("SELECT * FROM branches WHERE id='$id_branch'");
                          while ($j = $sel3->fetch_assoc()) {
                            $branch_name=  $j['branch_name'];
                            $location=  $j['location'];
                          }
                          echo $branch_name.'-'.$location
                          ?></td>
                        <td><a href="update_equipment.php?id=<?php echo $idx?>&id_brand=<?php echo $id?>&id_equipment=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el equipo?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_equipment.php?id=<?php echo     $f['id'] ?>&idx=<?php echo     $id ?>'; } else { location.href='update_model.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>

                    <?php  } ?>

             <a href="add_equipment.php?id=<?php echo $id?>"> + Agregar</a>
             </form>
           </div>
         </div>
      </div>
     </div>

</div>
</div>

<?php include '../extend/scripts.php'; ?>
   </body>
   </html>
