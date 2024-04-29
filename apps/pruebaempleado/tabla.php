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
    $cadena = "SELECT  b.nombre,a.minutos,a.horas,a.dias,a.tiempo_prueba,c.nombre_1,c.nombre_2,c.apellido_1,c.apellido_2
                    FROM  u116753122_cw3completa.asignacion_prueba a, u116753122_cw3completa.pruebas b,u116753122_cw3completa.persona c
                    where 1=1
                    and a.id_prueba = b.id
                    and a.id_empleado = c.id_persona
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
                    <th >Empleado</th>
                    <th >Tiempo Prueba</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                    <tr style=" background-color: rgb(249,249,249);">
                        <td><?php echo $filaP2['nombre_1']." ".$filaP2['nombre_2']." ".$filaP2['apellido_1']." ".$filaP2['apellido_2'] ?></td>
                        <td> <?php  if ($filaP2['minutos']=='1'){echo $filaP2['tiempo_prueba'].' Minutos';}elseif($filaP2['horas']=='1'){echo $filaP2['tiempo_prueba'].' horas';}elseif($filaP2['dias']=='1'){echo $filaP2['tiempo_prueba'].' dias';} ?> </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    

