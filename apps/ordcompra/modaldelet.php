<?php


if (isset($_REQUEST['id_prov'])) {
    $id_prov = $_REQUEST['id_prov'];
}else{
    $id_prov="";
}
if (isset($_REQUEST['id_prod'])) {
    $id_prod = $_REQUEST['id_prod'];
}else{
    $id_prod="";
}
if (isset($_REQUEST['nom_prov'])) {
    $nom_prov = $_REQUEST['nom_prov'];
}else{
    $nom_prov="";
}
if (isset($_REQUEST['numcotiza'])) {
    $numcotiza = $_REQUEST['numcotiza'];
}else{
    $numcotiza="";
}
?>

<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modaldelet" style="text-align: center;">
    Borrar Orden
</button>

<div class="modal fade" id="modaldelet">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="text-align: center;">


                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modalshow" name="modalshow">
                <div style="text-align: center;">
                    <h4 class="modal-title">¿Desea borrar la orden para el proveedor <?php echo $nom_prov ?>?</h4>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <input type="input" value="<?php echo $id_prov ?>" id="val1" name="val1"  numcotiza="<?php echo $numcotiza ?>"  style="display: none;"></input>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <input type="input" value="<?php echo $id_prod ?>" id="val3" name="val3" style="display: none;"> </input>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="acep" onclick="borrar();">Aceptar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function borrar() {
            var id_prov = $('input[name="val1"]').val();
            var id_prod = $('input[name="val3"]').val();
            var numcotiza = $('input[name="val1"]').attr('numcotiza');
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/ordcompra/borrarorden.php',
                data: {
                    id_prov: id_prov,
                    id_prod: id_prod,
                    numcotiza:numcotiza
                },
                success: function(data) {

                    $("#table1").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/tabla_detalle.php");
                    $("#dt").load("https://conlabweb3.tierramontemariana.org/apps/ordcompra/data.php");
                    alert('Se elimino correctamente');
                }
            })
          
        }
    </script>