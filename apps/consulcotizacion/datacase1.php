<?php
//si hay consulta
//     presntadio n par todos los departamento

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    //echo '..............................'.$_REQUEST['id'].'...';

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    
    $nombre = "";
    $recibida = "";
    $pendientes = "";
    $parcial_recibida = "";
    $fecha = "";
    $hora = "";
    $nit_proveedor = "";
    $plazo = "";
    $estado = "";


    if ($id != "") {
        $cadena = "select id, recibida,pendientes,parcial_recibida, fecha, hora,nit_proveedor,plazo,proveedor,estado
                    from u116753122_cw3completa.orden_compra
                    where id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $nombre = trim($filaP2['proveedor']);
            $recibida = $filaP2['recibida'];
            $pendientes = $filaP2['pendientes'];
            $parcial_recibida = $filaP2['parcial_recibida'];
            $fecha = $filaP2['fecha'];
            $hora = $filaP2['hora'];
            $nit_proveedor = $filaP2['nit_proveedor'];
            $plazo = $filaP2['plazo'];
            $estado = $filaP2['estado'];
        }
    }

?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row mb-2">

            <div class="col-md-12 col-lg-12 ">
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-4 ">
                        <label style="font-size: 12px;">Numero:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                    <div class="col-md-4 col-lg-4 ">
                        <label style="font-size: 12px;">Fecha:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " name="fecha" id="fecha" value="<?php echo $fecha; ?>"></input>
                    </div>
                  
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6">
                        <label style="font-size: 12px;">NIT Proveedor:</label>
                        <input type="input" class="form-control" name="nit_proveedor" id="nit_proveedor" value="<?php echo $nit_proveedor; ?>"></input>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <label style="font-size: 12px;">Proveedor:</label>
                        <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                    </div>
                </div>
            </div>
        </div>




        <div class="row mb-2">
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Hora:</label>
                <input type="input" class="form-control" name="hora" id="hora" value="<?php echo $hora; ?>"></input>
            </div>

            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Plazo:</label>
                <input type="input" class="form-control" name="plazo" id="plazo" value="<?php echo $plazo; ?>"></input>
            </div>
        </div>



    </form>


<?php
}
?>