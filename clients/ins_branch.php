<?php include '../extend/header.php';


$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM branches WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $id_clients = $f['id_clients'];
  $location = $f['location'];
  $phone = $f['phone'];
  $idx = $f['id'];
  $name = $f['branch_name'];
}
?>

   <div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de la sucursal</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="update_branch.php" method="post">
               <label for="name">Nombre</label>
               <input type="text" name="name" value="<?php echo $name ?>">
               <label for="location">Ubicación</label>
               <input type="text" name="location" value="<?php echo $location ?>">
               <label for="phone">Teléfono</label>
               <input type="text" name="phone" value="<?php  echo $phone ?>">
               <input type="text" name="id" value="<?php echo $idx ?>" hidden>
               <input type="text" name="idx" value="<?php echo $id ?>" hidden>
               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>

<div class="row">
<div class=" col s12">
<p style="color:grey;">Contactos</p>
       <div class="card horizontal" style="overflow:auto;">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_client.php" method="post">
             <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Departamento</th>
                      <th>Cargo </th>
                      <th>Editar </th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                   <?php
                     $sel2 = $con->query("SELECT * FROM contacts WHERE id_branches = '$id' ");


                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                        <td><?php echo $f['contact_name'] ?></td>
                        <td><?php echo $f['phone'] ?></td>
                        <td><?php echo $f['email'] ?></td>
                        <td><?php echo $f['department'] ?></td>
                        <td><?php echo $f['charge'] ?></td>
                        <td><a href="up_contact.php?id= <?php echo $f['id']?> " class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el contacto?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_contact.php?id=<?php echo     $f['id'] ?>&idx=<?php echo     $id ?>'; } else { location.href='ins_branch.php?id=<?php echo $idx ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>

                    <?php  } ?>

             <a href="add_contact.php?id=<?php echo $id?>"> + Agregar</a>
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
