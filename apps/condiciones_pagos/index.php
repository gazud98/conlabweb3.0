<?php

$nmbapp = "Listado de Condiciones De Pagos";
$moduraiz = $_SESSION['moduraiz'];
$ruta =  "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cw3.tierramontemariana.org/apps/condiciones_pagos/assets/style.css">
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
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" style="font-size:11px;background-color: rgb(0,69,165);border:none;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nueva condicion pago</button>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 content-table-condiciones_pagos">

                </div>
            </div>
        </div>

    </div>
    <!-- Edit Modal HTML -->
    <div id="addModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Condiciónes de Pago</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="display: none;">
                            <label>Código</label>
                            <input type="input" class="form-control" style="border:thin solid transparent; " readonly="" name="id" id="id" value="">
                        </div>
                        <div class="form-group">

                            <label>Nombre:</label>
                            <select class="form-control" name="nombre" id="nombre">
                                <option selected="true" disabled="disabled"></option>
                                <option value="1">Pago de Contado</option>
                                <option value="2">Credito</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Numero dias:</label>
                            <input type="number" class="form-control" name="numero" id="numero" required>
                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Aceptar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("apps/thedata.php") ?>
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formeditar" action="#" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Condiciones de Pago</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="modalshow">
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="text" class="form-control" name="id" id="idedit" required readonly style="border:none;" value="<?php echo $id ?>">
                        </div>
                        <div class="form-group">

                            <label>Nombre</label>
                            <select class="form-control" name="nombre" id="nombredit">
                                <option selected="true" disabled="disabled"></option>
                                <option value="1" >Pago de Contado</option>
                                <option value="2" >Credito</option>
                            </select>
                        </div>
                        <div class="form-group">

                            <label>Numero dias:</label>
                            <input type="number" class="form-control" name="numero" id="numeroedit" value="<?php echo $numero ?>" required>

                        </div>
                    </div>
                    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Aceptar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {


            $('.content-table-condiciones_pagos').load('https://cw3.tierramontemariana.org/apps/condiciones_pagos/table_view.php');



        })
    </script>

</body>

</html>