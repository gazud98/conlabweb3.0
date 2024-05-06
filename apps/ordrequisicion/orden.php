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


    $cadena23 = "SELECT count(id) as max
FROM u116753122_cw3completa.ordrequisicion_temp";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
}

?>


<button type="button" class="btn btn-primary btn-xs" id="btnsol" onclick="cargarTable()">
    <i class="fa-solid fa-clipboard-check"></i>&nbsp;&nbsp;Confirmar Requisicion
</button>

<script>
    max = $("#can").val();
    if (max == 0) {
        $("#btnsol").prop('disabled', true);
    } else {
        $("#btnsol").prop('disabled', false);
    }

    function cargarTable() {


        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/ordrequisicion/confirmarordenes.php',
            data: {},
            success: function(respuesta) {
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/ordrequisicion/mostrarequisicion.php',
                    data: {},
                    success: function(respuesta) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Satisfactorio!',
                            text: '¡Solicitud No. ' + respuesta + ' Creada con exito!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    }
                })

                cargarDatos();

            }
        })

    }
</script>