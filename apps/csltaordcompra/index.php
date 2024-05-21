<?php

$nmbapp = "Gestión de Ordenes de Compra";
$moduraiz = $_SESSION['moduraiz'];
$ruta =  "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);

?>
<link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/assets/style.css">


<div class="card border-info">

    <div class="card-header bg-light ">
        <div class="row">
            <div class="col-md-4">
                <nav class="breadcrumbs">
                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
                </nav>
            </div>
            <div class="col-md-4 col-lg-4">
                <h5 style="text-align: center; color: #0045A5;"><strong>Gestión de Ordenes de Compra</strong></h5>
            </div>
            <div class="col-md-4 col-lg-4">
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-lg-4" style="overflow:hidden; overflow-y:auto;">
                <div id="thetable" name="thetable" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                          heigth: 50vh;width:100%;"><?php ?></div><?php //aqui va thedatatable.php //tabla de la app 
                                                                                    ?>

            </div>

            <div class="col-md-8 col-lg-8 border" style="overflow:hidden; overflow-y:auto;">
                <div style="overflow:hidden; overflow-y:auto;" name="data1" id="data1">
                    <?php include("data.php"); ?>
                </div>
                <div class="card-footer" style="width:100%;">
                    <?php include('piepag.php'); //zona de botones
                    ?>
                </div>
            </div>

        </div>
    </div>



</div>

<?php

include("apps/thedata.php");

?>

<script>
    $(document).ready(function() {


            $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/csltaordcompra/thedatatable.php');



    })

    function mostrarSweetAlert() {
        Swal.fire({
            title: "¿Desea Recibir la Orden?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Recibir",
            cancelButtonText: "Recibir Parcialmente",
            reverseButtons: true,
            showCloseButton: true, // Botón para salir
            closeButtonHtml: "<i class='fas fa-times'></i>", // Ícono del botón para salir
        }).then((result) => {
            if (result.isConfirmed) {
                recibir();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                parcialRecibida();
            }
        });
    }
</script>