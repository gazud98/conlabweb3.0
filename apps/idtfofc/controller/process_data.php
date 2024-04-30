<?php




$conetar = new mysqli('localhost','u116753122_erbin', '3012046491@Erbin', 'u116753122_cw3completa');
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    $id = "";
    $identificacion_legal = "";
    $codigo_ria = "";
    $licencia = "";
    $nombre_empresa = "";
    $direccion = "";
    $pais = "";
    $ciudad = "";
    $telefono = "";
    $codigo_postal = "";
    $fax = "";
    $email = "";
    $direccion_electronica = "";
    $estado = "1";

    $cadena = "select id,identificacion_legal,codigo_ria,
                licencia,nombre_empresa,direccion,pais,ciudad,
                telefono,codigo_postal,fax,email,direccion_electronica
                    from u116753122_cw3completa.identificacion_empresa";
    //                      echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $identificacion_legal = trim($filaP2['identificacion_legal']);
        $codigo_ria = trim($filaP2['codigo_ria']);
        $ciudad = trim($filaP2['ciudad']);
        $licencia = trim($filaP2['licencia']);
        $nombre_empresa = trim($filaP2['nombre_empresa']);
        $direccion = trim($filaP2['direccion']);
        $pais = trim($filaP2['pais']);
        $telefono = trim($filaP2['telefono']);
        $codigo_postal = trim($filaP2['codigo_postal']);
        $fax = trim($filaP2['fax']);
        $email = trim($filaP2['email']);
        $direccion_electronica = trim($filaP2['direccion_electronica']);
    }

    //  después de procesar los datos, envía la respuesta como JSON
    $response = array(
        'id' => $id,
        'identificacion_legal' => $identificacion_legal,
        'codigo_ria' => $codigo_ria,
        'ciudad' => $ciudad,
        'licencia' => $licencia,
        'nombre_empresa' => $nombre_empresa,
        'direccion' => $direccion,
        'pais' => $pais,
        'telefono' => $telefono,
        'codigo_postal' => $codigo_postal,
        'fax' => $fax,
        'email' => $email,
        'direccion_electronica' => $direccion_electronica
    );

    echo json_encode($response);
}
?>
