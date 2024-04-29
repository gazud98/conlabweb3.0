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


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
}

?>

<label style="font-size: 12px;">Selecciona tus Aficiones:</label>
<?php
$cadena = "SELECT id, nombre, estado FROM aficiones WHERE estado='1'";
$resultadP2a = $conetar->query($cadena);
$numerfiles2a = mysqli_num_rows($resultadP2a);
if ($numerfiles2a >= 1) {
    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
?>
        &nbsp;&nbsp;<span><?php echo $filaP2a['nombre']; ?> <input type="checkbox" name="aficiones" id="aficiones" value="<?php echo $filaP2a['id']; ?>"></span>
<?php
    }
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

<script>
    $(document).ready(function() {


        var opcionesSeleccionadas = [];

        // Escucha el evento change de los checkboxes
        $('input[type="checkbox"]').change(function() {
            opcionesSeleccionadas = [];

            // Recorre los checkboxes marcados y agrega sus valores al array
            $('input[type="checkbox"]:checked').each(function() {
                opcionesSeleccionadas.push($(this).val());
            });

            // Puedes usar el array opcionesSeleccionadas según tus necesidades
            $('#aficionesall').val(opcionesSeleccionadas);

        });
    });
</script>