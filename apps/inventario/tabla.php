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
    FROM bodegaubcproducto where idproducto='" . $id_prodc . "' and identrepanio<>0;";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
    $cadena = "SELECT a.idbodegaentrapanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre as stand,e.nombre as bodega,a.fchvence, SUM(a.cant_recibida) as cant,b.nombre 
    FROM bodegaubcproducto a JOIN producto b ON a.idproducto = b.id_producto JOIN bodegaentrepanio c 
    ON a.identrepanio = c.id JOIN bodegastand d ON c.idstand = d.id JOIN bodegas e ON d.idbodega = e.id 
    WHERE a.identrepanio <> 0 AND a.cant_recibida <> 0 AND a.idproducto = " . $id_prodc . " GROUP BY a.fchvence,a.identrepanio 
    ORDER BY a.fchvence ASC;";


    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);

?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    
    
    <div class="content-buttons mb-3">
        <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel()"><i class="fa-solid fa-file-export"></i>&nbsp; Exportar excel</button>
    </div>

    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table-inventario" id="idinventario">
        <thead>
            <tr>
                <th style="text-align: center !important;">Referencia</th>
                <th style="text-align: center !important;">Categoría</th>
                <th style="text-align: center !important;">Nombre</th>
                <th style="text-align: center !important;">Cantidad en bodega</th>
                <th style="text-align: center !important;">Ubicación</th>
                <th style="text-align: center !important;">Valor unitario</th>
                <th style="text-align: center !important;">Valor total</th>
                <th style="text-align: center !important;">Promedio ponderado</th>
                <th style="text-align: center !important;">Fecha Ingreso</th>
                <th style="text-align: center !important;">Fecha Vencimiento</th>
                <th style="text-align: center !important;">Días de vida</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    
    <script>

        $(document).ready(function() {

            miDataTable = $('.table-inventario').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "searching": true,
                // ... Otras opciones ...
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/inventario/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '' // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                },

                "columns": [{
                        "data": "referencia"
                    },
                    {
                        "data": "categoria"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "cant"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<span style="color:blue;">'+full.bodega+'</span>--<span style="color:green;">'+full.stand+'</span>--<span style="color:red;">'+full.entrepanio+'</span>';
                        }
                    },
                    {
                        "data": "valor_unitario"
                    },
                    {
                        "data": "valor_total"
                    },
                    {
                        "data": "valor_h"
                    },
                    {
                        "data": "fecha_ingreso"
                    },
                    {
                        "data": "fchvence"
                    },
                    {
                        "data": "dias"
                    }
                ]
            });

        });
        
        function exportarExcel() {
            var nombreArchivo = 'inventario.xlsx';
            var tabla = document.getElementById('idinventario');
            var tablaHTML = tabla.outerHTML;
            var workbook = XLSX.utils.table_to_book(tabla);
            var excelBuffer = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'array'
            });
            var blob = new Blob([excelBuffer], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = nombreArchivo;
            a.click();
            URL.revokeObjectURL(url);

            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Archivo exportado con éxito!',
                showConfirmButton: false,
                timer: 1000
            })

    }
        
    </script>

<?php } ?>