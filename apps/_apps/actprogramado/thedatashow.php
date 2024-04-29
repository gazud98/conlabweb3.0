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

        $cadena = "SELECT id,instrumento, descripcion,actividades,frecuencia,fecha,resultado, estado
             FROM u116753122_cw3completa.mantenimiento
             where id='" . $id . "'";


        // echo $cadena;


        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id=trim($filaP2['id']);                     
            $fecha=$filaP2['fecha'];                         
            $actividades=$filaP2['actividades'];
            $frecuencia=$filaP2['frecuencia'];
            $descripcion=$filaP2['descripcion'];
            $resultado=$filaP2['resultado'];
            $instrumento=$filaP2['instrumento'];
            $estado=$filaP2['estado'];
        }
    } else {
        $id = "";
        $fecha = "";
        $instrumento = "";
        $actividades = "";
        $descripcion = ""; 
        $frecuencia = "";
        $resultado = "";
        $estado = "";
        
    }
?>

    <div class="col-md-12 col-lg-12 p-1" name="iddatas" id="iddatas" style="pointer-events: none;">
        <div class="row bg-light p-2" name="accionejec" id="accionejec" style="text-align:center; font-weight:bold;display:none"></div><?php //Aqui se esceo lo que va a pasar 
                                                                                                                                        ?>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Codigo:</label>
                <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id" id="id" value="<?php echo $id; ?>"></input>
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Instrumento:</label>
                <input type="input" class="form-control" name="instrumento" id="instrumento" value="<?php echo $instrumento; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <img src='assets/image/qr.png'>
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Actividades:</label>
                <input type="input" class="form-control" name="actividades" id="actividades" value="<?php echo $actividades; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                 <label style="font-size: 12px;">Descripcion:</label>
                <input type="input" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3 ">
                 <label style="font-size: 12px;">Fecha:</label>
                <input type="input" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>"></input>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Resultado:</label>
                <input type="input" class="form-control" name="resultado" id="resultado" value="<?php echo $resultado; ?>"></input>
            </div>
        </div>


    </div>





<?php
}
?>
