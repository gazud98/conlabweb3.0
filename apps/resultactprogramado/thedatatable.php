<?php
//SI POOSEE CONSULTA

if (file_exists("config/global_config.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/global_config.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/global_config.php")) {
            include("../../config/accesosystems.php");
        }
    }
}



// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    // echo '..............................';

?>
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Instrumento</th>
                <th>Fecha</th>
                <th>Actividad</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT a.id,a.id_actividad,a.id_instrumento,a.fecha,a.resultado,a.estado,b.descripcion,c.nombre
            
                    FROM  u116753122_cw3completa.mantenimiento a, u116753122_cw3completa.actividad_seguimiento b,u116753122_cw3completa.producto c " .
                $filterfrom .
                " where 1=1 
                and b.id_actividad_seguimiento = a.id_actividad
                and c.id_producto = a.id_instrumento" .
                $filterwhere;
            $cadena = $cadena . " order by 2
                    Limit " . $limiteinf . "," . $limitinpantalla;
            //                      echo $cadena;
            /* */
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $descripcion = trim($filaP2['descripcion']);                                  
                    $nombre = $filaP2['nombre']; 
                    $fecha = $filaP2['fecha']; 
                    $resultado = $filaP2['resultado'];
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
                    //                                 echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                    echo '>';
                    //                                 echo '<input type="radio" name="fileselect" id="fileselect'.$thefile.'" value="'.$id.'" style="display:none;" >';
                    echo $id;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    //                             echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                    echo '>';
                    echo $nombre;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">No esta habilitado</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    //                             echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                    echo '>';
                    echo $fecha;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    //                             echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                    echo '>';
                    echo $descripcion;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    //                             echo ' onclick="selectthefile('."'".trim($thefile)."','".$estado."'".')"  style="cursor:pointer;"';
                    echo '>';
                    echo $resultado;
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
