<?php



$moduraiz = "Activos Fijos";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/activofijo/assets/style.css">

</head>


<body>
    <div class="card col-md-10 container p-0 border-light">

        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Listado Activos Fijos</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado Activos Fijos</strong></h5>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddActivoFijo" style="font-size:11px;background-color: rgb(0,69,165);border:none;" onclick="loadTextFields()"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo Activo</button>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="content-table">

            </div>

        </div>

        <div class="modal fade" id="modalAddActivoFijo" tabindex="-1" aria-labelledby="modalAddActivoFijoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg para un modal más ancho, modal-dialog-centered para centrarlo verticalmente -->
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddActivoFijoLabel">Crear Activo Fijo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formAddActivos" id="formAddActivos" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="campos">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Activos Fijos -->
        <div class="modal fade" id="modalEditActivoFijo" tabindex="-1" aria-labelledby="modalEditActivoFijoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg para un modal más ancho, modal-dialog-centered para centrarlo verticalmente -->
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditActivoFijoLabel">Editar Activo Fijo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formEditActivos" id="formEditActivos" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="camposEdit">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Grabar</button>
                        </div>
                    </form>
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="exportarExcel();">Exportar a Excel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 1000px; margin-left:-280px;">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Historial de Mantenimientos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div id="tableHistorial">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <?php include("apps/thedata.php") ?>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.content-table').load('https://conlabweb3.tierramontemariana.org/apps/activofijo/tabla.php');


        })

        function loadTextFields() {
            $('#campos').load('https://conlabweb3.tierramontemariana.org/apps/activofijo/campos-add.php');
        }

    
    </script>
</body>

</html>