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
    $nmbapp = "CREACION DE EVENTOS";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.grupo_activos" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
                </div>
                <div class="col-md-6 col-lg-6">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-md-12 col-lg-12">
                <div class="row mb-2">


                    <div class="col-md-12 col-lg-12" id="data">
                        <?php include('buscar.php');
                        ?>

                    </div>


                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-lg-4">

                        <div class="col-md-12 col-lg-12" id="tabs">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active">Grupos Activos Fijos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">Activos Fijos</a>
                                </li>

                            </ul>
                        </div>


                        <div class="col-md-12 col-lg-12" style="overflow:scroll; overflow-x:auto;height:350px; width:100%;" name="table" id="table">
                            <?php  ?>

                            <div class="text-nowrap" id="thenavigation" name="thenavigation"></div><?php // aqui ca la navegacion y filtro btn 
                                                                                                    ?>
                        </div>


                    </div>

                    <div class="col-md-5 col-lg-5">

                        <div name="tabla_grupoactsg" id="tabla_grupoactsg">
                            <?php include('tabla_grupoactsg.php');
                            ?>


                        </div>


                    </div>
                    <div class="col-md-3 col-lg-3" id="tableevento">
                        <?php include('table_eventos.php');
                        ?>
                    </div>


                    <div>
                        <?php include('modal_evento.php'); ?>
                    </div>





                </div>
            </div>

            <div class="card-footer bg-light">
                <div id="btnreq" style="text-align:center;">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="btneven" disabled>
                        Crear Evento
                    </button>
                </div>

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