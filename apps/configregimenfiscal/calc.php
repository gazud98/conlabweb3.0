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

    if (isset($_REQUEST['cod'])) {

        $cod = $_REQUEST['cod'];

        $sql = "SELECT codigo_info, descripcion, valor_uvt, base_uvt 
                                FROM u116753122_cw3completa.codigo_contable WHERE codigo_info = '$cod';";

        $rest = $conetar->query($sql);
        $numerfiles2 = mysqli_num_rows($rest);

        if ($numerfiles2 >= 1) {

            while ($filaP3 = mysqli_fetch_array($rest)) {

                $valor = $filaP3['valor_uvt'];
                $base = $filaP3['base_uvt'];
            }
        }
    }

    $basepesos = $valor * $base;

    $data[] = array(
        'valor'=> $valor,
        'base'=> $base,
        'basepesos' => $basepesos
    );

    echo json_encode($data);
}

?>
