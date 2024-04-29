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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['datos'])) {

            $datos = json_decode($_POST['datos'], true);

            foreach ($datos as $element) {
                $id = $element['id'];
                $nombre = $element['nombre'];
                $ide = $element['ide'];

                $cadena = "SELECT nombre_examen FROM lista_precio WHERE nombre_examen LIKE '%$nombre%' AND id_detalle_lista = '$ide'";

                $rest = mysqli_query($conetar, $cadena);

                $rows = mysqli_num_rows($rest);

                if($rows != 1){
                    $sql = "INSERT INTO lista_precio(codigo_cups, nombre_examen, id_detalle_lista) VALUES ('$id', '$nombre', '$ide')";
                }else{
                    echo "¡Este examen ya está en la lista!";
                }

                $result = $conetar->query($sql);

                if (!$result) {
                    $error = "Error en la consulta SQL: " . $conetar->error;
                    echo $error;
                    break;
                }
            }

            $conetar->close();

            $response = ['success' => true];
            echo json_encode($response);

        } else {
            echo "No se recibieron datos.";
        }
    } else {
        echo "Método no permitido.";
    }
}
