<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/idtfofc/assets/style.css">
</head>
<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<body>

    <?php


    $nmbapp = "Identificacion de la Empresa";
    $moduraiz = $_SESSION['moduraiz'] ?? ''; //  'moduraiz' de la sesión
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);

    ?>

    <div class="card border-light" style="width:85%;margin:auto;">

    <h1>Pruebaaaaaaa</h1>

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
                <div class="col-md-4 col-lg-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong><?php echo $nmbapp; ?></strong></h5>
                </div>
                <div class="col-md-4 col-lg-4">

                </div>

            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12" style="width:100%;" id="form">
                </div>
            </div>
        </div>


    </div>

    <?php
    include 'apps/thedata.php'; //scripts de control
    ?>



    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {


            $('#form').load('https://conlabweb3.tierramontemariana.org/apps/idtfofc/view/formApp.php');


        });
    </script>

</body>

</html>