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

    <table class="table table-imp" >
        <thead>
            <tr>
                <th>CUENTA</th>
                <th>NOMBRE</th>
                <th>VALOR UVT</th>
                <th>BASE EN PESOS $</th>
                <th>%</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT id_config_imp, codigo_cuenta, nombre_cuenta, valor_uvt_config, base_pesos, porcentaje_uvt
                    from u116753122_cw3completa.config_impuestos";

            $rest = $conetar->query($sql);
            $numerfiles2 = mysqli_num_rows($rest);

            if ($numerfiles2 >= 1) {

                while ($filaP3 = mysqli_fetch_array($rest)) {

            ?>

                    <tr>
                        <td><?php echo $filaP3['codigo_cuenta']; ?></td>
                        <td><?php echo $filaP3['nombre_cuenta']; ?></td>
                        <td><?php

                            $valor_uvt = number_format($filaP3['valor_uvt_config'], '2', '.', ',');

                            echo '$' . $valor_uvt;

                            ?></td>
                        <td><?php

                            $base_pesos = number_format($filaP3['base_pesos'], '2', '.', ',');

                            echo '$' . $base_pesos;

                            ?></td>
                        <td><?php echo $filaP3['porcentaje_uvt']; ?></td>
                        <td><a href="#" onclick="buscarData(<?php echo $filaP3['id_config_imp']; ?>)"><i class="fa-solid fa-pen-to-square" style="font-size: 13px; color:blue;"></i></a>
                            <a href="#" onclick="deleteConfig1(<?php echo $filaP3['id_config_imp']; ?>, '1')"><i class="fa-solid fa-trash" style="font-size: 13px; color:red;"></i></a>
                        </td>
                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        miDataTable = new DataTable('.table-imp', {
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