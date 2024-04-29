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


    $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono,direccion_electronica
    FROM  u116753122_cw3completa.identificacion_empresa
    where 1=1";
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    date_default_timezone_set('America/Bogota');
    $fechaActual = date("d/m/Y");

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }
}
?>


<?php include("../../apps/formatos/requisicion.php") ?>


<script>
    <?php
    if (isset($_REQUEST['aux'])) {
    ?>
        window.print()

    <?php } else {} ?>
</script>