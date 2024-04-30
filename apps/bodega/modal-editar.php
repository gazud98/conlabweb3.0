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
    echo $error;
} else {
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }
  
    $cadena = "select id ,nombre,estado,id_centro_costo,id_empleado from u116753122_cw3completa.bodegas where id= '" . $id . "'";
                       //  echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $nombre = trim($filaP2['nombre']);
        $id_centro_costo = trim($filaP2['id_centro_costo']);
        $id_empleado = trim($filaP2['id_empleado']);
        $estado = trim($filaP2['estado']);
    }
?>

  
                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="text" class="form-control" name="id" id="id" required readonly style="border:none;" value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo $nombre ?>">
                    </div>
                    <div class="form-group">
                        <label>Centro de Costo</label>
                        <select class="form-control" name="id_centro_costo" id="id_centro_costo">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.centro_costos
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                    if (trim($filaP2a['id']) == $id_centro_costo) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Responsable</label>
                        <select class="form-control" name="id_empleado" id="id_empleado">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT b.nombre_1, b.nombre_2,b.apellido_1,b.apellido_2, b.id_persona
                                                    FROM u116753122_cw3completa.persona_empleados a, u116753122_cw3completa.persona b
                                                    where a.id_persona = b.id_persona";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                                    if (trim($filaP2a['id_persona']) == $id_empleado) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre_1'] . " " . $filaP2a['nombre_2'] . " " . $filaP2a['apellido_1'] . " " . $filaP2a['apellido_2'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
              

<?php } ?>
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {

        $('input[type="input"],input[type="text"] ').on('keyup', function() {
            var texto = $(this).val();
            var palabras = texto.split(' ');

            for (var i = 0; i < palabras.length; i++) {
                var primeraLetra = palabras[i].charAt(0).toUpperCase();
                var restoPalabra = palabras[i].slice(1).toLowerCase();
                palabras[i] = primeraLetra + restoPalabra;
            }

            var textoFormateado = palabras.join(' ');
            $(this).val(textoFormateado);
        });
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/bodega/crud.php',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {

                        cargarDatos();
                        //alert("¡Registro Actualizado con exito!");
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro Actualizado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                });
                $("#editModal").modal("hide");
            }
        });
        $('#formeditar').validate({
            rules: {
                nombre: {
                    required: true
                },
                id_centro_costo: {
                    required: true
                },
                id_empleado: {
                    required: true
                },
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                id_centro_costo: {
                    required: "Seleccione un centro de costo"
                },
                id_empleado: {
                    required: "Seleccione un responsable"
                },
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
</script>