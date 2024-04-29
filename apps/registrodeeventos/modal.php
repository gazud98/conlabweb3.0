<?php
if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

    $cadena = "SELECT evento
    FROM  u116753122_cw3completa.eventos where id=" . $id;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $evento = $filaP2['evento'];
           

?>


            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <label>Evento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:rgb(97,100,103)"><?php echo $evento ?></span></label>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 col-lg-12">
                    <label>Resultado:</label>
                    <textarea class="form-control" name="observacion" id="observacion"></textarea>
                    <input type="input" name="ide" id="ide" value="<?php echo $id ?>"  style="display: none;"></input>

                </div>
            </div>

    <?php }
    } ?>

<?php } ?>

<script>
    function terminarEvento() {
        observacion = $("#observacion").val();
        id = $("#ide").val();
        
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/registrodeeventos/terminar_evento.php',
                data: {
                    observacion: observacion,
                    id: id
                },
                success: function(respuesta) {

                    $("#thetable").load('https://cw3.tierramontemariana.org/apps/registrodeeventos/thedatatable.php');
                    alert("¡Evento Cerrado exitosamente!");
                }
            });
      
    }
</script>