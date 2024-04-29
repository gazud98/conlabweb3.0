<?php
//SI POSEE CONSUKTA

if (isset($_REQUEST['idd'])) {
    $idd = $_REQUEST['idd'];

    if ($idd == "-1") {
        $idd = "";
    }
} else {
    $idd = 0;
}
if (isset($_REQUEST['idgra'])) {
    $idgra = $_REQUEST['idgra'];

    if ($idgra == "-1") {
        $idgra = "";
    }
} else {
    $idgra = 0;
}
if (isset($_REQUEST['idsd'])) {
    $idsd = $_REQUEST['idsd'];

    if ($idsd == "-1") {
        $idsd = "";
    }
} else {
    $idsd = 0;
}
if (isset($_REQUEST['idta'])) {
    $idta = $_REQUEST['idta'];

    if ($idta == "-1") {
        $idta = "";
    }
} else {
    $idta = 0;
}
if (isset($_REQUEST['id_producto'])) {
    $id_producto = $_REQUEST['id_producto'];

    if ($id_producto == "-1") {
        $id_producto = "";
    }
} else {
    $id_producto = "";
}

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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $maxwhere = "";

    if (isset($idd) && ($idd != "")) {
        $maxwhere = $maxwhere . "  and a.id_departamento = '" . $idd . "' ";
    }
    if (isset($idsd) && ($idsd != "")) {
        $maxwhere = $maxwhere . "   and a.id_sede = '" . $idsd . "' ";
    }
    if (isset($idta) && ($idta != "")) {
        $maxwhere = $maxwhere . "   and a.id_tipo_activo = '" . $idta . "' ";
    }
    if (isset($id_producto) && ($id_producto != "")) {
        $maxwhere = $maxwhere . "   and a.id_producto = '" . $id_producto . "' ";
    }
    $cadena23 = "SELECT count(a.id_producto) as max
    FROM u116753122_cw3completa.producto a, u116753122_cw3completa.producto_activofijo b where 1=1  AND a.id_producto = b.id_producto and b.garantia='N'" . $maxwhere;
    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $maxi = trim($filaP23['max']);
        }
    }

    $cadena = "SELECT a.id_producto, a.nombre
     FROM u116753122_cw3completa.producto a , u116753122_cw3completa.producto_activofijo b 
     where 1=1 and a.id_categoria_producto ='1' and a.id_producto = b.id_producto and b.garantia = 'N'" . $maxwhere;
    // echo $cadena;
    /**/

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>

<div style="text-align: center;">
    <label>Activos Fijos</label>
</div>
<div style="overflow:scroll; overflow-x:auto;height:350px; width:100%;">
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2%;">
        <thead>
            <tr>
                <th> </th>
                <th>Id</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <?php
        if ($numerfiles2 >= 1) {
            $datos = 1;
            $thefile = 0;
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $id_producto = trim($filaP2['id_producto']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                $nombre = $filaP2['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                $thefile = $thefile + 1;

                echo '<tr ';
                echo ' name="thefileselected2' . trim($thefile) . '" id="thefileselected2' . trim($thefile) . '" ';
                echo '>';

                echo '<td style="font-size:0.8rem;display:none;"';
                echo '>';

                echo '<input type="radio"  name="fileselect23' . $thefile . '" id="fileselect23' . $thefile . '"
            value="' . $maxi . '"  idgra="' . $idgra . '"   id_producto="' . $id_producto . '"   style="display:none;" >';
                echo '</td>';

                echo '<td style="font-size:0.8rem; "';
                echo 'id="celda"';
                echo '>';

                echo '</td>';

                echo '<td style="font-size:0.8rem; "';
                echo 'id="celda"';
                echo '>';
                echo '<input class="form-check-input" type="checkbox" name="fileselect4' . $thefile . '" id="fileselect4' . $thefile . '" checked>';
                echo $id_producto;
                echo '</td>';

                echo '<td style="font-size:0.8rem; "';
                echo 'id="celda"';
                echo '>';
                echo $nombre;
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
  if(<?php echo $maxi ?>!==0){
    $("#btneven").prop('disabled', false);
  }
</script>