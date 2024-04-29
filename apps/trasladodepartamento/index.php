<?php

$nmbapp = "Entrega de Productos";
$moduraiz = $_SESSION['moduraiz'];
$ruta = "<a href='#'>Home</a> / " . $moduraiz;
$uppercaseruta = strtoupper($ruta);

?>

<div class="card border-info" style="width:100%;">

    <div class="card-header bg-light ">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <nav class="breadcrumbs">
                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                        <?php echo $moduraiz; ?>
                    </a>
                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">
                        <?php echo $nmbapp; ?>
                    </a>
                </nav>
            </div>
            <div class="col-md-4 text-center">
                <h5 style="text-align: center; color: #0045A5;"><strong>Entrega de Productos</strong></h5>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-12 col-lg-12" style=" overflow-x:auto; ">
                <?php include ('data.php');  //campos de la app 
                ?>

            </div>

        </div>
        <div class="row ">
            <div class="col-md-12 col-lg-12" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                           height:50vh;width:100%;" name="table" id="table">
                <?php ?>

                <div class="text-nowrap" id="thenavigation" name="thenavigation"></div>
                <?php // aqui ca la navegacion y filtro btn 
                ?>
            </div>
        </div>
    </div>

    <div class="card-footer bg-light">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <table>
                    <tr>
                        <td>
                            <div id="btndep">
                                <button type="button" class="btn btn-primary btn-xs" disabled>
                                    <i class="fa-solid fa-cart-flatbed"></i>
                                    Entregar Producto
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php


include ('apps/thedata.php'); //scriops de control
?>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        obtener();

    });

    function obtener() {

        $("#table").load("https://cw3.tierramontemariana.org/apps/trasladodepartamento/tabla.php");

    }
</script>