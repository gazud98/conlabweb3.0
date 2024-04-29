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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $aux = trim(htmlspecialchars($_REQUEST['aux']));

    if ($aux == 1) {

        $id_paciente = trim(htmlspecialchars($_REQUEST['id_paciente']));
        $procedencia = trim(htmlspecialchars($_REQUEST['procedencia']));
        $medico = trim(htmlspecialchars($_REQUEST['medico']));
        $empresa = trim(htmlspecialchars($_REQUEST['empresa']));
        $plan = trim(htmlspecialchars($_REQUEST['plan']));
        $user = trim(htmlspecialchars($_REQUEST['user']));
        $observacion_medico = trim(htmlspecialchars($_REQUEST['observacion_medico']));

        date_default_timezone_set('America/Bogota');
        $fchhora = date('Y-m-d H:i:s', time());

        $cadena = "SELECT id_sede FROM persona_empleados WHERE id_persona =" . $user;

        $resultadP2 = $conetar->query($cadena);
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {


            $id_sede =  trim($filaP2['id_sede']);
        }

        // Obtener el último valor de otro_campo_incremental
        $sql = "SELECT numero_orden FROM ingreso ORDER BY idingreso DESC LIMIT 1";
        $resultado = $conetar->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $numero_orden_ultimo = $fila['numero_orden'];
        } else {
            $numero_orden_ultimo = 0;
        }

        // Incrementar el valor
        $nuevo_valor = $numero_orden_ultimo + 1;

        $cadena = "insert into ingreso(fecha_ingreso,numero_orden,id_paciente,id_empresa,id_plan,idcentro_ingreso,id_procedencia,id_medico,observaciones_medico,estado_ingreso)values(
        '" . $fchhora .
            "','" . $nuevo_valor .
            "','" . $id_paciente .
            "','" . $empresa .
            "','" . $plan .
            "','" . $id_sede .
            "','" . $procedencia .
            "','" . $medico .
            "','" . $observacion_medico .
            "','PA')";
        $resultado = mysqli_query($conetar, $cadena);

        $sql = "SELECT idingreso FROM ingreso where numero_orden = $nuevo_valor";
        $resultado = $conetar->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $idingreso = $fila['idingreso'];
        } else {
            $idingreso = 0;
        }
        echo $idingreso;
    }
}//de hay cneion e bbd
