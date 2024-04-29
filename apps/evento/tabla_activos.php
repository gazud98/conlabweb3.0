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
if (isset($_REQUEST['idsd'])) {
    $idsd = $_REQUEST['idsd'];

    if ($idsd == "-1") {
        $idsd = "";
    }
} else {
    $idsd = 0;
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
    $cadena23 = "SELECT count(a.id_producto) as max
    FROM  u116753122_cw3completa.producto a  where 1=1 " . $maxwhere;

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $maxi = trim($filaP23['max']);
        }
    }

    $cadena = "SELECT a.id_producto, a.nombre,a.id_departamento,a.id_sede,a.id_tipo_activo,b.garantia
     FROM u116753122_cw3completa.producto a ,u116753122_cw3completa.producto_activofijo b
     where 1=1 and id_categoria_producto ='1' and b.id_producto=a.id_producto and a.id_producto  not in (select id_activo from u116753122_cw3completa.grupo_activos_fijos_detalle )" .$maxwhere;
    // echo $cadena;
    /**/

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>



<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2%;">
    <thead>
        <tr>
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
            $id_departamento = $filaP2['id_departamento'];
            $id_sede = $filaP2['id_sede'];
            $id_tipo_activo = $filaP2['id_tipo_activo'];
            $garantia = $filaP2['garantia'];
            $thefile = $thefile + 1;

            echo '<tr id="col2' . $thefile . '"';
            echo ' name="thefileselected2' . trim($thefile) . '" id="thefileselected2' . trim($thefile) . '" ';
            echo '>';

            echo '<td style="font-size:0.8rem;display:none;"';
            echo ' onclick=" selectthefile2('  . trim($thefile) . ')"';
            echo '>';
            echo '<input type="radio"  name="fileselect2' . $thefile . '" id="fileselect2' . $thefile . '"
                             value="' . $id_producto . '"   maxi="' . $maxi . '" garantia="' . $garantia . '"   id_tipo_activo="' . $id_tipo_activo . '" id_departamento="' . $id_departamento . '"  id_sede="' . $id_sede . '"  style="display:none;" >';
            echo '</td>';


            echo '<td style="font-size:0.8rem; "';
            echo 'id="celda"';
            echo ' onclick=" selectthefile2(' . trim($thefile)  . ')" ';
            echo '>';
            echo $id_producto;
            echo '</td>';

            echo '<td style="font-size:0.8rem; "';
            echo 'id="celda"';
            echo ' onclick=" selectthefile2(' . trim($thefile)  . ')" ';
            echo '>';
            echo $nombre;
            echo '<br>';
            echo '</td>';

            echo '</tr>';
        }
    }
    /**/
    ?>

    </tbody>
</table>


<script>
    function selectthefile2(thefile) {

        var theobject = "fileselect2" + thefile;
        //elementoActivo.checked = true;

        //  id = elementoActivo.value;

        var id_producto = $('input[name="' + theobject + '"]').val();
        var maxi = $('input[name="' + theobject + '"]').attr('maxi');
        var id_tipo_activo = $('input[name="' + theobject + '"]').attr('id_tipo_activo');
        var id_departamento = $('input[name="' + theobject + '"]').attr('id_departamento');
        var id_sede = $('input[name="' + theobject + '"]').attr('id_sede');
        var garantia = $('input[name="' + theobject + '"]').attr('garantia');

        for (let i = 1; i <= maxi; i++) {
            $('#col2' + [i]).css("border", "thin solid  transparent");
        }
        $('#col2' + thefile).css("border", "4px groove #dc3545");

       
      
            $("#data2").load("https://cw3.tierramontemariana.org/apps/evento/datasg.php", {
                id_producto: id_producto,
                grupo:'N'
            });
       
       
        $("#tabla_grupoactsg").load("https://cw3.tierramontemariana.org/apps/evento/tabla_grupoactsg.php", {
            idd: id_departamento,
            idsd: id_sede,
            idta: id_tipo_activo,
            id_producto: id_producto
        });
    }
</script>