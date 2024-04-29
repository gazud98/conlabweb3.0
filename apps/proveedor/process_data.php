<?php
// Verificación de la existencia del archivo de configuración
if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} elseif (file_exists("../config/accesosystems.php")) {
    include("../config/accesosystems.php");
} elseif (file_exists("../../config/accesosystems.php")) {
    include("../../config/accesosystems.php");
}

// Conexión a la base de datos
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    // Manejo de parámetros de solicitud
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : "";

    // Consulta SQL para obtener datos de proveedores
    if ($id != "") {
        $cadena = "SELECT P.id_proveedores, P.reteiva, P.reteica, P.retenfuente, P.id_tipo_contribuyente, P.id_pago, P.id_tipo_identificacion, P.dv, P.numero_identificacion, P.razon_social, P.nombre_comercial,
                    P.direccion, P.telefono, P.movil, P.email, P.email_empresarial, P.email_2, P.telefono_2, P.ciudad, P.direccion_alterna, P.telefono_alterno, P.fecha_ingreso, P.fecha_retiro, P.categoria, P.estado,
                    P.fecha_nacimiento, P.representante_legal, P.tarjeta_profesional, P.empresa_temporal, P.reteiva, P.reteica, P.retenfuente, P.id_sede, P.id_cargos, P.id_departamento, P.detalle_cargo,
                    P.observaciones, P.cuenta_pagar, P.pais, P.codigo_act_eco_1, P.codigo_act_ind_comer, P.nombrec, P.telefonoc, P.emailc, P.critico, P.descripcion, P.id_regimen
                FROM proveedores P
                WHERE 1=1
                    AND P.id_proveedores='" . $id . "'";
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            // Construcción del arreglo asociativo para el JSON
            $response = array(
                'id_proveedores' => trim($filaP2['id_proveedores']),
                'reteiva' => trim($filaP2['reteiva']),
                'reteica' => trim($filaP2['reteica']),
                'retenfuente' => trim($filaP2['retenfuente']),
                'id_tipo_contribuyente' => trim($filaP2['id_tipo_contribuyente']),
                'id_pago' => trim($filaP2['id_pago']),
                'id_tipo_identificacion' => trim($filaP2['id_tipo_identificacion']),
                'dv' => trim($filaP2['dv']),
                'numero_identificacion' => trim($filaP2['numero_identificacion']),
                'razon_social' => trim($filaP2['razon_social']),
                'nombre_comercial' => trim($filaP2['nombre_comercial']),
                'direccion' => trim($filaP2['direccion']),
                'telefono' => trim($filaP2['telefono']),
                'movil' => trim($filaP2['movil']),
                'email' => trim($filaP2['email']),
                'email_empresarial' => trim($filaP2['email_empresarial']),
                'email_2' => trim($filaP2['email_2']),
                'telefono_2' => trim($filaP2['telefono_2']),
                'ciudad' => trim($filaP2['ciudad']),
                'direccion_alterna' => trim($filaP2['direccion_alterna']),
                'telefono_alterno' => trim($filaP2['telefono_alterno']),
                'fecha_ingreso' => trim($filaP2['fecha_ingreso']),
                'fecha_retiro' => trim($filaP2['fecha_retiro']),
                'categoria' => trim($filaP2['categoria']),
                'estado' => trim($filaP2['estado']),
                'fecha_nacimiento' => trim($filaP2['fecha_nacimiento']),
                'representante_legal' => trim($filaP2['representante_legal']),
                'tarjeta_profesional' => trim($filaP2['tarjeta_profesional']),
                'empresa_temporal' => trim($filaP2['empresa_temporal']),
                'id_sede' => trim($filaP2['id_sede']),
                'id_cargos' => trim($filaP2['id_cargos']),
                'id_departamento' => trim($filaP2['id_departamento']),
                'detalle_cargo' => trim($filaP2['detalle_cargo']),
                'observaciones' => trim($filaP2['observaciones']),
                'cuenta_pagar' => trim($filaP2['cuenta_pagar']),
                'pais' => trim($filaP2['pais']),
                'codigo_act_eco_1' => trim($filaP2['codigo_act_eco_1']),
                'codigo_act_ind_comer' => trim($filaP2['codigo_act_ind_comer']),
                'nombrec' => trim($filaP2['nombrec']),
                'telefonoc' => trim($filaP2['telefonoc']),
                'emailc' => trim($filaP2['emailc']),
                'critico' => trim($filaP2['critico']),
                'descripcion' => trim($filaP2['descripcion']),
                'id_regimen' => trim($filaP2['id_regimen'])
            );

            // Convertir el arreglo asociativo a JSON
            echo json_encode($response);
        }
    }
}
?>
