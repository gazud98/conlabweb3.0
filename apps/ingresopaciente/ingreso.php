<?php
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
    echo json_encode(['error' => $error]);
} else {

    $id_pacientes = "";

    if(isset($_REQUEST['id_pacientes'])){
        $id_pacientes = $_REQUEST['id_pacientes'];
    }

    $sql = "SELECT id_empresa, id_plan, idcentro_ingreso, id_procedencia, id_medico, observaciones_medico 
    FROM ingreso WHERE id_paciente = '$id_pacientes'";

    $rest = mysqli_query($conetar, $sql);

    while($data = mysqli_fetch_array($rest)){
        $id_procedencia = $data['id_procedencia'];
        $id_medico = $data['id_medico'];
        $id_empresa = $data['id_empresa'];
        $id_plan = $data['id_plan'];
    }

?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label>Procedencia<span style="color: red;">*</span></label>
            <select class="form-control" id="procedencia" name="procedencia" style="      border-radius: 5px;
        border-color:gray;">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id_sedes, nombre
                                                    FROM sedes where estado = 1";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                        if($id_procedencia = $filaP2a['id_sedes']){
                            echo 'selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-3 col-lg-3">
            <label>Medico<span style="color: red;">*</span></label>

            <select class="form-control" id="medicoSelect" name="medicoSelect">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id_medicos, CONCAT(nombres,' ',apellidos) as nombre
                                                    FROM medicos  where estado = 1";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_medicos']) . "'";
                        if($id_medico = $filaP2a['id_medicos']){
                            echo 'selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-5 col-lg-5">
            <label>Observacion Medico</label>
            <input type="input" class="form-control" id="observacion_medico" name="observacion_medico" disabled>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4 col-lg-4">
            <label>Empresa<span style="color: red;">*</span></label>

            <select class="form-control" id="empresaSelect" name="empresaSelect">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id_empresas, nombre_comercial
                                                    FROM empresas  where estado = 1";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_empresas']) . "'";
                        if($id_empresa = $filaP2a['id_empresas']){
                            echo 'selected';
                        }
                        echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                    }
                }
                ?>
            </select>

        </div>
        <div class="col-md-4 col-lg-4">
            <label>Plan<span style="color: red;">*</span></label>
            <select class="form-control" id="planSelect" name="planSelect">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id, descripcion
                                                    FROM planes  where estado = 1";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if($id_plan = $filaP2a['id']){
                            echo 'selected';
                        }
                        echo '>' . $filaP2a['descripcion'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-lg-2 mt-4" style="display:none;">

            <input type="button" class="btn btn-info" id="nempresa" value="Notas Empresa">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#procedencia').select2({
                language: "es"
            });
            $('#medicoSelect').select2({
                language: "es"
            });
            $('#diagnostico').select2({
                language: "es"
            });
            $('#empresaSelect').select2({
                language: "es"
            });
            $('#planSelect').select2({
                language: "es"
            });
        });

        $(document).ready(function() {
            // Define una función para verificar y actualizar el estado del campo
            function actualizarEstadoCampo() {
                // Obtiene los valores seleccionados
                var id_paciente = $("#id_paciente").val();
                var user = $("#userc").val();
                var procedencia = $("#procedencia").val();
                var medico = $("#medicoSelect").val();
                var empresa = $("#empresaSelect").val();
                var plan = $("#planSelect").val();
                var observacion_medico = $("#observacion_medico").val();

                // Verifica si todos los campos tienen valores seleccionados
                if (procedencia && medico && empresa && plan) {
                    // Si todos tienen valores, habilita el campo
                    $.ajax({
                        type: 'POST',
                        url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/generar-ingreso.php',
                        data: {
                            aux: 1,
                            id_paciente: id_paciente,
                            procedencia: procedencia,
                            medico: medico,
                            empresa: empresa,
                            plan: plan,
                            user: user,
                            observacion_medico: observacion_medico
                        },
                        dataType: 'json', 
                        success: function(data) {

                            var idingreso = data;

                            $("#patient-examen").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla.php", {
                                id: idingreso
                            }, function() {
                                $("#id_examen, #prioridad, #observacion").prop("disabled", false);
                            });
                        }


                    })
                    $("#id_examen").prop("disabled", false);
                    $("#prioridad").prop("disabled", false);
                    $("#observacion").prop("disabled", false);
                    document.getElementById('btnpago').disabled = false;
                } else {
                    // Si alguno está sin seleccionar, deshabilita el campo

                    $("#id_examen, #prioridad, #observacion").prop("disabled", true);
                }

            }

            // Monitorea los cambios en los selects
            $("#procedencia, #medicoSelect, #empresaSelect, #planSelect").on("change", function() {
                actualizarEstadoCampo();
            });

            // Inicializa el estado del campo al cargar la página
            actualizarEstadoCampo();
        });
    </script>

<?php } ?>