<?php include '../extend/header.php'; ?>








<?php $sel = $con->query("SELECT o.id, o.description, o.leader, o.status, o.created_at, o.number,
                                        cli.name,
                                        bra.location,
                                        ser.service_name
                                  FROM  ots o
                                  INNER JOIN clients cli ON o.id_client = cli.id
                                  INNER JOIN branches bra ON o.id_branch = bra.id
                                  INNER JOIN services ser ON o.id_service = ser.id ORDER BY o.created_at desc");
$row = mysqli_num_rows($sel);
?>

<div class="row">
    <div class="col s12">
        <div class="card" style="min-height: 700px;">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <a class="right" style="padding: 10px;" href="add_ots.php?number=<?php echo $row ?>"> + Agregar</a>
                    <span class="card-title">Ordenes(<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="display" id="ot_tabledata" name="ot_tabledata">
                    <thead>
                        <th>#Orden</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Servicio</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                        <th class="borrar">Editar</th>
                        <th class="borrar">Eliminar</th>

                    </thead>
                    <?php while ($f = $sel->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $f['number'] ?></td>
                            <td><?php echo $f['name'] ?></td>
                            <td><?php echo $f['location'] ?></td>
                            <td><?php echo $f['service_name'] ?></td>
                            <td><?php echo $f['leader'] ?></td>

                            <td>
                                <?php if ($f['status'] == 'iniciada') { ?>
                                    <span class='task-cat green'><?php echo $f['status'] ?></span> <?php }
                                                                                                if ($f['status'] == 'finalizada') {
                                                                                                    ?>
                                    <span class='task-cat grey'><?php echo $f['status'] ?></span>
                                <?php  }
                                                                                                if ($f['status'] == 'pendiente') { ?>
                                    <span class='task-cat yellow'><?php echo $f['status'] ?></span>
                                <?php } ?>
                            </td>

                            <td><?php echo $f['created_at'] ?></td>
                            <?php if ($f['status'] == "iniciada") { ?>
                                <td><a href="detail_ot.php?id=<?php echo $f['id'] ?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td>
                            <?php
                            }
                            if ($f['status'] == "pendiente") { ?>
                                <td><a href="detail_ot.php?id=<?php echo $f['id'] ?>" class="btn-floating yellow"><i class="material-icons">remove_red_eye</i></a></td>
                            <?php  }
                            if ($f['status'] === "finalizada") { ?>
                                <td><a href="detail_ot.php?id=<?php echo $f['id'] ?>" class="btn-floating grey"><i class="material-icons">remove_red_eye</i></a></td><?php } ?>
                            <td><a href="update_ot.php?id=<?php echo $f['id'] ?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>

                            <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar esta orden?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_ot.php?id=<?php echo     $f['id'] ?>'; } else { location.href='index.php';} })"><i class="material-icons">clear</i></a></td>
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
        $('#ot_tabledata').DataTable({

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
