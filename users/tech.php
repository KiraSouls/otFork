<?php include '../extend/header_tech.php';

$name = $_SESSION['name'];
$tech_id = $_SESSION['id'];
?>





<?php $sel = $con->query("SELECT DISTINCT o.id, o.description, o.leader, o.status, o.created_at, o.number,
                                        cli.name,
                                        bra.location,
                                        ser.service_name,contact_name, id_service
                                  FROM  ots o
                                  INNER JOIN clients cli ON o.id_client = cli.id
                                  INNER JOIN branches bra ON o.id_branch = bra.id
                                  INNER JOIN services ser ON o.id_service = ser.id
                                  INNER JOIN participants par ON o.number = par.ot_number
                                  INNER JOIN contacts ON o.id_contact = contacts.id
                                  WHERE par.participant_name = '$name' OR par.users_id = '$tech_id' ORDER BY o.created_at desc");
$row = mysqli_num_rows($sel);
?>

<div class="row">
  <div class="col s12">
    <div class="card" style="min-height: 700px;">
      <div class="card-content">
        <form action="excel.php" method="post" target="_blank" id="exportar">
          <span class="card-title">Ordenes(<?php echo $row ?>)</span>
          <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
          <input type="hidden" name="datos" id="datos">
        </form>
        <table id="ot_techs" class="display">
          <thead>
            <th>#Orden</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Responsable</th>
            <th>Contacto</th>
            <th>estado</th>
            <th>Fecha</th>
            <th>Ver</th>
            <th>Actividad</th>
          </thead>
          <?php while ($f = $sel->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $f['number'] ?></td>
              <td><?php echo $f['name'] . "-" . $f['location'] ?></td>
              <td><?php echo $f['service_name'] ?></td>
              <td><?php echo $f['leader'] ?></td>
              <td><?php echo $f['contact_name'] ?></td>
              <td><?php echo $f['status'] ?></td>
              <td><?php echo $f['created_at'] ?></td>
              <?php if ($f['status'] == "iniciada") { ?>
                <td><a href="ot.php?id=<?php echo $f['id'] ?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td> <?php
                                                                                                                                              }
                                                                                                                                              if ($f['status'] == "pendiente") { ?>
                <td><a href="ot.php?id=<?php echo $f['id'] ?>" class="btn-floating yellow"><i class="material-icons">remove_red_eye</i></a></td>
              <?php  }
                                                                                                                                              if ($f['status'] === "finalizada") { ?>
                <td><a href="ot.php?id=<?php echo $f['id'] ?>" class="btn-floating grey"><i class="material-icons">remove_red_eye</i></a></td><?php } ?>
              <?php if ($f['leader'] == $name) { ?>
                <td><a href="add_activity_tech.php?id=<?php echo $f['id'] ?>&id_service=<?php echo $f['id_service'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">plus_one</i></a></td>
              <?php } else { ?>
                <td><a href="add_activity_tech.php?id=<?php echo $f['id'] ?>&id_service=<?php echo $f['id_service'] ?>" class="btn-floating light-blue darken-2" disabled><i class="material-icons">plus_one</i></a></td>
              <?php }  ?>
            </tr>

          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>



<?php include '../extend/scripts.php'; ?>


</body>




</html>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function() {
    $('#ot_techs').DataTable({

      responsive: true,
      order: [
        [0, 'desc']
      ],
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }

    });
  });
</script>
