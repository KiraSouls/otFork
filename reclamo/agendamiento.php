<?php include '../extend/header.php'; 
$name = $_SESSION['name'];
//phpinfo();?>

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

<?php $sel = $con->query("select e.id, o.number, c.name, b.branch_name, b.location, o.leader, e.dia, e.hora, o.status, ser.service_name from ejecucion_ot e 
inner join ots o on e.ot=o.number inner join clients c on c.id=o.id_client inner join branches b on b.id=o.id_branch 
INNER JOIN services ser ON o.id_service = ser.id");
$row = mysqli_num_rows($sel);
?>

<div class="row">
    <div class="col s12">
        <div class="card" style="min-height: 700px;">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <a class="right" style="padding: 10px;" href="../reclamo/add_agendamiento.php?number=<?php echo $name ?>"> + Agregar</a>
                    <span class="card-title">Agendamiento (<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>#OT</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th class="borrar">Editar</th>
                        <th class="borrar">Eliminar</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $f['number'] ?></td>
                        <td><?php echo  $f['name']."-".$f['location'] ?></td>
                        <td><?php echo $f['service_name'] ?></td>
                        <td><?php echo $f['leader'] ?></td>
                        <td>
                            <?php if ($f['status'] == 'iniciada') {?>
                            <span class='task-cat green'><?php echo $f['status'] ?></span> 
                            <?php }if ($f['status'] == 'finalizada') { ?>
                            <span class='task-cat grey'><?php echo $f['status'] ?></span>
                            <?php  }  if ($f['status'] == 'pendiente'){ ?>
                            <span class='task-cat yellow'><?php echo $f['status'] ?></span>
                            <?php } ?>
                        </td>
                        <td><?php echo substr($f['dia'], 0, 10) ?></td>
                        <td><?php echo $f['hora'] ?></td>
                        <!-- Modificar -->
                        <td><a href="../reclamo/update_agendamiento.php?id=<?php echo $f['number']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <!-- Eliminar -->
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar este Agendamiento?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='../reclamo/delete_agendamiento.php?id=<?php echo $f['id'] ?>'; } else { location.href='../reclamo/agendamiento.php';} })"><i class="material-icons">clear</i></a></td>
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
