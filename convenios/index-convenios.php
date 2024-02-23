<?php
include '../extend/header.php';
?>
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



<?php
//$sel = $con->query("SELECT * FROM convenios");
$sel = $con->query("SELECT c.id, c.number, c.visitas_presenciales, c.visitas_emergencia, c.soporte_remoto, c.estado, c.created_at,
cli.name
FROM  convenios c
INNER JOIN clients cli ON c.id_cliente = cli.id ORDER BY c.created_at desc
");
$row = mysqli_num_rows($sel);
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <form action="excel.php" method="post" target="_blank" id="exportar">
          <a class="right" style="padding: 10px;" href="../convenios/add_conv.php?number=<?php echo $row ?>"> + Agregar</a>
          <span class="card-title">Convenios(<?php echo $row ?>)</span>
          <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
          <input type="hidden" name="datos" id="datos">
        </form>
        <table class="excel striped responsive-table" border="1">
          <thead>
            <th>Numero Convenio</th>
            <th>Cliente</th>
            <th>Visitas Presenciales</th>
            <th>Visitas de Emergencia</th>
            <th>Soporte Remoto</th>
            <th>Estado</th>
            <th class="borrar">Editar</th>
            <th class="borrar">Eliminar</th>

          </thead>
          <?php while ($f = $sel->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $f['number'] ?></td>
              <td><?php echo $f['name'] ?></td>
              <td><?php echo $f['visitas_presenciales'] ?></td>
              <td><?php echo $f['visitas_emergencia'] ?></td>
              <td><?php echo $f['soporte_remoto'] ?></td>
              <td><?php echo $f['estado'] ?></td>
              <td><a href="../convenios/update_conv.php?id=<?php echo $f['id'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
              <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el cliente?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_conv.php?id=<?php echo     $f['id'] ?>'; } else { location.href='index-convenios.php';} })"><i class="material-icons">clear</i></a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include '../extend/scripts.php'; ?>
<script>
  $('.botonExcel').click(function() {
    $('.borrar').remove();
    $('#datos').val($("<div>").append($('.excel').eq(0).clone()).html());
    $('#exportar').submit();
    setInterval(function() {
      location.reload();
    }, 3000);
  });
</script>

</body>

</html>