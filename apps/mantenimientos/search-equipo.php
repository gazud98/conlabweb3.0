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

    $id = $_REQUEST['id'];

    $cadena33 = "SELECT a.id_producto, a.referencia, a.nombre AS producto, p.nombre AS dep, s.nombre AS sede
                    FROM producto a, departamentos p, sedes s
                    where a.estado='1'
                    and id_categoria_producto ='1' and op_mantenimiento = '1' AND a.id_departamento = p.id
                    AND a.id_sede = s.id_sedes AND a.id_sede = '$id'";
    $resultadP2a33 = $conetar->query($cadena33);
    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
    if ($numerfiles2a33 >= 1) {
        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {

?>

            <option value="<?php echo $filaP2a33['id_producto']; ?>"><?php echo $filaP2a33['producto'] . '-' . $filaP2a33['dep'] . '-' . $filaP2a33['referencia'] ?></option>

<?php

        }
    }else{
        echo 0;
    }
}

?>