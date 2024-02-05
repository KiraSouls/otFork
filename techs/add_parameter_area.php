<?php include '../extend/header.php'; ?>
<div class="row">
      <div class="col s12">
      <p style="color:grey;">Agregar nueva area al sistema</p>
      <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_parameter_area.php" method="post">
             
               <label for="nueva_area">Nombre de area</label>
               <input type="text" name="nueva_area" value="" required>

               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
     </div>



<div class="row">
<div class=" col s12">
<p style="color:grey;">Areas</p>
<a href="add_area.php?id=<?php echo $id?>"> + Agregar</a>
             <a class="right" href="add_parameter_area.php"> + Abrir nueva area</a>
       <div class="card horizontal">
        
         <div class="card-stacked">
           <div class="card-content">
             <form  action="up_client.php" method="post">
             <table class="excel" border="1"> 
                    <thead>
                      <th>Nombre</th>
                    <th class="borrar">Eliminar</th>
                    </thead>
                   <?php 
                     $sel2 = $con->query("SELECT * FROM parameter_area");

                     
                     while ($f = $sel2->fetch_assoc()) {  ?>
                        <tr>
                        <td><?php echo $f['name'] ?></td>
                        <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({ title:'Esta seguro que desea eliminar el cliente?',text: 'Se perderan los datos!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminar'}).then(function (isConfirm) {
                         if(isConfirm.value){  location.href='delete_area.php?id=<?php echo $f['id'] ?>'; } else { location.href='add_parameter_area.php?id=<?php echo $id ?>';} })"><i class="material-icons">clear</i></a></td>
                      </tr>
                      
                    <?php } ?>
                    </table>             
             

             </form>
             
           </div>
           
         </div>
      </div>
     </div>
</div>
<?php include '../extend/scripts.php'; ?>


</body>
</html>
