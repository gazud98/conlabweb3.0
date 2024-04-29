<?php


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

$id_users = $_SESSION['id_users'];

//echo $id_users;
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');


    // echo $sctrl1;
    $nmbapp = "Centros Médicos";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  cw3completa.sedes" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;

    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }


    $id = "";
    $nombre = "";
    $direccion = "";
    $estado = "1";


    if ($id != "") {
        $cadena = "SELECT id_centro, nombre_centro, direccion_centro, estado
        FROM  u116753122_cw3completa.centros_medicos WHERE id_centro = '" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_centro']);                      
            $nombre = $filaP2['nombre_centro'];
            $direccion = $filaP2['direccion_centro'];
            $estado = $filaP2['estado'];
        }
    }
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

    </head>

    <body>

        <div class="content-table">

            <div class="table-wrapper">
                <div class="table-title" style="padding: 30px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <nav class="breadcrumbs">
                                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Centros Médicos</a>
                                </nav>
                                <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 10px">
                            <h4><strong>Creación de Centros Médicos</strong></h4>
                        </div>
                        <div class="col-md-4">
                            <a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal" style="background-color: rgb(0,69,165);"><i class="fa-solid fa-plus"></i><span>Nuevo</span></a>
                            <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>-->
                        </div>
                    </div>
                </div>

                <div class="content-table-sedes">

                </div>

            </div>

        </div>
        <!-- Edit Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Centro Médico</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="input" class="form-control" name="nombre" id="nombre">
                            </div>
                            <div class="form-group">
                                <label>Dirección:</label>
                                <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="2"></textarea>
                            </div>
                            <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                            <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editsedeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Centro Médico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="formeditar" action="#" method="POST">
                        <div class="modal-body" id="editCentroMedico">
                            
                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" value="Aceptar">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("apps/thedata.php") ?>

        <script>
            $(document).ready(function() {


                $('.content-table-sedes').load('https://cw3.tierramontemariana.org/apps/centrosmedicos/thedatatable.php');



            })
        </script>

    </body>

    </html>

<?php
}
?>