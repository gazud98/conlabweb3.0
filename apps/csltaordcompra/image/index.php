<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    // echo $sctrl1;
    $nmbapp = "CONSULTAR ORDEN DE COMPRA";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.orden_compra";
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <style>
        .content-table {
            width: 100%;
            height: auto;
            background-color: #fff;
        }

        .table-wrapper {
            background: #fff;
            padding: 10px;
            margin: 0;
            border-radius: 5px;
            height: 580px;
            border: 1px solid #E3E3E3;
            height: auto;
        }

        .table-title .table-sedes {
            width: 800px;
        }

        .table-title {
            padding-bottom: 15px;
            color: #0045A5;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            vertical-align: middle;
            border: 1px solid #DCDCDC;
            word-wrap: break-word;
            padding: 2px;
            text-align: center;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }


        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .breadcrumbs {
            border: 1px solid #cbd2d9;
            border-radius: 0.3rem;
            display: inline-flex;
            overflow: hidden;
        }

        .breadcrumbs__item {
            background: #fff;
            color: #333;
            outline: none;
            padding: 0.55em 0.55em 0.55em 1.15em;
            position: relative;
            text-decoration: none;
            transition: background 0.2s linear;
            font-size: 13px;
        }

        .breadcrumbs__item:hover:after,
        .breadcrumbs__item:hover {
            background: #edf1f5;
        }

        .breadcrumbs__item:focus:after,
        .breadcrumbs__item:focus,
        .breadcrumbs__item.is-active:focus {
            background: #0045A5;
            color: #fff;
        }

        .breadcrumbs__item:after,
        .breadcrumbs__item:before {
            background: white;
            bottom: 0;
            clip-path: polygon(50% 50%, -50% -50%, 0 100%);
            content: "";
            left: 100%;
            position: absolute;
            top: 0;
            transition: background 0.2s linear;
            width: 1em;
            z-index: 1;
        }

        .breadcrumbs__item:before {
            background: #cbd2d9;
            margin-left: 1px;
        }

        .breadcrumbs__item:last-child {
            border-right: none;
        }

        .breadcrumbs__item.is-active {
            background: #edf1f5;
        }

        .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.2rem 0.2rem;
            margin-left: 0;
            line-height: 1.25;
            background-color: #fff;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #0045A5;
            border-color: #0045A5;
        }

        #icon:hover {
            background-color: rgb(242, 242, 242);
            color: black;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button a {
            padding: 0.8em;
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-size: 14px;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-size: 14px;
        }

        .dataTables_info {
            font-size: 14px;
        }


        .table-responsive {
            max-width: 100%;
            /* Ancho máximo del contenedor */
            overflow-x: auto;
            /* Barra de desplazamiento horizontal cuando sea necesario */
        }
    </style>

    <div class="card border-info">

        <div class="card-header bg-light ">
            <div class="row">
                <nav class="breadcrumbs">
                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong><?php echo $nmbapp; ?></strong></a>
                </nav>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-4" style="overflow:hidden; overflow-y:auto;">
                    <div id="thetable" name="thetable" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                          heigth: 50vh;width:100%;"><?php ?></div><?php //aqui va thedatatable.php //tabla de la app 
                                                                                    ?>

                </div>

                <div class="col-md-8 col-lg-8" style="overflow:hidden; overflow-y:auto;">
                    <div style="overflow:hidden; overflow-y:auto;" name="data1" id="data1">
                        <div class="row">
                            <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
                                <label style="margin-top: 4px;">Información Orden de Compra</label>
                            </div>
                        </div>
                        <div class="row mt-2" style="width:100%;">
                            <div class="col-md-2 col-lg-2">
                                <label>Numero</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                            </div>
                            <div class="col-md-2 col-lg-2 ">
                                <label>Recibida</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <label>Fecha:</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>

                            </div>
                            <div class="col-md-2 col-lg-2">
                                <label>Hora:</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>

                            </div>
                            <div class="col-md-2 col-lg-2">
                                <label>Plazo:</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                            </div>
                        </div>
                        <div class="row mt-2" style="width:100%;">
                            <div class="col-md-3 col-lg-3" id="tbd">
                                <label>NIT Proveedor</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                            </div>
                            <div class="col-md-6 col-lg-6" id="tbd">
                                <label>Proveedor</label>
                                <input type="input" class="form-control" name="nombre" id="nombre" value="" disabled></input>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 mt-2" style="background-color:rgb(1,103,183);color:white; text-align:center;">
                                <label style="margin-top: 4px;">DETALLE DE ORDEN COMPRA</label>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="result">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>Cod</th>
                                    <th>Descripción</th>
                                    <th>Cant. Ordenada</th>
                                    <th>Valor Unitario</th>
                                    <th>Cant. Recibida</th>
                                    <th>Valor Cant Recibida</th>
                                    <th>Cant. Faltante</th>
                                </tr>
                            </thead>
                            <tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer bg-light">
            <?php include('piepag.php'); //zoan de botornes
            ?>
        </div>

    </div>

    <?php

    include("apps/thedata.php");

    ?>

    <script>
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
                success: function(respuesta) {
                    if (respuesta == 'ok') {
                        //                     alert('Termiando');
                    }

                }
            });



            inhabilitacmpos();
        } //de alvar datos
        $(document).ready(function() {


            $('#thetable').load('/cw3/conlabweb3.0/apps/csltaordcompra/thedatatable.php');



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