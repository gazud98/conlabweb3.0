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
    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
        if ($status == "-1") {
            $status = "";
        }
    } else {
        $status = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $id_tipo_identificacion = "";
    $documento = "";
    $nombre_1 = "";
    $nombre_2 = "";
    $apellido_1 = "";
    $apellido_2 = "";
    $id_tipo_genero = "";
    $estado = "";
    $fecha_nacimiento = "";
    $direccion = "";
    $telefono = "";
    $movil = "";
    $ciudad = "";
    $direccion_alterna = "";
    $telefono_alterno = "";
    $username = '';
    $password = '';
    $ban_reason = '';
    $last_ip = '';
    $last_login = '';
    $created = '';
    $id_rol = '';
    $estado = "1";


    if ($id != "") {
        $cadena = "select P.id_persona,P.id_tipo_identificacion, P.documento, P.nombre_1, P.nombre_2, P.apellido_1, P.apellido_2, P.id_tipo_genero, P.estado,
                    P.fecha_nacimiento,P.direccion, P.telefono, P.movil, P.ciudad, P.direccion_alterna, P.telefono_alterno,
                    PE.username,PE.password,PE.ban_reason,PE.last_ip,PE.last_login,PE.created,PE.id_rol
                from persona P,
                    users PE
                where  P.id_persona=PE.id_users
                    and P.id_persona='" . $id . "'";
        // echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_persona']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombre_1 = trim($filaP2['nombre_1']);
            $nombre_2 = trim($filaP2['nombre_2']);
            $apellido_1 = trim($filaP2['apellido_1']);
            $apellido_2 = trim($filaP2['apellido_2']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $estado = trim($filaP2['estado']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $direccion = trim($filaP2['direccion']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $ciudad = trim($filaP2['ciudad']);
            $direccion_alterna = trim($filaP2['direccion_alterna']);
            $telefono_alterno = trim($filaP2['telefono_alterno']);
            $username = trim($filaP2['username']);
            $password = trim($filaP2['password']);
            $ban_reason = trim($filaP2['ban_reason']);
            $last_ip = trim($filaP2['last_ip']);
            $last_login = trim($filaP2['last_login']);
            $created = trim($filaP2['created']);
            $id_rol = trim($filaP2['id_rol']);
        }
    }

?>
    <style>
        .form-control {

            width: 100%;
            padding: 0;
            height: 1.5rem;
            font-size: 13px;
            line-height: 1.5;
        }


        .table-txt-order {
            width: 100%;
        }

        .table-txt-order tr,
        tr td {
            width: 100px;
            padding-left: 10px;
        }
    </style>
    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $status ?>">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

        <div class="row mb-2">
            <div class="col-md-4">
                <!-- Primer conjunto de campos -->
                <label style="font-size: 12px;">Tipo Identificación:</label>
                <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion">
                    <!-- Opciones del select -->
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id, nombre FROM tipo_identificacion where estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                    if ($numerfiles2a33 >= 1) {
                        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                            echo "<option value='" . trim($filaP2a33['id']) . "'";
                            if (trim($filaP2a33['id']) == $id_tipo_identificacion) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a33['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_tipo_identificacionx"></div>
            </div>

            <div class="col-md-4">
                <!-- Segundo conjunto de campos -->
                <label style="font-size: 12px;">Número:</label>
                <input type="input" class="form-control" name="documento" id="documento" value="<?php echo $documento; ?>"></input>
                <div id="documentox"></div>
            </div>

            <div class="col-md-4">
                <!-- Tercer conjunto de campos -->
                <label style="font-size: 12px;">&nbsp;</label>
                <button type="button" class="btn btn-secondary btn-xs" onclick="buscarDatos()" style="margin-top: 30px;">Buscar Persona</button>
            </div>
        </div>

        <div class="row mb-2" id="infempleado">
            <div class="col-md-3">
                <!-- Cuarto conjunto de campos -->
                <label style="font-size: 12px;">Primer Nombre:</label>
                <input type="input" class="form-control" name="nombre_1" id="nombre_1" value="<?php echo $nombre_1; ?>" readonly></input>
            </div>

            <div class="col-md-3">
                <!-- Quinto conjunto de campos -->
                <label style="font-size: 12px;">Segundo Nombre:</label>
                <input type="input" class="form-control" name="nombre_2" id="nombre_2" value="<?php echo $nombre_2; ?>" readonly></input>
            </div>

            <div class="col-md-3">
                <!-- Sexto conjunto de campos -->
                <label style="font-size: 12px;">Primer Apellido:</label>
                <input type="input" class="form-control" name="apellido_1" id="apellido_1" value="<?php echo $apellido_1; ?>" readonly></input>
            </div>

            <div class="col-md-3">
                <!-- Séptimo conjunto de campos -->
                <label style="font-size: 12px;">Segundo Apellido:</label>
                <input type="input" class="form-control" name="apellido_2" id="apellido_2" value="<?php echo $apellido_2; ?>" readonly></input>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <label style="font-size: 12px;">Usuario de acceso:</label>
                <input type="text" class="form-control" name="username" id="username" required value="<?php echo $username; ?>"></input>
                <div id="usernamex"></div>
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Contraseña:</label>
                <!--  <div class="col-md-12" name="ctrlpwd" id="ctrlpwd" style="display:none;"><input type="checkbox" id="cpwds" name="cpwds" value="S"> <label for="cpwds">Permitir Cambio de Contraseña</label></div>-->
                <input type="password" class="form-control" name="password" id="password" required value="<?php echo $password; ?>"></input>
                <div id="passwordx"></div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label style="font-size: 12px;">Rol:</label>
                    <select class="form-control" name="id_rol" id="id_rol" onchange="selectModulos(this)">
                        <option selected="true" disabled="disabled"></option>
                        <?php
                        $cadena33 = "SELECT id, nombre FROM roles where estado='1'";
                        $resultadP2a33 = $conetar->query($cadena33);
                        $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                        if ($numerfiles2a33 >= 1) {
                            while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                echo "<option value='" . trim($filaP2a33['id']) . "'";
                                if (trim($filaP2a33['id']) == $id_rol) {
                                    echo ' selected';
                                }
                                echo '>' . $filaP2a33['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label style="font-size: 12px;text-align:center">Privilegio Usuario:</label>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-light" role="alert" id="modulos">

                </div>
            </div>
        </div>

        <div class="mt-5 text-right">
            <button type="submit" class="btn btn-sm btn-success " style="font-size:12px;width:90px;">
                Grabar
            </button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="font-size:12px;width:90px;">
                Cancelar
            </button>
        </div>

    </form>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<?php
}
?>
<script>
    // Selecciona el campo de entrada de texto por su ID
    $(document).ready(function() {
        $("#id_tipo_contribuyente").change(function() {
            var selectValue = $(this).val();
            var checkboxList = $("#checkboxList");

            // Muestra el div con las opciones si se selecciona una opción válida en el select
            if (selectValue) {
                checkboxList.show();
            } else {
                checkboxList.hide();
            }
        });
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/usuarios/crud.php?aux=1',
                    data: $('#formcontrol').serialize(),
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '¡Este usuario ya existe!',
                                footer: 'Crea un usuario con un nuevo nombre'
                            })
                        } else {
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro Agregado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#modalAddUsers').modal('hide');
                            cargarDatos();
                            $('#nombre').val('');
                            $("#codigo").load('https://cw3.tierramontemariana.org/apps/usuarios/codigo.php');
                            $("#iddatas").css("pointer-events", "none");
                            $("#iddatas").css("background-color", "#ededed");
                            $("#accionejec").css("display", "none");
                            $("#accionejec").html("");
                            $("#btones").css("display", "none");
                        }



                    }
                });

            }
        });
        $('#formcontrol').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: ""
                },
                password: {
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
        $("#username").on("keyup", function() {
            var inputText = $(this).val(); // Obtener el valor del input
            var textoEnMinusculas = inputText.toLowerCase(); // Convertir el texto a minúsculas
            $(this).val(textoEnMinusculas); // Establecer el valor del input en minúsculas
        });
    });

    function selectModulos(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#modulos").load('https://cw3.tierramontemariana.org/apps/usuarios/opciones.php', {
            id: id
        })


    }


    function mostrarContrasena() {
        var contraseñaInput = document.getElementById("password");
        if (contraseñaInput.type === "password") {
            contraseñaInput.type = "text";
        } else {
            contraseñaInput.type = "password";
        }
    }

    $(document).ready(function() {
        $('#cancelbtn').click(function() {
            $("#username").css("border", "thin solid rgb(233,236,239)");
            $("#usernamex").empty();
            $("#password").css("border", "thin solid rgb(233,236,239)");
            $("#passwordx").empty();
        });

    });

    function buscarDatos() {
        var id_tipo_identificacion = $("#id_tipo_identificacion").val();
        var documento = $("#documento").val();

        if (id_tipo_identificacion == null) {
            id_tipo_identificacion = '';
        }
        if (id_tipo_identificacion.trim() === '') {
            $("#id_tipo_identificacion").css("border", "thin solid red");
            $("#id_tipo_identificacionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            return;
        } else {
            $("#id_tipo_identificacion").css("border", "thin solid rgb(233,236,239)");
            $("#id_tipo_identificacionx").empty();
        }
        if (documento.trim() === '') {
            $("#documento").css("border", "thin solid red");
            $("#documentox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            return;
        } else {
            $("#documento").css("border", "thin solid rgb(233,236,239)");
            $("#documentox").empty();
        }
        consultarDatos();


    }

    function cancelBTN() {
        $("#iddatas").css("pointer-events", "none");
        $("#iddatas").css("background-color", "#ededed");
        $("#accionejec").css("display", "none");
        $("#accionejec").html("");
        $("#btones").css("display", "none");
    }

    function savedata() {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/usuarios/crud.php',
            data: $('#form-control').serialize(),
            success: function(respuesta) {
                if (respuesta == 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡Este usuario ya existe!',
                        footer: 'Crea un usuario con un nuevo nombre'
                    })
                } else {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Agregado con exito!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    cargarDatos();
                    $('#nombre').val('');
                    $("#codigo").load('https://cw3.tierramontemariana.org/apps/usuarios/codigo.php');
                }



            }
        });
        inhabilitacmpos();
    } //de alvar datos

    function consultarDatos() {
        var documento = $("#documento").val();
        var t_iden = $("#id_tipo_identificacion").val();

        $("#infempleado").load("https://cw3.tierramontemariana.org/apps/usuarios/inf_empleados.php", {
            documento: documento,
            t_iden: t_iden
        });



    }
</script>