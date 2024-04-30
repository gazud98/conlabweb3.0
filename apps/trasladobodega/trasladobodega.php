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
    }
}
?>

<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
    <i class="fa-solid fa-cart-flatbed"></i> Traslado de Bodega
</button>
<div class="modal fade" id="myModal">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="text-align: center;">
                <label><strong>Traslado de Bodega de <?php echo $nom_insumo ?></strong></label>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modalshow" name="modalshow">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <label value="" id="val3">Bodega</label>
                        <input type="input" class="form-control" value="<?php echo  $bodega ?>" readonly></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <label>Estante</label>
                        <input type="input" class="form-control" value="<?php echo  $stand ?>" readonly></input>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>Entrepaño</label>
                        <input type="input" class="form-control" identrepanio="<?php echo $identrepanio ?>" id="entr" name="entr" value="<?php echo  $entrepanio ?>" readonly></input>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>Cantidad en Bodega</label>
                        <input type="number" class="form-control" id="cante" name="cante" value="<?php echo  $cante ?>" readonly></input>
                    </div>
                </div>

                <div style="text-align: center; margin-top:3%;">
                    <h5>Bodega Destino</h5>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12 col-lg-12">
                        <label>Bodega</label>
                        <select class="form-control" id="bod" onchange="agregar(this)">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id, nombre,id_empleado,predeterminada
                                                    FROM u116753122_cw3completa.bodegas
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                                    echo "<option value='" . trim($filaP2a['id']) . "'";
                                    echo '>' . $filaP2a['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="bodx"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-4" id="stand">
                        <?php include("stand.php"); ?>
                    </div>
                    <div class="col-md-4 col-lg-4" id="entrepanio">
                        <?php include("entrepanio.php"); ?>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label>Cantidad</label>
                        <input type="number" class="form-control" value="" id="cantt" name="cantt" fchvence="<?php echo $fchvence ?>" unidadentrada="<?php echo $unidadentrada ?>" unidaddetalle="<?php echo $unidaddetalle ?>" nofactura="<?php echo $nofactura ?>" id_orden="<?php echo $id_orden ?>" id_prod="<?php echo $idproducto ?>" idpe="<?php echo $id ?>"></input>
                        <div id="canttx"></div>
                    </div>
                </div>



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
    $(document).ready(function() {
        $('#btnacep').click(function() {
            var bod = $("#bod").val();
            var std = $("#std").val();
            var entrepan = $("#entrepan").val();
            var cantt = $("#cantt").val();

            if (bod == null) {
                bod = '';
            }

            if (std == null) {
                std = '';
            }

            if (entrepan == null) {
                entrepan = '';
            }

            if (bod.trim() === '') {
                $("#bod").css("border", "thin solid red");
                $("#bodx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#bod").css("border", "thin solid rgb(233,236,239)");
                $("#bodx").empty();
            }
            if (std.trim() === '') {
                $("#std").css("border", "thin solid red");
                $("#stdx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#std").css("border", "thin solid rgb(233,236,239)");
                $("#stdx").empty();
            }
            if (entrepan.trim() === '') {
                $("#entrepan").css("border", "thin solid red");
                $("#entrepanx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#entrepan").css("border", "thin solid rgb(233,236,239)");
                $("#entrepanx").empty();
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

    function agregar(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#stand").load("/cw3/conlabweb3.0/apps/trasladobodega/stand.php", {
            id: id
        });

    };

    function agregar2(sel) {
        var idstd = $('option:selected', sel).attr('value');
        $("#entrepanio").load("/cw3/conlabweb3.0/apps/trasladobodega/entrepanio.php", {
            idstd: idstd
        });

    };

    function traslado() {

        var identre = $("#entrepan").val();
        var entr = $('input[name="entr"]').attr('identrepanio');

        if (identre != entr) {

            var cant = $("#cantt").val();
            if (cant <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡Digite una cantidad mayor a 0!',

                })


            } else {


                //  var cant = $("#cantt").val();

                var cante = $("#cante").val();
                total = parseFloat(cante) - parseFloat(cant);


                if (cante <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡No hay insumos para trasladar!',
                        footer: '<a href="">Por favor seleccione otra bodega</a>'
                    })
                } else {
                    if (cante >= cant) {


                        var fchvence = $('input[name="cantt"]').attr('fchvence');
                        var unidadentrada = $('input[name="cantt"]').attr('unidadentrada');
                        var unidaddetalle = $('input[name="cantt"]').attr('unidaddetalle');
                        var nofactura = $('input[name="cantt"]').attr('nofactura');
                        var id_orden = $('input[name="cantt"]').attr('id_orden');
                        var id_prod = $('input[name="cantt"]').attr('id_prod');
                        var idpe = $('input[name="cantt"]').attr('idpe');
                        var identre = $("#entrepan").val();
                        var entr = $('input[name="entr"]').attr('identrepanio');

                        $.ajax({
                            type: 'POST',
                            url: '/cw3/conlabweb3.0/apps/trasladobodega/crud.php',
                            data: {

                                identre: identre,
                                cant: cant,
                                fchvence: fchvence,
                                unidadentrada: unidadentrada,
                                unidaddetalle: unidaddetalle,
                                nofactura: nofactura,
                                id_orden: id_orden,
                                id_prod: id_prod,
                                idpe: idpe,
                                total: total,
                                entr: entr
                            },
                            success: function(data) {
                                $("#table").load("/cw3/conlabweb3.0/apps/trasladobodega/tabla.php", {
                                    id_prodc: id_prod
                                });
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: '¡Traslado con Exito!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#myModal").modal('hide');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡No hay insumos para trasladar!',
                            footer: '<a href="">Solo hay ' + cante + ' productos en esta bodega</a>'
                        })
                    }
                }


            }

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡No puede trasladar productos a la misma bodega!'
            })
        }
    }
</script>