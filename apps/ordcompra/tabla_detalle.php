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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena23 = "SELECT count(id) as max
    FROM u116753122_cw3completa.orden_compratemp";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max1 = trim($filaP23['max']);
        }
    }


?>
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="table1">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT a.id_proveedor,a.id_producto,a.cantidad,a.valor, b.nombre_comercial,c.nombre ,a.numcotiza
            FROM  u116753122_cw3completa.orden_compratemp a, u116753122_cw3completa.proveedores b ,u116753122_cw3completa.producto c
            where a.id_proveedor =b.id_proveedores
            and c.id_producto=a.id_producto";
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);

            if ($numerfiles2 >= 1) {

                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {


                    $id_proveedor = trim($filaP2['id_proveedor']);                            //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre_comercial'];                                      //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $insumo = $filaP2['nombre'];
                    $id_producto = $filaP2['id_producto'];
                    $cantidad = $filaP2['cantidad'];
                    $precio = $filaP2['valor'];
                    $numcotiza = $filaP2['numcotiza'];
                    $thefile = $thefile + 1;


                    echo '<tr id="col1' . $thefile . '"';
                    echo ' name="thefileselected' . trim($thefile) . '" id="thefileselected' . trim($thefile) . '"';
                    echo '>';

                    echo '<td style="font-size:0.8rem;"';
                    echo ' onclick=" selectthefile3(' . trim($thefile) . ')"  ';
                    echo '>';
                    echo '<input type="radio" name="fileselect' . $thefile . '" id="fileselect' . $thefile . '"
                             value="' . $id_proveedor . '"  id_prod="' . $id_producto . '"  nom_prov="' . $nombre . '" numcotiza="' . $numcotiza . '" max1="'. $max1.'" style="display:none;" >';
                    echo $nombre;
                    echo '</td>';

                    echo '<td style="font-size:0.8rem; cursor:pointer;" id="celda"';
                    echo ' onclick=" selectthefile3(' . trim($thefile) . ')" >';
                    echo $insumo;
                    echo '</td>';


                    echo '<td style="font-size:0.8rem; cursor:pointer;" id="celda" ';
                    echo ' onclick=" selectthefile3(' . trim($thefile) . ')"  >';
                    echo $cantidad;
                    echo '</td>';


                    echo '<td style="font-size:0.8rem; cursor:pointer;"';
                    echo ' onclick=" selectthefile3(' . trim($thefile) . ')" >';
                    echo $precio;
                    echo '</td>';





                    echo '</tr>';
                }
            }
            /**/
            ?>

        </tbody>
    </table>

<?php
} ?>

<script>
    function selectthefile3(thefile) {
        var theobject = "fileselect" + thefile;
        var id_prov = $('input[name="' + theobject + '"]').val();
        var id_prod = $('input[name="' + theobject + '"]').attr('id_prod');
        var nom_prov = $('input[name="' + theobject + '"]').attr('nom_prov');
        var max1 = $('input[name="' + theobject + '"]').attr('max1');
        var numcotiza = $('input[name="' + theobject + '"]').attr('numcotiza');

        for (let i = 1; i <= max1; i++) {
            $('#col1' + [i]).css("border", "thin solid  transparent");
        }

        $('#col1' + thefile).css("border", "4px groove #dc3545");


        $("#btndlt").load("https://cw3.tierramontemariana.org/apps/ordcompra/modaldelet.php", {
            id_prov: id_prov,
            id_prod: id_prod,
            nom_prov: nom_prov,
            numcotiza:numcotiza
        });

    }
</script>