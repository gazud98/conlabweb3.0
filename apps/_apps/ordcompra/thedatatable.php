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
    <div style="height: 300px;">
        <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
            <thead>
                <tr>
                    <th>No. Orden</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>

                <?php
                /**/
                //******************************************************************************
                //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
                $cadena = "SELECT id_orden, proveedor,estado,recibida,fecha,hora,nit_proveedor,plazo,pendientes,parcial_recibida
                    FROM  u116753122_cw3completa.orden_compra" .
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
                        $id = trim($filaP2['id_orden']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                        $nombre = $filaP2['proveedor'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                        $estado = $filaP2['estado'];
                        $recibida = $filaP2['recibida'];
                        $pendientes = $filaP2['pendientes'];
                        $parcial_recibidas = $filaP2['parcial_recibida'];
                        $fecha = $filaP2['fecha'];
                        $hora = $filaP2['hora'];
                        $nit_proveedor = $filaP2['nit_proveedor'];
                        $plazo = $filaP2['plazo'];
                        $thefile = $thefile + 1;

                        echo '<tr style="';
                        if ($estado == "0") {
                            echo ' background-color:#DCD9B5; ';
                        }
                        if ($recibida == 1) {
                            echo "color:blue; ";
                        } elseif ($pendientes == 1) {
                            echo "color:red; ";
                        } elseif ($parcial_recibidas == 1) {
                            echo "color:green; ";
                        } else {
                            echo "color:black; ";
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
                        echo $nombre;
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
    </div>
    <div class="col-md-12 col-lg-12 " name="iddatas" id="iddatas" style="pointer-events: none;">
        <div class="row">
            <div class="col-md-1 col-lg-1 ">
                <p style="background-color: red;width:65%;">.</p>
            </div>
            <div class="col-md-3 col-lg-3" style="text-align:left;">
                <label style="font-size: 14px;">Ordenes Pendientes</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-lg-1 ">
                <p style="background-color: blue;width:65%;">.</p>
            </div>
            <div class="col-md-3 col-lg-3" style="text-align:left;">
                <label style="font-size: 14px;">Ordenes Recibidas</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-lg-1 ">
                <p style="background-color: green;width:65%;">.</p>
            </div>
            <div class="col-md-4 col-lg-4" style="text-align:left;">
                <label style="font-size: 14px;">Ordenes Parcialmente Recibidas</label>
            </div>
        </div>
    </div>

<?php
} /**/
?>
