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


    include('reglasdenavegacion.php');


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $id = trim($_REQUEST['id']);

    $cadena2="SELECT id_config_imp, codigo_cuenta, nombre_cuenta, valor_uvt_config, base_pesos, porcentaje_uvt 
    FROM u116753122_cw3completa.config_impuestos 
    WHERE id_config_imp = '$id'";
    $resultadP2=$conetar->query($cadena2);

    while($fileP2 = mysqli_fetch_array($resultadP2)){
        $idr = $fileP2['id_config_imp'];
        $codigo_cuenta = $fileP2['codigo_cuenta'];
        $nombre_cuenta = $fileP2['nombre_cuenta'];
        $valor_uvt_config = $fileP2['valor_uvt_config'];
        $base_pesos = $fileP2['base_pesos'];
        $porcentaje_uvt = $fileP2['porcentaje_uvt'];
    }

    $data[] = array(
        'id' => $idr,
        'cod' => $codigo_cuenta,
        'nombre' => $nombre_cuenta,
        'valor' => $valor_uvt_config,
        'base' => $base_pesos,
        'porcentaje' => $porcentaje_uvt
    );

    echo json_encode($data);

}
