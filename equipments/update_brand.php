<?php include '../extend/header.php';



$id = $_GET['id'];
$id_linea = $_GET['id_linea'];
$id_sublinea = $_GET['id_sublinea'];

$sel = $con->query("SELECT * FROM brands WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['name'];
  $idx = $f['id'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de la marca</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_brand.php" method="post">
               <label for="name">Nombre</label>
               <input type="text" name="name" value="<?php echo $name ?>" required>

               <input type="text" name="id" value="<?php echo $idx ?>" hidden>




               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
     </div>


<div class="row">
<div class=" col s12">
<p style="color:grey;">Modelos</p>
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_brand.php" method="post">
             <table class="excel responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th>Número de parte</th>
                      <th>Descripción corta</th>
                      <th>Descripción larga</th>
                      <th class="borrar">Editar</th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                   <?php
                     $sel2 = $con->query("SELECT * FROM model WHERE id_brand = '$id' AND id_linea='$id_linea' ");

                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td><?php echo $f['pal_number'] ?></td>
                        <td><?php echo $f['short_desc'] ?></td>
                        <td><?php echo $f['long_desc'] ?></td>
                        <td><a href="update_model.php?id=<?php echo $f['id']?>&id_linea=<?php echo $id_linea?>&id_sublinea=<?php echo $id_sublinea?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el modelo?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_model.php?id=<?php echo $f['id'] ?>&idx=<?php echo $id?>'; } else { location.href='update_brand.php?id=<?php echo $idx ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>

                    <?php  } ?>

             <a href="add_model.php?id=<?php echo $idx?>&id_linea=<?php echo $id_linea?>&id_sublinea=<?php echo $id_sublinea?>"> + Agregar</a>
             </form>
           </div>
         </div>
      </div>
     </div>

</div>

   <?php include '../extend/scripts.php'; ?>
   </body>
   </html>
