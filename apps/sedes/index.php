<?php

$nmbapp = " Listado de Sedes";
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
<style>
    .content-wrapper {
        background-image: url('/cw3/conlabweb3.0/apps/medicos/assets/backcw3-v1.png');
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
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado de Sedes</strong></h5>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEmployeeModal"
                        style="font-size:11px;background-color: rgb(0,69,165);border:none;"><i class="fas fa-plus"
                            title="Crear nuevo registro"></i>&nbsp;&nbsp;Nueva Sede</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 content-table-sedes">

                </div>
            </div>
        </div>

    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Sede</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="display: none;">
                            <label>Código</label>
                            <input type="input" class="form-control" style="border:thin solid transparent; " readonly=""
                                name="id" id="id" value="">
                        </div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="input" class="form-control" name="nombre" id="nombre">
                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include ("apps/thedata.php") ?>
    <!-- Edit Modal HTML -->
    <div id="editsedeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="formeditar" action="#" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Sede</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="modalshow">
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="text" class="form-control" name="id" id="idedit" required readonly
                                style="border:none;" value="">
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombredit" required value="">
                        </div>
                    </div>
                    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            value="Cancelar">Cancelar</button>
                        <button type="submit" class="btn btn-success" value="Guardar cambios">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

    </div>






    <script>
        $(document).ready(function () {


            $('.content-table-sedes').load('/cw3/conlabweb3.0/apps/sedes/table_view.php');



        })
    </script>

</body>

</html>