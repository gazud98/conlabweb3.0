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
    $cadena = "select id ,nombre,estado,numero
from u116753122_cw3completa.condicion_pago
where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $nombre = trim($filaP2['nombre']);
        $numero = trim($filaP2['numero']);
        $estado = trim($filaP2['estado']);
    }
?>

 
                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="text" class="form-control" name="id" id="id" required readonly style="border:none;" value="<?php echo $id ?>">
                    </div>
                    <div class="form-group">
                       
                        <label>Nombre</label>
                        <select class="form-control" name="nombre" id="nombre">
                            <option selected="true" disabled="disabled"></option>
                            <option value="1" <?php if ($nombre == "1") {
                                                    echo " selected";
                                                } ?>>Pago de Contado</option>
                            <option value="2" <?php if ($nombre == "2") {
                                                    echo " selected";
                                                } ?>>Credito</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <label>Numero dias:</label>
                        <input type="number" class="form-control" name="numero" id="numero" value="<?php echo $numero ?>" required>

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
                    url: 'https://cw3.tierramontemariana.org/apps/condiciones_pagos/crud.php',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {
                        cargarDatos();
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
                numero: {
                    required: true
                },

            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                numero: {
                    required: "Este campo no puede estar vacío"
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