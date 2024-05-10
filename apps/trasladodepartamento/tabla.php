<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<table class="table table-striped table responsive table-hover table-head-fixed text-nowrap table-sm table-departamento" style="margin-top: 2%;width:100%;">
    <thead>
        <tr>

            <th style="text-align:center;">Codigo</th>
            <th style="text-align:center;">Referencia</th>
            <th style="text-align:center;">Insumo</th>
            <th style="text-align:center;">Bodega</th>
            <th style="text-align:center;">Estante</th>
            <th style="text-align:center;">Entrepaño</th>
            <th style="text-align:center;">Cantidad</th>
            <th data-orderable="true">Fecha Vencimiento</th>
            <th style="text-align:center;">Traslado</th>
        </tr>
    </thead>

    </tbody>
</table>
<div id="btndep">

</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        return '<a href="#" data-toggle="tooltip" data-placement="top"  data-toggle="modal" data-target="#modalterc" title="Click para realizar el traslado de departamento" onclick="selectthefile3(' + full.idproducto + ', \'' + full.nombre + '\', ' + full.cant + ', \'' + full.fchvence + '\', ' + full.identrepanio + ')"><i class="fa-solid fa-cart-flatbed" style="font-size:14px;"></i></a>';
                    }
                }
            ]
        });
        //  $('#button-fil').click(function() {
        //      miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        //  });
        $('#id_producto2').keyup(function() {
            miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
        });
    });

        $("#btndep").load("https://conlabweb3.tierramontemariana.org/apps/trasladodepartamento/trasladodep.php", {
    function selectthefile3(id_produ, nom_insumo, cant, fchvence, identrepanio) {
            id_produ: id_produ,
            nom_insumo: nom_insumo,
            cant: cant,
            fchvence: fchvence,
            identrepanio: identrepanio
        }, function(response, status, xhr) {
            if (status == "error") {
                console.error("Error al cargar el contenido del modal:", xhr.status, xhr.statusText);
                // Aquí puedes manejar el error, por ejemplo, mostrando un mensaje al usuario
            } else {
                console.log("El contenido del modal se cargó correctamente.");
                // Aquí puedes abrir el modal
                $('#modalterc').modal('show');
            }
        });

    }
</script>