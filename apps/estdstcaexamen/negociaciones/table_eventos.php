<?php
//SI POSEE CONSUKTA

if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT a.evento,a.f_inicio
     FROM cw3completa.eventos a  ";
    // echo $cadena;
    /**/

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>
<div style="text-align: center;">
    <label>Eventos Creados</label>
</div>
<div style="overflow:scroll; overflow-x:auto;height:350px; width:100%;">
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2%;">
        <thead>
            <tr>
                <th>Evento</th>
                <th>F.Inicio</th>
            </tr>
        </thead>
        <?php
        if ($numerfiles2 >= 1) {
            $datos = 1;
            $thefile = 0;
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $evento = $filaP2['evento'];
                $f_inicio = $filaP2['f_inicio'];
                $thefile = $thefile + 1;

                echo '<tr id="col' . $thefile . '"';
                echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '" ';
                echo '>';

                echo '<td style="font-size:0.8rem;display:none;"';
                echo '>';
                echo '<input type="radio"  name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"
                               style="display:none;" >';
                echo '</td>';


                echo '<td style="font-size:0.8rem; "';
                echo 'id="celda"';
                echo '>';
                echo $evento;
                echo '</td>';

                echo '<td style="font-size:0.8rem; "';
                echo 'id="celda"';
                echo '>';
                echo $f_inicio;
                echo '</td>';

                echo '</tr>';
            }
        }
        /**/
        ?>

        </tbody>
    </table>
</div>

<script>

</script>