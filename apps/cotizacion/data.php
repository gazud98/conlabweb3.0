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


    if (isset($_REQUEST['idr'])) {
        $idr = $_REQUEST['idr'];
        if ($idr == "-1") {
            $idr = "";
        }
    } else {
        $idr = 0;
    }

    $cadena = "SELECT  a.id,b.nombre as nombre_sede,c.nombre_1, c.nombre_2, c.apellido_1,c.apellido_2
    FROM  u116753122_cw3completa.ordrequisicion a,  u116753122_cw3completa.sedes b,u116753122_cw3completa.persona c
    where a.id_persona = c.id_persona
    and b.id_sedes = a.id_sede
    and  a.id=" . $idr;
    // echo $cadena;
    /**/
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            date_default_timezone_set('America/Bogota');
            $fechaActual = date('d-m-Y');
            $id = trim($filaP2['id']);
            $solicitante = $filaP2['nombre_1']." ".$filaP2['nombre_2']." ".$filaP2['apellido_1']." ".$filaP2['apellido_2'];  
            $nombre_sede = trim($filaP2['nombre_sede']);
          
        }
    } else {
        $id = "";
        $nombre_sede="";
        $solicitante = "";  
    }
?>

    <div class="row mt-2 mb-2" style="width:100%;">



        <div class="col-md-6 col-lg-6 " id="solicitante">
            <label>Solicitante:</label>
            <input type="input" class="form-control" name="solicitante" id="solicitante" required readonly value="<?php echo $solicitante  ?>">
        </div>
        <div class="col-md-6 col-lg-6 " id="Sede">
            <label>Sede:</label>
            <input type="input" class="form-control" name="sede" id="sede" required readonly value="<?php echo $nombre_sede  ?>">
        </div>
        <div class="col-md-6 col-lg-6">
           
        </div>


    </div>


<?php } ?>

<script>
    function enviar() {

        var id_prod = $('input[name="id_producto"]').attr('id_prod');
        var id_req = $('input[name="id_producto"]').attr('id_req');
        var idprovee = $("#id_proveedor").val();
        var cantidad = $('input[name="id_producto"]').attr('cant');

        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/cotizacion/crud.php',
            data: {

                id_prod: id_prod,
                idprovee: idprovee,
                cantidad: cantidad,
                id_req: id_req
            },
            success: function(data) {

                $("#table").load('https://cw3.tierramontemariana.org/apps/cotizacion/tabla.php');

            }
        })

    }
</script>