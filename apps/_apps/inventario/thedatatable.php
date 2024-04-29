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
                <th>Cod inventario</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Unidad</th>
                <th>Fecha Vence</th>
                <th>Stock Maximo</th>
                <th>Stock Min</th>
                <th>Existencia</th>
                <th>Costo Prom.</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /**/
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT cod_inventario,nombre,descripcion,unidad,fecha_venc,stock_max,stock_min,existencia,costo_prom
                    FROM  u116753122_cw3completa.inventario" .
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
                    $id = trim($filaP2['cod_inventario']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $descripcion = $filaP2['descripcion'];
                    $unidad = $filaP2['unidad'];
                    $fecha_venc = $filaP2['fecha_venc'];
                    $stock_max = $filaP2['stock_max'];
                    $stock_min = $filaP2['stock_min'];
                    $existencia = $filaP2['existencia'];
                    $costo_prom = $filaP2['costo_prom'];

                    $thefile = $thefile + 1;

                    echo '<tr style="';

                    echo '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo '<input type="radio" name="fileselect" id="fileselect' . $thefile . '" value="' . $id . '" style="display:none;" >';
                    echo $id;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $nombre;

                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $descripcion;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $unidad;
                    echo '</td>';
                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $fecha_venc;
                    echo '</td>';
                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $stock_max;
                    echo '</td>';
                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $stock_min;
                    echo '</td>';
                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $existencia;
                    echo '</td>';
                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $costo_prom;
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
