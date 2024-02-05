<?php include '../extend/header.php';

$id = $_GET['id_linea'];

$selX = $con->query("SELECT * FROM linea WHERE id = '$id' ");

while ($K = $selX->fetch_assoc()) {
  $name = $K['name'];
}
?>

<div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de linea</p>
      <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_line.php" method="post">
               <label for="model_name">Nombre</label>
               <input type="text" name="line_name" value="<?php echo $name ?>">

               <input type="text" name="id" value="<?php echo $id ?>" hidden>


               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>

     <?php $sel = $con->query("SELECT DISTINCT * FROM sub_linea
                      WHERE id_line = '$id'");
        $row = mysqli_num_rows($sel);
        ?>
           <div class="row">
              <div class="col s12">
              <p style="color:grey;">sub lineas</p>
               <div class="card">
                 <div class="card-content">
                   <form  action="excel.php" method="post" target="_blank" id="exportar">
                   <a class="right" style="padding: 10px;" href="add_subline.php?id=<?php echo $id ?>"> + Agregar</a>
                  <span class="card-t
.itle">Sub lineas(<?php echo $row ?>)</span>
                  <input type="hidden" name="datos" id="datos">
                  </form>
                  <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th class="borrar">Editar</th>
                      <th class="borrar">Marca</th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td><a href="update_line.php?id=<?php echo $f['id']?>&id_linea=<?php echo $id?>&id_sublinea=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td> <a href="add_brand_line.php?id=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">add</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la sub linea?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_subline.php?id=<?php echo $f['id'] ?>'; } else { location.href='update_subline.php?id_linea=<?php echo     $id ?>';} })"><i class="material-icons">clear</i></a></ocatd>
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
