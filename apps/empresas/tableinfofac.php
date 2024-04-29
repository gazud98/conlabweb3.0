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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

    include('reglasdenavegacion.php');

    // echo '..............................';

?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />


    <table class="table table-striped table-infofac" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 20px;
                ">
        <thead>
            <tr>
                <th>Tipo Plan</th>
                <th>Plan</th>
                <th>Descripción</th>
                <th>Conceptos a Pagar</th>
                <th>Requisito Facturacion</th>
                <th>Descuentos / Incrementos</th>
                <th>Estado</th>
                <th>Fecha Creacion</th>
                <th>Fecha Actualizacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            

        </tbody>
    </table>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {

            new DataTable('.table-sedes', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true
            })

        });

    </script>

<?php
}
?>