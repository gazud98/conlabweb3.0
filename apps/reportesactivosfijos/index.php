<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style><?php

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

        $conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
        if ($conetar->connect_errno) {
            $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
            echo $error;
        } else {
            $nmbapp = "Reportes Activos Fijos";
            $moduraiz = $_SESSION['moduraiz'];
            $ruta = "<a href='#'>Home</a> / " . $moduraiz;
            $uppercaseruta = strtoupper($ruta);
        }
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/assets/style.css">
</head>
<style>
    .card-title-rezise {
        width: 100%;
        color: #164085;
        text-align: center;
        position: relative;
        margin-top: 9px;
    }
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
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                            <?php echo $moduraiz; ?>
                        </a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">
                            <?php echo $nmbapp; ?>
                        </a>
                    </nav>

                </div>

                <div class="col-md-4 text-center">
                    <h5 class="card-title card-title-rezise"><strong>Creación de Mantenimientos</strong></h5>
                </div>

            </div>
        </div>
        <div class="card-body">

            <!--<div class="row content-filter">

                </div>-->

            <div class="row mt-3">

                <div class="col-md-12 content-table">

                </div>

            </div>

        </div>
    </div>


    <!-- Modal View Activo Fijo -->
    <div class="modal fade" id="modalViewActivoFijo" tabindex="-1" aria-labelledby="modalViewActivoFijoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 700px; margin-left:-228px">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalViewActivoFijoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentFormsModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <!--<button type="button" class="btn btn-info" id="exportButton">Exportar</button>-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Buttons JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/assets/index.js"></script>

    <script>
        $(document).ready(function() {
            $('.content-filter').load('https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/filter-name.php');
            $('.content-table').load('https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/table-reporte-1.php');

        })
        document.getElementById('exportButton').addEventListener('click', function() {
            // Crear un objeto jsPDF
            var pdf = new jsPDF();

            // Obtener el elemento HTML que deseas exportar a PDF
            var element = document.getElementById('contentFormsModal');

            // Opciones de impresión
            var options = {
                background: 'white',
                scale: 3 // Ajustar la escala según sea necesario
            };

            // Guardar el área como PDF
            pdf.html(element, options, function() {
                pdf.save('documento.pdf');
            });
        });
    </script>

</body>

</html>