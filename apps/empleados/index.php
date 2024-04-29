<?php


$nmbapp = "Listado de Empleados";
$moduraiz = $_SESSION['moduraiz'];
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);
//echo ".................".$sctrl4."-----------";

?>
<style>
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
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/empleados/assets/style.css">
</head>
<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
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
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Empleados</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 text-center">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Listado de Empleados</strong></h5>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary btn-sm" onclick="loadFormEmployee()" data-toggle="modal" data-target="#modalAddEmployee" style="font-size:11px;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        Empleado</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12" id="contentTableEmploye">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Employee -->
    <div class="modal fade" id="modalAddEmployee" tabindex="-1" aria-labelledby="modalAddEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddEmployeeLabel">Crear Nuevo Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentFormEmployee">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Employee -->
    <div class="modal fade" id="modalViewEmployee" tabindex="-1" aria-labelledby="modalViewEmployeeLabel" aria-hidden="true" style="margin:auto;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalViewEmployeeLabel">Crear Nuevo Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentFormEmployeeView">

                </div>
            </div>
        </div>
    </div>

    <?php include("apps/thedata.php") ?>

    <script>
        function loadFormEmployee() {
            $('#contentFormEmployee').load('https://conlabweb3.tierramontemariana.org/apps/empleados/datacase1.php');
        }

        $(document).ready(function() {
            $('#contentTableEmploye').load('https://conlabweb3.tierramontemariana.org/apps/empleados/thedatatable.php');
        })

        function setEmployee() {
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/empleados/crud.php?aux=1',
                data: $('#formAddEmployee').serialize(),
                success: function(respuesta) {

                    cargarDatos();

                    $('#modalAddEmployee').modal('hide');

                    loadFormEmployee()

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            });
        }

        function updateEmployee() {
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/empleados/crud.php?aux=2',
                data: $('#formEditEmployee').serialize(),
                success: function(respuesta) {

                    cargarDatos();

                    $('#modalViewEmployee').modal('hide');

                    loadFormEmployee()

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            });
        }
    </script>


</body>

</html>