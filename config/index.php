<?php include '../extend/header.php'; ?>
       <div class="row">
<div style="    margin-top: 0px;" class="card">
  <nav class="nav-extended" style="background-color: #181d2b;">
<div class="nav-content">
  <ul class="tabs tabs-transparent">
    <li class="tab"><a class="active" href="#test2">Servicios</a></li>
  </ul>
</div>
</nav>



<div id="test1" class="col s12">

</div>
<div id="test2" class="col s12">
  <div class="row">
     <div class="col s12">
      <p>Configurar servicios</p>
      <div class="card horizontal">

        <div class="card-stacked">
          <div class="card-content">
            <form  action="service_config.php" method="post">

            <label for="name">Servicios</label>
              <select class="service browser-default" name="service" id="service" required>
              <option value="0" selected>Selecciona un servicio</option>

              <?php
                    $sel2 = $con->query("SELECT * FROM services");
                    while ($f = $sel2->fetch_assoc()) {  ?>
                 <option value="<?php echo $f['id'] ?>" ><?php echo $f['service_name'] ?></option>
              <?php  } ?>

               </select>

               <div class = "row">
                       <div class ="col s12" id="equipment">
                         <label for="type">Requiere equipo</label>
                           <p>
                             <input id = "true" type = "radio" name = "equipo"
                                value = "1" checked />
                             <label for = "true">si</label>
                           </p>

                          <p>
                             <input id = "false" type = "radio" name = "equipo"
                                value = "0" />
                             <label for = "false">no</label>
                          </p>



                       </div>
                    </div>

                    



              <button  type="submit" class="btn light-blue darken-2">Guardar</button>
            </form>
          </div>
        </div>
     </div>
    </div>
</div>
</div>



<div id="test2" class="col s12">
  <div class="row">
     <div class="col s12">
      <p>Configurar servicios</p>
      <div class="card horizontal">

        <div class="card-stacked">
          <div class="card-content">
            <form  action="up_service_config.php" method="post">

            <label for="name">Servicios</label>
              <select class="service browser-default" name="service" id="service" required>
              <option value="0" selected>Selecciona un servicio</option>

              <?php
                    $sel2 = $con->query("SELECT * FROM services");
                    while ($f = $sel2->fetch_assoc()) {  ?>
                 <option value="<?php echo $f['id'] ?>" ><?php echo $f['service_name'] ?></option>
              <?php  } ?>

               </select>
<br>
                <label for="sub_linea">Sub linea</label>

               <select class="service browser-default" name="sub_linea" id="sub_linea" required>
              <option value="0" selected>Selecciona una sublinea</option>

              <?php
                    $sel2 = $con->query("SELECT * FROM sub_linea");
                    while ($f = $sel2->fetch_assoc()) {  ?>
                 <option value="<?php echo $f['id'] ?>" ><?php echo $f['name'] ?></option>
              <?php  } ?>

               </select>
           

                    



              <button  type="submit" class="btn light-blue darken-2">Guardar</button>
            </form>
          </div>
        </div>
     </div>
    </div>
</div>
</div>
</div>

</div>

<?php include '../extend/scripts.php'; ?>
<script>


$(document).ready(function () {
   $("#service").change( function () {


      $("#service option:selected").each(function () {
         id_service = $(this).val();
         $.post("data_equipment_needed.php", {id_service: id_service
         }, function(data) {
               $("#equipment").html(data);
         });
      });


   })

});</script>
</body>
</html>
