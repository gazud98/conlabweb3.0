<?php

$nmbapp = "Generar Orden De Compra";
$moduraiz = "Compras e Inventario";
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);

?>

<link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/consulcotizacion/assets/style.css">
<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .border {
        border: 5px solid rgb(1, 103, 183);
        border-radius: 10px;
        /* Opcional: añade bordes redondeados */
        margin-top: 10px;
        /* Opcional: ajusta el margen superior según tu diseño */
        padding: 10px;
        /* Opcional: añade un poco de espacio interno */
    }
</style>
<div class="card border-info">

    <div class="card-header bg-light ">
        <div class="row">
            <div class="col-md-4">
                <nav class="breadcrumbs">
                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                        <?php echo $moduraiz; ?>
                    </a>
                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
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

            <div class="col-md-7 col-lg-7 border">
                <div name="data1" id="data1">
                    <div class="row">
                        <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
                            <label style="margin-top: 4px;">Información Cotizacion</label>
                        </div>
                    </div>
                    <div class="row mt-2">

                        <div class="col-md-3 col-lg-3" id="tbd">
                            <label>NIT Proveedor</label>
                            <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                        </div>
                        <div class="col-md-9 col-lg-9" id="tbd">
                            <label>Proveedor</label>
                            <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 mt-2" style="background-color:rgb(1,103,183);color:white; text-align:center;">
                            <label style="margin-top: 4px;">DETALLE DE COTIZACION</label>
                        </div>
                    </div>
                    <div style="height:400px; width:100%;">
                        <table class="table-sm table-bordered" style="overflow: scroll; overflow-x: auto;width:100%;" id="result">
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
                <div class="container" style="text-align: center; padding: 5px 0px 5px 0px;">
                    <button type="button" id="ordeccomp" class="btn btn-primary btn-xs" onclick="generarOrden()">
                        &nbsp;&nbsp;Generar Orden de compra
                    </button>
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
                    <?php include("https://conlabweb3.tierramontemariana.org/apps/consulcotizacion/modal.php") ?>
                </div>
                <div class="row p-3" name="thebuttoms" id="thebuttoms">

                    <div class="col-md-12 col-xs-12 " style="text-align: center;">
                        <a href="#" title="Descargar" onclick="genPDF2()"><i class="fa-solid fa-download" style="font-size: 25px;"></i></a>
                        <a href="#" title="Imprimir" onclick="printModal()"><i class="fa-solid fa-print" style="font-size: 25px;"></i></a>
                        <a href="#" title="Enviar Por Correo"><i class="fa-solid fa-envelope" style="font-size: 25px;"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<?php


include('apps/thedata.php'); //scriops de control
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://conlabweb3.tierramontemariana.org/apps/consulcotizacion/jsPDF/dist/jspdf.min.js"></script>
<script>
    var elemento = document.getElementById("modalshow");


    function genPDF2() {
        var element = document.getElementById('modalshow');
        html2pdf(element);
    }
    $(document).ready(function() {


        $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/consulcotizacion/thedatatable.php');



    })
</script>