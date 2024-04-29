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

        $cadena = "SELECT id_proveedores,nombre_comercial,estado, id_tipo_identificacion,dv,direccion,telefono,pais,plazo_dias,ciudad,id_idioma,email,id_email,numero_identificacion
             FROM u116753122_cw3completa.proveedores
             where id_proveedores='" . $id . "'";


        // echo $cadena;


        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_proveedores']);
            $nombre = trim($filaP2['nombre_comercial']);
            $estado = trim($filaP2['estado']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $dv = trim($filaP2['dv']);
            $direccion = trim($filaP2['direccion']);
            $telefono = trim($filaP2['telefono']);
            $pais = trim($filaP2['pais']);
            $plazo_dias = trim($filaP2['plazo_dias']);
            $ciudad = trim($filaP2['ciudad']);
            $id_idioma = trim($filaP2['id_idioma']);
            $email = trim($filaP2['email']);
            $id_email = trim($filaP2['id_email']);
            $numero_identificacion = trim($filaP2['numero_identificacion']);
        }
    } else {
        $id = "";
        $nombre = "";
        $estado = "";
        $id_tipo_identificacion = "";
        $dv = "";
        $direccion = "";
        $telefono = "";
        $pais = "";
        $plazo_dias = "";
        $ciudad = "";
        $id_idioma = "";
        $email = "";
        $id_email = "";
        $numero_identificacion = "";
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
                <img src='assets/image/qr.png'>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Tipo de Documento:</label>
                <select class="form-control" aria-label="Default select example" name="id_empleado" id="id_empleado">
                    <?php
                    $cadena = "SELECT id_tipo_identificacion, name
                                                    FROM u116753122_cw3completa.tipo_identificacion
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_tipo_identificacion']) . "'";
                            if (trim($filaP2a['id_tipo_identificacion']) == $id_tipo_identificacion) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">ID:</label>
                <input type="input" class="form-control" name="numero_identificacion" id="numero_identificacion" value="<?php echo $numero_identificacion; ?>"></input>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Razon Social:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Dia Verificacion:</label>
                <input type="input" class="form-control" name="dv" id="dv" value="<?php echo $dv; ?>"></input>
            </div>
            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Plazo en Dias:</label>
                <input type="input" class="form-control" name="plazo_dias" id="plazo_dias" value="<?php echo $plazo_dias; ?>"></input>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Direccion:</label>
                <input type="input" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Teléfono:</label>
                <input type="input" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Pais:</label>
                <input type="input" class="form-control" name="pais" id="pais" value="<?php echo $pais; ?>"></input>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Ciudad:</label>
                <input type="input" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
            </div>
        </div>

        <div class="row mb-2">

            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Idioma:</label>
                <select class="form-control" aria-label="Default select example" name="id_empleado" id="id_empleado">
                    <?php
                    $cadena = "SELECT id_idioma, nombre
                                                    FROM u116753122_cw3completa.idiomas
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_idioma']) . "'";
                            if (trim($filaP2a['id_idioma']) == $id_idioma) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3 col-lg-3">
                <label style="font-size: 12px;">Email:</label>
                <input type="input" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
            </div>

            <div class="col-md-1 col-lg-1 mt-4" style="text-align: center;">
                <label>@</label>
            </div>

            <div class="col-md-3 col-lg-3 mt-4">
                <select class="form-control" aria-label="Default select example" name="id_empleado" id="id_empleado">
                    <?php
                    $cadena = "SELECT id_email, nombre
                                                    FROM u116753122_cw3completa.emails
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_email']) . "'";
                            if (trim($filaP2a['id_email']) == $id_email) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label style="color: rgb(1,103,183);font-size: 14px;"><strong>Contacto</strong></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
            <label style="font-size: 12px;">Nombre Completo:</label>
                <input type="input" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
            </div>
        </div>

    </div>





<?php
}
?>
