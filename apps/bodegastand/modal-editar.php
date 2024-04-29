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
    $cadena = "select id ,nombre,estado,idbodega
from u116753122_cw3completa.bodegastand 
where id='" . $id . "'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $nombre = trim($filaP2['nombre']);
        $idbodega = trim($filaP2['idbodega']);
        $estado = trim($filaP2['estado']);
    }
?>


    <div class="form-group">
        <label>Codigo</label>
        <input type="text" class="form-control" name="id" id="id" required readonly style="border:none;" value="<?php echo $id ?>">
    </div>
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo $nombre ?>">
    </div>
    <div class="form-group">
        <label>Bodega:</label>
        <select class="form-control" name="bodega" id="bodega" onchange='agregar(this);'>
            <option selected="true" disabled="disabled"></option>
            <?php
            $cadena = "SELECT id, nombre,id_empleado
                                                    FROM u116753122_cw3completa.bodegas
                                                    where estado='1'";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    echo "<option value='" . trim($filaP2a['id']) . "'";
                    if (trim($filaP2a['id']) == $idbodega) {
                        echo ' selected';
                    }
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>
    </div>

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
                    url: 'https://conlabweb3.tierramontemariana.org/apps/bodegastand/crud.php',
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
                bodega: {
                    required: true
                },


            },
            messages: {
                nombre: {
                    required: 'Por favor, ingresa el nombre de la bodega'
                },
                bodega: {
                    required: 'Seleccione la bodega'
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