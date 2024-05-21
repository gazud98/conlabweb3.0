<?php

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



    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);

   $nmbapp= "Listado de Productos e Insumos";
?>
    <style>
        #thetable::-webkit-scrollbar {
            width: 1px;
        }
        
        .content-wrapper {
            background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/producto/assets/style.css">

    </head>

    <body>
        <div class="card" style="width:85%;margin:auto;">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Compras e Inventario</a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h5 style="text-align: center; color: #0045A5;"><strong><?php echo $nmbapp; ?></strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <!--<button style="float: right;background-color:rgb(0,69,165);font-size:11px;" type="button" class="btn btn-primary btn-xs" onclick="collapseanshow('C')">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        </button>-->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" onclick="loadFormProdcut()" data-toggle="modal" data-target="#modalAddProducto">Crear Producto</button>
                        <button class="btn btn-primary btn-sm" onclick="loadFormEquipo()" data-toggle="modal" data-target="#modalAddEquipo">Crear Equipo</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12" id="contentTableProdcutos">

                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="modalPrint" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 900px; height:500px; margin-left: -250px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPrintLabel">Exportar Tabla Productos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow: scroll;">
                            <?php include('table-print.php'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="exportarExcel();">Exportar a Excel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Producto -->
            <div class="modal fade" id="modalAddProducto" tabindex="-1" aria-labelledby="modalAddProductoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddProductoLabel">Crear Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormProduct">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Equipo -->
            <div class="modal fade" id="modalAddEquipo" tabindex="-1" aria-labelledby="modalAddEquipoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddEquipoLabel">Crear Equipo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormEquipo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Equipo -->
            <div class="modal fade" id="modaEditEquipo" tabindex="-1" aria-labelledby="modaEditEquipoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalContent">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaEditEquipoLabel">Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contentFormEditEquipo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

        <script>
            $(document).ready(function() {

                $('#contentTableProdcutos').load('https://conlabweb3.tierramontemariana.org/apps/producto/table.php');

            });

            function loadFormProdcut() {
                $('#contentFormProduct').load('https://conlabweb3.tierramontemariana.org/apps/producto/productos.php');
            }

            function loadFormEquipo() {
                $('#contentFormEquipo').load('https://conlabweb3.tierramontemariana.org/apps/producto/equipos.php');
            }

       

        </script>
    </body>

    </html>
<?php
}
?>