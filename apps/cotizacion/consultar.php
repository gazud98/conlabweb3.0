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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
}


?>
<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="tb">
    <thead>
        <tr>
            <th>No. Solicitud</th>
            <th>Insumo</th>
            <th>Cantidad</th>

        </tr>
    </thead>
    <tbody>

        <?php
        $cadena23 = "SELECT count(id) as max
             FROM u116753122_cw3completa.cotizacion_insumos 
             where id_proveedor <>0";

        $resultadP23 = $conetar->query($cadena23);
        $numerfiles23 = mysqli_num_rows($resultadP23);
        if ($numerfiles23 >= 1) {
            while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                $max = trim($filaP23['max']);
            }
        }
        /* */
        //******************************************************************************
        //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
        $cadena = "SELECT a.id,b.cantidad,c.nombre
        FROM u116753122_cw3completa.ordrequisicion a, u116753122_cw3completa.ordrequisicion_detalle b , u116753122_cw3completa.producto c
        where  a.id = b.id_req
        and c.id_producto = b.id_producto";
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $thefile = 0;
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $id = trim($filaP2['id']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                $nombre = $filaP2['nombre'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                $cantidad = $filaP2['cantidad'];
                




                $thefile = $thefile + 1;

                echo '<tr id="col' . $thefile . '" ';
                echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '" ';
                echo '>';

                echo '<td style="font-size:0.8rem;" ';
                echo ' onclick=" selectthefile1('  . trim($thefile) . ')"';
                echo '>';
                echo '<input type="radio"  name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"
                             value="' . $id . '"" max="' . $max . '" style="display:none;" >';
                echo $id;
                echo '</td>';

                echo '<td style="font-size:0.8rem;"';
                echo 'id="celda"';
                echo ' onclick=" selectthefile1(' . trim($thefile)  . ')"  style="cursor:pointer;"';
                echo '>';
                echo $nombre;
                echo '</td>';


                echo '<td style="font-size:0.8rem;"';
                echo ' onclick=" selectthefile1(' . trim($thefile) .  ')"  style="cursor:pointer;"';
                echo '>';
                echo $cantidad;
                echo '</td>';





                echo '</tr>';
            }
        }
        /**/
        ?>

    </tbody>
</table>
<!--<div class="col-md-3 col-lg-3">
    <label>No. Requisicion</label>
    <select class="form-control" name="norequisicion" id="norequisicion" onchange="enviarResp(this)">
        <option selected="true" disabled="disabled"></option>
        <?php
        $cadena = "SELECT a.id, a.id_persona,b.nombre_1, b.nombre_2,apellido_1,apellido_2
                                    FROM u116753122_cw3completa.ordrequisicion a, u116753122_cw3completa.persona b 
                                    where a.id_persona= b.id_persona";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                $id_persona = trim($filaP2['id_persona']);
                echo "<option value='" . trim($filaP2a['id']) . "'  nom_per='" . trim($filaP2a['nombre_1']) . " " . trim($filaP2a['nombre_2']) . " " . trim($filaP2a['apellido_1']) . " " . trim($filaP2a['apellido_2']) . "'";

                echo '>' . $filaP2a['id'] . "</option>";
            }
        }
        ?>
    </select>
</div>

<div class=" col-md-9 col-lg-9">
    <label>Responsable</label>
    <input type="input" class="form-control" name="resp" id="resp" value="" disabled></input>
</div>-->

<script>
    function enviarResp(el) {
        var nom_per = $('option:selected', el).attr('nom_per');
        var noreq = $("#norequisicion").val();
        $("#resp").val(nom_per);
        $("#table_req").load("https://conlabweb3.tierramontemariana.org/apps/cotizacion/tabla_req.php", {
            noreq: noreq
        });
    }
</script>