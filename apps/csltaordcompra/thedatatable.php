<?php
//SI POSEE CONSUKTA

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

?>

    <style>
        #icon:hover {
            background-color: rgb(242, 242, 242);
            color: black;
        }

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
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped table-hover table-head-fixed text-nowrap table responsive table-sm" id="tb" style="width:100%;">
        <thead>
            <tr>
                <th><i class="fa-solid fa-user-check"></i></th>
                <th>No.Orden</th>
                <th>Proveedor</th>
                <th>Fecha</th>

            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>

    <div class="col-md-4 col-lg-4">
        <label>Guia de Colores</label>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-1">
            <i style="color: red;" class="fa-solid fa-circle fa-xl"></i>
        </div>
        <div class="col-md-5 col-lg-5">
            <label style="font-size: 13px;">Ordenes Pendientes</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-1">
            <i style="color: Blue;" class="fa-solid fa-circle fa-xl"></i>

        </div>
        <div class="col-md-5 col-lg-5">
            <label style="font-size: 13px;">Ordenes Recibidas</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-1">
            <i style="color: green;" class="fa-solid fa-circle fa-xl"></i>
        </div>
        <div class="col-md-6 col-lg-6">
            <label style="font-size: 13px;">Ordenes Parcialmente Recibidas</label>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            miDataTable = $('#tb').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/mostrarordenes.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="radio" onclick="selectthefile1(' + full.thefile + ',' + full.codigo + ')" name="fileselect" id="fileselect' + full.thefile + '" value="' + full.codigo + '">';
                        }
                    }, {
                        "data": "codigo"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "fecha"
                    }

                ],
                "createdRow": function(row, data, dataIndex) {
                    // Condición para cambiar el color del texto en la columna "codigo"
                    if (data.estado_orden === "R") {
                        $('td', row).eq(1).css('color', 'blue'); // Cambia el color del texto en la columna "codigo" a rojo
                        $('td', row).eq(2).css('color', 'blue'); // Cambia el color del texto en la columna "nombre" a azul
                        $('td', row).eq(3).css('color', 'blue'); // Cambia el color del texto en la columna "fecha" a verde
                    }

                    // Condición para cambiar el color del texto en la columna "nombre"
                    if (data.estado_orden === "P") {
                        $('td', row).eq(1).css('color', 'red'); // Cambia el color del texto en la columna "nombre" a azul
                        $('td', row).eq(2).css('color', 'red'); // Cambia el color del texto en la columna "nombre" a azul
                        $('td', row).eq(3).css('color', 'red'); // Cambia el color del texto en la columna "nombre" a azul
                    }

                    // Condición para cambiar el color del texto en la columna "fecha"
                    if (data.estado_orden === "PR") {
                        $('td', row).eq(1).css('color', 'green'); // Cambia el color del texto en la columna "codigo" a rojo
                        $('td', row).eq(2).css('color', 'green'); // Cambia el color del texto en la columna "nombre" a azul
                        $('td', row).eq(3).css('color', 'green'); // Cambia el color del texto en la columna "fecha" a verde
                    }
                }
            });
        });

        function selectthefile1(thefile, id) {
            var theobject = "fileselect" + thefile;




            $("#btnsave").prop('disabled', false);


            $("#data1").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/data.php", {
                id: id
            });


            $("#btnord").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/modal.php", {
                id: id
            });
        }
    </script>

<?php } ?>