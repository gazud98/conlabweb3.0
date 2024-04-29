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
    $id_categoria_producto = "1"; //esa ctivo fijo
    $id_departamento = "";
    $id_sede = "";
    $id_tipo_activo = "";
    $nombre = "";
    $descripcion = "";
    $estado = "";
}


if ($id != "") {
    $cadena = "select id,id_departamento,id_sede,id_tipo_activo,nombre,descripcion,estado
                    from u116753122_cw3completa.grupo_activos
                    where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $id_departamento = trim($filaP2['id_departamento']);
        $id_sede = trim($filaP2['id_sede']);
        $id_tipo_activo = trim($filaP2['id_tipo_activo']);
        $nombre = trim($filaP2['nombre']);
        $descripcion = trim($filaP2['descripcion']);
        $estado = trim($filaP2['estado']);
    }
}

?>

<form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
    <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


    <div class="row mb-2">

        <div class="col-md-12 col-lg-12 ">
            <div class="row mb-2">
                <div class="col-md-6 col-lg-6 " id="codigo">
                    <label style="font-size: 12px;">Codigo:</label>
                    <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                </div>
                <!--  <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Es Predeterminada</label>
                        <select class="form-control" name="predeterminada" id="predeterminada">
                            <?php
                            echo "<option value='0'";
                            if ('0' == $predeterminada) {
                                echo ' selected';
                            }
                            echo '>NO</option>';
                            echo "<option value='1'";
                            if ('1' == $predeterminada) {
                                echo ' selected';
                            }
                            echo '>SI</option>';
                            ?>
                        </select>
                    </div>-->
            </div>
            <div class="col-md-12 col-lg-12">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
            </div>
            <div class="col-md-12 col-lg-12">
                <label style="font-size: 12px;">Descripcion:</label>
                <input type="input" class="form-control" name="descripcion" id="descripcion" value="<?php echo $nombre; ?>"></input>
            </div>
        </div>
    </div>


    <div class="row mb-2">
        <div class="col-md-6 col-lg-6">
            <label style="font-size: 12px;">Sedes</label>
            <select class="form-control" name="id_sedes" id="id_sedes">
            <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id_sedes,nombre
                                                    FROM u116753122_cw3completa.sedes
                                                    where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                        if (trim($filaP2a['id_sedes']) == $id_sede) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-6 col-lg-6">
            <label style="font-size: 12px;">Departamentos</label>
            <select class="form-control" name="id_departamento" id="id_departamento">
            <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id,nombre
                                                    FROM u116753122_cw3completa.departamentos
                                                    where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $id_departamento) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6 col-lg-6">
            <label style="font-size: 12px;">Tipos Activos Fijos</label>

            <select class="form-control" name="id_tipo_activo" id="id_tipo_activo">
            <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id,nombre
                                                    FROM u116753122_cw3completa.tipo_activo_fijos
                                                    where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $id_tipo_activo) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>


</form>



<script>
    function savedata() {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/creargrupoasactivos/crud.php',
            data: $('#formcontrol').serialize(),
            success: function(respuesta) {
                if (respuesta == 'ok') {
                    //                     alert('Termiando');
                }
                $("#codigo").load('https://cw3.tierramontemariana.org/apps/creargrupoasactivos/codigo.php', {});
                $("#thetable").load('https://cw3.tierramontemariana.org/apps/creargrupoasactivos/thedatatable.php');
                alert("Registro Exitoso");
            }
        });


        inhabilitacmpos();
    } //de alvar datos
</script>