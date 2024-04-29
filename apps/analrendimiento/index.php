<?php


// echo $sctrl1;
$nmbapp = "Reporte de Analisis de Rendimiento";
$moduraiz = $_SESSION['moduraiz'];
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cw3.tierramontemariana.org/apps/dptos/assets/style.css">
</head>
<style>
    .content-wrapper {
        background-image: url('https://cw3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<body>
    <div class="card" style="width:85%;margin:auto;">

        <div class="card-header bg-light ">

            <div class="row">
                <div class="col-md-4 col-lg-4">

                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                            <?php echo $moduraiz; ?>
                        </a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">
                            <?php echo $nmbapp; ?>
                        </a>
                    </nav>
                </div>

                <div class="col-md-4 text-center">
                    <h5 style="text-align: center; color: #0045A5;"><strong><?php echo $nmbapp; ?></strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12  thetable">

                </div>
            </div>
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

    <script>
        $(document).ready(function() {


            $('.thetable').load('https://cw3.tierramontemariana.org/apps/analrendimiento/table-1.php');


        })
    </script>

</body>

</html>