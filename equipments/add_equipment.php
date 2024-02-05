<?php include '../extend/header.php';
$id = htmlentities($_GET['id']);
?>
   <div class="row">
      <div class="col s12">
        <p>Agregar equipo</p> 
       <div class="card horizontal">

         <div class="card-stacked">
           <div class="card-content">
             <form  action="ins_equipment.php" method="post">
               <div class="row modal-form-row">
               <div class = "row">
               <div class = "col s6">
               <label for = "client">Cliente</label>

                     <select class="browser-default" name="client" id="client" required>
                     <option value="0" selected>Selecciona un cliente</option>

                     <?php
                           $sel2 = $con->query("SELECT * FROM clients");
                           while ($f = $sel2->fetch_assoc()) {  ?>
                        <option value='<?php echo $f['id'] ?>' > <?php echo $f['name'] ?></option>
                     <?php  } ?>

                     </select>

               </div>

               <div class = "col s6">
                  <label for="branch">Sucursal</label>
                  <select class="browser-default" name="branch" id="branch" required>
                  </select>

               </div>

               
       </div> <br>
       
                   <label for="linea_name">Linea</label>
                   <select class="browser-default" name="linea" id="linea" required>
                     <option value='0' selected>Selecciona una linea</option>
                   <?php
                         $sel2 = $con->query("SELECT * FROM linea");
                         while ($f = $sel2->fetch_assoc()) {  ?>
                      <option value="<?php echo $f['id'] ?>" ><?php echo $f['name'] ?></option>
                   <?php  } ?>

                    </select> <br>
                    <label for="linea_name">Sub linea</label>
                   <select class="browser-default" name="linea_name" id="linea_name" required>
                     <option value='0' selected>Selecciona una sub linea</option>
             

                    </select> <br>
                  <label for="name">Marca</label>
                   <select class="browser-default" name="brand_name" id="brand_name" required>
                     <option value='0' selected>Selecciona una marca</option>
                    </select>
               </div>

               

               <div class="row modal-form-row">
                 <label for="model_name">Modelo</label>
                   <select class="browser-default" name="model_name" id="model_name" required>
                    </select>
               </div>


              




               <div class="row">
                 <div class="input-field col s12">
                   <input id="serie_number" type="text" class="validate" name="serie_number">
                   <label for="serie_number">número de serie</label>
                 </div>
               </div>
             

              <input type="text" name="id" value="<?php echo $id ?>" hidden>

               <button  type="submit" class="btn light-blue darken-2">Guardar</button>
             </form>
           </div>
         </div>
      </div>
     </div>
</div>

   <?php include '../extend/scripts.php'; ?>
  <script>
  $(document).ready(function () {
   $("#client").change( function () {


      $("#client option:selected").each(function () {
         id_client = $(this).val();
         $.post("../ots/data.php", {id_client: id_client
         }, function(data) {
               $("#branch").html(data);
         });
      });


   })

});

$(document).ready(function () {
   $("#linea_name").change( function () {


      $("#linea_name option:selected").each(function () {
         id_subline = $(this).val();
         $.post("data_subline.php", {id_subline: id_subline
         }, function(data) {
               $("#brand_name").html(data);
         });
      });


   })

});

$(document).ready(function () {
     $("#linea").change( function () {


        $("#linea option:selected").each(function () {
           id_linea = $(this).val();
           $.post("data_line.php", {id_linea: id_linea
           }, function(data) {
                 $("#linea_name").html(data);
           });
        });


     })

  });

  $(document).ready(function () {
     $("#brand_name").change( function () {

      $("#linea_name option:selected").each(function () {
         id_sublinea = $(this).val();
         });

        $("#brand_name option:selected").each(function () {
           id_brand = $(this).val();
           $.post("data_model_and_line.php", {id_brand: id_brand, id_sublinea: id_sublinea
           }, function(data) {
                 $("#model_name").html(data);
           });
        });


     })

  });
  </script>
   </body>
   </html>
