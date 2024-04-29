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

        $cadena = "SELECT id_estuche, id_reactivo,reactivo,descripcion,instrumento,fecha_apertura,fecha_expiracion,presentacion,no_lote,fabricante,referencia_fabricante,pruebas_nominales,valor_reactivo,usuario,estado
             FROM u116753122_cw3completa.estuches
             where id_estuche='" . $id . "'";


        // echo $cadena;


        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id_estuche=trim($filaP2['id_estuche']);                   
                    $id_reactivo=$filaP2['id_reactivo'];     
                    $reactivo=$filaP2['reactivo'];                  
                    $descripcion=$filaP2['descripcion'];
                    $instrumento=$filaP2['instrumento'];
                    $fecha_apertura=$filaP2['fecha_apertura'];
                    $fecha_expiracion=$filaP2['fecha_expiracion'];
                    $presentacion=$filaP2['presentacion'];
                    $no_lote=$filaP2['no_lote'];
                    $fabricante=$filaP2['fabricante'];
                    $referencia_fabricante=$filaP2['referencia_fabricante'];
                    $pruebas_nominales=$filaP2['pruebas_nominales'];
                    $valor_reactivo=$filaP2['valor_reactivo'];
                    $usuario=$filaP2['usuario'];
                    $estado=$filaP2['estado'];
        }
    } else {
        $id_estuche="";
        $id_reactivo = "";
        $reactivo = "";
        $descripcion = "";
        $instrumento = "";
        $fecha_apertura = "";
        $fecha_expiracion = "";
        $presentacion = "";
        $no_lote = "";
        $fabricante = "";
        $referencia_fabricante = "";
        $pruebas_nominales = "";
        $valor_reactivo = "";
        $usuario = "";
        $estado = "";
    }
?>

    <div class="col-md-12 col-lg-12 p-1" name="iddatas" id="iddatas" style="pointer-events: none;">
        <div class="row bg-light p-2" name="accionejec" id="accionejec" style="text-align:center; font-weight:bold;display:none"></div><?php //Aqui se esceo lo que va a pasar 
                                                                                                                                        ?>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Codigo Estuche:</label>
                <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id_estuche" id="id_estuche" value="<?php echo $id_estuche; ?>"></input>
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Codigo Reactivo</label>
                <input type="input" class="form-control" style="border:thin solid transparent; " disabled name="id_reactivo" id="id_reactivo" value="<?php echo $id_reactivo; ?>"></input>
                <?php if ($estado == '0') {
                    echo "<span style='color:red;'> Inhabilitado</span>";
                } ?>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <img src='assets/image/qr.png'>
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Descripcion:</label>
                <input type="input" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Instrumento</label>
                <input type="input" class="form-control" name="instrumento" id="instrumento" value="<?php echo $instrumento; ?>"></input>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fecha Apertura:</label>
                <input type="input" class="form-control" name="fecha_apertura" id="fecha_apertura" value="<?php echo $fecha_apertura; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Fecha Expiracion</label>
                <input type="input" class="form-control" name="fecha_expiracion" id="fecha_expiracion" value="<?php echo $fecha_expiracion; ?>"></input>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Presentacion:</label>
                <input type="input" class="form-control" name="presentacion" id="presentacion" value="<?php echo $presentacion; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">No. Lote</label>
                <input type="input" class="form-control" name="no_lote" id="no_lote" value="<?php echo $no_lote; ?>"></input>
            </div>

        </div>

        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Fabricante:</label>
                <input type="input" class="form-control" name="fabricante" id="fabricante" value="<?php echo $fabricante; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Ref. Fabricante</label>
                <input type="input" class="form-control" name="referencia_fabricante" id="referencia_fabricante" value="<?php echo $referencia_fabricante; ?>"></input>
            </div>

        </div>

        <div class="row mb-2">
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Pruebas Nominales:</label>
                <input type="input" class="form-control" name="pruebas_nominales" id="pruebas_nominales" value="<?php echo $pruebas_nominales; ?>"></input>
            </div>

            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Valor Reactivo</label>
                <input type="input" class="form-control" name="valor_reactivo" id="valor_reactivo" value="<?php echo $valor_reactivo; ?>"></input>
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Usuario</label>
                <input type="input" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>"></input>
            </div>

           

        </div>

    </div>





<?php
}
?>
