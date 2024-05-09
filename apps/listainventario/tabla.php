<?php


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

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <div class="row">
        <div class="col-md-3 border p-3">
          
            <label for="bodega" style="font-size: 14px;">Filtrar por Bodega:</label>
            <div class="input-group">
                <select name="bodega" id="bodega" class="form-control">
                    <option value="" selected disabled></option>
                    <?php
                    $sql = "SELECT id,  nombre FROM bodegas";
                    $rest = mysqli_query($conetar, $sql);
                    while ($data = mysqli_fetch_array($rest)) {
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nombre'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="button" id="btnSearch">Buscar</button>
                </div>
            </div>
        </div>
    </div>



    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm table-inventario" id="idinventario">
        <thead>
            <tr>
                <th class="text-center">Referencia</th>
                <th class="text-center">Nombre</th>
                <th class="text-center" style="width: 3%;">Cantidad en bodega</th>
                <th class="text-center">Ubicación</th>
                <th class="text-center" style="width: 5%;">Fecha Ingreso</th>
                <th class="text-center" style="width: 5%;">Fecha Vencimiento</th>
                <th class="text-center">Días de vida</th>
                <th class="text-center" style="width: 10%;">Cantidades físicas</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div class=" mt-2">
        <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel()">
            <i class="fa-solid fa-file-export"></i>&nbsp; Exportar excel
        </button>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#bodega').select2({
                language: "es"
            });
            miDataTable = $('.table-inventario').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "searching": true,
                // ... Otras opciones ...
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listainventario/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {
                        d.bodega = $('#bodega').val();
                    },
                },

                "columns": [{
                        "data": "referencia"
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
                            return '<span style="color:blue;">' + full.bodega + '</span>--<span style="color:green;">' + full.stand + '</span>--<span style="color:red;">' + full.entrepanio + '</span>';
                        }
                    },
                    {
                        "data": "fecha_ingreso"
                    },
                    {
                        "data": "fchvence"
                    },
                    {
                        "data": "dias"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="text" name="" id="comentario-' + full.idbodegaentrapanio + '" class="form-control>" value="' + full.cant_fisicas + '" onkeydown="handleEnter(event, ' + full.idbodegaentrapanio + ')">' +
                                '<input type="hidden" name="idp" id="idp-' + full.idbodegaentrapanio + '" value="' + full.idbodegaentrapanio + '">'
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            if (full.ok == '1') {
                                return '<span>Ok <input type="checkbox" checked id="okbtn" onchange="setOk(' + full.idbodegaentrapanio + ')"></span>';
                            } else {
                                return '<span>Ok <input type="checkbox" id="okbtn" onchange="setOk(' + full.idbodegaentrapanio + ')"></span>';
                            }
                        }
                    }
                ]
            });
            $('#btnSearch').click(function() {
                miDataTable.ajax.reload();
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

        function handleEnter(event, id) {
            if (event.key === 'Enter') {

                event.preventDefault();

                //alert(id)

                $.ajax({
                    method: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listainventario/crud.php?aux=1',
                    data: {
                        comentario: $('#comentario-' + id).val(),
                        id: $('#idp-' + id).val()
                    },
                    success: function(res) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: res,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })

            }

        }

        function setOk(id){
            $.ajax({
                    method: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listainventario/crud.php?aux=2',
                    data: {
                        id: $('#idp-'+id).val()
                    },
                    success: function(res) {
                        console.log('Ok')
                        if(res == '1'){
                            $('#okbtn').attr('checked', true);
                        }else{
                            $('#okbtn').attr('checked', false);
                        }
                    }
                })
        }

        function getOk(id){
            $.ajax({
                    method: 'GET',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listainventario/crud.php?aux=3',
                    data: {
                        id: $('#idp-'+id).val()
                    },
                    success: function(res) {
                        console.log('Ok')
                    }
                })
        }

    </script>

<?php } ?>