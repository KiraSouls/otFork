<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

?>

<div class="row">
  <div class="col s12">
    <h4 class="header">Agregar tarea</h4>
    <div class="card horizontal">

      <div class="card-stacked">
        <div class="card-content">
          <form action="ins_task.php" method="post">

            <label for="name">Nombre de la tarea</label>
            <input type="text" name="name" value="" required>

            <label for="hours">Tiempo de la tarea (Minutos)</label>
            <input type="number" min="0" name="tiempo" required>


            <input type="text" name="id" value="<?php echo $id ?>" hidden>

            <button type="submit" class="btn light-blue darken-2">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>
</body>

</html>