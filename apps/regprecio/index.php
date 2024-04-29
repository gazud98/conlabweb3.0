<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "REGISTRO DE PRECIOS";

    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.cotizacion_insumos" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
?>

    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light ">
            <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
        </div>

        <div class="card-body" id="cuerpo" name="cuerpo">

            <div class="row ">
                <div class="col-md-12 col-lg-12" style="overflow:scroll; overflow-x:auto;height:350px; width:100%;">
                    <div name="table" id="table"></div>


                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12" >
                    <div class="text-nowrap" id="thenavigation" name="thenavigation"></div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light">
            <?php include('piepag.php'); //zoan de botornes
            ?>
        </div>
    </div>

    <?php
    include('thefinder.php'); //modal de busqueda personalizado

    include('apps/thedata.php'); //scriops de control
    ?>

    <script>
        $(document).ready(function() {
            obtener();
        });

        function obtener() {

            $("#table").load("<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>");

        }
    </script>
<?php
}
?>