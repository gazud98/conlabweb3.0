<?php
$limiteinf = $_REQUEST['limiteinf'];
$limitinpantalla = $_REQUEST['limitinpantalla'];
$filterfrom = "";
$filterwhere = "";


include("../../config/accesosystems.php");
// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
?>
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Presentación</th>
                <th>Proveedor</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /**/
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT id_proveedores,numero_identificacion,nombre_comercial,direccion,telefono,email,observaciones
                    FROM  u116753122_cw3completa.proveedores" .
                $filterfrom .
                " where 1=1" .
                $filterwhere .
                " order by 2
                    Limit " . $limiteinf . "," . $limitinpantalla;


            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id_proveedores']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $numero_identificacion = trim($filaP2['numero_identificacion']);
                    $nombre = $filaP2['nombre_comercial'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $direccion = $filaP2['direccion'];
                    $telefono = $filaP2['telefono'];
                    $email = $filaP2['email'];
                    $observaciones = $filaP2['observaciones'];

                    $thefile = $thefile + 1;

                   
                }
            }
            /**/
            ?>
        </tbody>
    </table>
<?php
} /**/
?>
