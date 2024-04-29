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
} else {





    if (isset($_REQUEST['tipo_activo'])) {
        $tipo_activo = $_REQUEST['tipo_activo'];

        if ($tipo_activo == "-1") {
            $tipo_activo = "";
        }
    } else {
        $tipo_activo = 0;
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

   

    if ($id <> 0 and $tipo_activo <>  0 ) {

        $cadena = "insert into u116753122_cw3completa.tipo_activo_proveedor( id_proveedor,id_tipo_activo)values(
        '" . $id .
            "','" . $tipo_activo .
            "')";
        $resultado = mysqli_query($conetar, $cadena);
    }
?>

    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
        <thead>
            <tr style="text-align: center; font-size: 12px;">
                <th>Id</th>
                <th>Nombre</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $cadena = "SELECT a.id,a.nombre
                          FROM  u116753122_cw3completa.tipo_activo_fijos a, u116753122_cw3completa.tipo_activo_proveedor b
                          where b.id_tipo_activo = a.id
                          and b.id_proveedor =" . $id;
            // echo $cadena;
            /**/
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            ?>
            <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                <tr style="text-align: center; font-size: 12px;">
                    <td>
                        <?php echo $filaP2['id']; ?>
                    </td>
                    <td>
                        <?php echo $filaP2['nombre']; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>