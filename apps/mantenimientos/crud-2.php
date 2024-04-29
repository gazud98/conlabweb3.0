<?php
$result = "err";
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

    $aux = 0;

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {
        $daño = trim($_POST['daño']);
        $equipo = trim($_POST['equipo']);
        $localizacion = trim($_POST['localizacion']);
        $respuestos = trim($_POST['respuestos']);
        $empresa = trim($_POST['empresa']);
        $telefono = trim($_POST['telefono']);
        $tecnico = trim($_POST['tecnico']);
        $valor_factura = trim($_POST['valor_factura']);
        $fechacorrectivo = date('Y-m-d', strtotime(trim($_POST['fechacorrectivo'])));
        $num_factura = trim($_POST['numfactura']);
        $fecha_factura = trim($_POST['fechafactura']);

        $cadena = "INSERT INTO correctivo(fecha_final,equipo,id_sede,
        daño, respuestos, empresa,telefono,tecnico,valor_factura, num_factura, fecha_factura,
        estado_mantenimiento, aux)
        VALUES('" . $fechacorrectivo . "','" .
            $equipo . "','" .
            $localizacion . "','" .
            $daño . "','" . $respuestos . "','" . $empresa . "','" .
            $telefono . "','" . $tecnico . "','" . $valor_factura . "','" . $num_factura . "','" . $fecha_factura . "','P','C')";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($aux == 2) {

        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $daño = trim($_POST['daño']);
        $equipo = trim($_POST['equipo']);
        $localizacion = trim($_POST['localizacion']);
        $respuestos = trim($_POST['respuestos']);
        $empresa = trim($_POST['empresa']);
        $telefono = trim($_POST['telefono']);
        $tecnico = trim($_POST['tecnico']);
        $valor_factura = trim($_POST['valor_factura']);
        $fechacorrectivo = date('Y-m-d', strtotime(trim($_POST['fechacorrectivo'])));
        $num_factura = trim($_POST['numfactura']);
        $fecha_factura = trim($_POST['fechafactura']);

        $cadena = "UPDATE correctivo SET
                                fecha_final = '" . $fechacorrectivo . "',
                                equipo = '" . $equipo . "',
                                id_sede = '" . $localizacion . "',
                                daño = '" . $daño . "',
                                respuestos = '" . $respuestos . "',
                                empresa = '" . $empresa . "',
                                telefono = '" . $telefono . "',
                                tecnico = '" . $tecnico . "',
                                valor_factura = '" . $valor_factura . "',
                                num_factura = '" . $num_factura . "',
                                fecha_factura = '" . $fecha_factura . "'
                            WHERE id = '" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);

        $result = "ok";
    }

}
