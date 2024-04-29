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

    include('reglasdenavegacion.php');


    $cadena = "SELECT id_examenes, codigo_cups, nombre_examen, nombre_alterno, abreviatura, estado, referencia, costo
    FROM u116753122_cw3completa.examenes WHERE id_examenes='$id'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_examenes = $filaP2['id_examenes'];
            $codcups = $filaP2['codigo_cups'];
            $nomexamen = $filaP2['nombre_examen'];
            $nombrealterno = $filaP2['nombre_alterno'];
            $abreviatura = $filaP2['abreviatura'];
            $referencia = $filaP2['referencia'];
            $costo = $filaP2['costo'];
        }
    }
?>
  
      

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
                    url: 'https://cw3.tierramontemariana.org/apps/crearexamenes/crud.php',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {
                        $(".content-table-sedes").load('https://cw3.tierramontemariana.org/apps/crearexamenes/thedatatable.php');

                        alert("¡Registro actualizado con exito!");
                    }
                });
                $("#editsedeModal").modal("hide");
            }
        });
        $('#formeditar').validate({
            rules: {
                nombre: {
                    required: true
                },
            },
            messages: {
                nombre: {
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