<?php
//SI POSEE CONSUKTA

if( file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
}else{
    if( file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    }else{
        if( file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena = "SELECT a.id,b.nombre,a.cantidad
                    FROM  u116753122_cw3completa.solicitud_insumo_enc a, u116753122_cw3completa.producto b
                    where 1=1
                    and a.id_insumo=b.id_producto
                     order by 2";
    // echo $cadena;
    /**/
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>

        <table class="table table-bordered " id="result" style="margin-top: 2%;">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                    <tr style=" background-color: rgb(249,249,249);">
                        <td> <?php echo $filaP2['nombre']; ?> </td>
                        <td> <?php echo $filaP2['cantidad']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    

