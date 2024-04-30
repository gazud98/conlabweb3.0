<?php
$result = "err";
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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['idpac'])) {
        $id = $_REQUEST['idpac'];
        if ($id == "-1") {
            $id = 0;
        }
    } else {
        $id = 0;
    }

    if (isset($_REQUEST['numorden'])) {
        $numorden = $_REQUEST['numorden'];
        if ($numorden == "-1") {
            $numorden = 0;
        }
    } else {
        $numorden = 0;
    }

    $id_pacientes = "";
    $id_tipo_identificacion = "";
    $documento = "";
    $nombre_1 = "";
    $apellido_1 = "";
    $fecha_nacimiento = "";
    $id_tipo_genero = "";
    $departamento = "";
    $ciudad = "";
    $id_tipovia = "";
    $n_via = "";
    $numero_vivienda = "";
    $telefono = "";
    $movil = "";
    $email = "";

    if ($id != "") {
        $cadena = "SELECT p.id_pacientes,
        p.id_tipo_identificacion ,
        p.documento,
        p.nombre_1,
        p.apellido_1,
        p.fecha_nacimiento,
        p.id_tipo_genero,
        p.departamento,
        p.ciudad,
        p.n_via,
        p.id_tipovia,
        p.numero_vivienda,
        p.telefono,
        p.movil,
        p.email
    FROM 
        pacientes p
        JOIN tipo_identificacion tp ON p.id_tipo_identificacion = tp.id
        JOIN sexo s ON p.id_tipo_genero = s.id
        JOIN departamento d ON d.id = p.departamento
        JOIN ciudades c ON c.id = p.ciudad
        JOIN tp_vias tpv ON tpv.id = p.id_tipovia 
    WHERE p.id_pacientes ='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id_pacientes = trim($filaP2['id_pacientes']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombre_1 = trim($filaP2['nombre_1']);
            $apellido_1 = trim($filaP2['apellido_1']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $departamento = trim($filaP2['departamento']);
            $ciudad = trim($filaP2['ciudad']);
            $n_via = trim($filaP2['n_via']);
            $id_tipovia = trim($filaP2['id_tipovia']);
            $numero_vivienda = trim($filaP2['numero_vivienda']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $email = trim($filaP2['email']);
        }
    }
}
?>
<div class="row mt-2">

    <div class="col-md-3">
        <input type="hidden" name="numorden" value="<?php echo $numorden; ?>">
        <input type="hidden" name="idpac" value="<?php echo $id_pacientes; ?>">
        <label style="font-size: 12px;">Departamento:</label>
        <select class="form-control" name="dep" id="dep" value="<?php echo $departamento ?>">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre
                                                    FROM departamento";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    echo "<option value='" . trim($filaP2a['id']) . "'";
                    if (trim($filaP2a['id']) == $departamento) {
                        echo ' selected';
                    }
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>

    </div>

    <div class="col-md-3">
        <label style="font-size: 12px;">Ciudad:</label>
        <select class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad ?>">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre
                                                    FROM ciudades";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    echo "<option value='" . trim($filaP2a['id']) . "'";
                    if (trim($filaP2a['id']) == $ciudad) {
                        echo ' selected';
                    }
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>

    </div>

    <div class="col-md-3">
        <label style="font-size: 12px;">Barrio:</label>
        <input type="input" class="form-control" name="barrio" id="barrio" value=""></input>
    </div>

    <div class="col-md-3">
        <label style="font-size: 12px;">Tipo de vía:</label>
        <select class="form-control" name="tp_via" id="tp_via">
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre
                                                    FROM tp_vias";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    echo "<option value='" . trim($filaP2a['id']) . "'";
                    if (trim($filaP2a['id']) == $id_tipovia) {
                        echo ' selected';
                    }
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>

    </div>

</div>
<div class="row mt-2">
    <div class="col-md-3">
        <label style="font-size: 12px;">N° Vía:</label>
        <input type="input" class="form-control" name="numvia" id="numvia" value="<?php echo $n_via; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 12px;">Numero de Vivienda:</label>
        <input type="input" class="form-control" name="numvivienda" id="numvivienda" value="<?php echo $numero_vivienda; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 12px;">Telefono:</label>
        <input type="input" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
    </div>
    <div class="col-md-3">
        <label style="font-size: 12px;">Celular:</label>
        <input type="input" class="form-control" name="movil" id="movil" value="<?php echo $movil; ?>"></input>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <label for="">Observaciones:</label>
        <textarea class="form-control" name="" id="" cols="30" rows="2"></textarea>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <label for="">Rutas:</label>
        <select name="rutasdomicilios" id="rutasdomicilios" class="form-control" required>
            <option value="" disabled selected>SELECCIONA:</option>
            <option value="1">Ruta 01 am</option>
            <option value="2">Ruta 01 pm</option>
            <option value="3">Ruta 02 Baq</option>
        </select>
    </div>
    <div class="col-md-8">
        <label for="">Técnico:</label>
        <select class="form-control" id="tecnico" name="tecnico" required>
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id_medicos, CONCAT(nombres,' ',apellidos) as nombre
                                                    FROM medicos  where estado = 1";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    echo "<option value='" . trim($filaP2a['id_medicos']) . "'";
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <label for="">Fecha:</label>
        <input type="date" class="form-control" name="fechaDomicilio" id="fechaDomicilio" required>
    </div>
    <div class="col-md-2">
        <label for="">Hora:</label>
        <input type="time" class="form-control" name="horaDomicilio" id="horaDomicilio" required>
    </div>
    <div class="col-md-2">
        <label for="">Valor:</label>
        <input type="text" class="form-control" name="valorDomicilio" id="valorDomicilio" required>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-info btn-sm" style="margin-top: 28px;">Agregar</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.content-table').load('/cw3/conlabweb3.0/apps/ingresopaciente/table-domicilios.php', {
            numorden: <?php echo $numorden; ?>
        });
        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/ingresopaciente/set-domicilio.php',
                    data: $('#formDomicilios').serialize(),
                    success: function(data) {
                        $('.content-table').load('/cw3/conlabweb3.0/apps/ingresopaciente/table-domicilios.php', {
                            numorden: <?php echo $numorden; ?>
                        });
                        Swal.fire({
                            icon: 'success',
                            title: '¡Satisfactorio!',
                            text: '¡Agregado con Éxito!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            timer: 1500,
                        });
                    }
                });

            }
        });
        $('#formDomicilios').validate({
            rules: {
                id_examen: {
                    required: true
                },
                prioridad: {
                    required: true
                }
            },
            messages: {
                id_examen: {
                    required: ""
                },
                prioridad: {
                    required: ""
                }
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    })
</script>