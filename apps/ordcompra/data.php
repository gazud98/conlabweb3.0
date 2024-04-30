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
    echo $error;
} else {
    $nombre_empresa="";
    $ciudad="";
    $telefono="";
    $direccion="";
    $fechaActual="";
    //   $fechaActual = date("d/m/Y");
    //  echo  $fechaActual;
    $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono
    FROM  u116753122_cw3completa.identificacion_empresa
    where 1=1";
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $nombre_empresa = trim($filaP2['nombre_empresa']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            $ciudad = $filaP2['ciudad'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            $telefono = $filaP2['telefono'];
            $direccion = $filaP2['direccion'];
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('d-m-Y');
        }
    }
}
?>
<div class="row">
    <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
        <label style="margin-top: 4px;">Datos de Envio</label>
    </div>
</div>

<div class="row mt-2" style="width:100%;">
    <div class="col-md-3 col-lg-3">
        <label>Nombre:</label>
        <input type="input" class="form-control" style="border: transparent;" readonly name="nombre" id="nombre" value="<?php echo $nombre_empresa; ?>" required></input>
    </div>
    <div class="col-md-2 col-lg-2 ">
        <label>Ciudad</label>
        <input type="input" class="form-control" style="border: transparent;" readonly name="descripcion" id="descripcion" value="<?php echo $ciudad  ?>" required></input>
    </div>

    <div class="col-md-3 col-lg-3 ">
        <label>Direccion</label>
        <input type="input" class="form-control" style="border: transparent;" readonly name="valor" id="valor" value="<?php echo  $direccion ?>" required></input>

    </div>
    <div class="col-md-2 col-lg-2 ">
        <label>Telefono</label>
        <input type="input" class="form-control" style="border: transparent;" readonly name="mes" id="mes" value="<?php echo  $telefono; ?>" required></input>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
        <label style="margin-top: 4px;">Orden de Compra de Insumos</label>
    </div>
</div>
<div class="row mt-2" style="width:100%;">
    <?php

    ?>
    <div class="col-md-1 col-lg-1">
        <label>Fecha:</label>
        <input type="input"  style="border: transparent;" class="form-control" name="nombre" id="nombre" value="<?php echo $fechaActual ?>" disabled>
    </div>

    <div class="col-md-4 col-lg-4" id="tbd">
        <label>Insumo</label>
        <select class="form-control" name="insumo" id="insumo" onchange='seleccionar(this);' required>
            <option selected="true" disabled="disabled" required></option>
            <?php
            $cadena = "SELECT distinct a.id_producto, b.nombre
                         FROM u116753122_cw3completa.cotizacion_insumos a, u116753122_cw3completa.producto b
                         where a.id_producto = b.id_producto
                         and a.estado_cot = 'PO'
                         and a.id_producto not in (select id_producto from u116753122_cw3completa.orden_compratemp) ";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    $id_insumo = trim($filaP2a['id_producto']);
                    echo "<option value='" . trim($filaP2a['id_producto']) . "' ";
                    echo '>' . $filaP2a['nombre'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-2 col-lg-2">
        <button type="button" class="btn btn-primary" style="margin:14% 0% 0% 0% ;" onclick="buscar();">Gestionar Insumo</button>
    </div>

</div>



<script>
    function seleccionar(sel) {
        var ide = $('option:selected', sel).attr('value');
        return ide;

    }

    function buscar() {

        var ide = seleccionar();

        $("#table").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/tabla.php", {
            ide: ide
        });

        $("#dt").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/data.php");
    }
</script>