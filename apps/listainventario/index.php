<?php


   
    $nmbapp = "Listado para Inventario Físico y Auditoría";
    $moduraiz = "Compras e Inventario";
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    
?>

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/listainventario/assets/style.css">

    <div class="card border-light" style="width:85%;margin:auto;">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Listado para Inventario Físico y Auditorías</a>
                    </nav>
                    <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado para Inventario Físico y Auditoría</strong></h5>
                </div>

            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="thetable" name="thetable">

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php


    include('apps/thedata.php'); //scriops de control
    ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {


            $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/listainventario/tabla.php');



        })
    </script>
