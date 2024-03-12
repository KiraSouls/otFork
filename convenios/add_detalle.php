<?php include '../extend/header.php';
$id = $con->real_escape_string(htmlentities($_GET['id']));
?>


<div class="row" style="padding-top:10px;">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Agregar Detalles de Convenio</span>
        <form class="form" action="ins_detalle.php" method="post">

          <div>
            <label for="service">Servicio</label>
            <select class="browser-default" name="service" id="service" required>
              <option value="" disabled selected>Selecciona servicio</option>
              <?php
              $sel2 = $con->query("SELECT * FROM services");
              while ($f = $sel2->fetch_assoc()) {  ?>
                <option value='<?php echo $f['id'] ?>'> <?php echo $f['service_name'] ?></option>
              <?php  } ?>
            </select>

          </div>



          <div>
            <label for="task">Tarea</label>
            <select style="height:150px;width: 300px;" class="browser-default" name="task[]" id="task" multiple>
            </select>
          </div>
          <br>

          <br>
          <input id="id" type="text" name="id" value="<?php echo $id ?>" hidden>
          <br>
          <br>
          <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Guardar</button>

        </form>
      </div>
    </div>
  </div>
</div>


<?php include '../extend/scripts.php'; ?>
<script>
  $(document).ready(function() {
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });


  $(document).ready(function() {
    $("#service").change(function() {
      $("#service option:selected").each(function() {
        id_service = $(this).val();

        $.post("data_service.php", {
          id_service: id_service
        }, function(data) {
          $("#task").html(data);
          $("#task2").html(data);
          $("#task3").html(data);
          $("#task4").html(data);
          $("#task5").html(data);
          $("#task6").html(data);
          $("#task7").html(data);
          $("#task8").html(data);
          $("#task9").html(data);
          $("#task10").html(data);
        });

      });
    })
  });
</script>
</body>

</html>