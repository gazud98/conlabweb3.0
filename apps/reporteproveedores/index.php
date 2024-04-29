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

$id_users = $_SESSION['id_users'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $moduraiz = $_SESSION['moduraiz'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cw3.tierramontemariana.org/apps/reporteproveedores/assets/style.css">
</head>

<body>

    <div class="row content-all">

        <div class="col-md-12 p-4">
            <di class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <nav class="breadcrumbs">
                                <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                                <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Listado de Proveedores</strong></a>
                            </nav>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <h5 style="text-align: center; color: #0045A5;"><strong style="font-size:20px;">Listado de Proveedores</strong></h5>
                        </div>
                        <div class="col-md-4 col-lg-4">
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="contentFilter">

                    </div>

                    <div class="mt-3" id="contetnTableListaProveedores">

                    </div>
                </div>
            </di>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- DataTables Buttons JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cw3.tierramontemariana.org/apps/reporteproveedores/assets/index.js"></script>

    <script>

        $(document).ready(function(){
            $('#contetnTableListaProveedores').load('https://cw3.tierramontemariana.org/apps/reporteproveedores/table.php');
            $('#contentFilter').load('https://cw3.tierramontemariana.org/apps/reporteproveedores/filters.php');
        })
    </script>

</body>

</html>