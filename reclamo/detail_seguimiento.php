<?php include '../extend/header.php';

$id = htmlentities($_GET['id']);

$sel = $con->query("select m.name as model, m.pal_number, e.series_number, c.name as client, b.branch_name from model m inner join equipment e on e.id_model=m.id inner join branches b on e.id_branches=b.id inner join clients c on b.id_clients=c.id where e.series_number='$id'");

while ($f = $sel->fetch_assoc()) {
    $id_client = $f['client'];
    $id_branch = $f['branch_name'];
    $model = $f['model'];    
    $part = $f['pal_number'];
    $series = $f['series_number'];
}
?>
<style type="text/css">
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>
<div class="row">
    <div class="col s12">
        <p style="color:grey;">Detalles de Equipo</p>
        <div style='overflow:auto;' class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <form action="up_tech.php" method="post">
                        <label for="name_clients"> Nombre del cliente</label>
                        <input disabled type="text" name="client_name" value="<?php echo $id_client; ?>" required>

                        <label for="email">Sucursal</label>
                        <?php $sel2 = $con->query("SELECT * FROM branches WHERE branch_name='$id_branch'");
                     while ($f = $sel2->fetch_assoc()) { 
                        $name_branch = $f['branch_name'];
                         $branch_name = $f['location']    ?>
                        <input disabled type="text" name="branch_name" value="<?php echo $f['branch_name']?>-<?php echo $f['location']?>" required>
                        <?php  } ?>

                        <label for="rut">Modelo</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $model?>" required>

                        <label for="rut">N° Parte</label>
                        <input disabled type="text" name="contact_name" value="<?php echo $part?>" required>

                        <label for="phone">N° Serie</label>
                        <input disabled type="text" name="type" value="<?php echo $series?>" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $sel_e = $con->query("SELECT * from equipment e where e.series_number='$series'");
while ($f = $sel_e->fetch_assoc()) {
    $id_e = $f['id'];
}                           
    
$sel = $con->query("select DISTINCT o.number, o.leader, o.created_at from tasks_equipments t inner join ots o on t.number_ot=o.number inner JOIN tasks ts on t.id_tasks=ts.id where t.id_equipment='$id_e' ORDER by o.created_at desc");
$row = mysqli_num_rows($sel);                               
?>
<div class="row">
    <div class="col s12">
        <div style="min-height:320px;" class="card">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <span class="card-title">Avances(<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>OT</th>
                        <th>Técnico</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $f['number'] ?></td>
                        <td><?php echo $f['leader'] ?></td>
                        <td><?php echo $f['created_at'] ?></td>
                        <td><a id="view" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td>
                    </tr>
                    <?php } ?>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <div style="min-height:320px;" class="card">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <span class="card-title">Detalle</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>OT</th>
                        <th>Tarea</th>
                        <th>Fecha</th>
                    </thead>
                    <tbody id="detalle">
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="row">
    <div class=" col s12">
        <p style="color:grey;">Documento de orden</p>
        <div class="card horizontal" style="padding: 10px;">
            <a href="orden_de_trabajo.php?location=<?php echo $location?>&contact_name=<?php echo $contact_name?>&comment=<?php echo $comment?>&client_name=<?php echo $client_name?>&leader=<?php echo $leader?>&description=<?php echo $description?>&ot_number=<?php echo $number_ot?>&id=<?php echo $id?>&created_at=<?php echo $created_at?>&type=<?php echo $type?>&status=<?php echo $status?>&name_branch=<?php echo $name_branch?>"> <button type="=submit" class="btn light-blue darken-2" name="button" id="btn-guardar">Generar</button>
            </a>
        </div>
    </div>
</div>-->

<?php include '../extend/scripts.php'; ?>
<script>
    $(document).on('click', '#view', function(event) {
        //Obtener Datos actuales del producto
        position = $(this).closest('tr').index();
        ot = $(this).parents("tr").find('td').eq(0).html();
        $.post("../reclamo/data_detalle.php", {
                ot: ot
            },
            function(data) {
                $("#detalle").html(data);
            });
    });

</script>
</body>

</html>
