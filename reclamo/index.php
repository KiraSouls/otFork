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

<?php $sel = $con->query("select r.id, c.name as client, 
    b.branch_name, r.status, 
    co.contact_name, u.name, t.name as tecnico, 
    e.description, r.created_at from reclamo r 
    inner join clients c on r.id_client=c.id 
    inner join branches b on r.id_branch=b.id 
    inner join contacts co on r.id_contact=co.id 
    inner join users u on r.id_users=u.id 
    inner join techs t on r.id_tech=t.id 
    inner join estado_reclamo e on r.status=e.id ORDER BY r.created_at desc");
$row = mysqli_num_rows($sel);
?>

<div class="row">
    <div class="col s12">
        <div class="card" style="min-height: 700px;">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <a class="right" style="padding: 10px;" href="../reclamo/add_reclamo.php?number=<?php echo $name ?>"> + Agregar</a>
                    <span class="card-title">Reclamos (<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                        <th class="borrar">Editar</th>
                        <th class="borrar">Eliminar</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $f['id'] ?></td>
                        <td><?php echo $f['client'] ?></td>
                        <td><?php echo $f['tecnico'] ?></td>
                        <td>
                    <?php if ($f['status'] == 1) { ?>
                            <span class='task-cat green'><?php echo $f['description'] ?></span> 
                    <?php }else if ($f['status'] == 2) { ?>
                            <span class='task-cat grey'><?php echo $f['description'] ?></span>
                    <?php } else if ($f['status'] == 3){ ?>
                            <span class='task-cat yellow'><?php echo $f['description'] ?></span>
                    <?php } ?>
                        </td>
                        <td><?php echo substr($f['created_at'], 0, 10) ?></td>
                        <!-- Ver -->
                        <?php if($f['status'] == 1){?>
                        <td><a href="../reclamo/detail_reclamo.php?id=<?php echo $f['id']?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td> <?php
                        }if ($f['status'] == 2){ ?>
                        <td><a href="../reclamo/detail_reclamo.php?id=<?php echo $f['id']?>" class="btn-floating yellow"><i class="material-icons">remove_red_eye</i></a></td>
                        <?php  }if($f['status'] === 3){ ?>
                        <td><a href="../reclamo/detail_reclamo.php?id=<?php echo $f['id']?>" class="btn-floating grey"><i class="material-icons">remove_red_eye</i></a></td><?php }?>
                        <!-- Modificar -->
                        <td><a href="../reclamo/update_reclamo.php?id=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <!-- Eliminar -->
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar este reclamo?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='../reclamo/delete_reclamo.php?id=<?php echo $f['id'] ?>'; } else { location.href='../reclamo/index.php';} })"><i class="material-icons">clear</i></a></td>
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
