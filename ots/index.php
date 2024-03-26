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
                        <th>Cotizacion</th>
                        <th>Ver</th>
                        <th class="borrar">Editar</th>
                        <th class="borrar">Eliminar</th>

                    </thead>
                    <tbody>

                    </tbody>
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
    $(document).on('click', 'a.delete', function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        warnBeforeRedirect(linkURL);
    });

    function warnBeforeRedirect(linkURL) {
        swal({
            title: "¿Deseas Eliminar?",
            text: "Si das click a Ok, se perderán datos.",
            type: "warning",
            showCancelButton: true,
        }).then(function(result) {
            console.log(result);
            if (result.value) {
                window.location.href = linkURL;
            }
        });
    }

    $(document).ready(function() {
        $('#ot_tabledata').DataTable({


            /* --datatable-- */
            "ajax": {
                "url": "datos_tabla_ot.php",
                "dataSrc": ""

            },
            "columns": [{
                    "data": "number",
                }, {
                    "data": "name",
                }, {
                    "data": "location",
                }, {
                    "data": "service_name",
                }, {
                    "data": "leader",
                }, {
                    "data": "status",
                    "render": function(data, type, row) {
                        var statusHtml = '';

                        if (row.status === 'iniciada') {
                            statusHtml = '<span class="task-cat green">' + row.status + '</span>';
                        } else if (row.status === 'finalizada') {
                            statusHtml = '<span class="task-cat grey">' + row.status + '</span>';
                        } else if (row.status === 'pendiente') {
                            statusHtml = '<span class="task-cat yellow">' + row.status + '</span>';
                        }

                        return statusHtml;
                    }
                }, {
                    "data": "created_at",
                },
                {
                    "data": "cotizacion",
                }, {
                    // Botón "Ver"
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="detail_ot.php?id=' + row.id + '" class="btn-floating grey"><i class="material-icons">remove_red_eye</i></a>';
                    }
                },
                {
                    // Botón "Editar"
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="update_ot.php?id=' + row.id + '" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a>';
                    }
                },
                {
                    // Botón "Eliminar"
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="delete_ot.php?id= ' + row.id + '" class="btn-floating red delete"><i class="material-icons">clear</i></a>';

                    }
                }
            ],
            /* ---- */

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
