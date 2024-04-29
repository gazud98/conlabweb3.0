<?php $user = $_SESSION['id_users'];

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Agrega enlaces a tus hojas de estilo aquí -->
    <link rel="stylesheet" type="text/css" href="https://cw3.tierramontemariana.org/apps/ingresopaciente/assets/style.css">
</head>

<body>

    <main>
        <div class="divcontainer">

            <div class="row">
                <div class="card border-info" style="width:95%;margin:auto;">
                    <div class="card-header bg-info" style="font-size: 15px !important;">
                        <strong>Buscar Paciente</strong>
                    </div>
                    <div class="card-body" id="search-patient">
                    </div>
                </div>
            </div>

            <div class="row mt-1">

                <div class="card border-info" style="width:95%;margin:auto;">

                    <div class="card-header bg-light text-bold" style="font-size: 15px !important;">
                        Datos Básicos
                    </div>


                    <div class="card-body" id="divappshow">

                    </div>

                </div>
            </div>
            <div class="row mt-1">
                <div class="card border-info" style="width:95%;margin:auto;">

                    <div class="card-header bg-light text-bold" style="font-size: 15px !important;">
                        Datos Ingreso
                    </div>

                    <div class="card-body" id="patient-admission">

                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="card border-info" style="width:95%;margin:auto;">

                    <div class="card-header bg-light ">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">

                            </div>
                            <div class="col-md-6 col-lg-6">

                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="patient-examen">

                    </div>
                </div>
            </div>

            <div class="row mt-2" id="contentPagos">
                <div class="card" style="width:95%;margin:auto;">
                    <div class="card-header bg-light">
                        <strong>Pagos</strong>
                    </div>
                    <div class="card-body" id="pagos">

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="modalDomicilios" tabindex="-1" aria-labelledby="modalDomiciliosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDomiciliosLabel">Crear Domicilios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="formDomicilios" id="formDomicilios" action="" method="POST" enctype="multipart/form-data">
                        <div id="contentModalDomicilios">

                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="content-table" style="width: 100%;">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("modal.php") ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#divappshow").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/datacase1.php");
            $("#patient-admission").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/ingreso.php");
            $("#patient-examen").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla.php");
            $("#search-patient").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/search.php", {
                user: <?php echo $user ?>
            });

        });

        function setDomicilio() {
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/set-domicilio.php',
                data: $('#formDomicilios').serialize(),
                success: function(data) {
                    $('.content-table').load('https://cw3.tierramontemariana.org/apps/ingresopaciente/table-domicilios.php');
                    Swal.fire({
                        icon: 'success',
                        title: '¡Satisfactorio!',
                        text: '¡Agregado con Éxito!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 1500,
                    });
                }
            });
        }
    </script>
</body>

</html>