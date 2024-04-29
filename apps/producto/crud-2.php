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

    $aux = 0;

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    $id_categoria_producto = $_POST['categoria']; //esa ctivo fijo
    $nombre = trim($_POST['nombre']);
    $referencia = trim($_POST['referencia']);
    $cod_contable = trim($_POST['cod_contable']);
    $id_departamento = trim($_POST['id_departamento']);
    //$id_sede = trim($_POST['id_sede']);
    $iva = trim($_POST['iva']);
    $cantidad_unidadmedida = trim($_POST['cantidad_unidadmedida']);
    $id_unidadmedida = trim($_POST['id_unidadmedida']);
    $id_presentacion = trim($_POST['id_presentacion']);
    $cantidad_presentacion = trim($_POST['cantidad_presentacion']);
    $stckmin = trim($_POST['stckmin']);
    $stckpntoreorden = trim($_POST['stckpntoreorden']);
    $stckmax = trim($_POST['stckmax']);
    $id_clasificacion_riesgo = trim($_POST['id_clasificacion_riesgo']);
    $id_condicion_almacenaje = trim($_POST['id_condicion_almacenaje']);
    $concentracion = trim($_POST['concentracion']);
    $reg_invima = trim($_POST['reg_invima']);
    $estado = trim($_POST['estado']);
    $categoria = trim($_POST['categoria']);

    if ($aux == 1) {

        $id = "";

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $cadena = "select estado from producto where id_producto='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a != 1) {
            $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,categoria,
                            cantidad_presentacion,id_presentacion,cantidad_unidadmedida,id_unidadmedida,
                            id_clasificacion_riesgo,stckmin,
                            stckpntoreorden,stckmax,id_condicion_almacenaje,cod_contable,
                            concentracion,reg_invima,iva,tipo_prod
                        )values('" .
                $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" . $categoria . "','" .
                $cantidad_presentacion . "','" . $id_presentacion . "','" . $cantidad_unidadmedida . "','" . $id_unidadmedida . "','" .
                $id_clasificacion_riesgo . "','" . $stckmin . "','" .
                $stckpntoreorden . "','" . $stckmax . "','" . $id_condicion_almacenaje . "','" . $cod_contable . "','"
                . $concentracion
                . "','" . $reg_invima . "','" . $iva . "','I')";


            echo $cadena;
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";
        } else {

            $cadena = "update producto set
                        id_categoria_producto='" . $id_categoria_producto . "',
                        nombre='" . $nombre . "',
                        referencia='" . $referencia . "',
                        id_departamento='" . $id_departamento . "',
                        categoria='" . $categoria . "',
                        cantidad_presentacion='" . $cantidad_presentacion . "',
                        id_presentacion='" . $id_presentacion . "',
                        cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                        id_unidadmedida='" . $id_unidadmedida . "',
                        id_clasificacion_riesgo='" . $id_clasificacion_riesgo . "',
                        stckmin='" . $stckmin . "',
                        stckpntoreorden='" . $stckpntoreorden . "',
                        stckmax='" . $stckmax . "',
                        id_condicion_almacenaje='" . $id_condicion_almacenaje . "',
                        cod_contable='" . $cod_contable . "',
                        concentracion='" . $concentracion . "',
                        iva='" . $iva . "',
                        reg_invima='" . $reg_invima . "'
                    where id_producto='" . $id . "'";
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";
        }
    } else if ($aux == 2) {

        $id = "";

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $cadena = "select estado from producto where id_producto='" . $id . "'";
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
        $cadena = "update producto set estado='" . $estado . "' where id_producto='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }
}
