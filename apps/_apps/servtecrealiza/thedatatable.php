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
                <th>Instrumentoc</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /**/
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT id, fecha,id_proveedor,id_instrumento,instrumento,falla,reparacion,repuesto,tecnico,valor,estado
                    FROM  u116753122_cw3completa.visitas_tecnicas" .
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
                    $fecha = $filaP2['fecha'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $id_proveedor = $filaP2['id_proveedor'];
                    $id_instrumento = $filaP2['id_instrumento'];
                    $instrumento = $filaP2['instrumento'];
                    $falla = $filaP2['falla'];
                    $reparacion = $filaP2['reparacion'];
                    $repuesto = $filaP2['repuesto'];
                    $tecnico = $filaP2['tecnico'];
                    $valor = $filaP2['valor'];
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
                    echo $instrumento;
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

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                   
                    $cadena = "SELECT id_proveedores, nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            
                            if (trim($filaP2a['id_proveedores']) == $id_proveedor) {
                                echo  $filaP2a['nombre_comercial'];
                            }
                            
                        }
                    }
                   
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "','" . $estado . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $valor;
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
