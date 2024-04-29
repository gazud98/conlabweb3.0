<?php
if (file_exists("../../config/global_config.php")) {
    include("../../config/accesosystems.php");
}
$filterfrom = "";
$filterwhere = "";
// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    /* */
    // $caso=$_REQUEST['caso'];
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        //$id=1;
        // echo $caso.'----'.$id;
        /* */

        $cadena = "SELECT id_orden,proveedor,estado,fecha, recibida, hora, nit_proveedor, plazo,pendientes,parcial_recibida
             FROM u116753122_cw3completa.orden_compra
             where id_orden='" . $id . "'";


        // echo $cadena;


        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_orden']);
            $nombre = trim($filaP2['proveedor']);
            $estado = trim($filaP2['estado']);
            $fecha = trim($filaP2['fecha']);
            $recibida = trim($filaP2['recibida']);
            $pendientes = trim($filaP2['pendientes']);
            $parcial_recibidas = trim($filaP2['parcial_recibida']);
            $hora = trim($filaP2['hora']);
            $nit_proveedor = trim($filaP2['nit_proveedor']);
            $plazo = trim($filaP2['plazo']);
        }
    } else {
        $id = "";
        $nombre = "";
        $estado = "";
        $fecha = "";
        $recibida = "";
        $pendientes = "";
        $parcial_recibidas = "";
        $hora = "";
        $nit_proveedor = "";
        $plazo = "";
    }
?>

    <div class="col-md-12 col-lg-12 p-1" name="iddatas" id="iddatas" style="pointer-events: none;">
        <div class="row bg-light p-2" name="accionejec" id="accionejec" style="text-align:center; font-weight:bold;display:none"></div><?php //Aqui se esceo lo que va a pasar 
                                                                                                                                        ?>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Numero:</label>
                <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id" id="id" value="<?php echo $id; ?>"></input>
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>
            <div class="col-md-1 col-lg-1">
                <label style="font-size: 12px;">Recibida:</label>
                <input <?php if ($recibida == 1) { echo "CHECKED ";} ?>
                type="checkbox" class="form-control" name="recibida" id="recibida" value="<?php echo $recibida; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <img src='assets/image/qr.png'>
            </div>
        </div>


        <div class="row mb-2">
           

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Fecha:</label>
                <input type="check" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>"></input>
                </select>
            </div>

            <div class="col-md-2 col-lg-2 ">
                <label style="font-size: 12px;">Hora:</label>
                <input type="check" class="form-control" name="hora" id="hora" value="<?php echo $hora; ?>"></input>
                </select>
            </div>
            <div class="col-md-2 col-lg-2 ">
                <label style="font-size: 12px;">Plazo:</label>
                <input type="check" class="form-control" name="plazo" id="plazo" value="<?php echo $plazo; ?>"></input>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">NIT Proveedor:</label>
                <input type="check" class="form-control" name="nit_proveedor" id="nit_proveedor" value="<?php echo $nit_proveedor; ?>"></input>
            </div>

            <div class="col-md-4 col-lg-4 ">
                <label style="font-size: 12px;">Proveedor:</label>
                <input type="check" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                </select>
            </div>
        </div>


    </div>





<?php
}
?>
