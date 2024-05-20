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

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    echo $aux;

    if ($aux == 1) {

        $id_categoria_producto = $_POST['id_categoria_producto'];
        $nombre = trim($_POST['nombre']);
        //$referencia = trim($_POST['referencia']);
        $id_departamento = trim($_POST['id_departamento']);
        $descp = trim($_POST['descp']);
        // $estado = trim($_POST['estado']);
        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');
        $fecha = $fechaActual;
        $hora = date("h:i:s");
        $fechafinal = $fecha . " " . $hora;
        $valor = trim($_POST['valor']);
        $modelo = trim($_POST['modelo']);
        $serie = trim($_POST['serie']);
        $fchinstalacion = trim($_POST['fchinstalacion']);
        $seguro = trim($_POST['seguro']);
        $aseguradora = trim($_POST['aseguradora']);
        $valor_seguro = trim($_POST['valor_seguro']);
        $garantia = trim($_POST['garantia']);
        $fchiniciogarantia = trim($_POST['fchiniciogarantia']);
        $fchexpgarantia = trim($_POST['fchexpgarantia']);
        $vidautilmes = trim($_POST['vidautilmes']);
        $metdepreciacion = trim($_POST['metdepreciacion']);
        $id_sedes = trim($_POST['id_sedes']);
        $id_tipo_activo = trim($_POST['id_tipo_activo']);
        $responsable = trim($_POST['responsable']);
        $fchinicioseguro = trim($_POST['fchinicioseguro']);
        $fchexpseguro = trim($_POST['fchexpseguro']);
        $proveegarantia = trim($_POST['proveegarantia']);
        $optmante = trim($_POST['optmante']);
        $descp = trim($_POST['descp']);
        $area = trim($_POST['area']);
        $dpr = $valor / $vidautilmes;
        $responsablemant = trim($_POST['responsablemant']);
        $cadena = "insert into producto(id_categoria_producto,nombre,id_departamento,
                id_sede,id_tipo_activo,op_mantenimiento,dpr,descripcion)values('" .
            $id_categoria_producto . "','" . $nombre . "','" . $id_departamento .
            "','" . $id_sedes . "','" . $id_tipo_activo . "','" . $optmante . "','" . $dpr . "','" . $descp . "')";
        $resultado = mysqli_query($conetar, $cadena);
        //busco el id
        $cadena = "select id_producto
                                from producto
                                where id_categoria_producto='" . $id_categoria_producto . "'
                                        and nombre='" . $nombre . "'
                                        and id_departamento='" . $id_departamento . "'
                                        and id_sede = '" . $id_sedes . "'
                                        and id_tipo_activo = '" . $id_tipo_activo . "'";
        $resultadP2 = $conetar->query($cadena);
        echo $cadena;
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2);
            $id = $filaP2a['id_producto'];
            $sql = "insert into producto_activofijo(id_producto,valor,modelo,serie,
                                       fchinstalacion,seguro,garantia,
                                        fchexpgarantia,vidautilmes,metdepreciacion,id_proveegarantia,
                                        id_responsable,aseguradora,valor_asegurado,op_mantenimiento,dpr,descripcion,fchiniciogarantia,id_area,fchinicioseguro,fchexpseguro,id_respmantemiento)values('" .
                $id . "','" . $valor . "','" . $modelo . "','" . $serie . "','" .
                $fchinstalacion . "','" . $seguro . "','" . $garantia . "','" .
                $fchexpgarantia . "','" . $vidautilmes . "','" . $metdepreciacion . "',
                        '" . $proveegarantia . "','" . $responsable . "','" . $aseguradora . "',
                        '" . $valor_seguro . "','" . $optmante . "','" . $dpr . "','" . $descp . "','" . $fchiniciogarantia . "','" . $area . "','" . $fchinicioseguro . "','" . $fchexpseguro . "','" . $responsablemant . "')";
            $rest = mysqli_query($conetar, $sql);
            echo $sql;
        }
    } else if ($aux == 2) {

        $id = trim($_POST['id_producto']);
        $id_categoria_producto = $_POST['id_categoria_producto'];
        $nombre = trim($_POST['nombre']);
        $referencia = trim($_POST['referencia']);
        $id_departamento = trim($_POST['id_departamento']);
        $descp = trim($_POST['descp']);
        $estado = trim($_POST['estado']);
        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');
        $fecha = $fechaActual;
        $hora = date("h:i:s");
        $fechafinal = $fecha . " " . $hora;
        $valor = trim($_POST['valor']);
        $modelo = trim($_POST['modelo']);
        $serie = trim($_POST['serie']);
        $fchinstalacion = trim($_POST['fchinstalacion']);
        $seguro = trim($_POST['seguro']);
        $aseguradora = trim($_POST['aseguradora']);
        $valor_seguro = trim($_POST['valor_seguro']);
        $garantia = trim($_POST['garantia']);
        $fchiniciogarantia = trim($_POST['fchiniciogarantia']);
        $fchexpgarantia = trim($_POST['fchexpgarantia']);
        $vidautilmes = trim($_POST['vidautilmes']);
        $metdepreciacion = trim($_POST['metdepreciacion']);
        $id_sedes = trim($_POST['id_sedes']);
        $id_tipo_activo = trim($_POST['id_tipo_activo']);
        $responsable = trim($_POST['responsable']);
        $proveegarantia = trim($_POST['proveegarantia']);
        $optmante = trim($_POST['optmante']);
        $area = trim($_POST['area']);
        $dpr = $valor / $vidautilmes;
        $fchinicioseguro = trim($_POST['fchinicioseguro']);
        $fchexpseguro = trim($_POST['fchexpseguro']);
        $responsablemant = trim($_POST['responsablemant']);
        $sqlpr = "UPDATE producto SET 
        nombre='" . $nombre . "', id_sede='$id_sedes',id_departamento='$id_departamento',id_tipo_activo='$id_tipo_activo' WHERE id_producto = '$id'";
        $restpr = mysqli_query($conetar, $sqlpr);

        $sql = "UPDATE producto_activofijo SET 
        valor='$valor',
        modelo='$modelo',
        serie='$serie',
        fchinstalacion='$fchinstalacion',
        seguro='$seguro',
        aseguradora='$aseguradora',
        valor_asegurado='$valor_seguro',
        garantia='$garantia',
        fchexpgarantia='$fchexpgarantia',
        fchiniciogarantia='$fchiniciogarantia',
        vidautilmes='$vidautilmes',
        metdepreciacion='$metdepreciacion',
        id_proveegarantia='$proveegarantia',
        id_responsable='$responsable',
        op_mantenimiento='$optmante',
        id_area='$area',
        fchexpseguro='$fchexpseguro',
        fchinicioseguro='$fchinicioseguro',
        id_respmantemiento='$responsablemant',
        dpr='$dpr',
        descripcion='$descp' WHERE id_producto = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 3) {
        $id = $_REQUEST['id'];

        $sql =  "DELETE FROM producto WHERE id_producto = '$id'";
        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 4) {
        $id = $_REQUEST['id'];
        $estado = $_REQUEST['estado'];

        if ($estado == 1) {
            $cadena = "update producto set estado='2' where id_producto='" . $id . "'";
        } else if ($estado == 2) {
            $cadena = "update producto set estado='1' where id_producto='" . $id . "'";
        }

        $resultado = mysqli_query($conetar, $cadena);
    }
}
