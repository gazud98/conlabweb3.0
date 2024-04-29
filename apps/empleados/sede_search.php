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


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {



    $q = $_GET['q'];

    // Query para obtener registros basados en el término de búsqueda
    $query = "SELECT id_sedes, nombre
    FROM sedes
    where estado='1' and nombre LIKE '%$q%'";
    $resultado = mysqli_query($conetar, $query);
    
    // Crear un array para almacenar los resultados
    $resultados = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $resultados[] = array(
            'id' => $fila['id_sedes'],
            'text' => $fila['nombre']
        );
    }
    
    // Devuelve los resultados como formato JSON
    echo json_encode($resultados);






}
?>