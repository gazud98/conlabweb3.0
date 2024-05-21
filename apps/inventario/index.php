<?php

    $nmbapp = "Inventario";
    $moduraiz = "Compras e Inventario";
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
 
?>

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/inventario/assets/style.css">

    <div class="card border-light" style="width: 90%;margin:auto;">

        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Compras e Inventario</a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Inventario</a>
                    </nav>
                        <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <h5 style="text-align: center; color: #0045A5;"><strong style="font-size:18px;">Listado de inventario</strong></h5>
                </div>
                <div class="col-md-4" style="text-align: center;">
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

    <script>
        $(document).ready(function() {


            $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/inventario/tabla.php');



        })
    </script>
