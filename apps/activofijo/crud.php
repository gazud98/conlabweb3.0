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




    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];
    if ($modeeditstatus == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "select estado from  u116753122_cw3completa.producto where id_producto='" . $id . "'";
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
        $cadena = "update  u116753122_cw3completa.producto set estado='" . $estado . "' where id_producto='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else { //es crea o moifica

        $id_categoria_producto = $_POST['id_categoria_producto']; //esa ctivo fijo
        $nombre = trim($_POST['nombre']);
        $referencia = trim($_POST['referencia']);
        $id_departamento = trim($_POST['id_departamento']);
        $id_sede = trim($_POST['id_sedes']);
        $estado = trim($_POST['estado']);
      
        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');
        $fecha = $fechaActual;
        $hora = date("h:i:s");
        $fechafinal = $fecha . " " . $hora;


        //activos fijos....1
        //reactivos...2
        //proucto en genrnal-...3
        //servicios...4
        //insumos .....5
        if ($id_categoria_producto == "1") {  //activo fijo
            $valor = trim($_POST['valor']);
            $modelo = trim($_POST['modelo']);
            $serie = trim($_POST['serie']);
            $fchinstalacion = trim($_POST['fchinstalacion']);
            $seguro = trim($_POST['seguro']);
            $aseguradora = trim($_POST['aseguradora']);
            $valor_seguro = trim($_POST['valor_seguro']);
            //$seguroprima = trim($_POST['seguroprima']);
            $garantia = trim($_POST['garantia']);
            $fchexpgarantia = trim($_POST['fchexpgarantia']);
            $vidautilmes = trim($_POST['vidautilmes']);
            $metdepreciacion = trim($_POST['metdepreciacion']);
            $id_sedes = trim($_POST['id_sedes']);
            $id_tipo_activo = trim($_POST['id_tipo_activo']);
            $responsable = trim($_POST['responsable']);
            $proveegarantia = trim($_POST['proveegarantia']);
            $optmante = trim($_POST['optmante']);
            $descp = trim($_POST['descp']);

            $dpr = $valor / $vidautilmes;

            if ($modeeditstatus == "C") { ////CREACION
                $cadena = "insert into  u116753122_cw3completa.producto(id_categoria_producto,nombre,referencia,id_departamento,
                id_sede,id_tipo_activo,op_mantenimiento,dpr,descripcion)values('" .
                    $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . 
                    "','" . $id_sedes . "','" . $id_tipo_activo . "','" .$optmante. "','" .$dpr. "','" .$descp. "')";
                $resultado = mysqli_query($conetar, $cadena);
                //busco el id
                $cadena = "select id_producto
                                from  u116753122_cw3completa.producto
                                where id_categoria_producto='" . $id_categoria_producto . "'
                                        and nombre='" . $nombre . "'
                                        and referencia='" . $referencia . "'
                                        and id_departamento='" . $id_departamento . "'
                                        and id_sede = '" . $id_sedes . "'
                                        and id_tipo_activo = '" . $id_tipo_activo . "'";
                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                if ($numerfiles2 >= 1) {
                    //creo el compelntero
                    $filaP2a = mysqli_fetch_array($resultadP2);
                    $id = $filaP2a['id_producto'];
                    //no existe creo
                    $cadena = "insert into  u116753122_cw3completa.producto_activofijo(id_producto,valor,modelo,serie,
                                       fchinstalacion,seguro,garantia,
                                        fchexpgarantia,vidautilmes,metdepreciacion,id_proveegarantia,
                                        id_responsable,aseguradora,valor_asegurado,op_mantenimiento,dpr,descripcion)values('" .
                        $id . "','" . $valor . "','" . $modelo . "','" . $serie . "','" .
                        $fchinstalacion . "','" . $seguro . "','" . $garantia . "','" .
                        $fchexpgarantia . "','" . $vidautilmes . "','" . $metdepreciacion . "',
                        '" . $proveegarantia . "','" . $responsable . "','" . $aseguradora . "',
                        '" . $valor_seguro . "','".$optmante."','".$dpr."','" .$descp. "')";
                    $resultado = mysqli_query($conetar, $cadena);
                }
                $result = "ok";
            } else {

                if ($modeeditstatus == "E") { //acgualzucsion
                    $cadena = "update  u116753122_cw3completa.producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                id_sede='" . $id_sedes . "',
                                id_tipo_activo='" . $id_tipo_activo . "',
                                op_mantenimiento='" . $optmante . "',
                                descripcion ='" . $descp . "'
                            where id_producto='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);

                    //asegruo que este en la tabla de campso adicoanes pde activos fijos
                    $cadena = "select id_producto
                                from  u116753122_cw3completa.producto_activofijo
                                where id_producto='" . $id . "'";
                    $resultadP2 = $conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if ($numerfiles2 >= 1) {
                        //exite actualizao
                        $cadena = "update  u116753122_cw3completa.producto_activofijo set
                                    valor='" . $valor . "',
                                    modelo='" . $modelo . "',
                                    serie='" . $serie . "',
                                    fchinstalacion='" . $fchinstalacion . "',
                                    seguro='" . $seguro . "',
                                    aseguradora='" . $aseguradora . "',
                                    valor_asegurado='" . $valor_seguro . "',
                                    garantia='" . $garantia . "',
                                    fchexpgarantia='" . $fchexpgarantia . "',
                                    vidautilmes='" . $vidautilmes . "',
                                    metdepreciacion='" . $metdepreciacion . "',
                                    id_proveegarantia='" . $proveegarantia . "',
                                    id_responsable='" . $responsable . "',
                                    op_mantenimiento='" . $optmante . "',
                                    descripcion ='" . $descp . "'
                                 where id_producto='" . $id . "'";
                        $resultado = mysqli_query($conetar, $cadena);
                    } else {
                        //no existe creo
                        $cadena = "insert into  u116753122_cw3completa.producto_activofijo(id_producto,valor,modelo,serie,
                                       fchinstalacion,seguro,seguroprima,garantia,
                                        fchexpgarantia,vidautilmes,metdepreciacion,id_proveegarantia,id_responsable,aseguradora,valor_asegurado,op_mantenimiento,descripcion)values('" .
                            $id . "','" . $valor . "','" . $modelo . "','" . $serie . "','" .
                            $fchinstalacion . "','" . $seguro . "','" . $garantia . "','" .
                            $fchexpgarantia . "','" . $vidautilmes . "','" . $metdepreciacion . "',
                            '" . $proveegarantia . "','" . $responsable . "','" . $aseguradora . "',
                            '" . $valor_seguro . "','".$optmante."','" .$descp. "')";

                        echo '<br><br>' . $cadena;

                        $resultado = mysqli_query($conetar, $cadena);
                    }
                    $result = "ok";
                } //De actualziacon

            } //De inserccion
            
        } //de 4s 1 o activo fijo

        //............................................................................................................................................


        if ($id_categoria_producto == "2") { //rectivo
            $cantidad_presentacion = trim($_POST['cantidad_presentacion']);
            $id_presentacion = trim($_POST['id_presentacion']);
            $cantidad_unidadmedida = trim($_POST['cantidad_unidadmedida']);
            $id_unidadmedida = trim($_POST['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($_POST['id_clasificacion_riesgo']);
            $nombre_imagen = trim($_POST['nombre_imagen']);
            $id_bodegas = trim($_POST['id_bodegas']);
            $stckmin = trim($_POST['stckmin']);
            $stckpntoreorden = trim($_POST['stckpntoreorden']);
            $stckmax = trim($_POST['stckmax']);
            $csmoprommes = trim($_POST['csmoprommes']);
            $id_condicion_almacenaje = trim($_POST['id_condicion_almacenaje']);
            $costo = trim($_POST['costo']);
            $estante = trim($_POST['estante']);

            if ($modeeditstatus == "C") { ////CREACION
                $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,
                                    cantidad_presentacion,id_presentacion,cantidad_unidadmedida,id_unidadmedida,
                                    id_clasificacion_riesgo,nombre_imagen,id_bodegas,stckmin,
                                    stckpntoreorden,stckmax,csmoprommes,id_condicion_almacenaje
                                )values('" .
                    $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" .
                    $cantidad_presentacion . "','" . $id_presentacion . "','" . $cantidad_unidadmedida . "','" . $id_unidadmedida . "','" .
                    $id_clasificacion_riesgo . "','" . $nombre_imagen . "','" . $id_bodegas . "','" . $stckmin . "','" .
                    $stckpntoreorden . "','" . $stckmax . "','0','" . $id_condicion_almacenaje . "')";
                $resultado = mysqli_query($conetar, $cadena);
                //busco el id
                $cadena = "select id_producto
                                from producto
                                where id_categoria_producto='" . $id_categoria_producto . "'
                                        and nombre='" . $nombre . "'
                                        and referencia='" . $referencia . "'
                                        and id_departamento='" . $id_departamento . "'";
                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                if ($numerfiles2 >= 1) {
                    //creo el compelntero
                    $filaP2a = mysqli_fetch_array($resultadP2);
                    $id = $filaP2a['id_producto'];
                    //no existe creo
                    $cadena = "insert into producto_reactivo(id_producto,costo,estante)values('" .
                        $id . "','" . $costo . "','" . $estante . "')";
                    $resultado = mysqli_query($conetar, $cadena);
                }
                $result = "ok";
            } else {
                if ($modeeditstatus == "E") { //acgualzucsion
                    $cadena = "update producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                cantidad_presentacion='" . $cantidad_presentacion . "',
                                id_presentacion='" . $id_presentacion . "',
                                cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                                id_unidadmedida='" . $id_unidadmedida . "',
                                id_clasificacion_riesgo='" . $id_clasificacion_riesgo . "',
                                nombre_imagen='" . $nombre_imagen . "',
                                id_bodegas='" . $id_bodegas . "',
                                stckmin='" . $stckmin . "',
                                stckpntoreorden='" . $stckpntoreorden . "',
                                stckmax='" . $stckmax . "',
                                csmoprommes='" . $csmoprommes . "',
                                id_condicion_almacenaje='" . $id_condicion_almacenaje . "'
                            where id_producto='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                    //asegruo que este en la tabla de campso adicoanes pde activos fijos
                    $cadena = "select id_producto
                                from cw3completa.producto_reactivo
                                where id_producto='" . $id . "'";
                    $resultadP2 = $conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    if ($numerfiles2 >= 1) {
                        //exite actualizao
                        $cadena = "update producto_reactivo set
                                    id_categoria_producto='" . $id_categoria_producto . "',
                                    nombre='" . $nombre . "',
                                    referencia='" . $referencia . "',
                                    id_departamento='" . $id_departamento . "',
                                    cantidad_presentacion='" . $cantidad_presentacion . "',
                                    id_presentacion='" . $id_presentacion . "',
                                    cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                                    id_unidadmedida='" . $id_unidadmedida . "',
                                    id_clasificacion_riesgo='" . $id_clasificacion_riesgo . "',
                                    nombre_imagen='" . $nombre_imagen . "',
                                    id_bodegas='" . $id_bodegas . "',
                                    stckmin='" . $stckmin . "',
                                    stckpntoreorden='" . $stckpntoreorden . "',
                                    stckmax='" . $stckmax . "',
                                    csmoprommes='" . $csmoprommes . "',
                                    id_condicion_almacenaje='" . $id_condicion_almacenaje . "'
                                 where id_producto='" . $id . "'";
                        $resultado = mysqli_query($conetar, $cadena);
                    } else {
                        //no existe creo
                        $cadena = "insert into producto_reactivo(id_producto,costo,estante)values('" .
                            $id . "','" . $costo . "','" . $estante . "')";
                        $resultado = mysqli_query($conetar, $cadena);
                    }
                    $result = "ok";
                } //De actualziacon
            } //De inserccion
        } //es freactico

        //...............................................................................................................................................................


        if ($id_categoria_producto == "3") { //produtos
            $directorio_destino = "/desarrolloV3/appsdata/producto";
            $nombre_archivo = $_FILES["files"]["name"];
            $ruta_temporal = $_FILES["files"]["tmp_name"];

            $tipprod = trim($_POST['tipprod']);
            $cantidad_presentacion = trim($_POST['cantidad_presentacion']);
            $id_presentacion = trim($_POST['id_presentacion']);
            $cantidad_unidadmedida = trim($_POST['cantidad_unidadmedida']);
            $id_unidadmedida = trim($_POST['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($_POST['id_clasificacion_riesgo']);
            $nombre_imagen = trim($_POST['nombre_imagen']);
            $id_bodegas = trim($_POST['id_bodegas']);
            $id_departamento = trim($_POST['id_departamento']);
            $stckmin = trim($_POST['stckmin']);
            $stckpntoreorden = trim($_POST['stckpntoreorden']);
            $stckmax = trim($_POST['stckmax']);
            $csmoprommes = trim($_POST['csmoprommes']);
            $id_condicion_almacenaje = trim($_POST['id_condicion_almacenaje']);
            $cod_contable = trim($_POST['cod_contable']);
            $categoria = trim($_POST['categoria']);
            $pactivo = trim($_POST['pactivo']);
            $ffarmaceutica = trim($_POST['ffarmaceutica']);
            $vida_util = trim($_POST['vida_util']);
            $lote = trim($_POST['lote']);
            $marca = trim($_POST['marca']);
            $serie = trim($_POST['serie']);
            $fvence = trim($_POST['fvence']);
            $concentracion = trim($_POST['concentracion']);
            $reginvima = trim($_POST['reginvima']);

            if($tipprod==""){
            if ($modeeditstatus == "C") { ////CREACION
                $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,
                                    cantidad_presentacion,id_presentacion,cantidad_unidadmedida,id_unidadmedida,
                                    id_clasificacion_riesgo,nombre_imagen,id_bodegas,stckmin,
                                    stckpntoreorden,stckmax,csmoprommes,id_condicion_almacenaje,cod_contable,categoria,principio_activo,forma_farmaceutica,vida_util,
                                    lote,marca,serie,fecha_vencimiento,concentracion,reg_invima
                                )values('" .
                    $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" .
                    $cantidad_presentacion . "','" . $id_presentacion . "','" . $cantidad_unidadmedida . "','" . $id_unidadmedida . "','" .
                    $id_clasificacion_riesgo . "','" . $nombre_imagen . "','" . $id_bodegas . "','" . $stckmin . "','" .
                    $stckpntoreorden . "','" . $stckmax . "','0','" . $id_condicion_almacenaje . "','" . $cod_contable . "','" . $categoria . "','" . $pactivo . "','" . $ffarmaceutica . "','" . $vida_util . "'
                                ,'" . $lote . "' ,'" . $marca . " ','" . $serie . "' ,'" . $fvence . " ','" . $concentracion . "','" . $reginvima . "')";


                echo $cadena;
                $resultado = mysqli_query($conetar, $cadena);
                $result = "ok";
            } else {
                if ($modeeditstatus == "E") { //acgualzucsion
                    $cadena = "update producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                cantidad_presentacion='" . $cantidad_presentacion . "',
                                id_presentacion='" . $id_presentacion . "',
                                cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                                id_unidadmedida='" . $id_unidadmedida . "',
                                id_clasificacion_riesgo='" . $id_clasificacion_riesgo . "',
                                nombre_imagen='" . $nombre_imagen . "',
                                id_bodegas='" . $id_bodegas . "',
                                stckmin='" . $stckmin . "',
                                stckpntoreorden='" . $stckpntoreorden . "',
                                stckmax='" . $stckmax . "',
                                csmoprommes='" . $csmoprommes . "',
                                id_condicion_almacenaje='" . $id_condicion_almacenaje . "',
                                cod_contable='" . $cod_contable . "',
                                categoria='" . $categoria . "',
                                principio_activo='" . $pactivo . "',
                                forma_farmaceutica='" . $ffarmaceutica . "',
                                vida_util='" . $vida_util . "',
                                lote='" . $lote . "',
                                marca='" . $marca . "',
                                serie='" . $serie . "',
                                fecha_vencimiento='" . $fvence . "',
                                concentracion='" . $concentracion . "',
                                reg_invima='" . $reginvima . "'
                            where id_producto='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                    $result = "ok";
                } //De actualziacon
            } //De inserccion
        } //de proxucos

        //...............................................................................................................................................................

        if ($id_categoria_producto == "4") { //servciicos

            if ($modeeditstatus == "C") { ////CREACION
                $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,id_sede)values('" .
                    $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" . $id_sede . "')";
                $resultado = mysqli_query($conetar, $cadena);
                $result = "ok";
            } else {
                if ($modeeditstatus == "E") { //acgualzucsion
                    $cadena = "update cw3completa.producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                id_sede='" . $id_sede . "',
                                id_user_mod='" . $iduserx . "',
                                fecha_mod='" . $fechafinal . "',
                                motivo_mod='" . $motmod . "'
                            where id_producto='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                    $result = "ok";
                } //De actualziacon
            } //De inserccion
        } //de servviioc

        //...............................................................................................................................................................




        if ($id_categoria_producto == "5") { //produtos
            $cantidad_presentacion = trim($_POST['cantidad_presentacion']);
            $id_presentacion = trim($_POST['id_presentacion']);
            $cantidad_unidadmedida = trim($_POST['cantidad_unidadmedida']);
            $id_unidadmedida = trim($_POST['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($_POST['id_clasificacion_riesgo']);
            $id_departamento = trim($_POST['id_departamento']);
            $stckmin = trim($_POST['stckmin']);
            $stckpntoreorden = trim($_POST['stckpntoreorden']);
            $stckmax = trim($_POST['stckmax']);
            $csmoprommes = trim($_POST['csmoprommes']);
            $id_condicion_almacenaje = trim($_POST['id_condicion_almacenaje']);
            $categoria = trim($_POST['categoria']);
            $pactivo = trim($_POST['pactivo']);
            $ffarmaceutica = trim($_POST['ffarmaceutica']);
            $vida_util = trim($_POST['vida_util']);
            $lote = trim($_POST['lote']);
            $marca = trim($_POST['marca']);
            $serie = trim($_POST['serie']);
            $fvence = trim($_POST['fvence']);
            $concentracion = trim($_POST['concentracion']);
            $reginvima = trim($_POST['reginvima']);


            if ($modeeditstatus == "C") { ////CREACION
                $cadena = "insert into producto(id_categoria_producto,nombre,referencia,id_departamento,
                                    cantidad_presentacion,id_presentacion,cantidad_unidadmedida,id_unidadmedida,
                                    id_clasificacion_riesgo,stckmin,
                                    stckpntoreorden,stckmax,csmoprommes,id_condicion_almacenaje,categoria,principio_activo,forma_farmaceutica,vida_util,
                                    lote,marca,serie,fecha_vencimiento,concentracion,reg_invima
                                )values('" .
                    $id_categoria_producto . "','" . $nombre . "','" . $referencia . "','" . $id_departamento . "','" .
                    $cantidad_presentacion . "','" . $id_presentacion . "','" . $cantidad_unidadmedida . "','" . $id_unidadmedida . "','" .
                    $id_clasificacion_riesgo . "','" . $stckmin . "','" .
                    $stckpntoreorden . "','" . $stckmax . "','0','" . $id_condicion_almacenaje . "','" . $categoria . "','" . $pactivo . "','" . $ffarmaceutica . "','" . $vida_util . "'
                                ,'" . $lote . "' ,'" . $marca . " ','" . $serie . "' ,'" . $fvence . " ','" . $concentracion . "','" . $reginvima . "')";

                echo $cadena;

                $resultado = mysqli_query($conetar, $cadena);
                $result = "ok";
            } else {
                if ($modeeditstatus == "E") { //acgualzucsion
                    $cadena = "update producto set
                                id_categoria_producto='" . $id_categoria_producto . "',
                                nombre='" . $nombre . "',
                                referencia='" . $referencia . "',
                                id_departamento='" . $id_departamento . "',
                                cantidad_presentacion='" . $cantidad_presentacion . "',
                                id_presentacion='" . $id_presentacion . "',
                                cantidad_unidadmedida='" . $cantidad_unidadmedida . "',
                                id_unidadmedida='" . $id_unidadmedida . "',
                                id_clasificacion_riesgo='" . $id_clasificacion_riesgo . "',
                                nombre_imagen='" . $nombre_imagen . "',
                                id_bodegas='" . $id_bodegas . "',
                                stckmin='" . $stckmin . "',
                                stckpntoreorden='" . $stckpntoreorden . "',
                                stckmax='" . $stckmax . "',
                                csmoprommes='" . $csmoprommes . "',
                                id_condicion_almacenaje='" . $id_condicion_almacenaje . "'
                            where id_producto='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                    $result = "ok";
                } //De actualziacon
            } //De inserccion
        } //de proxucos


        //...............................................................................................................................................................
    } //es de desahibilitar/habikitr
}

}