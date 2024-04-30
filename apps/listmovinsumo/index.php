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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    <div class="card border-info" style="width:100%;margin:auto;">

        <div class="card-header bg-light text-bold" style="font-size: 15px !important;">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Lista de Movimientos de Insumos</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Reportes</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">

                </div>
            </div>
        </div>


        <div class="card-body" id="divappshow">


            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" onclick="cargarEntregas()" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Reporte de Salidas</a>
                        <a class="nav-link" onclick="cargarCompras()" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Reporte de Compras</a>
                        <a class="nav-link" onclick="cargarInventario()" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Reporte de Inventario</a>
                        <a class="nav-link" onclick="cargarTraslados()" id="v-pills-traslados-tab" data-toggle="pill" href="#v-pills-traslados" role="tab" aria-controls="v-pills-traslados" aria-selected="false">Reporte de Traslados</a>
                    </div>
                </div>
                <div class="col-md-10 col-lg-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"></div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"></div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"></div>
                        <div class="tab-pane fade" id="v-pills-traslados" role="tabpanel" aria-labelledby="v-pills-traslados-tab"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        cargarEntregas();
    });


    function cargarEntregas() {
        $("#v-pills-home").load("/cw3/conlabweb3.0/apps/listmovinsumo/thedatatable.php");
    }

    function cargarCompras() {
        $("#v-pills-profile").load("/cw3/conlabweb3.0/apps/listmovinsumo/thedatatable-2.php");
    }

    function cargarInventario() {
        $("#v-pills-messages").load("/cw3/conlabweb3.0/apps/listmovinsumo/thedatatable-3.php");
    }
    function cargarTraslados() {
        $("#v-pills-traslados").load("/cw3/conlabweb3.0/apps/listmovinsumo/thedatatable-4.php");
    }
</script>

</html>