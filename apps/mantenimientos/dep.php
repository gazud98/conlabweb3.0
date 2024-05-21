<?php
$result = "err";
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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $id = $_REQUEST['id'];

}

?>

<?php
$sql =  "SELECT id, nombre FROM departamentos WHERE sede = '$id'";
$rest = mysqli_query($conetar, $sql);

while ($filaP2a = mysqli_fetch_array($rest)) {
?>
    <option value="<?php echo $filaP2a['id']; ?>"><?php echo $filaP2a['nombre']; ?></option>
<?php
}
?>