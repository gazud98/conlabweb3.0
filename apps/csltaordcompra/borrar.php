<?php
$id_prodc = $_REQUEST['idpr'];
$nom = $_REQUEST['nom'];
$id = $_REQUEST['id'];
?>

<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#delete">
    &nbsp;&nbsp;Borrar
</button>

<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="text-align: center;">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modalshow" name="modalshow">
                <div style="text-align: center;">
                    <h5 class="modal-title">¿Estas seguro de borrar el producto <?php echo $nom ?> ?</h5>
                    <input type="radio" name="proveed" id="proveed" value="<?php echo $id_prodc ?>" num_ord="<?php echo $id ?>" style="display:none;">
                </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="row" style="width: 100%;">

                    <div class="col-md-6 col-lg-6" style="text-align: center;">
                        <button type="button" class="btn btn-success" onclick="borrar()" data-dismiss="modal">Aceptar</button>
                    </div>
                    <div class="col-md-6 col-lg-6" style="text-align: center;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function borrar() {
        var id_prod = $('input[name="proveed"]').attr('value');
        var id = $('input[name="proveed"]').attr('num_ord');




        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/csltaordcompra/crud.php',
            data: {
                id_prod: id_prod,
                status: 'D'
            },
            success: function(data) {
                $("#data1").load("/cw3/conlabweb3.0/apps/csltaordcompra/data.php", {
                    id: id
                });

            }
        });

    }
</script>