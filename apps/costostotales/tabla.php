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
        font-size: 15px;
    }

    #btnsol {
        font-size: 11px;
    }

    div.dataTables_wrapper div.dataTables_length label {
        display: none;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        display: none !important;
    }

    div.dataTables_wrapper div.dataTables_filter label {
        display: none !important;
    }

    #dt {
        font-size: 14px;
        padding: 1%;
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

<table class="table table-striped table-hover table-head-fixed table responsive  text-nowrap table-sm table-reportes-costos">

    <thead>
        <tr>
            <th style="width:25%;">Nombre Examen</th>
            <th style="width:15%;">Costo Total</th>
            <th style="width:15%;">Fecha</th>
            <th style="width:15%;">Hora</th>
            <th style="width:15%;">Gastos Administrativos</th>
            <th style="width:10%;"></th>
        </tr>
    </thead>

    <tbody>

    </tbody>

</table>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(1,103,183);color:white; text-align:center;">
                <h5 class="modal-title">Detalle Costo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalshow">

            </div>

        </div>
    </div>
</div>


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        miDataTable1 = $('.table-reportes-costos').DataTable({
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
                url: '/cw3/conlabweb3.0/apps/costostotales/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [

                {
                    "data": "nombre_examen"
                },
                {
                    "data": "total_valor",
                },
                {
                    "data": "fecha",
                },
                {
                    "data": "hora",
                },
                {
                    "data": "valor_admin",
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<a href="#" data-toggle="modal" onclick="openModal(\''+data.fecha+'\',\''+data.hora+'\')" data-target=".bd-example-modal-lg" ><i class="fa-solid fa-eye" style="font-size:18px;"></i></a>';

                    }
                }
            ]
        })

    });
   

    function openModal(fecha, hora) {

        $("#modalshow").load("/cw3/conlabweb3.0/apps/costostotales/content-modal.php",{
            fecha:fecha,hora: hora  
        });
       
    }
</script>