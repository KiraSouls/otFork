<?php include '../extend/header.php';
$number = $con-> real_escape_string(htmlentities($_GET['number']));
?>

<div class="row" style="padding-top:10px;">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Agendar OT</span>
                <form class="form" action="../reclamo/ins_agendamiento.php" id="add_ot" method="post">
                    <div class="row">
                        <div class="col s3">
                            <label for="client">OT</label>
                            <input type="number" min="0" name="ot">
                        </div>
                        
                        <div class="col s3">
                            <label for="client">Día</label>
                            <input type="date" min="0" name="dia">
                        </div>
                        
                        <div class="col s3">
                            <label for="client">Hora</label>
                            <input type="time" min="0" name="hora">
                        </div>
                    </div> <br>

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

</script>

</body>

</html>
