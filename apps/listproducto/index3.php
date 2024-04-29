<?php


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

    include('reglasdenavegacion.php');

    // echo $sctrl1;
    if ($sctrl1 == "0") {
        $nmbapp = "TODOS LOS PRODUCTOS Y SERVICIOS";
    }
    if ($sctrl1 == "1") {
        $nmbapp = "ACTIVOS FIJOS";
    }
    if ($sctrl1 == "2") {
        $nmbapp = "REACTIVOS";
    }
    if ($sctrl1 == "3") {
        $nmbapp = "PRODUCTOS";
    }
    if ($sctrl1 == "4") {
        $nmbapp = "SERVICIOS";
    }
    if ($sctrl1 == "5") {
        $nmbapp = "INSUMOS";
    }
    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.producto" .
        $filterfrom .
        " where 1=1";
    if ($sctrl1 != "0") {
        $cadena = $cadena . " and id_categoria_producto='" . $sctrl1 . "'";
    }
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

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

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            margin-left: 2px;
            text-align: center;
            cursor: pointer;
            color: inherit !important;
            padding: 0em 0em;
            border-width: 1px;
            border-style: solid;
            border-color: transparent;
            border-image: none;
            border-radius: 2px;
            background: transparent;
            text-decoration: none !important;
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
    </style>

    <div class="content-table">

        <div class="table-wrapper">
            <div class="table-title" style="padding: 30px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="">
                            <nav class="breadcrumbs">
                                <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Home</a>
                                <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Insumos</a>
                            </nav>
                            <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: center; padding: 10px">
                        <h4><strong>Creación de insumo</strong></h4>
                    </div>
                    <div class="col-md-4">
                        <a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal"><i class="fa-solid fa-plus"></i><span>Nuevo</span></a>
                        <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>-->
                    </div>
                </div>
            </div>

            <div class="content-tables-insumos container-fluid">

                <div class="row">

                    <div class="col-md-5" id="contenttableinsumos">

                    </div>

                    <div class="col-md-7">

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir sede</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Código</label>
                            <input type="input" class="form-control" style="border:thin solid transparent; " readonly="" name="id" id="id" value="">
                        </div>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control required" name="nombre" id="nombre" value="" required="">
                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Aceptar" id="aceptsede">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>

        $(document).ready(function(){

            $('#contenttableinsumos').load('/desarrolloV5/apps/producto/thedatatable.php')

        })

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
                url: '/desarrolloV5/apps/producto/crud.php',
                data: $('#formcontrol').serialize(),
                success: function(respuesta) {
                    $("#thetable").load('/desarrolloV5/apps/producto/thedatatable.php', {
                        sctrl1: <?php echo $sctrl1 ?>
                    });
                    alert("¡Registro Satisfactorio!");
                }
            });



            inhabilitacmpos();
        } //de alvar datos

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