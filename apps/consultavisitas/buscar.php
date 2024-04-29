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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label>Departamento:</label>
            <select class="form-control" name="id_departamento" id="id_departamento" >
                <option selected="true"></option>
                <?php
                $cadena = "SELECT id, nombre
                                                    FROM cw3completa.departamentos
                                                    where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 col-lg-4">
            <label>Sede:</label>
            <select class="form-control" name="id_sede" id="id_sede">
                <option selected="true"></option>
                <?php
                $cadena = "SELECT id_sedes, nombre
                                                    FROM cw3completa.sedes
                                                    where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class=" col-md-1 col-lg-1 mt-4">

            <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio" onclick="enviar()" data-toggle="modal" data-target="#modalupdt">Buscar</button>
        </div>
    </div>




<?php } ?>
<script>
    function enviar() {
        var idd = $("#id_departamento").val();
        var idsd = $("#id_sede").val();


        $("#table").load('https://cw3.tierramontemariana.org/apps/evento/tabla.php', {
            idd: idd,
            idsd: idsd
        });
        $("#tabs").load('https://cw3.tierramontemariana.org/apps/evento/tab.php');
      
    }

    function grupoActivos() {
        var idd = $("#id_departamento").val();
        var idsd = $("#id_sede").val();
        $("#table").load('https://cw3.tierramontemariana.org/apps/evento/tabla.php', {
            idd: idd,
            idsd: idsd
        });
        $("#gact1").attr("class","nav-link active");
        $("#act1").attr("class","nav-link");  
    }

    function activosFijos() {
        var idd = $("#id_departamento").val();
        var idsd = $("#id_sede").val();
        $("#table").load('https://cw3.tierramontemariana.org/apps/evento/tabla_activos.php', {
            idd: idd,
            idsd: idsd
        });
        $("#act1").attr("class","nav-link active"); 
        $("#gact1").attr("class","nav-link");  
    }
</script>