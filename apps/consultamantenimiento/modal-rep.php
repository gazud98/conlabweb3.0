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

    $id = "";
    $aux = "";
    $nombre = "";
    $fecha = "";
    $ide = "";
    $axu2 = "";

    if (isset($_REQUEST['id']) || isset($_REQUEST['aux'])) {
        $id = $_REQUEST['id'];
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 'C') {
        $sql = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento,p.estado,a.nombre, s.nombre AS sede_mant, p.aux FROM 
        correctivo p, producto a, sedes s 
        WHERE p.id_sede = s.id_sedes AND a.id_producto = p.equipo AND p.id = '$id'";

        $rest = mysqli_query($conetar, $sql);

        while ($data = mysqli_fetch_array($rest)) {
            $nombre = $data['nombre'];
            $fecha = $data['fecha_final'];
            $ide = $data['id'];
            $axu2 = $data['aux'];
        }


    }else if ($aux == 'P') {
        $sql = "SELECT p.id,p.comienzo,p.desc_mantenimiento,p.estado,p.estado_mantenimiento, c.nombre_comercial 
        AS resp,p.fecha_final,a.nombre,s.nombre AS sede_mant, p.aux FROM preventiva p, proveedores c, 
        producto a, sedes s WHERE c.id_proveedores = p.responsable AND p.id_sede = s.id_sedes 
        AND a.id_producto = p.equipo AND p.id = '$id'";

        $rest = mysqli_query($conetar, $sql);

        while ($data = mysqli_fetch_array($rest)) {
            $nombre = $data['nombre'];
            $fecha = $data['fecha_final'];
            $ide = $data['id'];
            $axu2 = $data['aux'];
        }

    }else if ($aux == 'A') {
        $sql = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento, p.id_sede, a.nombre, s.nombre AS sede_mant, p.aux 
        FROM correctivo p, producto a, sedes s WHERE a.id_producto = p.equipo
        AND p.id_sede = s.id_sedes AND p.id = '$id' UNION SELECT p.id, p.fecha_final, p.desc_mantenimiento,p.estado_mantenimiento, 
        p.id_sede, a.nombre, s.nombre AS sede_mant, p.aux FROM preventiva p, producto a, sedes s 
        WHERE a.id_producto = p.equipo AND p.id_sede = s.id_sedes AND p.id = '$id'";

        $rest = mysqli_query($conetar, $sql);

        while ($data = mysqli_fetch_array($rest)) {
            $nombre = $data['nombre'];
            $fecha = $data['fecha_final'];
            $ide = $data['id'];
            $axu2 = $data['aux'];
        }
    }
}

?>

<div class="row">
    <div class="col-md-12">
        <label for="">Activo:</label>
        <input type="hidden" name="idactivo" value="<?php echo $id; ?>">
        <input type="hidden" name="aux" id="aux" value="<?php echo $axu2; ?>">
        <input type="text" class="form-control" name="" id="" disabled value="<?php echo $nombre; ?>">
    </div>
    <div class="col-md-12 mt-2">
        <label for="">Fecha de final:</label>
        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-8" id="loadMotivo">
        
    </div>
    <div class="col-md-1">
        <button type="button" data-toggle="modal" data-target="#modalAddMotivo" class="btn btn-primary btn-xs" style="margin-left: -20px;margin-top:25px"><i class="fa-solid fa-plus"></i></button>
    </div>
</div>

<div class="row mt-3 text-right">
    <div class="col-md-12">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="updateRepPrev()">Grabar</button>
    </div>
</div>

<script>

    $(document).ready(function(){
        $('#loadMotivo').load('https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/load-motivo.php');
    })

    function updateRepPrev() {
        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/reprogramar.php',
            data: $('#formEditDatosBasicos').serialize(),
            success: function(respuesta) {

                tp = "<?php echo $aux; ?>"

                if(tp == 'C'){
                    $("#thetable").load("https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/thedatatable-c.php");
                }else if(tp == 'P'){
                    $("#thetable").load("https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/thedatatable-p.php");
                }else if(tp == 'A'){
                    $("#thetable").load("https://conlabweb3.tierramontemariana.org/apps/consultamantenimiento/all-1.php");
                }
                //alert("¡Registro actualizado con exito!");
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: '¡Registro actualizado con exito!',
                    showConfirmButton: false,
                    timer: 1500
                })
                
                $('#modalReprogramar').modal('hide');
            }
        });
    }
</script>