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

<?php $sel = $con->query("select m.name as model, m.pal_number, e.series_number, c.name as client, b.branch_name from model m inner join equipment e on e.id_model=m.id inner join branches b on e.id_branches=b.id inner join clients c on b.id_clients=c.id");
$row = mysqli_num_rows($sel);
?>

<div class="row">
    <div class="col s12">
        <div class="card" style="min-height: 700px;">
            <div class="card-content">
                <form action="excel.php" method="post" target="_blank" id="exportar">
                    <span class="card-title">Seguimientos (<?php echo $row ?>)</span>
                    <button class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                    <input type="hidden" name="datos" id="datos">
                </form>
                <table class="excel striped responsive-table" border="1">
                    <thead>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Modelo</th>
                        <th>N° Parte</th>
                        <th>N° Serie</th>
                        <th>Ver</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $f['client'] ?></td>
                        <td><?php echo $f['branch_name'] ?></td>
                        <td><?php echo $f['model'] ?></td>
                        <td><?php echo $f['pal_number'] ?></td>
                        <td><?php echo $f['series_number'] ?></td>
                        <!-- Ver -->
                        <td><a href="../reclamo/detail_seguimiento.php?id=<?php echo $f['series_number']?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td>
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
