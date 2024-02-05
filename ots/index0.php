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




       <?php $sel = $con->query("SELECT o.id, o.description, o.leader, o.status, o.created_at, o.number,
                                        cli.name,
                                        bra.location,
                                        ser.service_name
                                  FROM  ots o
                                  INNER JOIN clients cli ON o.id_client = cli.id
                                  INNER JOIN branches bra ON o.id_branch = bra.id
                                  INNER JOIN services ser ON o.id_service = ser.id");
        $row = mysqli_num_rows($sel);
        ?>

           <div class="row">
              <div class="col s12">
               <div class="card">
                 <div class="card-content">
                   <form  action="excel.php" method="post" target="_blank" id="exportar">
                   <a class="right" style="padding: 10px;" href="add_ots.php?number=<?php echo $row ?>"> + Agregar</a>
                  <span class="card-title">Ordenes(<?php echo $row ?>)</span>
                  <button  class="btn-floating light-blue darken-2 botonExcel"><i class="material-icons">grid_on</i></button>
                  <input type="hidden" name="datos" id="datos">
                  </form>
                  <table class="excel striped" border="1">
                    <thead>
                      <th>#Orden</th>
                      <th>Cliente</th>
                      <th>Servicio</th>
                      <th>Responsable</th>
                      <th>estado</th>
                      <th>Fecha</th>
                      <th>Ver</th>
                      <th class="borrar">Editar</th>
                      <th class="borrar">Eliminar</th>

                    </thead>
                    <?php  while ($f = $sel->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $f['number'] ?></td>
                        <td><?php echo $f['name'] ?></td>
                        <td><?php echo $f['service_name'] ?></td>
                        <td><?php echo $f['leader'] ?></td>
                        <td><?php echo $f['status'] ?></td>
                        <td><?php echo $f['created_at'] ?></td>
                        <?php if($f['status'] == "iniciada"){?>
                        <td><a href="detail_ot.php?id=<?php echo $f['id']?>" class="btn-floating green"><i class="material-icons">remove_red_eye</i></a></td> <?php
                        }if ($f['status'] == "pendiente"){ ?>
                          <td><a href="detail_ot.php?id=<?php echo $f['id']?>" class="btn-floating yellow"><i class="material-icons">remove_red_eye</i></a></td>
                      <?php  }if($f['status'] === "finalizada"){ ?>
                        <td><a href="detail_ot.php?id=<?php echo $f['id']?>" class="btn-floating red"><i class="material-icons">remove_red_eye</i></a></td><?php }?>
                        <td><a href="update_ot.php?id=<?php echo $f['id']?>" class="btn-floating light-blue darken-2"><i class="material-icons">settings_applications</i></a></td>

                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el cliente?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_ots.php?id=<?php echo     $f['id'] ?>'; } else { location.href='index.php';} })"><i class="material-icons">clear</i></a></td>
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
