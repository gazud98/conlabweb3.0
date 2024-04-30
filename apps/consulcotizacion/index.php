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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include ('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "GENERAR ORDEN DE COMPRA";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM cotizacion_insumos" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
    ;
    ?>

    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/consulcotizacion/assets/style.css">
    
    <div class="card border-info">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                            <?php echo $moduraiz; ?>
                        </a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong>
                                <?php echo $nmbapp; ?>
                            </strong></a>
                    </nav>
                </div>
                <div class="col-md-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Generar Orden de Compra</strong></h5>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-lg-5" style="overflow:hidden; overflow-y:auto;">
                    <div id="thetable" name="thetable" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                            height:350px;width:auto;"></div>
                    <?php //aqui va thedatatable.php //tabla de la app 
                        ?>

                </div>

                <div class="col-md-7 col-lg-7" style="overflow:hidden; overflow-y:auto;">
                    <div style="overflow:hidden; overflow-y:auto; " name="data1" id="data1">
                        <div class="row">
                            <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
                                <label style="margin-top: 4px;">Información Cotizacion</label>
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col-md-3 col-lg-3" id="tbd">
                                <label>NIT Proveedor</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value=""
                                    disabled></input>
                            </div>
                            <div class="col-md-9 col-lg-9" id="tbd">
                                <label>Proveedor</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value=""
                                    disabled></input>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 mt-2"
                                style="background-color:rgb(1,103,183);color:white; text-align:center;">
                                <label style="margin-top: 4px;">DETALLE DE COTIZACION</label>
                            </div>
                        </div>
                        <table class="table-sm table-bordered" id="result" style="margin-top: 2%;width:100%;">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>No. Cot</th>
                                    <th>Descripción</th>

                                    <th>Cantidad</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal" id="ordcompra">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modalContent">

                    <!-- Modal Header -->

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="modalshow" name="modalshow">
                        <?php include ("/cw3/conlabweb3.0/apps/consulcotizacion/modal.php") ?>
                    </div>
                    <div class="row p-3" name="thebuttoms" id="thebuttoms">

                        <div class="col-md-12 col-xs-12 " style="text-align: center;">
                            <a href="#" title="Descargar" onclick="genPDF2()"><i class="fa-solid fa-download"
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

        <div class="card-footer bg-light">
            <?php include ('piepag.php'); //zoan de botornes
                ?>
        </div>

    </div>

    <?php
    include ('thefinder.php'); //modal de busqueda personalizado

    include ('apps/thedata.php'); //scriops de control
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/cw3/conlabweb3.0/apps/consulcotizacion/jsPDF/dist/jspdf.min.js"></script>
    <script>
        var elemento = document.getElementById("modalshow");


        function genPDF2() {
            var element = document.getElementById('modalshow');
            html2pdf(element);
        }



        function habilitacmpos() {
            $("#iddatas").css("pointer-events", "auto");
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("pointer-events", "none");
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }

        function savedata() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url . 'apps/' . $p . '/crud.php'; ?>',
                data: $('#formcontrol').serialize(),
                success: function (respuesta) {
                    if (respuesta == 'ok') {
                        //                     alert('Termiando');
                    }

                }
            });



            inhabilitacmpos();
        } //de alvar datos
        $(document).ready(function () {


            $('#thetable').load('/cw3/conlabweb3.0/apps/consulcotizacion/thedatatable.php');



        })

        function accionesespecificas(caso) {
            if (caso == "X") { //cancelar....
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "A") { //aceptar...
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "C") { //de crer
                //desaparece la creacion de proveedores, solo sale en los demas casos
                $("#divproveedoresproducto").css("display", "none");
            } //De crear
            if (caso == "E") {
                $("#divproveedoresproducto").css("display", "block");
            } //Editar
            if (caso == "D") {
                $("#divproveedoresproducto").css("display", "block");
            } //Es de habolita / inhablitar
        } //funcikjnes que hacen casos epeciales en
    </script>
    <?php
}
?>