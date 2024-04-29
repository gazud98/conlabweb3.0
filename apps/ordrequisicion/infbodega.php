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
    if (isset($_REQUEST['idx'])) {
        $idx = $_REQUEST['idx'];

        if ($idx == "-1") {
            $idx = "";
        }
    } else {
        $idx = 0;
    }
}

// Establecer el valor predeterminado para $cant y $fchvence
$cant = 0;
$fchvence = "";

if (!empty($idx) && $idx != 0) { // Verificar si $idx no está vacía ni es igual a cero
    $cadena =  "SELECT sum(cant_recibida) as cant
FROM u116753122_cw3completa.bodegaubcproducto
where idproducto =" . $idx;

    $resultadP2a = $conetar->query($cadena);
    $numerfiles2a = mysqli_num_rows($resultadP2a);
    if ($numerfiles2a >= 1) {
        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
            if ($filaP2a['cant'] == 0) {
                $cant = 0;
            } else {
                $cant = trim($filaP2a['cant']);
            }
        }
    } else {
        $cant = 0;
    }
    $cadenax =  "SELECT MIN(fchvence) as fchvence 
FROM u116753122_cw3completa.bodegaubcproducto 
where idproducto = '" . $idx . "'and identrepanio <>0";
    $resultadP2ax = $conetar->query($cadenax);
    $numerfiles2ax = mysqli_num_rows($resultadP2ax);
    if ($numerfiles2ax >= 1) {
        while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
            $fchvence = trim($filaP2ax['fchvence']);
        }
    }
}
?>

<label style="font-size: 14px;">Cant. Bodega</label>
<input type="input" class="form-control" style="height: 45%!important" name="cantbode" id="cantbode" readonly value="<?php echo $cant ?>" fch="<?php echo $fchvence ?>"></input>

<script>
    var fch = $('input[name="cantbode"]').attr('fch');
    $("#fecha").val(fch);
</script>
