<?php

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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $id = "";

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $equipo = "";
    $localizacion = "";
    $fecha_comienzo = "";
    $id_proveedor = "";
    $meses_garantia = "";
    $meses_garantia_ext = "";
    $tipo_mantenimiento = "";
    $desc_mantenimiento = "";
    $period_semanal = "";
    $resp_mantenimiento = "";
    $direccion_resp = "";
    $tef_resp = "";
    $periodicidad = "";
    $mesoption = "";
    $comienzo = "";
    $comienzo = "";
    $responsable = "";
    $departamento = "";
    $accion = "";
    $repuestos = "";
    $danio = "";
    $email = "";
    $aux = "";
    $fecharealizacion = "";
    $avance = "";
    if ($id != "") {
        $cadena = "SELECT p.id, p.equipo, p.id_sede, p.departamento, p.id_proveedor, p.meses_garantia, p.desc_mantenimiento, p.periodicidad, p.period_semanal, 
        p.resp_mantenimiento, p.responsable, p.comienzo, p.fecha_final, p.fecha_realizacion, p.tef_resp, p.direccion_resp, p.email, p.estado_mantenimiento, 
        p.aux, p.danio, p.repuestos, p.accion, p.avance, e.nombre, po.nombre_comercial, s.nombre AS sede, de.nombre AS dep FROM preventiva p, producto e, proveedores po, sedes s, departamentos de 
        WHERE p.equipo = e.id_producto AND p.id_proveedor = po.id_proveedores AND p.id_sede = s.id_sedes AND p.departamento = de.id AND p.id = '$id' UNION SELECT c.id, c.equipo, 
        c.id_sede, c.departamento, c.id_proveedor, c.meses_garantia, c.desc_mantenimiento, c.periodicidad, c.period_semanal, c.resp_mantenimiento, c.responsable, 
        c.comienzo, c.fecha_final, c.fecha_realizacion, c.tef_resp, c.direccion_resp, c.email, c.estado_mantenimiento, c.aux, c.danio, c.repuestos, c.accion, c.avance, 
        pe.nombre, po.nombre_comercial, s.nombre AS sede, de.nombre AS dep FROM correctivo c, producto pe, proveedores po, sedes s, departamentos de WHERE c.equipo = pe.id_producto 
        AND c.id_proveedor = po.id_proveedores AND c.id_sede = s.id_sedes AND c.departamento = de.id AND c.id = '$id'";

        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $equipo = trim($filaP2['equipo']);
            $localizacion = trim($filaP2['id_sede']);
            $id_proveedor = trim($filaP2['id_proveedor']);
            $meses_garantia = trim($filaP2['meses_garantia']);
            $desc_mantenimiento = trim($filaP2['desc_mantenimiento']);
            $period_semanal = trim($filaP2['period_semanal']);
            $direccion_resp = trim($filaP2['direccion_resp']);
            $tef_resp = trim($filaP2['tef_resp']);
            $periodicidad = trim($filaP2['periodicidad']);
            $comienzo = trim($filaP2['comienzo']);
            $responsable = trim($filaP2['responsable']);
            $fecha_final = trim($filaP2['fecha_final']);
            $departamento = trim($filaP2['departamento']);
            $accion = trim($filaP2['accion']);
            $repuestos = trim($filaP2['repuestos']);
            $danio = trim($filaP2['danio']);
            $email = trim($filaP2['email']);
            $aux = trim($filaP2['aux']);
            $resp_mantenimiento = trim($filaP2['resp_mantenimiento']);
            $fecharealizacion = date('Y-d-m');
            $nombre_equipo = trim($filaP2['nombre']);
            $proveedor = trim($filaP2['nombre_comercial']);
            $sede = trim($filaP2['sede']);
            $dep = trim($filaP2['dep']);
            $avance = trim($filaP2['avance']);
        }
    }
?>

    <style>
        .form-report {
            border: none;
            border-bottom: 1px solid gray;
            padding: 2px;
            outline: none;
        }

        .form-text-area {
            outline: none;
        }

        .r-background {
            background-color: #EEF7FB;
            border-radius: 5px;
            padding: 5px;
        }
    </style>

    <form name="formMantReport" id="formMantReport" action="" method="POST" enctype="multipart/form-data">
        <div class="row mt-4 r-background" style="text-align: center;width:100%;">
            <strong>Descripción del equipo</strong>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <!--<label for="">Fecha:</label>
                <input type="date" class="form-report" name="fechamant" id="fechamant" value="<?= $fecharealizacion ?>">-->
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Tipo de mantenimiento:</label>
                <?php
                if ($aux == 'C') {
                ?>
                    <input type="text" class="form-report" name="tipomant" id="tipomant" value="Correctivo" style="width: 80px;">
                <?php
                } else if ($aux == 'P') {
                ?>
                    <input type="text" class="form-report" name="tipomant" id="tipomant" value="Preventivo" style="width: 80px;">
                <?php
                }
                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Equipo:</label>
                <input type="text" class="form-report" name="nombreequipo" id="nombreequipo" style="width: 250px;font-size:12px;" value="<?= $nombre_equipo ?>">
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Proveedor:</label>
                <input type="text" class="form-report" name="proveedor" id="proveedor" style="width: 250px;font-size:12px;" value="<?= $proveedor ?>">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <label for="">Sede:</label>
                <input type="text" class="form-report" name="sede" id="sede" style="width: 150px;" value="<?= $sede ?>">
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Departamento:</label>
                <input type="text" class="form-report" name="sede" id="sede" style="width: 150px;" value="<?= $dep ?>">
            </div>
        </div>

        <!--<div class="row mt-4 r-background" style="text-align: center;width:100%;">
            <strong>Descripción del mantenimiento</strong>
        </div>-->

        <div class="row mt-4">

            <?php
            if ($aux == 'C') {
                echo '<div class="col-md-4"><label for="">Descripción del daño:</label>
                    <textarea name="descdanio" class="form-text-area" id="descdanio" cols="50" rows="3"><?= $desc_mantenimiento ?></textarea></div>';
            } else if ($aux == 'P') {
                echo '';
            }
            ?>

            <div class="col-md-4">
                <label for="">Descripción del mantenimiento:</label>
                <textarea name="descmant" class="form-text-area" id="descmant" cols="50" rows="3"><?= $danio ?></textarea>
            </div>
            <div class="col-md-4">
                <label for="">Repuestos:</label>
                <textarea name="repuestos" class="form-text-area" id="repuestos" cols="50" rows="3"><?= $repuestos ?></textarea>
            </div>
        </div>

        <div class="row mt-4 r-background">
            <div class="col-md-12">
                <label for="">Responsable:</label>
                <input type="text" class="form-report" name="responsable" id="responsable" style="width: 200px;" value="<?= $responsable ?>">
                <!--&nbsp;&nbsp;&nbsp;&nbsp;<label for="">Avance del mantenimiento:</label>
                <input type="number" class="form-report" name="avance" id="avance" style="width: 50px;text-align: center;" value="<?= $avance ?>">%-->
                &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Fecha de continuación:</label>
                <input type="date" class="form-report" name="fechacon" id="fechacon" value="<?= $comienzo ?>">
            </div>
        </div>

        <input type="hidden" name="tipmant" value="<?= $aux ?>">
        <input type="hidden" name="id" value="<?= $id ?>">
    </form>

<?php

}

?>

<script>
    function saveReport() {
        $.ajax({
            method: 'POST',
            url: '/cw3/conlabweb3.0/apps/consultamantenimiento/crud.php?aux=2',
            data: $('#formMantReport').serialize(),
            success: function() {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Registro guardado correctamente!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
    }
</script>