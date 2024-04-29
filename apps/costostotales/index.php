<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Agrega enlaces a tus hojas de estilo aquí -->
    <link rel="stylesheet" type="text/css" href="/cw3/apps/costostotales/assets/style.css">
</head>

<body>

    <main>
        <div class="divcontainer">

            <div class="row">
                <div class="card border-info" style="width:95%;margin:auto;">
                    <div class="card-header bg-gradient" style="font-size: 15px !important;">
                        <strong>Reporte de Costos</strong>
                    </div>
                    <div class="card-body" id="content-table-reportes-costos" style="width: 100%;">
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="assets/plugins/jquery/jquery.min.js"></script>


    
    <script>
        $(document).ready(function() {
            $("#content-table-reportes-costos").load("https://conlabweb3.tierramontemariana.org/apps/costostotales/tabla.php");

            

        });
    </script>
</body>

</html>