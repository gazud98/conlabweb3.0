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
    echo json_encode(['error' => $error]);
} else {
    $id_num = $_POST['id_num'];
    $sql = "SELECT 
       p.id_pacientes
    FROM 
        pacientes p
        JOIN tipo_identificacion tp ON p.id_tipo_identificacion = tp.id
        JOIN sexo s ON p.id_tipo_genero = s.id
        JOIN departamento d ON d.id = p.departamento
        JOIN ciudades c ON c.id = p.ciudad
        JOIN tp_vias tpv ON tpv.id = p.id_tipovia 
    WHERE p.documento = ".$id_num;

    $result = $conetar->query($sql);
    $datos = array();

    if ($result) {
        while ($filaP2 = mysqli_fetch_assoc($result)) {
            $datos[] = $filaP2;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($datos);
    
    $conetar->close();
}
?>
