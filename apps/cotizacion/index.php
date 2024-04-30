<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}

$user = $_SESSION['id_users'];
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include ('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "Gestión de Cotizaciones";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  cotizacion_insumos" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
    ;
    ?>
    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/cotizacion/assets/style.css">
    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Compras e Inventario</a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong>
                                <?php echo $nmbapp; ?>
                            </strong></a>
                    </nav>
                </div>
                <div class="col-md-4">
                    <h1 style="text-align: center; color: #0045A5;"><strong style="font-size:20px;">Gestión de
                            Cotizaciones</strong></h1>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-5 pr-3">
                    <div style="text-align: center;">
                        <label style="color: rgb(1,103,183);">Listado de Solicitudes Creadas</label>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12" id="table_req" style="height:350px;"></div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-12" style="background-color: rgb(1,103,183); color: white;">
                            <label style="margin-top: 4px;">Información Solicitud</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 pt-1 pb-2" id="data">
                            <div class="row">
                                <?php include ("data.php") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12"
                            style="background-color: rgb(1,103,183); color: white; text-align: center;">
                            <label style="margin-top: 4px;">DETALLE DE SOLICITUD</label>
                        </div>
                        <div class="col-md-12 col-lg-12"
                            style="overflow: scroll; overflow-x: auto; height:350px; width:100%;" name="table" id="table">
                        </div>
                        <div class="container" style="text-align: center; padding: 5px 0px 5px 0px;">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".modal"
                                id="btnsave" disabled onclick="previa()">
                                <i class="fas fa-plus"></i>&nbsp; Crear cotización
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light" style="width:100%;">
                <div class="row">
                    <div class="col-md-12 col-lg-12"></div>
                </div>
            </div>


            <div class="modal modal-fade" id="contentdatamodal">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 800px; margin-left:-150px;">

                        <!-- Modal Header -->

                        <div class="modal-header">
                            <div class="container">

                            </div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body" id="modalshow" name="modalshow">

                        </div>
                        <div class="row p-3" name="thebuttoms" id="thebuttoms">

                            <div class="col-md-12 col-xs-12 " style="text-align: center;">
                                <!--<button type="button" class="btn btn-secondary btn-xs" id="btnprint" data-dismiss="modal">
                            <i class="fas fa-print"></i>&nbsp;&nbsp;Imprimir
                        </button>-->
                                <a href="#" title="Descargar" onclick="genPDF2()"><i class="fa-solid fa-download"
                                        style="font-size: 25px;"></i></a>
                                <a href="#" title="Crear Cotizacion" onclick="recorrer()"><i class="fa-brands fa-telegram"
                                        style="font-size: 25px;"></i></a>
                                <a href="#" title="Imprimir" onclick="printModal()"><i class="fa-solid fa-print"
                                        style="font-size: 25px;"></i></a>
                                <a href="#" title="Enviar Por Correo"><i class="fa-solid fa-envelope"
                                        style="font-size: 25px;"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="idusersend" value="<?php echo $user; ?>">
        <?php
        include ('thefinder.php'); //modal de busqueda personalizado
    
        include ('apps/thedata.php'); //scriops de control
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
            integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                obtener();

            });

            function obtener() {

                $("#table").load("<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>");
                $("#table_req").load("<?php echo base_url . 'apps/' . $p . '/tabla_req.php'; ?>");

            }

            function genPDF2() {
                var element = document.getElementById('modalshow');
                html2pdf(element);
            }
        </script>
        <?php
}
?>