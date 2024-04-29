<?php

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





// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

    include('reglasdenavegacion.php');

    // echo '..............................';

?>

    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="width:100%;">
        <thead style="font-size:15px;">
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT id_sedes, nombre,estado
                    FROM  cw3completa.sedes" .
                $filterfrom .
                " where 1=1" .
                $filterwhere;
            $cadena = $cadena . " order by 1
                    Limit " . $limiteinf . "," . $limitinpantalla;
            //                      echo $cadena;
            /* */
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id_sedes']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $estado = $filaP2['estado'];

                    $thefile = $thefile + 1;

            ?>

                    <tr>
                        <td style="<?php if ($estado == "0") {
                                        echo 'background-color:#DCD9B5;';
                                    } ?>" name="thefileselected<?php echo trim($thefile); ?>" id="thefileselected<?php echo trim($thefile); ?>"><?php echo $id; ?></td>
                        <td><?php echo $nombre;
                            if ($estado == "0") {
                                echo '<br><span style="color:red;">No esta habilitado</span>';
                            } ?>
                        </td>
                        <td></td>
                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
<?php
} /**/
?>