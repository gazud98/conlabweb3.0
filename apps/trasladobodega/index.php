<?php

$nmbapp = "Traslado de Bodega";
$moduraiz = "Compras e Inventario";
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/trasladobodega/assets/style.css">
</head>

<body>
    <div class="card border-info" style="width:85%;margin:auto;">

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
                    <h5 style="text-align: center; color: #0045A5;"><strong>Traslado de Bodega</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12 col-lg-12" style=" overflow-x:auto; " id="data">
                    <?php include('data.php');  //campos de la app 
                    ?>

                </div>

            </div>
            <div class="row ">
                <div class="col-md-12 col-lg-12" style="  width:100%;" name="table" id="table">
                    <div class="text-nowrap" id="thenavigation" name="thenavigation"></div>
                    <?php // aqui ca la navegacion y filtro btn 
                    ?>
                </div>
            </div>
        </div>


    </div>

    <?php


    include('apps/thedata.php'); //scriops de control
    ?>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            obtener();

        });

        function obtener() {

            $("#table").load('https://conlabweb3.0.tierramontemariana.org/apps/trasladobodega/tabla.php');

        }
    </script>
</body>

</html>