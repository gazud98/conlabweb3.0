<?php

$nmbapp = "Listado de Solicitudes";
$moduraiz = "Compras e Inventario";
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/reporteproveedores/assets/style.css">
</head>
<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<body>

    <div class="card" style="width:85%;margin:auto;">
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
            </div>
        </div>
        <div class="card-body">
            <div id="contentFilter">

            </div>
            <div class="row mt-3">
                <div class="col-md-12" id="contetnTableListaProveedores">

                </div>
            </div>
        </div>
    </div>


    <?php include 'apps/thedata.php'; ?>
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
    <script src="/cw3/conlabweb3.0/apps/reporteproveedores/assets/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
            $('#contetnTableListaProveedores').load('https://conlabweb3.tierramontemariana.org/apps/reporteproveedores/table.php');
            $('#contentFilter').load('https://conlabweb3.tierramontemariana.org/apps/reporteproveedores/filters.php');
        $(document).ready(function() {
        })
    </script>

</body>

</html>