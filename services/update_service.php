<?php include '../extend/header.php';



$id = htmlentities($_GET['id']);

$sel = $con->query("SELECT * FROM services WHERE id = '$id' ");

while ($f = $sel->fetch_assoc()) {
  $name = $f['service_name'];
  $id = $f['id'];
}
?>

<div class="row">
  <div class="col s12">
    <p style="color:grey;">Detalles de servicio</p>
    <div class="card horizontal">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_service.php" method="post">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo $name ?>" required>

            <input type="text" name="id" value="<?php echo $id ?>" hidden>

            <button type="submit" class="btn light-blue darken-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class=" col s12">
    <p style="color:grey;"> Tareas</p>
    <div class="card horizontal">

      <div class="card-stacked">
        <div class="card-content">
          <form action="up_client.php" method="post">
            <table class="excel striped" border="1">
              <thead>
                <th>Nombre Tarea</th>
                <th>Tiempo Tarea (Minutos)</th>
                <th class="borrar">Eliminar</th>
              </thead>
              <?php
              $sel2 = $con->query("SELECT * FROM tasks WHERE id_service = '$id' ");


              while ($f = $sel2->fetch_assoc()) {  ?>
                <tr>
                  <td><?php echo $f['name'] ?></td>
                  <td><?php echo $f['tiempo'] ?></td>
                  <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la tarea?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_task.php?id=<?php echo $f['id'] ?>&idx=<?php echo $id ?>'; } else { location.href='update_service.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
                </tr>

              <?php  } ?>

              <a href="add_task.php?id=<?php echo $id ?>"> + Agregar</a>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>




<?php include '../extend/scripts.php'; ?>


</body>

</html>