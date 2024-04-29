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

    $id_categoria_producto = $_POST['id_categoria_producto'];
    $nombre = trim($_POST['nombre']);
    $referencia = trim($_POST['referencia']);
    $id_departamento = trim($_POST['id_departamento']);
    $estado = trim($_POST['estado']);
    $iva = trim($_POST['iva']);
    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
    $fecha = $fechaActual;
    $hora = date("h:i:s");
    $fechafinal = $fecha . " " . $hora;
    $cantidad_presentacion = trim($_POST['cantidad_presentacion']);
    $cantidad_unidadmedida = trim($_POST['cantidad_unidadmedida']);
    $id_unidadmedida = trim($_POST['id_unidadmedida']);
    $cod_contable = trim($_POST['cod_contable']);
    $vida_util = trim($_POST['vida_util']);
    $lote = trim($_POST['lote']);
    $marca = trim($_POST['marca']);
    $serie = trim($_POST['serie']);
    $name_file = $_POST['nombre_reg'];

    if ($aux == 1) {
        $id = "";

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $cadena = "select estado from producto where id_producto='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a != 1) {
            $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,
                                    cantidad_presentacion,cantidad_unidadmedida,id_unidadmedida,
                                    cod_contable,vida_util,
                                    lote,marca,serie,iva,tipo_prod
                                )values('" . $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" .
                $cantidad_presentacion . "','" . $cantidad_unidadmedida . "','" . $id_unidadmedida . "','" .
                $cod_contable . "','" . $vida_util . "','" . $lote .
                "','" . $marca . "','" . $serie . "','" . $iva . "','P')";


            echo $cadena;
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";

            if (isset($_FILES['file'])) {
                echo 'si';
                if (($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/png")
                    || ($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "application/pdf")
                ) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], "public/" . $_FILES['file']['name'])) {
                        echo 'si';

                        $url = "public/" . $_FILES['file']['name'];

                        $sql = "INSERT INTO productos_archivo (id_producto,nombre_archivo, ruta)VALUES ('" . $id . "','" . $name_file . "', '" . $url . "')";

                        $rest = mysqli_query($conetar, $sql);

                        echo $sql;
                    } else {
                        echo 'no';
                    }
                }
            }else{
                echo 'no';
            }
        } else {
            $cadena = "update producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                cantidad_presentacion='" . $cantidad_presentacion . "',
                                cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                                id_unidadmedida='" . $id_unidadmedida . "',
                                cod_contable='" . $cod_contable . "',
                                vida_util='" . $vida_util . "',
                                lote='" . $lote . "',
                                marca='" . $marca . "',
                                serie='" . $serie . "',
                                iva='" . $iva . "'
                            where id_producto='" . $id . "'";

            echo $cadena;
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";
        }
    }
}
