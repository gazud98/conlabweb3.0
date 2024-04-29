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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = 0;
        }
    } else {
        $id = 0;
    }

    if (isset($_REQUEST['user'])) {
        $user = $_REQUEST['user'];
        if ($user == "-1") {
            $user = 0;
        }
    } else {
        $user = 0;
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
    // Crear objeto DateTime solo si la fecha de nacimiento está disponible
    $fechaNacimiento = new DateTime($fecha_nacimiento);
    $fechaActual = new DateTime();

    // Calcular la diferencia entre las fechas
    $diferencia = $fechaNacimiento->diff($fechaActual);

    // Obtener la diferencia en años
    $edad = $diferencia->y;
?>
    <style>
        input[type='date'] {
            padding: 0 !important;
            margin: 0 !important;
            font-size: 12px !important;
            height: 28px !important;
            /* Otros estilos personalizados */
            text-align: left !important;
        }

        #form-paciente[disabled] {
            opacity: 0.7;
            /* Reduce la opacidad */
            cursor: not-allowed;
            /* Cambia el cursor a 'not-allowed' */
        }
    </style>
    <form name="form-paciente" id="form-paciente" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_pacientes ?>">
        <input type="hidden" id="userc" name="userc" value="<?php echo $user ?>">
        <div class="row">

            <div class="col-md-2">
                <label style="font-size: 12px;">Tipo Identificacion:</label>
                <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion">
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

            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">N° Documento:</label>
                <input type="input" class="form-control" name="documento" id="documento" value="<?php echo $documento ?>" required> </input>

            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Nombres:</label>
                <input type="input" class="form-control" name="nombres" id="nombres" value="<?php echo $nombre_1 ?>" required></input>

            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Apellidos:</label>
                <input type="input" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellido_1 ?>" required></input>

            </div>
            <div class="col-md-2">
                <label style="height: 18px !important;">Fecha de Nacimiento:</label>
                <input type="input" class="form-control" placeholder="aa-mm-dd" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento ?>" required></input>
                <!--<input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento ?>" required></input>-->

            </div>
            <div class="col-md-1">
                <label style="font-size: 12px;">Edad:</label>
                <input type="input" class="form-control" name="edad" id="edad" disabled value="<?php echo $edad ?> Años"></input>

            </div>
            <div class="col-md-1">
                <label style="font-size: 12px;">Sexo:</label>
                <select class="form-control" name="id_tipo_genero" id="id_tipo_genero" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, abreviatura
                                                    FROM sexo";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_tipo_genero) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['abreviatura'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>
        </div>

        <div class="row mt-2">

            <div class="col-md-2">
                <label style="font-size: 12px;">Departamento:</label>
                <select class="form-control" name="dep" id="dep" value="<?php echo $departamento ?>" required>
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

            <div class="col-md-2">
                <label style="font-size: 12px;">Ciudad:</label>
                <select class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad ?>" required>
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

            <div class="col-md-2">
                <label style="font-size: 12px;">Barrio:</label>
                <input type="input" class="form-control" name="barrio" id="barrio" value="" required></input>
            </div>

            <div class="col-md-1">
                <label style="font-size: 12px;">Tipo de vía:</label>
                <select class="form-control" name="tp_via" id="tp_via" required>
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

            <div class="col-md-1">
                <label style="font-size: 12px;">N° Vía:</label>
                <input type="input" class="form-control" name="numvia" id="numvia" value="<?php echo $n_via ?>" required></input>

            </div>

            <div class="col-md-1">
                <label style="font-size: 12px;">Numero de Vivienda:</label>
                <input type="input" class="form-control" name="direccion" id="direccion" value="<?php echo $numero_vivienda ?>" required></input>
            </div>

            <div class="col-md-1">
                <label style="font-size: 12px;">Telefono:</label>
                <input type="input" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono ?>" required></input>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;">Movil 1:</label>
                <input type="input" class="form-control" name="movil" id="movil" value="<?php echo $movil ?>" required></input>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-md-2">
                <label style="font-size: 12px;">Movil 2:</label>
                <input type="input" class="form-control" name="movil2" id="movil2" value=""></input>
            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Email 1:</label>
                <input type="input" class="form-control" name="email" id="email" value="<?php echo $email ?>" required></input>
            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Email 2:</label>
                <input type="input" class="form-control" name="email2" id="email2" value="<?php echo $email ?>"></input>
            </div>
            <div class="col-md-2 mt-4">

                <button type="submit" class="btn btn-sm btn-success" style="font-size:12px;width:90px;">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Grabar
                </button>

            </div>
        </div>

    </form>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para verificar y actualizar el estado del botón de envío
            function actualizarEstadoBoton() {
                // Obtén los valores de los campos
                var tipoIdentificacion = $("#id_tipo_identificacion").val();
                var documento = $("#documento").val();
                var nombres = $("#nombres").val();
                var apellidos = $("#apellidos").val();
                var fechaNacimiento = $("#fecha_nacimiento").val();
                var edad = $("#edad").val(); // Puede ser necesario ajustar esto si se calcula automáticamente
                var tipoGenero = $("#id_tipo_genero").val();
                var departamento = $("#dep").val();
                var ciudad = $("#ciudad").val();
                var tipoVia = $("#tp_via").val();
                var numVia = $("#numvia").val();
                var direccion = $("#direccion").val();
                var telefono = $("#telefono").val();
                var movil = $("#movil").val();
                var email = $("#email").val();

                // Verifica si todos los campos tienen valores
                if (tipoIdentificacion && documento && nombres && apellidos && fechaNacimiento && edad && tipoGenero &&
                    departamento && ciudad && tipoVia && numVia && direccion && telefono && movil && email) {
                    // Habilita el botón de envío
                    $("#procedencia").prop("disabled", false);
                    $("#medicoSelect").prop("disabled", false);
                    $("#empresaSelect").prop("disabled", false);
                    $("#planSelect").prop("disabled", false);
                    $("#observacion_medico").prop("disabled", false);
                } else {
                    // Deshabilita el botón de envío
                    $("#procedencia").prop("disabled", true);
                    $("#medicoSelect").prop("disabled", true);
                    $("#empresaSelect").prop("disabled", true);
                    $("#planSelect").prop("disabled", true);
                    $("#observacion_medico").prop("disabled", true);
                }
            }

            // Monitorea los cambios en los campos
            $("#id_tipo_identificacion, #documento, #nombres, #apellidos, #fecha_nacimiento, #id_tipo_genero, #dep, #ciudad, #tp_via, #numvia, #direccion, #telefono, #movil, #email").on("change keyup", function() {
                actualizarEstadoBoton();
            });

            // Inicializa el estado del botón al cargar la página
            actualizarEstadoBoton();
        });
        $(document).ready(function() {
            // Cuando cambia la fecha de nacimiento
            $('#fecha_nacimiento').on('change', function() {
                // Obtener la fecha de nacimiento
                var fechaNacimiento = new Date($(this).val());

                // Obtener la fecha actual
                var fechaActual = new Date();

                // Calcular la diferencia de tiempo en milisegundos
                var diferencia = fechaActual - fechaNacimiento;

                // Convertir la diferencia a años
                var edad = Math.floor(diferencia / (365.25 * 24 * 60 * 60 * 1000));
                var edadaños = edad + ' Años';
                // Mostrar la edad en el elemento con id "edad"
                $('#edad').val(edadaños);
            });
        });
        $(document).ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {

                    $.ajax({
                        type: 'POST',
                        url: 'https://conlabweb3.tierramontemariana.org/apps/ingresopaciente/crud.php',
                        data: $('#form-paciente').serialize(),
                        success: function(respuesta) {

                            if (respuesta == 1) {
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    text: '¡Informacion actualizada con exito!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: '¡Paciente Agregado con exito!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                            }

                        }
                    });



                }
            });
            $('#form-paciente').validate({
                rules: {
                    id_tipo_identificacion: {
                        required: true
                    },
                    documento: {
                        required: true
                    },
                    nombres: {
                        required: true
                    },
                    apellidos: {
                        required: true
                    },
                    fecha_nacimiento: {
                        required: true
                    },
                    id_tipo_genero: {
                        required: true
                    },
                    dep: {
                        required: true
                    },
                    ciudad: {
                        required: true
                    },
                    tp_via: {
                        required: true
                    },
                    numvia: {
                        required: true
                    },
                    direccion: {
                        required: true
                    },
                    telefono: {
                        required: true
                    },
                    movil: {
                        required: true
                    },
                    email: {
                        required: true
                    }
                },
                messages: {
                    id_tipo_identificacion: {
                        required: ""
                    },
                    documento: {
                        required: ""
                    },
                    nombres: {
                        required: ""
                    },
                    apellidos: {
                        required: ""
                    },
                    fecha_nacimiento: {
                        required: ""
                    },
                    id_tipo_genero: {
                        required: ""
                    },
                    dep: {
                        required: ""
                    },
                    ciudad: {
                        required: ""
                    },
                    tp_via: {
                        required: ""
                    },
                    numvia: {
                        required: ""
                    },
                    direccion: {
                        required: ""
                    },
                    telefono: {
                        required: ""
                    },
                    movil: {
                        required: ""
                    },
                    email: {
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
        });
        $(document).ready(function() {
            $('#id_tipo_identificacion').select2({
                language: "es"
            });
            $('#id_tipo_genero').select2({
                language: "es"
            });
            $('#dep').select2({
                language: "es"
            });
            $('#ciudad').select2({
                language: "es"
            });
            $('#tp_via').select2({
                language: "es"
            });

            
        });
        
        $(document).ready(function(){
            $('#dep').change(function(){
                loadCities();
            })
        })

        function loadCities(){

            id = $('#dep').val();

            $.ajax({
                url: 'https://conlabweb3.tierramontemariana.org/apps/ingresopaciente/ciudades.php',
                data: {
                    id: id
                },
                success:function(res){
                    $('#ciudad').html(res);
                }
            })

        }
        
    </script>

<?php } ?>