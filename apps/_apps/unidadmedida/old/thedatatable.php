<?php

include("../../config/accesosystems.php");
// echo __FILE__.'>dd.....<br>';
//echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $limiteinf = $_REQUEST['limiteinf'];
    if ($limiteinf == "") {
        $limiteinf = 0;
    } else {
        if ($limiteinf == "1") {
            $limiteinf = 0;
        }
    }

    if (true === (isset($_REQUEST["filterfrom"]) ? $_REQUEST["filterfrom"] : null)) {
        if ($_REQUEST["filterfrom"] != "") {
            $filterfrom = $_REQUEST["filterfrom"];
        } else {
            $filterfrom = "";
        }
    } else {
        $filterfrom = "";
    }
    if (true === (isset($_REQUEST["filterwhere"]) ? $_REQUEST["filterwhere"] : null)) {
        if ($_REQUEST["filterwhere"] != "") {
            $filterwhere = $_REQUEST["filterwhere"];
        } else {
            $filterwhere = "";
        }
    } else {
        $filterwhere = "";
    }


?>
    <table class="table table-striped table-hover table-sm" style="overflow:hidden; overflow-y:auto;">
        <thead>
            <tr>
                <?php
                $thecolums = "<th>Id Unidad Medida</th>
                <th>Categoria Unidad Medida</th><th>Nombre</th>";
                echo $thecolums ?>
            </tr>
        </thead>
        <tbody>

            <?php
            //******************************************************************************
            //prieemrpo la ejecutpo apra el maxio de egistro para cuadrar el paginador.   CAMBIAR CONSULTA
            $cadena = "SELECT count(*) as cantidad
            FROM  desarrollo_laboratorio.unidad_medida U,
                 desarrollo_laboratorio.categoria_umd C".
                $filterfrom .
                " where U.id_categoria_umd=C.id_categoria_umd
                        and C.estado=1" .
                $filterwhere;

            //                echo $cadena;

            $resultadP2 = $conetar->query($cadena);
            $filaP2 = mysqli_fetch_array($resultadP2);
            $cantrgt = $filaP2['cantidad'];
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT U.id_unidad_medida,U.nombre, U.estado,C.nombre as nmbcatumd
            FROM  desarrollo_laboratorio.unidad_medida U,
                    desarrollo_laboratorio.categoria_umd C" .
                $filterfrom .
                " where U.id_categoria_umd=C.id_categoria_umd
                        and C.estado=1" .
                $filterwhere .
                " order by 2
            Limit " . $limiteinf . "," . limitinpantalla;


            //echo $cadena;

            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id_unidad_medida']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre'];
                    $estado = $filaP2['estado'];
                    $nmbcatumd=$filaP2['nmbcatumd'];


                    $thefile = $thefile + 1;
                    echo '<tr style="';
                    if ($estado == "0") {
                        echo ' background-color:#DCD9B5; ';
                    }
                    echo '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';
                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo '<input type="radio" name="fileselect" id="fileselect' . $thefile . '" value="' . $id . '" style="display:NONE;" >';
                    echo $id;
                    if ($estado == "0") {
                        echo '<br><span style="color:red;">It is not enabled</span>';
                    }
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $nmbcatumd;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick="selectthefile(' . "'" . trim($thefile) . "'" . ')"  style="cursor:pointer;"';
                    echo '>';
                    echo $nombre;
                    echo '</td>';


                    echo '</tr>';
                }
            }

            ?>
        </tbody>

    </table>



<?php
}
/**/
?>
