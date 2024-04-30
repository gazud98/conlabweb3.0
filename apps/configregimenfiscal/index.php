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
    $nmbapp = "Configuración de impuestos";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";

    $cantrgt = 1;
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

        .dataTables_info {
            font-size: 14px;
        }
    </style>
    <div class="card border-light">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><i class="fa-solid fa-house"></i></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong><?php echo $nmbapp; ?></strong></a>
                    </nav>
                </div>

            </div>
        </div>

        <div class="card-body">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Impuestos</a>
                    <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab" aria-controls="nav-reg" aria-selected="false">Régimen Fiscal</a>
                    <a class="nav-item nav-link" id="nav-iva-tab" data-toggle="tab" href="#nav-iva" role="tab" aria-controls="nav-iva" aria-selected="false">IVA</a>
                    <a class="nav-item nav-link" id="nav-cuenta-tab" data-toggle="tab" href="#nav-cuenta" role="tab" aria-controls="nav-cuenta" aria-selected="false">Cuentas por Pagar</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="col-md-12 col-lg-12" name="divappshow" id="divappshow">
                        <?php include('thedatashow.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="col-md-5 col-lg-5" style="margin: auto;">
                        <?php include('configreg.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-iva" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-md-5 col-lg-5" style="margin: auto;">
                        <?php include('configiva.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-cuenta" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="col-md-5 col-lg-5" style="margin: auto;">
                    <?php include('config_ctaxpagar.php');  //campos de la app 
                    ?>
                </div>
                </div>
            </div>
        </div>


    </div>


    <?php
    include('apps/thedata.php'); //scriops de control
    ?>

    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>
        function habilitacmpos() {
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }


        $('#form-control4').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-4.php',
                data: $('#form-control4').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-cuenta').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-4.php');
                    $('#codcuenta').val('');
                    $('#nombrecuenta').val('');
                    $('#porcentacuenta').val('');
                }
            });

            inhabilitacmpos();
        })

        $('#form-control3').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-3.php',
                data: $('#form-control3').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-iva').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-3.php');
                    $('#codiva').val('');
                    $('#nombreiva').val('');
                    $('#porcentajeiva').val('');
                }
            });

            inhabilitacmpos();
        })


        $('#form-control2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-2.php',
                data: $('#form-control2').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-reg').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-2.php');
                    $('#regfiscal').val('');
                    $('#idreg').val('');
                }
            });

            inhabilitacmpos();
        })

        $('#form-control').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud.php',
                data: $('#form-control').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.content-table-config').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla.php');
                    $('#cuentacontable').val("");
                    $('#nombrecu').val("");
                    $('#valoruvt').val("");
                    $('#basepesos').val("");
                    $('#porcentajeuvt').val("");

                }
            });

            inhabilitacmpos();
        })

        function deleteConfig1(id, aux) {
            Swal.fire({
                title: '¿Está seguro de eliminar?',
                text: "Está a punto de eliminar un registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00A400',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/delete.php?aux=' + aux + '&id=' + id,
                        success: function(respuesta) {

                            if (aux == '1') {
                                $('.content-table-config').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla.php');
                            } else if (aux == '2') {
                                $('.table-config-reg').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-2.php');
                            } else if (aux == '3') {
                                $('.table-config-iva').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-3.php');
                            } else if (aux == '4') {
                                $('.table-config-cuenta').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-4.php');
                            }

                        }
                    });
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado.',
                        'success'
                    )
                }
            })
        }

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