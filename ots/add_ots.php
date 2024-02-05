<?php include '../extend/header.php';
$number = $con->real_escape_string(htmlentities($_GET['number']));
?>

<div class="row" style="padding-top:10px;">
   <div class="col s12">
      <div class="card">
         <div class="card-content">
            <span class="card-title">Crear nueva orden</span>
            <form class="form" action="ins_ot.php" id="add_ot" method="post">

               <div class="row">
                  <div class="col s3">
                     <label for="client">Cliente</label>

                     <select class="browser-default" name="client" id="client" required>
                        <option value="0" selected>Selecciona un cliente</option>

                        <?php
                        $sel2 = $con->query("SELECT * FROM clients");
                        while ($f = $sel2->fetch_assoc()) {  ?>
                           <option value='<?php echo $f['id'] ?>'> <?php echo $f['name'] ?></option>
                        <?php  } ?>

                     </select>

                  </div>

                  <div class="col s7">
                     <label for="branch">Sucursal</label>
                     <select class="browser-default" name="branch" id="branch" required>
                     </select>

                  </div>

                  <div class=" col s2">
                     <label for="contact">Contacto</label>
                     <select class="browser-default" name="contact" id="contact" required>
                     </select>
                  </div>
               </div> <br>



               <div class="row">
                  <div class=" col s6">
                     <label for="service">Servicio</label>

                     <select class="browser-default" name="service" id="service" required>
                        <option value="" disabled selected>Selecciona servicio</option>

                        <?php
                        $sel2 = $con->query("SELECT * FROM services");
                        while ($f = $sel2->fetch_assoc()) {  ?>
                           <option value='<?php echo $f['id'] ?>'> <?php echo $f['service_name'] ?></option>
                        <?php  } ?>
                     </select>
                  </div>

               </div>



               <div class="row" style="overflow: auto;">

                  <table class="highlight striped responsive-table" id="dynamic_field">
                     <tr>
                        <td>
                           <div id="sublinea" class="col s12 hide">
                              <label for="subline">Sublinea</label>
                              <select style='width:300px;' class="browser-default" name="subline" id="subline">
                              </select>
                           </div>
                        </td>
                        <td>
                           <div id="equipo" class="col s12 equipo hide">
                              <label for="equipment">Equipo</label>
                              <select style='width: 300px;' class="browser-default" name="equipment" id="equipment">
                              </select>
                           </div>
                        </td>
                        <td>
                           <div class="col s12 right">
                              <label for="task">Tarea</label>
                              <select style="height:150px;width: 300px;" class="browser-default" name="task[]" id="task" multiple>
                              </select>
                           </div>
                        </td>
                        <td>
                           <div class="col s6 right">
                              <a id="add" class="btn-floating btn-large waves-effect waves-light light-blue darken-2 right hide"><i class="material-icons">add</i></a>
                           </div>
                        </td>
                     </tr>



                  </table>

               </div>


               <div class="row">
                  <div class=" col s6">
                     <label>Técnico</label>
                     <select class="browser-default" name="participants[]" id="participants" required multiple>
                     </select>
                  </div>

                  <div class="col s6">
                     <label>Encargado</label>
                     <select class="browser-default" name="leader" id="leader">

                     </select>

                  </div>
               </div>
               <input id="e_count" name="e_count" value="" type="text" hidden>
               <div class="row">
                  <div class="input-field col s12">
                     <textarea id="description" name="description" class="materialize-textarea" data-length="800"></textarea>
                     <label for="description">Descripción</label>
                  </div>
               </div>

               <div class="row">
                  <div class="col s6">
                     <label for="hours">Horas</label>

                     <input type="number" min="0" name="hours">

                  </div>
               </div>

               <div class="col s6">
                  <label for="task">Prioridad</label>
                  <select class="" name="priority">
                     <option value="alta">Alta</option>
                     <option value="media">Media</option>
                     <option value="baja">Baja</option>
                  </select>

               </div>

               <div class="row">
                  <div class=" col s12">
                     <p>
                        <input id="interna" type="radio" name="type" value="Laboratorio" checked />
                        <label for="interna">Laboratorio</label>
                     </p>

                     <p>
                        <input id="externa" type="radio" name="type" value="Terreno" checked />
                        <label for="externa">Terreno</label>
                     </p>

                     <p>
                        <input id="remota" type="radio" name="type" value="Remota" checked />
                        <label for="remota">Remota</label>
                     </p>

                  </div>
               </div>


               <input id="number" type="text" name="number" value="<?php echo $number ?>" hidden>

               <button class="btn light-blue darken-2" name="btn-guardar" id="btn-guardar">Crear</button>


            </form>

         </div>
      </div>
   </div>
</div>
<?php include '../extend/scripts.php'; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<script>
   $(document).ready(function() {
      // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
      $('.modal-trigger').leanModal();
   });

   $(document).ready(function() {
      $("#client").change(function() {


         $("#client option:selected").each(function() {
            id_client = $(this).val();
            $.post("data.php", {
               id_client: id_client
            }, function(data) {
               $("#branch").html(data);
            });
         });


      })

   });


   $(document).ready(function() {
      $("#brand_name").change(function() {


         $("#brand_name option:selected").each(function() {
            id_brand = $(this).val();
            $.post("data_model.php", {
               id_brand: id_brand
            }, function(data) {
               $("#model_name").html(data);
            });
         });


      })

   });

   $(document).ready(function() {
      $("#subline").change(function() {


         $("#subline option:selected").each(function() {
            id_subline = $(this).val();
            $.post("data_subline_equipment.php", {
               id_subline: id_subline,
               id_branch: id_branch
            }, function(data) {
               $("#equipment").html(data);
            });
         });


      })

   });






   $(document).ready(function() {
      $("#branch").change(function() {


         $("#branch option:selected").each(function() {
            id_branch = $(this).val();

            //   $.post("data_equipment.php", {id_branch: id_branch
            //   }, function(data) {
            //         $("#equipment").html(data);
            //         $("#equipment2").html(data);
            //         $("#equipment3").html(data);
            //         $("#equipment4").html(data);
            //         $("#equipment5").html(data);
            //         $("#equipment6").html(data);
            //         $("#equipment7").html(data);
            //         $("#equipment8").html(data);
            //         $("#equipment9").html(data);
            //         $("#equipment10").html(data);


            //   });
            $.post("data_contact.php", {
               id_branch: id_branch
            }, function(data) {
               $("#contact").html(data);
            });




         });


      })

   });




   $(document).ready(function() {
      $("#service").change(function() {


         $("#service option:selected").each(function() {
            id_service = $(this).val();


            $.post("data_tech.php", {
               id_service: id_service
            }, function(data) {
               $("#leader").html(data);
               $("#participants").html(data);
            });



            $.post("data_service.php", {
               id_service: id_service
            }, function(data) {
               $("#task").html(data);
               $("#task2").html(data);
               $("#task3").html(data);
               $("#task4").html(data);
               $("#task5").html(data);
               $("#task6").html(data);
               $("#task7").html(data);
               $("#task8").html(data);
               $("#task9").html(data);
               $("#task10").html(data);

            });

            $.post("data_equipment_show.php", {
               id_service: id_service
            }, function(data) {

               if (data == 1) {

                  var element = document.getElementById("sublinea");
                  element.classList.remove("hide");

                  var element = document.getElementById("equipo");
                  element.classList.remove("hide");

                  var element2 = document.getElementById("add");
                  element2.classList.remove("hide");
               } else {
                  var element = document.getElementById("sublinea");
                  element.classList.add("hide");

                  var element = document.getElementById("equipo");
                  element.classList.add("hide");
                  var element3 = document.getElementById("add");
                  element3.classList.add("hide");
               }
            });



            $.post("data_line.php", {
               id_service: id_service,
               id_branch: id_branch
            }, function(data) {
               $("#equipment").html(data);
               $("#equipment2").html(data);
               $("#equipment3").html(data);
               $("#equipment4").html(data);
               $("#equipment5").html(data);
               $("#equipment6").html(data);
               $("#equipment7").html(data);
               $("#equipment8").html(data);
               $("#equipment9").html(data);
               $("#equipment10").html(data);
            });

            $.post("data_subline.php", {
               id_service: id_service
            }, function(data) {
               $("#subline").html(data);
               $("#subline2").html(data);
               $("#subline3").html(data);
               $("#subline4").html(data);
               $("#subline5").html(data);
               $("#subline6").html(data);
               $("#subline7").html(data);
               $("#subline8").html(data);
               $("#subline9").html(data);
               $("#subline10").html(data);
            });
         });


      })

   });


   $(document).ready(function() {
      var i = 1;
      $('#add').click(function() {

         $.post("data_line.php", {
            id_service: id_service,
            id_branch: id_branch
         }, function(data) {

            for (f = 0; f < i; f++) {
               $("#equipment" + i).html(data);
            }

         });

         $.post("data_service.php", {
            id_service: id_service
         }, function(data) {

            for (f = 0; f < i; f++) {
               $("#task" + i).html(data);
            }

         });
         $.post("data_subline.php", {
            id_service: id_service
         }, function(data) {

            for (f = 0; f < i; f++) {
               $("#subline" + i).html(data);
            }
         });


         i++;
         $(document).ready(function() {
            $("#subline" + i).change(function() {


               $("#subline" + i + " option:selected").each(function() {
                  id_subline = $(this).val();
                  $.post("data_subline_equipment.php", {
                     id_subline: id_subline,
                     id_branch: id_branch
                  }, function(data) {
                     $("#equipment" + i).html(data);
                  });
               });


            })

         });


         document.getElementById('e_count').value = i;
         document.getElementById('equipo').value = i;

         $('#dynamic_field').
         append('<tr id="row' + i + '"> <td> <div id="sublinea' + i + '" class="col s12 " > <label for="subline' + i + '">Sublinea</label> <select style="width:300px;" class="browser-default" name="subline' + i + '" id="subline' + i + '" > </select> </div> </td><td> <div id="equipo" class="col s12 equipo" > <label for="equipment' + i + '">Equipo</label> <select style="width:300px;" class="browser-default" name="equipment' + i + '" id="equipment' + i + '"> </select> </div> </td> <td> <div class = "col s12 right"> <label for="task">Tarea</label> <select style="height:150px;width:300px;" class="browser-default" name="task' + i + '[]" id="task' + i + '" multiple> </select> </div> </td> <td> <div class = "col s6 right"> <a name="remove" id="' + i + '" class="btn-floating btn-large waves-effect waves-light light-blue darken-2 right btn_remove"><i class="material-icons">remove</i></a> </div> </td> </tr>');
      });

      $(document).on('click', '.btn_remove', function() {
         var button_id = $(this).attr("id");
         $('#row' + button_id + '').remove();
      });




   });
</script>

</body>

</html>