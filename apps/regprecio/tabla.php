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
    $cadena = "SELECT a.id,a.id_proveedor,a.id_producto, a.fecha,a.hora,case when a.estado_cot = 'P' then 'Pendiente' WHEN a.estado_cot = 'PO' THEN 'Por Orden'  WHEN a.estado_cot = 'PT' THEN 'Pendiente Temporal' end as estado_cot,a.estado,a.precio,b.nombre
    FROM  u116753122_cw3completa.cotizacion_insumos a, u116753122_cw3completa.producto b
    where 1=1
    and b.id_producto = a.id_producto
    and a.estado_cot <> 'O' ";
    // echo $cadena;
    /**/
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
}
?>


<table class="table table-bordered " id="result" style="margin-top: 2%;">
    <thead>
        <tr style="text-align:center;">
            <th>No. Cotizacion</th>
            <th>Proveedor</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id = $filaP2['id']; ?>
            
            <tr style=" background-color: rgb(249,249,249);text-align:center;">
                <td id="id"><?php echo $filaP2['id']; ?></td>
                <td> <?php echo $filaP2['nombre']; ?> </td>
                <td> <?php echo $filaP2['fecha']; ?></td>
                <td> <?php echo $filaP2['hora']; ?></td>
                <td style="<?php if ($filaP2['estado_cot']=='Pendiente'){echo "color:red;";}elseif ($filaP2['estado_cot']=='Por Orden'){echo "color:blue;";}elseif ($filaP2['estado_cot']=='Pendiente Temporal'){echo "color:green;";}; ?>"> <?php echo $filaP2['estado_cot']; ?></td>
                <td id="preci"> <input type="number" class="form-control" name="prec<?php echo $filaP2['id']; ?>" id="prec<?php echo $filaP2['id']; ?>" required value="<?php echo $filaP2['precio'];  ?>" onchange='grabador(<?php echo $filaP2['id']; ?>)'></input>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php //echo "------------------".$p."---------------".base_url; 
?>
<script>
    function grabador(id) {
        var objeto = "#prec" + id;
        var preci = $(objeto).val();

        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/regprecio/crud.php',
            data: {
                id: id,
                preci: preci
            },
            success: function(data) {
                
                $("#table").load("/cw3/conlabweb3.0/apps/regprecio/tabla.php");
                alert('Se Agrego Correctamente');
            }
        });



    }
</script>