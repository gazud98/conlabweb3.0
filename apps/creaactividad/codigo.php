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

$cadena = "select max(id_actividad_seguimiento) as id, estado
                   from u116753122_cw3completa.actividad_seguimiento";
$resultadP2 = $conetar->query($cadena);
$numerfiles2 = mysqli_num_rows($resultadP2);
if ($numerfiles2 >= 1) {

    $filaP2a = mysqli_fetch_array($resultadP2);
    $id = $filaP2a['id'];
    $estado = $filaP2a['estado'];
}
}
?>


<label style="font-size: 12px;">Codigo:</label>
<input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
<?php if ($estado == '0') {
    echo "<span style='color:red;'> Inhabilitado</span>";
} ?>



