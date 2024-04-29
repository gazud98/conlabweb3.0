<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="text-align: center;">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modalshow" name="modalshow">
                <div style="text-align: center;">
                    <h4 class="modal-title">¿Desea Recibir la Orden?</h4>
                </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="row" style="width: 100%;">

                    <div class="col-md-6 col-lg-6" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="parcialRecibida();" data-dismiss="modal">Recibir Parcialmente</button>
                    </div>
                    <div class="col-md-6 col-lg-6" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="recibir();" data-dismiss="modal">Recibir</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
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




    $id = $_REQUEST['id'];
}
?>
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ordcompra">
    &nbsp;&nbsp;Ver Orden
</button>




<div class="modal" id="ordcompra">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 700px;margin-left:-130px;">

            <!-- Modal Header -->

            <div class="modal-header">
                <div class="container">

                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body" id="modalshow" name="modalshow">
                <?php include("../../apps/formatos/ordencompra.php") ?>
            </div>
        </div>
    </div>
</div>

<script>
    $("#modalshow").load("https://conlabweb3.tierramontemariana.org/apps/formatos/ordencompra.php", {
        id: id
    });
</script>