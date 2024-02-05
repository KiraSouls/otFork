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

<?php $sel = $con->query("select cl.name, b.branch_name, c.type, c.created_at, c.id from contrato c inner join clients cl on c.client=cl.id inner join branches b on b.id=c.branche");
$row = mysqli_num_rows($sel);
?>

<div class="row">
    <div class="col s12">
        <div class="card" style="min-height: 700px;">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <a class="right" style="padding: 10px;" href="../reclamo/add_contrato.php?number=<?php echo $name ?>"> + Agregar</a>
                    <span class="card-title">Contratos (<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>#ID</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                        <th class="borrar">Editar</th>
                        <th class="borrar">Eliminar</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $f['id'] ?></td>
                        <td><?php echo $f['name'] ?></td>
                        <td><?php echo $f['branch_name'] ?></td>
                        <td><?php echo $f['type'] ?></td>
                        <td><?php echo substr($f['created_at'], 0, 10) ?></td>
                        <!-- Ver -->
                        <td><a href="../reclamo/detail_contrato.php?id=<?php echo $f['id']?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td> 
                        <!-- Modificar -->
                        <td><a href="../reclamo/update_contrato.php?id=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <!-- Eliminar -->
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar este Contrato?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='../reclamo/delete_contrato.php?id=<?php echo $f['id'] ?>'; } else { location.href='../reclamo/contratos.php';} })"><i class="material-icons">clear</i></a></td>
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
