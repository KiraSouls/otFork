<?php include '../extend/header.php';

$id = $_GET['id_linea'];
$id_sublinea = $_GET['id_sublinea'];


$sel_subline = $con->query("SELECT * FROM sub_linea WHERE id = '$id_sublinea' ");

while ($j = $sel_subline->fetch_assoc()) {
  $name_subline = $j['name'];
}
?>

<div class="row">
      <div class="col s12">
      <p style="color:grey;">Detalles de la Sub linea</p>
      <div class="card horizontal">
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_subline.php" method="post">
               <label for="subline_name">Nombre</label>
               <input type="text" name="subline_name" value="<?php echo $name_subline ?>">

               <input type="text" name="id" value="<?php echo $id_sublinea ?>" hidden>


               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>


       <?php $sel = $con->query("SELECT DISTINCT name, id, linea_brands.id_relation FROM brands
                      INNER JOIN linea_brands
                      ON brands.id = linea_brands.id_brand
                      WHERE linea_brands.id_line = '$id_sublinea'");
        $row = mysqli_num_rows($sel);
        ?>
           <div class="row">
              <div class="col s12">
               <div class="card">
                 <div class="card-content">
                   
                  <span class="card-title">Marcas de la sub linea(<?php echo $row ?>)</span>
                  <input type="hidden" name="datos" id="datos">
                  </form>
                  <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th class="borrar">Editar</th>
                      <th class="borrar">Eliminar</th>
                      <th class="hide">id_relation</th>
                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) {
                       $id_relation = $f['id_relation']; ?>
                      <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td><a href="update_brand.php?id=<?php echo $f['id']?>&id_linea=<?php echo $id?>&id_sublinea=<?php echo $id_sublinea?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea desvincular la marca en esta linea?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_brand_line.php?id_relation=<?php echo $id_relation?>&id=<?php echo     $id ?>'; } else { location.href='update_line.php?id_linea=<?php echo     $id ?>';} })"><i class="material-icons">clear</i></a></td>
                        <td class="hide"><?php echo $f['id_relation'] ?></td>
                      </tr>
                    <?php } ?>
                  </table>
                 </div>
              </div>
             </div>
           </div>

           <?php $sel2 = $con->query("SELECT * from brands");
        $row = mysqli_num_rows($sel2);
        ?>
           <div class="row">
              <div class="col s12">
               <div class="card">
                 <div class="card-content">
                 <a class="right" style="padding: 10px;" href="add_brand.php"> + Agregar</a>
                   <form  action="excel.php" method="post" target="_blank" id="exportar">
                  <span class="card-title">Marcas del sistema(<?php echo $row ?>)</span>
                  <input type="hidden" name="datos" id="datos">
                  </form>
                  <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th class="borrar">Eliminar</th>
                    </thead>
                      <tr>
                      <?php  while ($l = $sel2->fetch_assoc()) {
                      ?>
                        <td><?php echo $l['name'] ?></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la marca del sistema?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_brand.php?id=<?php echo  $l['id'] ?>'; } else { location.href='update_line.php?id_linea=<?php echo     $id ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>
                      <?php } ?>
                  </table>
                 </div>
              </div>
             </div>
           </div>
<?php include '../extend/scripts.php'; ?>
  <script>
    $('.botonExcel').click(function(){
    $('.borrar').remove();
    $('#datos').val($("<div>").append($('.excel').eq(0).clone()).html());
    $('#exportar').submit();
    setInterval(function(){location.reload();}, 3000);
});
  </script>

</body>
</html>
