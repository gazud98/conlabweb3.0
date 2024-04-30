<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
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

    include ('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "Lisatado de Proveedores";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM proveedores P" .
        $filterfrom .
        " where  1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
    ?>

    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/proveedor/assets/style.css">

    <style>
        #modalContent {
            width: 1500px;
            margin-left: -550px;
        }

        @media only screen and (max-width:700px) {
            #modalContent {
                width: 100%;
                margin-left: 0px;
            }
        }

        .content-wrapper {
            background-image: url('/cw3/conlabweb3.0/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

    <div class="card border-info" style="width:85%;margin:auto;">

        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                            <?php echo $moduraiz; ?>
                        </a>
                        <a href="#" class="breadcrumbs__item is-active" >
                                <?php echo $nmbapp; ?>
                            </a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado de Proveedores</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">
                    <button onclick="loadFormAddProvider()"
                        style="float: right;background-color:rgb(0,69,165);font-size:11px;" data-toggle="modal"
                        data-target="#modalAddProvider" type="button" class="btn btn-primary btn-xs">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo Proveedor
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="thetable">

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Add Provider -->
    <div class="modal fade" id="modalAddProvider" tabindex="-1" aria-labelledby="modalAddProviderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="contenFormAddProvider">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Provider -->
    <div class="modal fade" id="modalEditProvider" tabindex="-1" aria-labelledby="modalEditProviderLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditProviderLabel">Editar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="contenFormEditProvider">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include ('apps/thedata.php'); //scriops de control
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="/cw3/conlabweb3.0/apps/proveedor/assets/index.js"></script>

    <?php
}
?>