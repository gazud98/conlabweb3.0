<?php

//$p viene con el modulo activo

    $nmbapp="Productos en Bodegas";
    $filterwhere="";
?>
<footer class="footer bg-light p-1 mb-4" name="thebuttoms" id="thebuttoms">

        <div class="row" style="padding:3px;">

            <div class="col-md-4 col-xs-12">
                <h6 class="fw-semibold "><?php echo $nmbapp; ?></h6>
            </div>

            <?php if($nocreatebittomP!="S") { ?>

                <div class="col-md-8 col-xs-12 ">

                    <div class="btn-group ml-2 float-sm-right" >
                            <button type="button" class="btn btn-outline-secondary btn-xs"  onclick="collapseanshow('IP')">
                               <i class="fas fa-caret-down"></i>&nbsp;&nbsp;Importar
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-xs"  onclick="collapseanshow('EP')">
                                <i class="fas fa-caret-up"></i>&nbsp;&nbsp;Exportar
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-xs"  onclick="collapseanshow('II')">
                                <i class="fas fa-print"></i>&nbsp;&nbsp;Imprimir
                            </button>
                        </div>

                    <div class="btn-group ml-2 float-sm-right" >
                            <button type="button" class="btn btn-outline-<?php if($filterwhere==""){ echo 'secondary'; } else{ echo 'info'; } ?> btn-xs"  onclick="collapseanshow('B')">
                                <i class="fas fa-newspaper"></i>&nbsp;&nbsp;
                                <?php if($filterwhere==""){ echo ' Filtro'; }else{ echo "Filtro Aplicado"; } ?>
                            </button>
                        </div>


                    <div class="btn-group float-sm-right">
                            <button type="button" class="btn btn-outline-info btn-xs" onclick="collapseanshow('C')">
                               <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                            </button>
                            <button type="button" class="btn btn-outline-info btn-xs"  onclick="collapseanshow('E')">
                                <i class="fas fa-pen"></i>&nbsp;&nbsp;Modificar
                            </button>
                            <button type="button" class="btn btn-outline-info btn-xs"  onclick="collapseanshow('D')">
                                <i class="fas fa-eraser"></i>&nbsp;&nbsp;Eliminar
                            </button>
                        </div>

                </div>

            <?php } ?>

        </div>


</footer>

<?php include('apps/thedata.php'); ?>


