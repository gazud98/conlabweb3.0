<?php
//SI POSEE CONSUKTA

if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {
    ?>
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <div class="row" id="dt">
        <div class="col-md-1 col-lg-1">
            <label for="filtro">No. Solicitud:</label>
            <input type="text" class="form-control" name="nosolicitud" id="nosolicitud" style="height: 29px; widht:100%;"
                data-toggle="tooltip" data-placement="top" title="Escribe el numero de solicitud">
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="filtro">Producto:</label>
            <input type="text" class="form-control product" name="id_producto2" id="id_producto2" autocomplete="off"
                autofocus style="height: 29px; widht:100%;" data-toggle="tooltip" data-placement="top"
                title="Escribe el nombre del producto para una búsqueda inteligente.">
        </div>
        <div class="col-md-1 col-lg-1">
            <label for="filtro">Fecha Inicio:</label>
            <input type="date" class="form-control" id="fecha1" name="fecha1" style="height: 29px;">
        </div>
        <div class="col-md-1 col-lg-1">
            <label for="filtro">Fecha Fin:</label>
            <input type="date" class="form-control" id="fecha2" name="fecha2" style="height: 29px;">
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="filtro">Departamento:</label>
            <select class="form-control" name="id_departamento" id="id_departamento" style="widht:100%;">
                <option value=""></option>
                <?php
                $cadena = "SELECT id, nombre
                                FROM u116753122_cw3completa.departamentos
                                where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="filtro">Sede:</label>
            <select class="form-control" name="id_sede" id="id_sede" style="widht:100%;">
                <option value=""></option>
                <?php
                $cadena = "SELECT id_sedes, nombre
                                FROM u116753122_cw3completa.sedes
                                where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="filtro">Estado Solicitud:</label>
            <select class="form-control" name="estado" id="estado" style="widht:100%;">
                <option selected="true" disabled="disabled"></option>
                <option value="P">Pendiente</option>
                <option value="F">Finalizado</option>
                <option value="%">Todos</option>
            </select>
        </div>
        <div class="col-md-3 col-lg-3" style="margin-top:15px;">
            <button type="button" class="btn btn-primary btn-sm" value="Filtrar" id="button-fil">
                <i class="fa-solid fa-filter"></i> Filtrar Solicitudes
            </button>
        </div>
    </div>


    <div class="id_tabla">
        <table class="table table-striped table-hover table-head-fixed table responsive  text-nowrap table-sm table-tb"
            id="tb" style="width:100%;" data-toggle="tooltip" data-placement="top"
            title="Los resultados relacionados aparecerán en la tabla.">
            <thead>
                <tr>
                    <th style="text-align: center;width:10%;">No. Solicitud</th>
                    <th style="text-align: center;width:10%;">Fecha</th>
                    <th style="text-align: center;width:20%;">Departamento</th>
                    <th style="text-align: center;width:20%;">Sede</th>
                    <th style="text-align: center;width:15%;">Estado</th>
                    <th style="text-align: center;width:8%;">Ver Solicitud</th>
                </tr>
            </thead>
            <tbody>



            </tbody>
        </table>
    </div>
    <div class="modal" id="verord" style="width: 100%;">
        <div class="modal-dialog modal-xl" style="max-width: 50%;">
            <div class="modal-content">

                <!-- Modal Header -->

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" id="modalshow" name="modalshow">
                    <!-- Aquí puedes agregar el contenido del cuerpo del modal -->
                </div>
                <div class="row p-3" name="thebuttoms" id="thebuttoms">

                    <div class="col-md-6 col-xs-6">
                        <!-- Aquí puedes agregar botones u otros elementos según tus necesidades -->
                    </div>

                </div>
            </div>
        </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
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
                "processing": true,

                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listasolicitud/search.php', // URL de tu archivo PHP que devuelve los datos
                    type: 'GET', // Método HTTP utilizado para la solicitud
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                    data: function (d) {
                        d.nosolicitud = $('#nosolicitud').val();
                        d.id_producto2 = $('#id_producto2').val();
                        d.id_departamento = $('#id_departamento').val();
                        d.id_sede = $('#id_sede').val();
                        d.fecha1 = $('#fecha1').val();
                        d.fecha2 = $('#fecha2').val();
                        d.estado = $('#estado').val();
                    },
                },
                "columns": [
                    {
                        "data": "id"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "nombre_dpto"
                    },
                    {
                        "data": "nombre_sede"
                    },
                    {
                        "data": "estados"
                    }, {
                        "data": null,
                        "render": function (data, type, full, meta) {
                            return '<a href="#"  data-toggle="modal" data-target="#verord"  id="btnsol"  onclick="formato(' + full.id + ');" > <i class="fa-solid fa-eye" style="font-size:18px;"></i></a>';
                        }
                    }
                ]
            });
            $('#button-fil').click(function () {
                miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
            });
            $('#id_producto2').keyup(function () {
                miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
            });
            $('#id_sede').select2({
                language: "es"
            });
            $('#id_departamento').select2({
                language: "es"
            });
            $('#estado').select2({
                language: "es"
            });
        });

        function ejecutarForm() {
            var id_sede = $('#id_sede').val();
            var id_departamento = $('#id_departamento').val();
            var fecha1 = $('#fecha1').val();
            var fecha2 = $('#fecha2').val();
            var estado = $('#estado').val();
            var nosolicitud = $('#nosolicitud').val();
            miDataTable.columns(1).search(1).draw();


        }

        function filtroDatatable(data) {
            // Obtiene los valores de los campos del formulario





            $.ajax({
                url: 'https://conlabweb3.tierramontemariana.org/apps/listasolicitud/search.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    // Limpiar el DataTable y cargar los nuevos datos
                    miDataTable.clear().rows.add(data).draw();
                },
                error: function (xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error('Error al obtener datos:', status, error);
                }
            });



            // Realiza una solicitud AJAX para cargar los datos filtrados

        }



        function formato(id) {
            $("#modalshow").load("https://conlabweb3.tierramontemariana.org/apps/listasolicitud/modal.php", {
                id: id
            });

        }

        function selectthefile(thefile) {

            var theobject = "fileselect" + thefile;
            //elementoActivo.checked = true;

            //  id = elementoActivo.value;

            var id = $('input[name="' + theobject + '"]').val();

            var max = $('input[name="' + theobject + '"]').attr('max');

            /* for (let i = 1; i <= max; i++) {
                    $('#col' + [i]).css("border", "thin solid  transparent");
                }
                $('#col' + thefile).css("border", "4px groove #dc3545");
    */
            /*$("#btnord").load("/desarrolloV4/apps/listasolicitud/modal.php", {
                id: id
            });*/

        }


        $(document).ready(function () {
            $('#btnprint').click(function () {
                const contentDiv = document.getElementById('modalshow');
                printAreaDiv2(contentDiv);
            })
        })


        function printAreaDiv2(div) {

            const printContents = div.cloneNode(true);
            // Imprimir el contenido clonado directamente
            document.body.appendChild(printContents);
            window.print();
            // Eliminar el contenido clonado después de la impresión
            document.body.removeChild(printContents);

        }

    </script>

<?php } ?>