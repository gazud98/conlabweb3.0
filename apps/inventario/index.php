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
    $nmbapp = "INVENTARIO";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    // echo $sctrl1;
   

    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  bodegaubcproducto";
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/inventario/assets/style.css">

    <div class="card border-light" style="width: 90%;margin:auto;">

        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Inventario</a>
                    </nav>
                        <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <h5 style="text-align: center; color: #0045A5;"><strong style="font-size:18px;">Listado de inventario</strong></h5>
                </div>
                <div class="col-md-4" style="text-align: center;">
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="thetable" name="thetable">

                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <?php


    include('apps/thedata.php'); //scriops de control
    ?>

    <script>
        $(document).ready(function() {


            $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/inventario/tabla.php');



        })
    </script>
<?php
}
?>