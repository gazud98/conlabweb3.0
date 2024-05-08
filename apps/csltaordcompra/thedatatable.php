<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped table-hover table-head-fixed text-nowrap table responsive table-sm" id="tb" style="width:100%;">
        <thead>
            <tr>
                <th style="text-align:center;">Ver</th>
                <th style="text-align:center;">No.Orden</th>
                <th style="text-align:center;">Proveedor</th>
                <th style="text-align:center;">Fecha</th>

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
                            return '<a href="#" data-toggle="tooltip" data-placement="top" title="Click para ver el detalle de la orden de compra" onclick="selectthefile1(' + full.codigo + ')"  value="' + full.codigo + '"><i class="fa-solid fa-eye" style="font-size:14px;"></i></a>';
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

        function selectthefile1( id) {
        




            $("#btnsave").prop('disabled', false);

            $("#btnorde").prop('disabled', false);

            $("#data1").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/data.php", {
                id: id
            });


            $("#btnord").load("https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/modal.php", {
                id: id
            });
        }
    </script>

<?php } ?>