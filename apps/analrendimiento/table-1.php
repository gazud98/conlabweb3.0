<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">


<style>
    .dt-buttons .dt-button {
        border: none !important;
        background: #17AB00 !important;
        color: #fff !important;
    }
</style>

<div class="row content-filters m-4">
    <div class="col-md-2">
        <label for="">Fecha Inicial:</label>
        <input type="date" class="form-control" name="fecha_a" id="fecha_a">
    </div>
    <div class="col-md-2">
        <label for="">Fecha Final:</label>
        <input type="date" class="form-control" name="fecha_c" id="fecha_c">
    </div>
    <div class="col-md-2" style="margin-top:28px;">
        &nbsp;&nbsp;<button class="btn btn-info btn-sm" id="btnSearch">Buscar</button>
    </div>
</div>
<button type="button" class="btn btn-light" onclick="exportarExcel()" title="Generar Excel">
    <i class="fa-solid fa-file-excel fa-2x" style="color:green;transition: color 0.3s;"></i>&nbsp;&nbsp;Generar Excel

</button>


    <table class="table table-striped table-hover table-head-fixed table responsive text-nowrap table-roporte-insumos" id="tableroporteinsumos">
        <thead>
            <tr>
                <th>Nombre de la prueba</th>
                <th>Fecha - apertura</th>
                <th>Fecha - cierre</th>
                <th>N° Controles</th>
                <th>N° Calibradores</th>
                <th>N° Verificaciones</th>
                <th>N° Diluciones</th>
                <th>Rendimiento</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        miDataTable = $('.table-roporte-insumos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                url: '/cw3/conlabweb3.0/apps/analrendimiento/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '',
                data: function(d) {

                    d.fecha1 = $('#fecha_a').val();
                    d.fecha2 = $('#fecha_c').val();

                }
            },
            "columns": [{
                    "data": "name_examen"
                },
                {
                    "data": "fecha_apertura"
                },
                {
                    "data": "fecha_cierre"
                },
                {
                    "data": "n_controles"
                },
                {
                    "data": "n_calibradores"
                },
                {
                    "data": "n_verificaciones"
                },
                {
                    "data": "n_diluciones"
                },
                {
                    "data": "rendimiento",
                    "render": function(data, type, full, meta) {
                        return '% ' + full.rendimiento;

                    }
                }
            ]
        });

        $('#btnSearch').click(function() {
            miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });

    });
</script>