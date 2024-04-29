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

    $cadena = "select P.id ,P.nombre,P.estado,P.idstand,B.id as idbodega
from u116753122_cw3completa.bodegaentrepanio P, u116753122_cw3completa.bodegastand S, u116753122_cw3completa.bodegas B
where P.id='" . $id . "' and S.id = P.idstand and S.idbodega=B.id";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $nombre = trim($filaP2['nombre']);
        $idstand = trim($filaP2['idstand']);
        $idbodega = trim($filaP2['idbodega']);
        $estado = trim($filaP2['estado']);
    } else {
        $nombre = "";
        $idstand = "";
        $idbodega = "";
        $estado = "";
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
        <label>Bodega:</label>
        <select class="form-control" name="bodega" id="bodega" onchange="agregar(this)">
            <option selected="true" disabled="disabled" selected></option>
            <?php
            $cadena = "SELECT id, nombre
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
    <div class="form-group">

        <div class="estante" id="estante">

            <label>Stands</label>
            <select class="form-control" id="id_stands" name="id_stands" onchange='agregar2(this);'>
                <option selected="true" disabled="disabled"></option>
                <?php

                $cadenax = "SELECT b.id,b.nombre
            FROM u116753122_cw3completa.bodegas a, u116753122_cw3completa.bodegastand b
            where  a.id = b.idbodega";

                $resultadP2ax = $conetar->query($cadenax);
                $numerfiles2ax = mysqli_num_rows($resultadP2ax);
                if ($numerfiles2ax >= 1) {
                    while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                        echo "<option value='" . trim($filaP2ax['id']) . "'";
                        if (trim($filaP2ax['id']) == $idstand) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2ax['nombre'] . "</option>";
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
                    url: 'https://cw3.tierramontemariana.org/apps/bodegaentrepanio/crud.php',
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
                bodega: {
                    required: true
                },
                id_stands: {
                    required: true
                },
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                bodega: {
                    required: "Este campo no puede estar vacío"
                },
                id_stands: {
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

    function agregar(sel) {
        var id = $('option:selected', sel).attr('value');

        $(".estante").load("https://cw3.tierramontemariana.org/apps/bodegaentrepanio/stands.php", {
            id: id
        });

    };
</script>