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

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }


    if ($aux == '1') {

        $tp_identificacion = trim($_POST['id_tipo_identificacion']);
        $numide = trim($_POST['numide']);
        $digverificacion = trim($_POST['digverificacion']);
        $razon = trim($_POST['razon']);
        $nombrecomercial = trim($_POST['nombrecomercial']);
        $tel = trim($_POST['tel']);
        $cel = trim($_POST['cel']);
        $email = trim($_POST['email']);
        $dep = trim($_POST['dep']);
        $ciudad = trim($_POST['ciudad']);
        $tipovia = trim($_POST['tipovia']);
        $novia = trim($_POST['novia']);
        $novivienda = trim($_POST['novivienda']);
        $replegal = trim($_POST['replegal']);
        $numiderep = trim($_POST['numiderep']);
        //$tipoide = trim($_POST['tipoide']);
        $direccion = $tipovia . ' #' . $novia . ' ' . $novivienda;

        $sql = "INSERT INTO empresas(razon_social, nombre_comercial, id_tipo_identificacion, departamento, ciudad, documento, email, 
        tel_fijo, celular, nombre_representante, id_representate_legal, direccion, estado) 
        VALUES ('$razon','$nombrecomercial','$tp_identificacion','$dep','$ciudad','$numide','$email','$tel','$cel','$replegal',
        '$numiderep','$direccion','1')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == '2') {

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $tp_identificacion = trim($_POST['id_tipo_identificacion']);
        $numide = trim($_POST['numide']);
        $digverificacion = trim($_POST['digverificacion']);
        $razon = trim($_POST['razon']);
        $nombrecomercial = trim($_POST['nombrecomercial']);
        $tel = trim($_POST['tel']);
        $cel = trim($_POST['cel']);
        $email = trim($_POST['email']);
        $dep = trim($_POST['dep']);
        $ciudad = trim($_POST['ciudad']);
        //$tipovia = trim($_POST['tipovia']);
        //$novia = trim($_POST['novia']);
        //$novivienda = trim($_POST['novivienda']);
        $replegal = trim($_POST['replegal']);
        $numiderep = trim($_POST['numiderep']);
        //$tipoide = trim($_POST['tipoide']);
        $direccion = trim($_POST['direccion']);

        $sql = "UPDATE empresas SET 
        razon_social='$razon',
        nombre_comercial='$nombrecomercial',
        id_tipo_identificacion='$tp_identificacion',
        departamento='$dep',
        ciudad='$ciudad',
        documento='$numide',
        dv='$digverificacion',
        email='$email',
        tel_fijo='$tel',
        celular='$cel',
        nombre_representante='$replegal',
        id_representate_legal='$numiderep',
        direccion='$direccion'
        WHERE id_empresas = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 3) {

        $cupocredito = trim($_POST['cupocredito']);
        $cupocredito2 = trim($_POST['cupocredito2']);
        $diaspago = trim($_POST['diaspago']);
        $estadocartera = trim($_POST['estadocartera']);
        $fechacobro = trim($_POST['fechacobro']);
        $motivo = trim($_POST['motivo']);
        $empresa = trim($_POST['empresa']);

        $sql = "INSERT INTO info_economica(cupo, cupo_consumido, dias_pago, estado, fecha, motivo_cobro, empresa) 
        VALUES (
        '$cupocredito',
        '$cupocredito2',
        '$diaspago',
        '$estadocartera',
        '$fechacobro',
        '$motivo',
        '$empresa'
        )";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 4) {

        $descglosa = trim($_POST['descglosa']);
        $estadoglosas = trim($_POST['estadoglosas']);

        $sql = "INSERT INTO motivo_glosas(descripcion, estado) VALUES ('$descglosa','$estadoglosas')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 5) {

        $id = trim($_POST['idempresafact']);

        $sql = "SELECT id_empresa FROM info_facturacion WHERE id_empresa = '$id'";

        $rest = mysqli_query($conetar, $sql);

        $row = mysqli_num_rows($rest);

        if ($row != 0) {

            $rad1 = trim($_POST['rad1']);
            $rad2 = trim($_POST['rad2']);
            $tipofact = trim($_POST['tipofact']);
            $formatofact = trim($_POST['formatofact']);
            $cantpacientes = trim($_POST['cantpacientes']);
            $formatoanexo = trim($_POST['formatoanexo']);
            $nocopias = trim($_POST['nocopias']);
            $reqrips = trim($_POST['reqrips']);
            $catpacientesfac = trim($_POST['catpacientesfac']);
            $noria = trim($_POST['noria']);
            $tipousuario = trim($_POST['tipousuario']);
            $notasempresa = trim($_POST['notasempresa']);
            $otrasnotas = trim($_POST['otrasnotas']);

            $sql = "UPDATE info_facturacion SET 
            dia_rad_1='$rad1',
            dia_rad_2='$rad2',
            tipo_factura='$tipofact',
            formato_factura='$formatofact',
            cant_pacientes_mes='$cantpacientes',
            formato_anexo='$formatoanexo',
            numero_copias='$nocopias',
            requiere_rips='$reqrips',
            cant_pacientes_factura='$catpacientesfac',
            numero_ria='$noria',
            tipo_usuario='$tipousuario',
            notas_empresa='$notasempresa',
            otras_notas='$otrasnotas' WHERE id_empresa = '$id'";
        } else {

            $rad1 = trim($_POST['rad1']);
            $rad2 = trim($_POST['rad2']);
            $tipofact = trim($_POST['tipofact']);
            $formatofact = trim($_POST['formatofact']);
            $cantpacientes = trim($_POST['cantpacientes']);
            $formatoanexo = trim($_POST['formatoanexo']);
            $nocopias = trim($_POST['nocopias']);
            $reqrips = trim($_POST['reqrips']);
            $catpacientesfac = trim($_POST['catpacientesfac']);
            $noria = trim($_POST['noria']);
            $tipousuario = trim($_POST['tipousuario']);
            $notasempresa = trim($_POST['notasempresa']);
            $otrasnotas = trim($_POST['otrasnotas']);

            $sql = "INSERT INTO info_facturacion(id_empresa, dia_rad_1, dia_rad_2, tipo_factura, formato_factura, cant_pacientes_mes, formato_anexo, 
            numero_copias, requiere_rips, cant_pacientes_factura, numero_ria, tipo_usuario, notas_empresa, otras_notas) 
            VALUES (
            '$id',
            '$rad1',
            '$rad2',
            '$tipofact',
            '$formatofact', 
            '$cantpacientes',
            '$formatoanexo',
            '$nocopias',
            '$reqrips',
            '$catpacientesfac',
            '$noria',
            '$tipousuario',
            '$notasempresa',
            '$otrasnotas')";
        }

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 6) {

        $desc = trim($_POST['desc']);
        $puc = trim($_POST['puc']);
        $estado = trim($_POST['estado']);

        $sql = "INSERT INTO entidades_bancarias(descripcion, puc, estado) VALUES (
        '$desc',
        '$puc',
        '$estado')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 7) {

        $nombreplan = trim($_POST['nombreplan']);
        $listabaseplan = trim($_POST['listabaseplan']);
        $estadoplan = trim($_POST['estadoplan']);
        $descripcionplan = trim($_POST['descripcionplan']);
        $conectopagar = trim($_POST['conectopagar']);
        $reqfacturacion = trim($_POST['reqfacturacion']);
        $frecuenciaplan = trim($_POST['frecuenciaplan']);
        $descuentoplan = trim($_POST['descuentoplan']);
        $porcentajeplan = trim($_POST['porcentajeplan']);
        $idEmpresaReq = trim($_POST['idEmpresaReq']);
        $tipoplan = trim($_POST['tipoplan']);

        $sql = "INSERT INTO planes_empresa(id_empresa, nombre_plan, id_lista_base, estado, tipo_plan,
        descripcion_plan, concepto_pagar, requisito_facturacion, frecuencia_plan, descuento_plan, porcentaje_plan) VALUES 
        ('$idEmpresaReq',
        '$nombreplan',
        '$listabaseplan',
        '$estadoplan',
        '$tipoplan',
        '$descripcionplan',
        '$conectopagar',
        '$reqfacturacion',
        '$frecuenciaplan',
        '$descuentoplan',
        '$porcentajeplan')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 8) {

        $id = trim($_POST['idplan']);
        $nombreplan = trim($_POST['nombreplan']);
        $listabaseplan = trim($_POST['listabaseplan']);
        $estadoplan = trim($_POST['estadoplan']);
        $descripcionplan = trim($_POST['descripcionplan']);
        $conectopagar = trim($_POST['conectopagar']);
        $reqfacturacion = trim($_POST['reqfacturacion']);
        $frecuenciaplan = trim($_POST['frecuenciaplan']);
        $descuentoplan = trim($_POST['descuentoplan']);
        $porcentajeplan = trim($_POST['porcentajeplan']);
        $idEmpresaReq = trim($_POST['idEmpresaReq']);
        $tipoplan = trim($_POST['tipoplan']);

        $sql = "UPDATE `planes_empresa` SET 
        `nombre_plan`='$nombreplan',
        `id_lista_base`='$listabaseplan',
        `estado`='$estadoplan',
        `tipo_plan`='$tipoplan',
        `descripcion_plan`='$descripcionplan',
        `concepto_pagar`='$conectopagar',
        `requisito_facturacion`='$reqfacturacion',
        `frecuencia_plan`='$frecuenciaplan',
        `descuento_plan`='$descuentoplan',
        `porcentaje_plan`='$porcentajeplan' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 9) {

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $sql = "DELETE FROM empresas WHERE id_empresas = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 10) {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $descglosa = trim($_POST['descglosa']);
        $estadoglosas = trim($_POST['estadoglosas']);

        $sql = "UPDATE motivo_glosas SET descripcion='$descglosa', estado='$estadoglosas' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 11) {

        $id_edn = trim($_POST['id']);
        $desc = trim($_POST['desc']);
        $puc = trim($_POST['puc']);
        $estado = trim($_POST['estado']);

        $sql = "UPDATE entidades_bancarias SET descripcion='$desc', puc='$puc', estado='$estado' WHERE id_entidades_bancarias = '$id_edn'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 12) {

        $id_edn2 = trim($_POST['id']);

        $sql = "DELETE FROM entidades_bancarias WHERE id_entidades_bancarias = '$id_edn2'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 13) {

        $empresa = trim($_POST['empresa']);

        $sql = "SELECT id FROM info_tributaria WHERE empresa = '$empresa'";

        $rest = mysqli_query($conetar, $sql);

        $row = mysqli_num_rows($rest);

        if ($row != 0) {

            $num_resolucion = trim($_POST['numresolucion']);
            $fecha_resolucion = trim($_POST['fecharesolucion']);
            $act_eco_principal = trim($_POST['codactividad']);
            $act_ind_comercio = trim($_POST['codactividad2']);
            $tarifa_retencion = trim($_POST['tarifaretencion']);
            $res_fiscal = trim($_POST['r_fiscal']);

            $sql = "UPDATE info_tributaria SET 
            num_resolucion='$num_resolucion',
            fecha_resolucion='$fecha_resolucion',
            act_eco_principal='$act_eco_principal',
            act_ind_comercio='$act_ind_comercio',
            tarifa_retencion='$tarifa_retencion',
            res_fiscal='$res_fiscal' WHERE empresa = '$empresa'";

            echo $sql;

            $rest = mysqli_query($conetar, $sql);
        } else {

            $num_resolucion = trim($_POST['numresolucion']);
            $fecha_resolucion = trim($_POST['fecharesolucion']);
            $act_eco_principal = trim($_POST['codactividad']);
            $act_ind_comercio = trim($_POST['codactividad2']);
            $tarifa_retencion = trim($_POST['tarifaretencion']);
            $res_fiscal = trim($_POST['r_fiscal']);

            $sql = "INSERT INTO info_tributaria(num_resolucion, fecha_resolucion, act_eco_principal, act_ind_comercio, 
            tarifa_retencion, res_fiscal, empresa) VALUES ('$num_resolucion','$fecha_resolucion','$act_eco_principal',
            '$act_ind_comercio','$tarifa_retencion','$res_fiscal','$empresa')";

            echo $sql;

            $rest = mysqli_query($conetar, $sql);
        }
    }
}
