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
    echo json_encode(['error' => $error]);
} else {

    if(isset($_REQUEST['numorden'])){
        $numorden = $_REQUEST['numorden'];
    }

    $sql = "SELECT id, ruta, valor, fecha, hora, tecnico, direccion, num_orden FROM domicilios WHERE num_orden = '$numorden'";

    $rest = mysqli_query($conetar, $sql);
}
?>
<table class="table">
    <thead>
        <tr>
            <th>Ruta</th>
            <th>Valor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tecnico</th>
            <th>Direccion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($rest)) {
            $ruta = $data['ruta'];
            $valor = $data['valor'];
            $fecha = $data['fecha'];
            $hora = $data['hora'];
            $tecnico = $data['tecnico'];
            $direccion = $data['direccion'];
        ?>

        <tr>
            <td><?php echo $ruta; ?></td>
            <td><?php echo $valor; ?></td>
            <td><?php echo $fecha; ?></td>
            <td><?php echo $hora; ?></td>
            <td><?php echo $tecnico; ?></td>
            <td><?php echo $direccion; ?></td>
        </tr>

        <?php
        }
        ?>
    </tbody>
</table>