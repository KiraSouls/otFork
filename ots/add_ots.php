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
                           <div id="equipo" class="col s12 hide">
                              <label for="equipment">Equipo</label>
                              <select style='width: 300px;' class="browser-default" name="equipment" id="equipment">
                              </select>
                           </div>
                        </td>

                        <td>
                           <div id="tarea" class="col s12">
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

               <div id="det" class="row" style="border:1px solid #cfcfcf">
                  <div class="col s6">
                     <div>
                        <legend>¿El Equipo Posee Detalles?:</legend>
                        <div>
                           <input type="radio" id="detsi" name="deta" value="si" onclick="detalles('Y');" />
                           <label for="detsi">Si</label>
                        </div>
                        <div>
                           <input type="radio" id="detno" name="deta" value="no" onclick="detalles('N');" />
                           <label for="detno">No</label>
                        </div>
                     </div>


                     <div id="rayones" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Rayones?:</legend>
                           <div>
                              <input type="radio" id="raysi" name="raya" value="si" onclick="hideShowJacks('Y');" />
                              <label for="raysi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="rayno" name="raya" value="no" onclick="hideShowJacks('N');" />
                              <label for="rayno">No</label>
                           </div>
                           <div>
                              <textarea id="area" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>


                     <div id="rupturas" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Rupturas?:</legend>
                           <div>
                              <input type="radio" id="rupsi" name="rup" value="si" onclick="hideShowJacks2('Y');" />
                              <label for="rupsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="rupno" name="rup" value="no" onclick="hideShowJacks2('N');" />
                              <label for="rupno">No</label>
                           </div>
                           <div>
                              <textarea id="area2" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>


                     <div id="tornillos" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Todos Los Tornillos De Su Carcasa?:</legend>
                           <div>
                              <input type="radio" id="torsi" name="torn" value="si" onclick="hideShowJacks3('Y');" />
                              <label for="torsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="torno" name="torn" value="no" onclick="hideShowJacks3('N');" />
                              <label for="torno">No</label>
                           </div>
                           <div>
                              <textarea id="area3" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="gomas" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Las Gomas De La Base En Buen Estado?:</legend>
                           <div>
                              <input type="radio" id="gosi" name="go" value="si" onclick="hideShowJacks4('Y');" />
                              <label for="gosi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="gono" name="go" value="no" onclick="hideShowJacks4('N');" />
                              <label for="gono">No</label>
                           </div>
                           <div>
                              <textarea id="area4" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="toner" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Toner?:</legend>
                           <div>
                              <input type="radio" id="tonsi" name="ton" value="si" onclick="hideShowJacks11('Y');" />
                              <label for="tonsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="tonno" name="ton" value="no" onclick="hideShowJacks11('N');" />
                              <label for="tonno">No</label>
                           </div>
                           <div>
                              <textarea id="area11" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="drum" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Drum?:</legend>
                           <div>
                              <input type="radio" id="drsi" name="dru" value="si" onclick="hideShowJacks12('Y');" />
                              <label for="drsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="drno" name="dru" value="no" onclick="hideShowJacks12('N');" />
                              <label for="drno">No</label>
                           </div>
                           <div>
                              <textarea id="area12" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>




                     <div class="row hide" id="estado">
                        <div class="input-field col s12 ">
                           <textarea name="estado" placeholder="El Equipo (si/no) enciende..." class="materialize-textarea" data-length="800"></textarea>
                           <label for="estado">Indique El Estado Del Equipo</label>
                        </div>
                     </div>

                     <div class="row hide" id="obs">
                        <div class="input-field col s12 ">
                           <textarea name="obs" class="materialize-textarea" placeholder="El Equipo presenta..." data-length="800"></textarea>
                           <label for="obs">Observaciones Adicionales</label>
                        </div>
                     </div>
                  </div>
               </div>

               <div id="acc" class="row " style="border: 1px solid #cfcfcf">
                  <div class="col s6">
                     <div>
                        <legend>¿El Equipo Posee Accesorios:</legend>
                        <div>
                           <input type="radio" id="accsi" name="acce" value="si" onclick="accesorios('Y');" />
                           <label for="accsi">Si</label>
                        </div>
                        <div>
                           <input type="radio" id="accno" name="acce" value="no" onclick="accesorios('N');" />
                           <label for="accno">No</label>
                        </div>
                     </div>

                     <div id="cargador" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Cargador?:</legend>
                           <div>
                              <input type="radio" id="carsi" name="carga" value="si" onclick="hideShowJacks5('Y');" />
                              <label for="carsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="carno" name="carga" value="no" onclick="hideShowJacks5('N');" />
                              <label for="carno">No</label>
                           </div>
                           <div>
                              <textarea id="area5" placeholder="N° de serie del accesorio"></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="cable" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Cable de Poder?:</legend>
                           <div>
                              <input type="radio" id="podersi" name="poder" value="si" onclick="hideShowJacks6('Y');" />
                              <label for="podersi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="poderno" name="poder" value="no" onclick="hideShowJacks6('N');" />
                              <label for="poderno">No</label>
                           </div>
                           <div>
                              <textarea id="area6" placeholder="N° de serie del accesorio"></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="adaptador" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Adaptador de Poder?:</legend>
                           <div>
                              <input type="radio" id="adasi" name="adapt" value="si" onclick="hideShowJacks7('Y');" />
                              <label for="adasi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="adano" name="adapt" value="no" onclick="hideShowJacks7('N');" />
                              <label for="adano">No</label>
                           </div>
                           <div>
                              <textarea id="area7" placeholder="N° de serie del accesorio"></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="bateria" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Batería?:</legend>
                           <div>
                              <input type="radio" id="batsi" name="bat" value="si" onclick="hideShowJacks8('Y');" />
                              <label for="batsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="batno" name="bat" value="no" onclick="hideShowJacks8('N');" />
                              <label for="batno">No</label>
                           </div>
                           <div>
                              <textarea id="area8" placeholder="N° de serie del accesorio"></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="pantalla" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Pantalla En Mal Estado?:</legend>
                           <div>
                              <input type="radio" id="pansi" name="pant" value="si" onclick="hideShowJacks9('Y');" />
                              <label for="pansi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="panno" name="pant" value="no" onclick="hideShowJacks9('N');" />
                              <label for="panno">No</label>
                           </div>
                           <div>
                              <textarea id="area9" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>

                     <div id="teclado" class="row hide">
                        <div>
                           <legend>¿El Equipo Posee Teclado en Mal Estado?:</legend>
                           <div>
                              <input type="radio" id="tecsi" name="tec" value="si" onclick="hideShowJacks10('Y');" />
                              <label for="tecsi">Si</label>
                           </div>
                           <div>
                              <input type="radio" id="tecno" name="tec" value="no" onclick="hideShowJacks10('N');" />
                              <label for="tecno">No</label>
                           </div>
                           <div>
                              <textarea id="area10" placeholder="El Equipo presenta..."></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="input-field col s12">
                     <textarea id="description" name="description" class="materialize-textarea" data-length="800"></textarea>
                     <label for="description">Descripción De Orden</label>
                  </div>
               </div>
               <!-- Recuerda Editar La Hora - 09/02/2024 -->
               <div class="row">
                  <div class="col s6">
                     <label for="hours">Horas</label>

                     <input type="number" min="0" name="hours">

                  </div>
               </div>
               <div class="row">
                  <div class="col s6">
                     <label for="priority">Prioridad</label>
                     <select class="browser-default" name="priority">
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                     </select>

                  </div>
               </div>

               <div class="row">
                  <div class=" col s12">
                     <label for="type">Tipo</label>
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
<style>
   #area {
      display: none;
   }

   #area2 {
      display: none;
   }

   #area3 {
      display: none;
   }

   #area4 {
      display: none;
   }

   #area5 {
      display: none;
   }

   #area6 {
      display: none;
   }

   #area7 {
      display: none;
   }

   #area8 {
      display: none;
   }

   #area9 {
      display: none;
   }

   #area10 {
      display: none;
   }

   #area11 {
      display: none;
   }

   #area12 {
      display: none;
   }
</style>

<!-- funcion que esconde el textarea segun el radiobutton seleccionado -->
<script>
   function hideShowJacks(val) {
      if (val == "Y") {
         $("#area").show();
      } else {
         $("#area").hide();
      }
   }

   function hideShowJacks2(val) {
      if (val == "Y") {
         $("#area2").show();
      } else {
         $("#area2").hide();
      }
   }

   function hideShowJacks3(val) {
      if (val == "Y") {
         $("#area3").show();
      } else {
         $("#area3").hide();
      }
   }

   function hideShowJacks4(val) {
      if (val == "Y") {
         $("#area4").show();
      } else {
         $("#area4").hide();
      }
   }

   function hideShowJacks5(val) {
      if (val == "Y") {
         $("#area5").show();
      } else {
         $("#area5").hide();
      }
   }

   function hideShowJacks6(val) {
      if (val == "Y") {
         $("#area6").show();
      } else {
         $("#area6").hide();
      }
   }

   function hideShowJacks7(val) {
      if (val == "Y") {
         $("#area7").show();
      } else {
         $("#area7").hide();
      }
   }

   function hideShowJacks8(val) {
      if (val == "Y") {
         $("#area8").show();
      } else {
         $("#area8").hide();
      }
   }

   function hideShowJacks9(val) {
      if (val == "Y") {
         $("#area9").show();
      } else {
         $("#area9").hide();
      }
   }

   function hideShowJacks10(val) {
      if (val == "Y") {
         $("#area10").show();
      } else {
         $("#area10").hide();
      }
   }

   function hideShowJacks11(val) {
      if (val == "Y") {
         $("#area11").show();
      } else {
         $("#area11").hide();
      }
   }

   function hideShowJacks12(val) {
      if (val == "Y") {
         $("#area12").show();
      } else {
         $("#area12").hide();
      }
   }

   function detalles(val) {

      if (val == "Y") {

         var element = document.getElementById("rayones");
         element.classList.remove("hide");

         var element = document.getElementById("rupturas");
         element.classList.remove("hide");

         var element = document.getElementById("tornillos");
         element.classList.remove("hide");

         var element = document.getElementById("gomas");
         element.classList.remove("hide");

         var element = document.getElementById("estado");
         element.classList.remove("hide");

         var element = document.getElementById("obs");
         element.classList.remove("hide");

         var element2 = document.getElementById("add");
         element2.classList.remove("hide");

      } else {

         var element = document.getElementById("sublinea");
         element.classList.add("hide");

         var element = document.getElementById("equipo");
         element.classList.add("hide");

         var element = document.getElementById("tarea");
         element.classList.remove("hide");

         var element = document.getElementById("rayones");
         element.classList.add("hide");

         var element = document.getElementById("rupturas");
         element.classList.add("hide");

         var element = document.getElementById("tornillos");
         element.classList.add("hide");

         var element = document.getElementById("gomas");
         element.classList.add("hide");

         var element = document.getElementById("estado");
         element.classList.add("hide");

         var element = document.getElementById("obs");
         element.classList.add("hide");

         var element3 = document.getElementById("add");
         element3.classList.add("hide");
      }
   };

   function accesorios(val) {

      if (val == "Y") {

         var element = document.getElementById("cargador");
         element.classList.remove("hide");

         var element = document.getElementById("cable");
         element.classList.remove("hide");

         var element = document.getElementById("adaptador");
         element.classList.remove("hide");

         var element = document.getElementById("bateria");
         element.classList.remove("hide");

         var element = document.getElementById("pantalla");
         element.classList.remove("hide");

         var element = document.getElementById("teclado");
         element.classList.remove("hide");

         var element2 = document.getElementById("add");
         element2.classList.remove("hide");

      } else {

         var element = document.getElementById("cargador");
         element.classList.add("hide");

         var element = document.getElementById("cable");
         element.classList.add("hide");

         var element = document.getElementById("adaptador");
         element.classList.add("hide");

         var element = document.getElementById("bateria");
         element.classList.add("hide");

         var element = document.getElementById("pantalla");
         element.classList.add("hide");

         var element = document.getElementById("teclado");
         element.classList.add("hide");

         var element3 = document.getElementById("add");
         element3.classList.add("hide");
      }
   };
</script>


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

            //Esta funcion despliega los elementos visualmente dependiendo de si es servicio o laboratorio (0-1)

            $.post("data_equipment_show.php", {
               id_service: id_service
            }, function(data) {

               if (data == 1) {

                  var element = document.getElementById("sublinea");
                  element.classList.remove("hide");

                  var element = document.getElementById("equipo");
                  element.classList.remove("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.remove("hide");

                  var element = document.getElementById("acc");
                  element.classList.remove("hide");

                  var element = document.getElementById("toner");
                  element.classList.add("hide");

                  var element = document.getElementById("drum");
                  element.classList.add("hide");

                  var element2 = document.getElementById("add");
                  element2.classList.remove("hide");

               }
               if (data == 0) {
                  var element = document.getElementById("sublinea");
                  element.classList.add("hide");

                  var element = document.getElementById("equipo");
                  element.classList.add("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.add("hide");

                  var element = document.getElementById("acc");
                  element.classList.add("hide");

                  var element = document.getElementById("toner");
                  element.classList.add("hide");

                  var element = document.getElementById("drum");
                  element.classList.add("hide");

                  var element3 = document.getElementById("add");
                  element3.classList.add("hide");

               }
               if (data == 2) {
                  var element = document.getElementById("sublinea");
                  element.classList.remove("hide");

                  var element = document.getElementById("equipo");
                  element.classList.remove("hide");

                  var element = document.getElementById("tarea");
                  element.classList.remove("hide");

                  var element = document.getElementById("det");
                  element.classList.remove("hide");

                  var element = document.getElementById("acc");
                  element.classList.remove("hide");

                  var element = document.getElementById("toner");
                  element.classList.remove("hide");

                  var element = document.getElementById("drum");
                  element.classList.remove("hide");

                  var element2 = document.getElementById("add");
                  element2.classList.remove("hide");

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
         append('<tr id="row' + i + '"> <td> <div id="sublinea' + i + '" class="col s12 " > <label for="subline' + i + '">Sublinea</label> <select style="width:300px;" class="browser-default" name="subline' + i + '" id="subline' + i +
            '" > </select> </div> </td><td> <div id="equipo" class="col s12 equipo" > <label for="equipment' + i + '">Equipo</label> <select style="width:300px;" class="browser-default" name="equipment' + i + '" id="equipment' + i +
            '"> </select> </div> </td> <td> <div class = "col s12 right"> <label for="task">Tarea</label> <select style="height:150px;width:300px;" class="browser-default" name="task' + i + '[]" id="task' + i +
            '" multiple> </select> </div> </td> <td> <div class = "col s6 right"> <a name="remove" id="' + i + '" class="btn-floating btn-large waves-effect waves-light light-blue darken-2 right btn_remove"><i class="material-icons">remove</i></a> </div> </td> </tr>'
         );
      });

      $(document).on('click', '.btn_remove', function() {
         var button_id = $(this).attr("id");
         $('#row' + button_id + '').remove();
      });




   });
</script>

</body>

</html>