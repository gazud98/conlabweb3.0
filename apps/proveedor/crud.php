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

    $regimen_fiscal = trim($_POST['regfiscal']);
    $id_tipo_contribuyente = trim($_POST['id_tipo_contribuyente']);
    $id_tipo_identificacion = trim($_POST['id_tipo_identificacion']);
    $numero_identificacion = trim($_POST['documento']);
    $razon_social = trim($_POST['razon_social']);
    $nombre_comercial = trim($_POST['nombre_comercial']);
    $direccion = trim($_POST['direccion']);
    $reteiva = trim($_POST['reteiva']);
    $retenfuente = trim($_POST['retenfuente']);
    $reteica = trim($_POST['reteica']);
    $telefono = trim($_POST['telefono']);
    $digverificacion = trim($_POST['digverificacion']);
    $email = trim($_POST['email']);
    $id_pago = trim($_POST['id_pago']);
    $estado = trim($_POST['estado']);
    $representante_legal = trim($_POST['representante_legal']);
    $codigo_act_eco_1 = trim($_POST['codigo_act_eco_1']);
    $codigo_act_ind_comer = trim($_POST['codigo_act_ind_comer']);
    $observaciones = trim($_POST['observaciones']);
    //$telefono2 = trim($_POST['telefono2']);
    $categoria = trim($_POST['categoria']);
    $nombrec = trim($_POST['nombrec']);
    $telefonoc = trim($_POST['telefonoc']);
    $emailc = trim($_POST['emailc']);
    //$critico = trim($_POST['critico']);
    $descripcion = trim($_POST['descripcion']);
    $ciudad = trim($_POST['ciudad']);
    $dep = trim($_POST['dep']);
    $cuentapagar = trim($_POST['cuentapagar']);
    $pais = trim($_POST['pais']);

    if ($aux == 1) {
        $cadena = "INSERT into proveedores(
            id_tipo_contribuyente,id_tipo_identificacion, numero_identificacion, razon_social, nombre_comercial,
              direccion,telefono,email,representante_legal,codigo_act_eco_1,codigo_act_ind_comer,
              observaciones,id_pago,dv,categoria,nombrec,telefonoc,emailc,descripcion,id_regimen,ciudad,retenfuente,reteica,cuenta_pagar,id_departamento,estado
          )values('" .
            $id_tipo_contribuyente . "','" . $id_tipo_identificacion . "','" .
            $numero_identificacion . "','" . $razon_social . "','" . $nombre_comercial . "','" . $direccion . "','" .
            $telefono . "','" . $email . "','" . $representante_legal . "','" . $codigo_act_eco_1 . "','" .
            $codigo_act_ind_comer . "','" . $observaciones . "','" . $id_pago . "'
            ,'" . $digverificacion . "','" . $categoria . "','" . $nombrec . "','" . $telefonoc . "','" . $emailc .
            "','" . $descripcion . "','" . $regimen_fiscal . "','" . $pais . "','" . $ciudad . "','" . $retenfuente . "','" . $reteica . "','" . $cuentapagar . "','" . $dep . "','1')";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($aux == 2) {

        $ide = trim($_POST['id']);

        $cadena = "UPDATE proveedores SET
                                id_tipo_contribuyente = '" . $id_tipo_contribuyente . "',
                                id_tipo_identificacion = '" . $id_tipo_identificacion . "',
                                numero_identificacion = '" . $numero_identificacion . "',
                                razon_social = '" . $razon_social . "',
                                nombre_comercial = '" . $nombre_comercial . "',
                                direccion = '" . $direccion . "',
                                telefono = '" . $telefono . "',
                                email = '" . $email . "',
                                direccion = '" . $direccion . "',
                                id_pago = '" . $id_pago . "',
                                representante_legal = '" . $representante_legal . "',
                                codigo_act_eco_1 = '" . $codigo_act_eco_1 . "',
                                codigo_act_ind_comer = '" . $codigo_act_ind_comer . "',
                                dv = '" . $digverificacion . "',
                                categoria = '" . $categoria . "',
                                observaciones = '" . $observaciones . "',
                                nombrec = '" . $nombrec . "',
                                telefonoc = '" . $telefonoc . "',
                                emailc = '" . $emailc . "',
                                descripcion = '" . $descripcion . "',
                                pais = '" . $pais . "',
                                ciudad = '" . $ciudad . "',
                                retenfuente = '" . $retenfuente . "',
                                reteica = '" . $reteica . "',
                                cuenta_pagar = '" . $cuentapagar . "',
                                id_departamento = '" . $dep . "',
                                id_regimen = '" . $regimen_fiscal . "'
                            WHERE id_proveedores = '" . $ide . "'";
        $resultado = mysqli_query($conetar, $cadena);

        $result = "ok";
    }else if($aux == 3){

        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "select estado from proveedores where id_proveedores='" . $id . "'";
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
        $cadena = "update proveedores set estado='" . $estado . "' where id_proveedores='" . $id . "'";

        echo $cadena;

        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }else if($aux == 4){

        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "DELETE FROM proveedores  where id_proveedores='" . $id . "'";

        echo $cadena;

        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }

}
