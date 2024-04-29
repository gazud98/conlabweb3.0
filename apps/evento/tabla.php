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
    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.grupo_activos";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
    $maxwhere = "";

    if (isset($idd) && ($idd != "")) {
        $maxwhere = $maxwhere . "  and a.id_departamento = '" . $idd . "' ";
    }
    if (isset($idsd) && ($idsd != "")) {
        $maxwhere = $maxwhere . "   and a.id_sede = '" . $idsd . "' ";
    }


    $cadena = "SELECT a.id,a.id_departamento,a.id_sede,a.id_tipo_activo, a.nombre, b.nombre as nombre_departamento,c.nombre as nombre_sede,d.nombre as nombre_tipo
     FROM u116753122_cw3completa.grupo_activos a ,  u116753122_cw3completa.departamentos b,u116753122_cw3completa.sedes c,u116753122_cw3completa.tipo_activo_fijos d 
     where 1=1 and b.id = a.id_departamento  and c.id_sedes = a.id_sede  and d.id = a.id_tipo_activo" . $maxwhere;
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
            $id = trim($filaP2['id']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $nombre = $filaP2['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $nombre_departamento = $filaP2['nombre_departamento'];
            $nombre_sede = $filaP2['nombre_sede'];
            $nombre_tipo = $filaP2['nombre_tipo'];
            $id_departamento = $filaP2['id_departamento'];
            $id_sede = $filaP2['id_sede'];
            $id_tipo_activo = $filaP2['id_tipo_activo'];
            $thefile = $thefile + 1;

            echo '<tr id="col' . $thefile . '"';
            echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '" ';
            echo '>';

            echo '<td style="font-size:0.8rem;display:none;"';
            echo ' onclick=" selectthefile('  . trim($thefile) . ')"';
            echo '>';
            echo '<input type="radio"  name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"
                             value="' . $id . '"  id_departamento="' . $id_departamento . '" id_sede="' . $id_sede . '" id_tipo_activo="' . $id_tipo_activo . '"  max="' . $max . '"  style="display:none;" >';
            echo '</td>';


            echo '<td style="font-size:0.8rem; "';
            echo 'id="celda"';
            echo ' onclick=" selectthefile(' . trim($thefile)  . ')" ';
            echo '>';
            echo $id;
            echo '</td>';

            echo '<td style="font-size:0.8rem; "';
            echo 'id="celda"';
            echo ' onclick=" selectthefile(' . trim($thefile)  . ')" ';
            echo '>';
            echo $nombre;
            echo '<br>';
            echo '<span style="font-size:9px;font-style:italic; ">' . $nombre_departamento . ", " . $nombre_sede . ", " . $nombre_tipo . '</span>';
            echo '</td>';

            echo '</tr>';
        }
    }
    /**/
    ?>

    </tbody>
</table>


<script>
    function selectthefile(thefile) {

        var theobject = "fileselect" + thefile;
        //elementoActivo.checked = true;

        //  id = elementoActivo.value;

        var id_grupo_act = $('input[name="' + theobject + '"]').val();
        var id_departamento = $('input[name="' + theobject + '"]').attr('id_departamento');
        var id_sede = $('input[name="' + theobject + '"]').attr('id_sede');
        var id_tipo_activo = $('input[name="' + theobject + '"]').attr('id_tipo_activo');
        var max = $('input[name="' + theobject + '"]').attr('max');

        for (let i = 1; i <= max; i++) {
            $('#col' + [i]).css("border", "thin solid  transparent");
        }
        $('#col' + thefile).css("border", "4px groove #dc3545");
        
    
        $("#tabla_grupoactsg").load("https://conlabweb3.tierramontemariana.org/apps/evento/tabla_grupoactsg.php", {
            idd: id_departamento,
            idsd: id_sede,
            idta: id_tipo_activo,
            idgra: id_grupo_act,
            grupo: 'S'
        });


    }
</script>