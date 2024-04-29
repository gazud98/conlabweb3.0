<?php
if (isset($_REQUEST['idx'])) {
    $idx = $_REQUEST['idx'];

    if ($idx == "-1") {
        $idx = "";
    }
} else {
    $idx = 0;
}
if (isset($_REQUEST['iduser'])) {
    $iduser = $_REQUEST['iduser'];

    if ($iduser == "-1") {
        $iduser = "";
    }
} else {
    $iduser = "0";
}

if (isset($_REQUEST['nom_insumo'])) {
    $nom_insumo = $_REQUEST['nom_insumo'];

    if ($nom_insumo == "-1") {
        $nom_insumo = "";
    }
} else {
    $nom_insumo = "0";
}
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





$cadena23 = "SELECT  id_producto
    FROM u116753122_cw3completa.ordrequisicion_temp 
    where id_producto =" . $idx;

$resultadP23 = $conetar->query($cadena23);
$numerfiles23 = mysqli_num_rows($resultadP23);
if ($numerfiles23 >= 1) {
    $caso = "S";
} else {
    $caso = "N";
}
echo "<input type='input' value='" . $caso . "'  idx='" . $idx . "' iduser='" . $iduser . "'  nom_insumo='" . $nom_insumo . "'  ' id='caso' name='caso' style='display:none;' >";
?>


<script>
    var caso = $("#caso").val();
    var idx = $('input[name="caso"]').attr('idx');
    var nom_insumo = $('input[name="caso"]').attr('nom_insumo');
    var iduser = $('input[name="caso"]').attr('iduser');
    var id = $('input[name="caso"]').attr('id');

    if (caso == "S") {
        $("#modalcant").load('https://cw3.tierramontemariana.org/apps/ordrequisicion/updatecant.php', {
            idx: idx,
            nom_insumo: nom_insumo,
            iduser: iduser,
            id: id
        })

    } else if (caso == "N") {

        $("#modalcant").empty();

    }


    function enviar() {

        var id_prod = $("#id_producto").val();
        var id_persona = $("#id_users").val();
        var id_departamento = $("#id_departamento").val();
        var ccosto = $("#ccosto").val();
        var cantidad = $("#cantidad").val();
        var id_sede = $("#id_sede").val();
        var caso = $("#caso").val();
        var max = $('input[name="caso"]').attr('max');
        var iduser = $('input[name="caso"]').attr('iduser');


        //$("#id_producto").empty();


        if (caso == "N") {
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/ordrequisicion/crud.php',
                 data: $('#formcontrol').serialize(),
                success: function(data) {
              
                    $("#table").load('https://cw3.tierramontemariana.org/apps/ordrequisicion/tabla.php', {
                        iduser: iduser
                    });

                    Swal.fire({
                        icon: 'success',
                        title: '¡Satisfactorio!',
                        text: '¡Agregado con Exito!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 1500,
                    });

                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...¡El Producto ya esta registrado!',
                text: 'Actualice la cantidad en la tabla de registros.'
            });
        }
    }
</script>