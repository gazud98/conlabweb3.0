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

    $aux = 0;

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    $id = trim($_POST['id']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $id_rol = trim($_POST['id_rol']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($aux == 1) {
        $cadena = "INSERT INTO users
                         (id_users, username, password, 
                         ban_reason, last_ip, last_login, created,id_rol) 
                         VALUES ('" . $id . "', '" . $username . "', '" . $hashed_password . "', 
                         NULL, NULL, '1000-01-01 00:00:00.000000', '1000-01-01 00:00:00.000000','" .   $id_rol . "')";
        $resultado = mysqli_query($conetar, $cadena);


        $result = "ok";
    } else if ($aux == 2) {

        $id = "";

        if(isset($_POST['id'])){
            $id = $_POST['id'];
        }

        $cadena = "UPDATE users SET
        username='" . $username . "',
        password='" . $hashed_password . "',
        id_rol='" . $id_rol . "'
        WHERE id_users = '" . $id . "'";

        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }else if($aux == 3){

        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        
        $cadena = "select estado from persona where id_persona='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2a);
            $estado = trim($filaP2a['estado']);
        } else {
            $estado = '1';
        }
        if ($estado == '1') {
            $estado = '0';
        } else {
            $estado = '1';
        }
        $cadena = "update persona set estado='" . $estado . "' where id_persona='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }

}
