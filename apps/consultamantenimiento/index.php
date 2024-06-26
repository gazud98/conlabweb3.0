<?php


$nmbapp = "Consulta de Mantenimientos";
$moduraiz = "Mantenimiento";


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/assets/style.css">
</head>

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
                    <h5 style="text-align: center; color: #0045A5;"><strong>Consulta de Mantenimientos</strong></h5>
                </div>
            </div>
        </div>



        <div class="card-body">
            <div class="row ">
                <div class="col-md-12 col-lg-12" style="  width:100%;" name="filters" id="filters">

                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 col-lg-12" style="  width:100%;" name="table" id="table">

                </div>
            </div>
        </div>

    </div>



    <?php
    include('apps/thedata.php'); //scriops de control
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#filters").load('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/filters.php');
            $("#table").load('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/table_view.php');
        });
    </script>

</body>

</html>