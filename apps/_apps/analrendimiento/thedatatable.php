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
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /**/
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT codigo,reactivo,descripcion,pruebas,estado
                    FROM  u116753122_cw3completa.asignacion_reactivos" .
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
                    $id = trim($filaP2['codigo']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $reactivo = trim($filaP2['reactivo']);
                    $descripcion = $filaP2['descripcion'];
                    $pruebas = $filaP2['pruebas'];
                    $estado = $filaP2['estado'];


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
                    echo $reactivo;

                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $descripcion;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo '   style="cursor:pointer;"';
                    echo '>';
                    echo $pruebas;
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