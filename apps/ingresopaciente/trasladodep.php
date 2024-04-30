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
} else {
}
$fchvence = $_REQUEST['fchvence'];
$id_produ = $_REQUEST['id_produ'];
$cante = $_REQUEST['cant'];
$nom_insumo = $_REQUEST['nom_insumo'];
$identrepanio = $_REQUEST['identrepanio'];

$cadenax = "SELECT cant_recibida as cantreci FROM u116753122_cw3completa.bodegaubcproducto where idproducto =" . $id_produ . " and identrepanio <>'0' and fchvence <'" . $fchvence . "' ";
$resultadP2x = $conetar->query($cadenax);
$numerfiles2x = mysqli_num_rows($resultadP2x);

if ($numerfiles2x >= 1) {
    while ($filaP2x = mysqli_fetch_array($resultadP2x)) {
        $cantreci = $filaP2x['cantreci'];
    }

    if ($cantreci >= 1) {
        $productofecha = 'T';
    } else {
        $productofecha = 'NT';
    }
} else {
    $productofecha = 'NT';
}




$cadena = "SELECT  a.idbodegaentrapanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre as stand,e.nombre as bodega,a.id_orden, 
   sum( a.cant_recibida) as cant, a.fchvence,a.unidadentrada,a.unidaddetalle,a.nofactura
    FROM u116753122_cw3completa.bodegaubcproducto a ,
    u116753122_cw3completa.bodegaentrepanio c,u116753122_cw3completa.bodegastand d,u116753122_cw3completa.bodegas e
    where  c.idstand= d.id and a.identrepanio=c.id
    and d.idbodega=e.id
    and a.idproducto=" . $id_produ . " and a.fchvence='" . $fchvence . "' and a.identrepanio = '" . $identrepanio . "' GROUP BY a.fchvence,a.identrepanio";

$resultadP2 = $conetar->query($cadena);
$numerfiles2 = mysqli_num_rows($resultadP2);

if ($numerfiles2 >= 1) {
    $thefile = 0;
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $id = $filaP2['idbodegaentrapanio'];
        $bodega = $filaP2['bodega'];
        $stand = $filaP2['stand'];
        $entrepanio = $filaP2['entrepanio'];
        $cant = $filaP2['cant'];
        $idproducto = $filaP2['idproducto'];
        $identrepanio = $filaP2['identrepanio'];
        $idstand = $filaP2['idstand'];
        $idbodega = $filaP2['idbodega'];
        $fchvence = $filaP2['fchvence'];
        $unidadentrada = $filaP2['unidadentrada'];
        $unidaddetalle = $filaP2['unidaddetalle'];
        $nofactura = $filaP2['nofactura'];
        $id_orden = $filaP2['id_orden'];
        $thefile = $thefile + 1;


?>

        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalterc">
            Entregar Producto
        </button>
        <div class="modal fade" id="modalterc">
            <div class="modal-dialog ">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header" style="text-align: center;">
                        <label><strong>Entrega a Departamentos de <?php echo $nom_insumo ?></strong></label>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modalshow" name="modalshow">
                        <div class="row mb-2">
                            <div class="col-md-12 col-lg-12">
                                <label>Departamento</label>
                                <select class="form-control" id="dep">
                                    <option selected="true" disabled="disabled"></option>
                                    <?php
                                    $cadenax = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.departamentos ";
                                    $resultadP2ax = $conetar->query($cadenax);
                                    $numerfiles2ax = mysqli_num_rows($resultadP2ax);
                                    if ($numerfiles2ax >= 1) {
                                        while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {

                                            echo "<option value='" . trim($filaP2ax['id']) . "'";
                                            echo '>' . $filaP2ax['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="depx"></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <?php
                            $cadenaxy = "SELECT CONCAT(p.nombre_1, ' ', p.nombre_2,' ',p.apellido_1,' ',p.apellido_2) as nombre_persona, b.id_persona FROM cotizacion_insumos a INNER JOIN ordrequisicion b on a.norequisicion = b.id INNER JOIN persona p ON p.id_persona = b.id_persona WHERE numorden = '" . $id_orden . "'";
                            $resultadcadenaxy = $conetar->query($cadenaxy);
                            $numerfiles2xy = mysqli_num_rows($resultadcadenaxy);
                            if ($numerfiles2xy >= 1) {
                                while ($filaP2xy = mysqli_fetch_array($resultadcadenaxy)) {
                                    $nombre_persona = $filaP2['nombre_persona'];
                                    $id_persona = $filaP2['id_persona'];


                            ?>

                                    <div class="col-md-12 col-lg-12" id="resp">
                                        <label>Solicitante</label>
                                        <input type="text" class="form-control" id="sol" name="sol" value="<?php echo  $id_persona ?>" readonly></input>
                                        <div id="solx"></div>

                                    </div>

                        </div>
                <?php     }
                            } ?>
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-4">
                        <label>Cantidad en Bodega</label>
                        <input type="number" class="form-control" id="cante" name="cante" value="<?php echo  $cante ?>" readonly></input>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <label>Cantidad a Entregar</label>
                        <input type="number" class="form-control" value="" id="cantt" name="cantt" 
                        productofecha="<?php echo $productofecha ?>" 
                        fchvence="<?php echo $fchvence ?>" unidadentrada="<?php echo $unidadentrada ?>" 
                        unidaddetalle="<?php echo $unidaddetalle ?>" nofactura="<?php echo $nofactura ?>" 
                        id_orden="<?php echo $id_orden ?>" id_prod="<?php echo $idproducto ?>" 
                        identrepanio="<?php echo $identrepanio ?>" idpe="<?php echo $id ?>" id_persona="<?php echo $id_persona ?>"></input>
                        <div id="canttx"></div>
                    </div>
                </div>

        <?php }
} ?>

        <!-- Modal footer -->
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" id="btnacep">Aceptar</button>
        </div>


                    </div>
                </div>
            </div>
        </div>
        <script>
            function agregarxy(sel) {
                var idd = $('option:selected', sel).attr('value');

                $("#resp").load("/cw3/conlabweb3.0/apps/trasladodepartamento/solicitante.php", {
                    idd: idd
                });


            };

            $(document).ready(function() {
                $('#btnacep').click(function() {
                    var dep = $("#dep").val();
                    var sol = $("#sol").val();
                    var cantt = $("#cantt").val();


                    if (dep == null) {
                        dep = '';
                    }

                    if (sol == null) {
                        sol = '';
                    }

                    if (dep.trim() === '') {
                        $("#dep").css("border", "thin solid red");
                        $("#depx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                        return;
                    } else {
                        $("#dep").css("border", "thin solid rgb(233,236,239)");
                        $("#depx").empty();
                    }
                    if (sol.trim() === '') {
                        $("#sol").css("border", "thin solid red");
                        $("#solx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                        return;
                    } else {
                        $("#sol").css("border", "thin solid rgb(233,236,239)");
                        $("#solx").empty();
                    }
                    if (cantt.trim() === '') {
                        $("#cantt").css("border", "thin solid red");
                        $("#canttx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                        return;
                    } else {
                        $("#cantt").css("border", "thin solid rgb(233,236,239)");
                        $("#canttx").empty();
                    }
                    traslado();
                });
            });


            function traslado() {
                var productofecha = $('input[name="cantt"]').attr('productofecha');
                var fchvence = $('input[name="cantt"]').attr('fchvence');
                var cant = $("#cantt").val();

                if (productofecha === 'T') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡Hay productos con menor fecha de vencimiento!',
                        footer: '¡Seleccione un producto con menor fecha de vencimiento que el actual!'
                    });
                } else {
                    var cante = $("#cante").val();
                    total = parseFloat(cante) - parseFloat(cant);

                    if (cante <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡No hay insumos para trasladar!',
                            footer: '<a href="">Por favor seleccione otro entrepaño</a>'
                        });
                    } else {
                        if (cante >= cant) {

                            var fchvence = $('input[name="cantt"]').attr('fchvence');
                            var unidadentrada = $('input[name="cantt"]').attr('unidadentrada');
                            var unidaddetalle = $('input[name="cantt"]').attr('unidaddetalle');
                            var nofactura = $('input[name="cantt"]').attr('nofactura');
                            var id_orden = $('input[name="cantt"]').attr('id_orden');
                            var id_prod = $('input[name="cantt"]').attr('id_prod');
                            var idpe = $('input[name="cantt"]').attr('idpe');
                            var id_persona = $('input[name="cantt"]').attr('id_persona');
                            var entr = $('input[name="cantt"]').attr('identrepanio');
                            var sol = $("#sol").val();
                            var dep = $("#dep").val();
                            $.ajax({
                                type: 'POST',
                                url: '/cw3/conlabweb3.0/apps/trasladodepartamento/crud.php',
                                data: {


                                    cant: cant,
                                    fchvence: fchvence,
                                    unidadentrada: unidadentrada,
                                    unidaddetalle: unidaddetalle,
                                    nofactura: nofactura,
                                    id_orden: id_orden,
                                    id_prod: id_prod,
                                    id_persona:id_persona,
                                    idpe: idpe,
                                    total: total,
                                    entr: entr
                                },
                                success: function(data) {
                                    $("#table").load("/cw3/conlabweb3.0/apps/trasladodepartamento/tabla.php", {
                                        id_prod: id_prod
                                    });
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: 'Entrega con Exito!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    $("#modalterc").modal('hide');
                                }
                            });

                        }
                    }
                }
            }
        </script>