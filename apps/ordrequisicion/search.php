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



    $nombre = $_POST['nombre'];
    $nosolicitud = $_POST['nosolicitud'];
    $ccosto = $_POST['ccosto'];
    $referencia = $_POST['referencia'];
    $estado = $_POST['estado'];

    // Query para obtener registros basados en el término de búsqueda
    $query = "SELECT a.id,a.fecha, e.nombre as costo,c.nombre as nombre_sede, case when a.estado = 'P' then 'Pendiente' end as estado_solicitud, 
    b.nombre_1,b.nombre_2,b.apellido_1,b.apellido_2
     FROM  u116753122_cw3completa.ordrequisicion a, u116753122_cw3completa.persona b,u116753122_cw3completa.sedes c ,u116753122_cw3completa.ordrequisicion_detalle d,u116753122_cw3completa.centro_costos e
      where 1=1 
      and b.id_persona = a.id_persona 
      and a.id_sede = c.id_sedes  and a.id = d.id_req and e.id = d.ccosto";
    $resultado = $conetar->query($query);
    $thefile =0;
    // Crear un array para almacenar los resultados
    $resultados = array();
    while ($fila = mysqli_fetch_array($resultado)) {
       
        $thefile = $thefile + 1;
        $resultados[] = array(
            'id' => $fila['id'],
            'nombre_sede' => $fila['nombre_sede'],
            'nombre_persona' => $fila['nombre_1']. " " .$fila['nombre_2']. " " . $fila['apellido_1']. " " .$fila['apellido_2'],
            'estados' => $fila['estados'],
            'costo' => $fila['costo'],
            'fecha' => $fila['fecha'],
   
        );
    }
    
    // Devuelve los resultados como formato JSON
    echo json_encode($resultados);






}
