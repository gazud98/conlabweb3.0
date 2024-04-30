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


    // echo $sctrl1;
    $nmbapp = "MÉDICOS";
    $moduraiz = $_SESSION['moduraiz'];
    //echo ".................".$sctrl4."-----------";
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    $id = "";
    $id_tipo_identificacion = "";
    $documento = "";
    $nombres = "";
    $apellidos = "";
    $id_tipo_genero = "";
    $fecha_nacimiento = "";
    $registro_medico = "";
    $especialidad = "";
    $email = "";
    $telefono = "";
    $movil = "";
    $entidades_ads = "";
    $comentarios = "";
    $centro_medico = "";
    $direccion = "";
    $ciudad = "";
    $departamento = "";
    $aficiones = "";
    $categoria = "";
    $secretaria = "";
    $fecha_secretaria = "";
    $estado = "";

    if ($id != "") {
        $cadena = "SELECT id_medicos, id_tipo_identificacion, documento, nombres, apellidos, id_tipo_genero, 
        fecha_nacimiento, registro_medico, especialidad, email, telefono, movil, entidades_ads, comentarios, centro_medico, 
        direccion, ciudad, departamento, aficiones, categoria, secretaria, fecha_secretaria, estado
                FROM medicos
                WHERE id_medicos='" . $id . "'";

        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_medicos']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombres = trim($filaP2['nombres']);
            $apellidos = trim($filaP2['apellidos']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $registro_medico = trim($filaP2['registro_medico']);
            $especialidad = trim($filaP2['especialidad']);
            $email = trim($filaP2['email']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $entidades_ads = trim($filaP2['entidades_ads']);
            $comentarios = trim($filaP2['comentarios']);
            $centro_medico = trim($filaP2['centro_medico']);
            $direccion = trim($filaP2['direccion']);
            $ciudad = trim($filaP2['ciudad']);
            $departamento = trim($filaP2['departamento']);
            $aficiones = trim($filaP2['aficiones']);
            $categoria = trim($filaP2['categoria']);
            $secretaria = trim($filaP2['secretaria']);
            $fecha_secretaria = trim($filaP2['fecha_secretaria']);
            $estado = trim($filaP2['estado']);
        }
    }
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/medicos/assets/style.css">

    </head>

    <style>
        .content-wrapper {
            background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .tags-look .tagify__dropdown__item {
            display: inline-block;
            vertical-align: middle;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active {
            color: black;
        }

        .tags-look .tagify__dropdown__item:hover {
            background: lightyellow;
            border-color: gold;
        }

        .tags-look .tagify__dropdown__item--hidden {
            max-width: 0;
            max-height: initial;
            padding: .1em 0;
            margin: .2em 0;
            white-space: nowrap;
            text-indent: -20px;
            border: 0;
        }
    </style>

    <body>

    <h1>Didier</h1>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="">
                            <nav class="breadcrumbs">
                                <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                                <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Médicos</a>

                            </nav>
                            <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <h5 class="card-title card-title-rezise"><strong>Creación de Médicos</strong></h5>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="btn-group" role="group" aria-label="Basic example" style="margin-top:3px;">
                            <button title="Refresacar tabla" type="button" class="btn btn-outline-primary btn-sm" id="btnRefresh"><i class="fa-solid fa-rotate-right"></i> Refrescar Tabla</button>
                            <button title="Crear nuevo médico" type="button" class="btn btn-outline-primary btn-sm" onclick="loadAficionesSelect()" class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">
                                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <p>
                    <button title="Cliack aquí para abrir los filtros" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-filter"></i> Click aquí para Filtrar
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label style="font-size: 12px;">No. Identificación:</label>
                                <input class="form-control" type="text" name="noide" id="noide" placeholder="Filtro por No. Identificación">
                            </div>
                            <div class="col-md-2">
                                <label style="font-size: 12px;">Fecha de nacimiento:</label>
                                <input class="form-control" type="date" name="fecha_cumple" id="fecha_cumple">
                            </div>
                            <div class="col-md-1">
                                <label style="font-size: 12px;">Categoría:</label>
                                <select class="form-control" name="catemedica" id="catemedica">
                                    <option selected="true" disabled="disabled"></option>
                                    <option value="A">A > 8M</option>
                                    <option value="B">B 5-8M</option>
                                    <option value="C">C 1-5M</option>
                                    <option value="NA">No Aplica</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label style="font-size: 12px;">Centro Médico:</label>
                                <select class="form-control" name="centro_medico" id="centro_medico">
                                    <option selected="true" disabled="disabled"></option>
                                    <?php
                                    $cadena = "SELECT id_centro, nombre_centro FROM centros_medicos
                                            where estado='1'";
                                    $resultadP2a = $conetar->query($cadena);
                                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                                    if ($numerfiles2a >= 1) {
                                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                            echo "<option value='" . trim($filaP2a['id_centro']) . "'";
                                            if (trim($filaP2a['id_centro']) == $centro_medico) {
                                                echo ' selected';
                                            }
                                            echo '>' . $filaP2a['nombre_centro'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label style="font-size: 12px;">Estado:</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option selected="true" disabled="disabled"></option>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary btn-sm" id="btnfiltrar" style="margin-top: 28px;">Filtrar <i class="fa-solid fa-filter"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-table-sedes p-2">

                </div>
            </div>
        </div>
        <!-- Add Modal HTML -->
        <div id="addEmployeeModal" class="modal fade addMedicoModal">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 1000px; margin-left:-280px;">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Crear Médico</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-bottom:10px; font-size:13px;">
                                <strong>Datos Básicos:</strong>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <label style="font-size: 12px;">Tipo Identificacion:</label>
                                    <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena = "SELECT id, nombre
                                                                FROM tipo_identificacion
                                                                where estado='1'";
                                        $resultadP2a = $conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if ($numerfiles2a >= 1) {
                                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                                echo "<option value='" . trim($filaP2a['id']) . "'";
                                                if (trim($filaP2a['id']) == $id_tipo_identificacion) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $filaP2a['nombre'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="id_tipo_identificacionx"></div>
                                </div>
                                <div class="col-md-2">
                                    <label style="font-size: 12px;">No. Identificación:</label>
                                    <input type="text" class="form-control" name="numero_ide" id="numero_ide" required>
                                </div>
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" required>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Apellidos:</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" required>
                                </div>
                            </div>

                            <div class="row mt-2 mb-4">
                                <div class="col-md-2">
                                    <label style="font-size: 12px;">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" min="1900-01-01" max="2024-12-31"></input>
                                    <div id="fecha_nacimientox"></div>
                                </div>
                                <div class="col-md-2">
                                    <label style="font-size: 12px;">Sexo:</label>
                                    <select class="form-control" name="id_tipo_genero" id="id_tipo_genero" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <option value="1" <?php if ($id_tipo_genero == "1") {
                                                                echo " selected";
                                                            } ?>>Masculino</option>
                                        <option value="2" <?php if ($id_tipo_genero == "2") {
                                                                echo " selected";
                                                            } ?>>Femenino</option>
                                        <option value="3" <?php if ($id_tipo_genero == "3") {
                                                                echo " selected";
                                                            } ?>>Otro</option>
                                    </select>
                                    <div id="id_tipo_generox"></div>
                                </div>

                                <div class="col-md-2">
                                    <label style="font-size: 12px;">Teléfono Consultorio:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
                                    <div id="telefonox"></div>
                                </div>

                                <div class="col-md-2">
                                    <label style="font-size: 12px;">Celular:</label>
                                    <input type="text" class="form-control" name="movil" id="movil" value="<?php echo $movil; ?>" required></input>
                                    <div id="movilx"></div>
                                </div>

                                <div class="col-md-4">
                                    <label style="font-size: 12px;">Correo:</label>
                                    <input type="text" class="form-control" name="correo" id="correo">
                                </div>

                            </div>

                            <hr>

                            <div class="row mt-2">

                                <!--<div class="col-md-3">
                                    <label style="font-size: 12px;">Registro Médico:</label>
                                    <input type="text" class="form-control" name="regmedico" id="regmedico">
                                </div>-->

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Especialidad:</label>
                                    <select name="especialidad" id="especialidad" class="form-control" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena = "SELECT id, descripcion, estado FROM especialidades
                                                                            where estado='1'";
                                        $resultadP2a = $conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if ($numerfiles2a >= 1) {
                                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                                echo "<option value='" . trim($filaP2a['id']) . "'";
                                                if (trim($filaP2a['id']) == $especialidad) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $filaP2a['descripcion'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Sub - Especialidad:</label>
                                    <select name="subespecialidad" id="subespecialidad" class="form-control" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena = "SELECT id, nombre, estado FROM sub_especialidades
                                                                            where estado='1'";
                                        $resultadP2a = $conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if ($numerfiles2a >= 1) {
                                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                                echo "<option value='" . trim($filaP2a['id']) . "'";
                                                if (trim($filaP2a['id']) == $especialidad) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $filaP2a['nombre'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label style="font-size: 12px;">Comentarios:</label>
                                    <textarea class="form-control" name="comentarios" id="comentarios" cols="30" rows="1"></textarea>
                                </div>

                            </div>

                            <!--<div class="row mt-2">

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Entidades Adscritas:</label>
                                    <textarea class="form-control" name="entidades" id="entidades" cols="30" rows="1" required></textarea>
                                </div>

                            </div>-->

                            <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
                                <strong>Dirección:</strong>
                            </div>

                            <div class="row mt-2">

                                <div class="col-md-5">
                                    <label style="font-size: 12px;">Centro Médico:</label>
                                    <select class="form-control" name="centro_medico" id="centro_medico" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena = "SELECT id_centro, nombre_centro FROM centros_medicos
                                                                            where estado='1'";
                                        $resultadP2a = $conetar->query($cadena);
                                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                                        if ($numerfiles2a >= 1) {
                                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                                echo "<option value='" . trim($filaP2a['id_centro']) . "'";
                                                if (trim($filaP2a['id_centro']) == $centro_medico) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $filaP2a['nombre_centro'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="centro_medicox"></div>
                                </div>

                                <div class="col-md-4">
                                    <label style="font-size: 12px;">Dirección - Consultorio:</label>
                                    <!--<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>-->
                                    <textarea class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" cols="30" rows="1"></textarea>
                                    <div id="direccionx"></div>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Ciudad:</label>
                                    <select class="form-control" name="ciudad" id="ciudad" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena33 = "SELECT id, nombre FROM ciudades";
                                        $resultadP2a33 = $conetar->query($cadena33);
                                        if ($resultadP2a33->num_rows > 0) {
                                            while ($row = $resultadP2a33->fetch_assoc()) {
                                                $value = $row['id'];
                                                $ciudad_nombre = $row['nombre'];
                                                $selected = ($ciudad == $value) ? 'selected' : '';
                                                echo "<option value='$value' $selected>$ciudad_nombre</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="ciudadx"></div>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Departamento:</label>
                                    <select class="form-control" name="dep" id="dep" required>
                                        <option selected="true" disabled="disabled"></option>
                                        <?php
                                        $cadena33 = "SELECT id, nombre FROM departamento";
                                        $resultadP2a33 = $conetar->query($cadena33);

                                        if ($resultadP2a33->num_rows > 0) {
                                            while ($row = $resultadP2a33->fetch_assoc()) {
                                                $value = $row['id'];
                                                $dep_nombre = $row['nombre'];
                                                $selected = ($id_departamento == $value) ? 'selected' : '';
                                                echo "<option value='$value' $selected>$dep_nombre</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div id="depx"></div>
                                </div>
                            </div>

                            <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
                                <strong>Información Adicional:</strong>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Categoría:</label>
                                    <select class="form-control" name="catemedica" id="catemedica">
                                        <option disabled="disabled"></option>
                                        <option value="A">A > 8M</option>
                                        <option value="B">B 5-8M</option>
                                        <option value="C">C 1-5M</option>
                                        <option value="NA" selected="true">No Aplica</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;" for="">Aficiones:</label>
                                    <textarea name='tags2' cols="30" rows="5" placeholder='Escribe o elige las aficiones'>
                                    </textarea>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Nombres - Secreataria:</label>
                                    <input type="text" class="form-control" name="nombre_secre" id="nombre_secre" value="<?php echo $departamento; ?>"></input>
                                    <div id="depx"></div>
                                </div>

                                <div class="col-md-3">
                                    <label style="font-size: 12px;">Fecha cumpleaños - Secreataria:</label>
                                    <input type="date" class="form-control" name="cumple_secre" id="cumple_secre" value="<?php echo $departamento; ?>"></input>
                                    <div id="depx"></div>
                                </div>

                            </div>

                            <div class="row" style="margin-top: 20px;">

                            </div>

                            <input type="hidden" name="aficionesall" id="aficionesall">
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
        <div id="editsedeModal" class="modal fade editMedicoModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Médico</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formeditar" action="#" method="POST">

                        <div class="modal-body" id="editMedicos">


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" value="Aceptar">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("apps/thedata.php") ?>

        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

        <script>
            $(document).ready(function() {

                var input = document.querySelector('textarea[name=tags2]'),
                    tagify = new Tagify(input, {
                        enforceWhitelist: true,
                        whitelist: [
                            <?php
                            $cadena = "SELECT id, nombre, estado FROM aficiones WHERE estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            ?> "<?= $filaP2a['nombre'] ?>",
                            <?php
                                }
                            }
                            ?>
                        ],
                        callbacks: {
                            add: console.log, // callback when adding a tag
                            remove: console.log // callback when removing a tag
                        }
                    });

                $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');

                $('#btnRefresh').click(function() {
                    $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');
                })

                $('#btnfiltrar').click(function() {

                    id = $('#noide').val();
                    fecha = $('#fecha_cumple').val();
                    catemedica = $('#catemedica').val();
                    centro_medico = $('#centro_medico').val();
                    estado = $('#estado').val();

                    $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable2.php', {
                        doc: id,
                        fecha: fecha,
                        categoria: catemedica,
                        centro_medico: centro_medico,
                        estado: estado
                    });
                })



            })

            function loadAficionesSelect() {
                $('#contentAficiones').load('https://conlabweb3.tierramontemariana.org/apps/medicos/aficiones.php');
            }
        </script>

    </body>

    </html>

<?php
}
?>