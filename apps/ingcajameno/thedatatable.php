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
                <th>Codigo</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>F. Venc</th>
                <th>Costo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /**/
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT id, insumo,cantidad,fecha_ven,costo,fecha,estado
                    FROM  u116753122_cw3completa.caja_menor" .
                $filterfrom .
                " where 1=1" .
                $filterwhere .
                " order by 2
                    Limit " . $limiteinf . "," . $limitinpantalla;
            // echo $cadena;
            /**/
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $insumo = $filaP2['insumo'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $cantidad = $filaP2['cantidad'];
                    $fecha_ven = $filaP2['fecha_ven'];
                    $costo = $filaP2['costo'];
                    $fecha = $filaP2['fecha'];
                    $estado = $filaP2['estado'];
                    $thefile = $thefile + 1;

                    echo '<tr style="';
                    if ($estado == "0") {
                        echo ' background-color:#DCD9B5; ';
                    }
                    echo '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo '<input type="radio" name="fileselect" id="fileselect' . $thefile . '" value="' . $id . '" style="display:none;" >';
                    echo $id;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $insumo;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $cantidad;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $fecha_ven;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $costo;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $fecha;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '</tr>';
                }
            }
            /**/
            ?>
        </tbody>
    </table>
<?php
} /**/
?>
