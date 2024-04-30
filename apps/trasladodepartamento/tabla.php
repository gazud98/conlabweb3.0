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
    if (isset($_REQUEST['id_prodc'])) {
        $id_prodc = $_REQUEST['id_prodc'];
        if ($id_prodc == "-1") {
            $id_prodc = "";
        }
    } else {
        $id_prodc = 0;
    }

    $cadena23 = "SELECT count(idbodegaentrapanio) as max 
    FROM u116753122_cw3completa.bodegaubcproducto where idproducto='" . $id_prodc . "' and identrepanio<>0;";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
}
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

    div.dataTables_wrapper div.dataTables_length label {
        font-size: 14px;
    }

    div.dataTables_wrapper div.dataTables_filter label {
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
<table class="table table-striped table responsive table-hover table-head-fixed text-nowrap table-sm table-departamento" style="margin-top: 2%;width:100%;">
    <thead>
        <tr>
            <th><i class="fa-solid fa-user-check"></i></th>
            <th style="text-align:center;">Codigo</th>
            <th style="text-align:center;">Referencia</th>
            <th style="text-align:center;">Insumo</th>
            <th style="text-align:center;">Bodega</th>
            <th style="text-align:center;">Estante</th>
            <th style="text-align:center;">Entrepaño</th>
            <th style="text-align:center;">Cantidad</th>
            <th data-orderable="true">Fecha Vencimiento</th>
        </tr>
    </thead>

    </tbody>
</table>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_producto').select2({
            language: "es"
        });
    });
    $(document).ready(function() {
        var miDataTable; // Declara la variable del DataTable fuera de $(document).ready

        // Agrega un listener de eventos para el cambio en el campo <select>



        miDataTable = $('.table-departamento').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "destroy": true,
            "searching": false,
            // ... Otras opciones ...
            "ajax": {
                url: 'https://conlabweb3.tierramontemariana.org/apps/trasladodepartamento/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                data: function(d) {

                    d.id_prodc = $('#id_producto2').val();
                },
            },

            "columns": [{
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<input type="radio" onclick="selectthefile3(' + full.thefile + ')"  name="fileselect3" id="fileselect3' + full.thefile + '" value="' + full.idproducto + '"  nom_insumo="' + full.nombre + '"     cant="' + full.cant + '" fchvence="' + full.fchvence + '"  max="' + <?php echo $max ?> + '"  identrepanio="' + full.identrepanio + '"  >';
                    }
                },
                {
                    "data": "idproducto"
                },
                {
                    "data": "referencia"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "bodega"
                },
                {
                    "data": "stand"
                },
                {
                    "data": "entrepanio"
                },
                {
                    "data": "cant"
                },
                {
                    "data": "fchvence"
                },
            ]
        });
        //  $('#button-fil').click(function() {
        //      miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        //  });
        $('#id_producto2').keyup(function() {
            miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });
    });

    function selectthefile3(thefile) {

        var theobject = "fileselect3" + thefile;
        var id_produ = $('#' + theobject).val();
        var nom_insumo = $('#' + theobject).attr('nom_insumo');
        var cant = $('#' + theobject).attr('cant');
        var fchvence = $('#' + theobject).attr('fchvence');
        var max = $('#' + theobject).attr('max');
        var identrepanio = $('#' + theobject).attr('identrepanio');

        for (let i = 1; i <= thefile; i++) {
            $('#' + [i]).prop('checked', false);
        }
        $('#' + theobject).prop('checked', true);

        $("#btndep").load("https://conlabweb3.tierramontemariana.org/apps/trasladodepartamento/trasladodep.php", {
            id_produ: id_produ,
            nom_insumo: nom_insumo,
            cant: cant,
            fchvence: fchvence,
            identrepanio: identrepanio
        });

    }
</script>