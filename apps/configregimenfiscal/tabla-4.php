<?php
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

?>

    <table class="table table-imp-4">
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>DESCRIPCIÓN</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT id_ctapagar, codigo_ctapagar, descripcion FROM u116753122_cw3completa.config_ctaxpagar";

            $rest = $conetar->query($sql);
            $numerfiles2 = mysqli_num_rows($rest);

            if ($numerfiles2 >= 1) {

                while ($filaP3 = mysqli_fetch_array($rest)) {

            ?>

                    <tr>
                        <td><?php echo $filaP3['codigo_ctapagar']; ?></td>
                        <td><?php echo $filaP3['descripcion']; ?></td>
                        <td><a href="#" id="buscardata" onclick="buscarData3(<?php echo $filaP3['id_ctapagar']; ?>)"><i class="fa-solid fa-pen-to-square" style="font-size: 13px;color:blue;"></i></a>
                        <a href="#" onclick="deleteConfig1(<?php echo $filaP3['id_ctapagar']; ?>, '4')"><i class="fa-solid fa-trash" style="font-size: 13px; color:red;"></i></a></td>
                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        miDataTable = new DataTable('.table-imp-4', {
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                autoFilter: true,
                sheetName: 'Exported data'
            }],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        })
    </script>


<?php } ?>