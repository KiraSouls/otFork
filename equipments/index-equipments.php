<?php include '../extend/header.php'; ?>



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




       <?php $sel = $con->query("SELECT * FROM linea");
        $row = mysqli_num_rows($sel);
        ?>

           <div class="row">
              <div class="col s12">
               <div class="card">
                 <div class="card-content">
                   <form  action="excel.php" method="post" target="_blank" id="exportar">
                   <a class="right" style="padding: 10px;" href="add_line.php"> + Agregar</a>
                  <span class="card-title">Lineas(<?php echo $row ?>)</span>
                  <input type="hidden" name="datos" id="datos">
                  </form>
                  <table class="excel striped responsive-table" border="1">
                    <thead>
                      <th>Nombre</th>
                      <th class="borrar">Editar</th>
                      <th class="borrar">Eliminar</th>

                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                      <tr>               

                        <td><?php echo $f['name'] ?></td>
                        <td><a href="update_subline.php?id_linea=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar la linea?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_line.php?id=<?php echo     $f['id'] ?>'; } else { location.href='index.php';} })"><i class="material-icons">clear</i></a></td>
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
