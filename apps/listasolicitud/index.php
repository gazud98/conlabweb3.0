<?php

$nmbapp = "Listado de Solicitudes";
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

    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/sedes/assets/style.css">
</head>

<body>
    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/listasolicitud/assets/style.css">
    <div class="card" style="width:85%;margin:auto;">

        <div class="card-header bg-light ">

            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Compras e Inventario</a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">
                            <?php echo $nmbapp; ?>
                        </a>
                    </nav>
                </div>

                <div class="col-md-4 text-center">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado de Solicitudes</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12" id="thetable">
                 
                </div>
            </div>
        </div>
    </div>
    <?php include 'apps/thedata.php'; ?>



    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/cw3/conlabweb3.0/apps/listasolicitud/assets/index.js"></script>
    <script>

        $(document).ready(function () {


            $(document).ready(function () {
                $('#thetable').load('/cw3/conlabweb3.0/apps/listasolicitud/table_view.php');
            });


        });
    </script>


</body>

</html>