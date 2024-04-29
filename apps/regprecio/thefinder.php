<?php

    // echo __FILE__.'>dd.....<br>';
    if( file_exists("config/accesosystems.php")) {
        include("config/accesosystems.php");
    }else{
        if( file_exists("../config/accesosystems.php")) {
            include("../config/accesosystems.php");
        }else{
            if( file_exists("../../config/accesosystems.php")) {
                include("../../config/accesosystems.php");
            }
        }
    }

?>

    <div class="modal fade" id="modal-find"  name="modal-find" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Busqueda</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="clickbtnmodal" id="clickbtnmodal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">


                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <label style="font-size: 12px;">No. Cotizacion</label>
                                <input type="input" class="form-control" name="fndcodigo" id="fndcodigo" style="width: 100%; height: 28px;font-size: 12px;"></input>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <label style="font-size: 12px;">Proveedor</label>
                                <input type="input" class="form-control" name="fndnombre" id="fndnombre" style="width: 100%; height: 28px;font-size: 12px;"></input>
                            </div>
                        </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar Filtro</button>
              <button type="button" class="btn btn-primary" onclick="generafilters()">Aplicar Filtro</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>






<script>
    function generafilters(){
        var fndcodigo=$("#fndcodigo").val();
        var fndnombre=$("#fndnombre").val();

      //  alert(fndnombre);

        $.ajax({
            url : '<?php echo base_url.'apps/'.$p.'/genfiltro.php'; ?>',
            type : 'POST',
            data : {
                    fndcodigo:fndcodigo,
                    fndnombre:fndnombre
                    },

            success : function(data) {
                if(data.length >= 9){
                    //hacemos las separaciones y armamos el recargue del datatable
                    var pos1 = data.indexOf("|F:");
                    var sctrl4= data.substring(2 ,pos1);
                    var sctrl5= data.substring(pos1 ,data.length);;
                    var pos1 = sctrl5.indexOf("|W:");
                    var sctrl6= sctrl5.substring(pos1+3 ,sctrl5.length);
                    var sctrl5= sctrl5.substring(3 ,pos1);
    //                  alert(cselect);
    //                  alert(cfrom);
    //                  alert(cwhere);

                    $("#thetable").load("<?php echo base_url.'apps/'.$p.'/thedatatable.php'; ?>",
                                    { p:"<?php echo $p; ?>",
                                    limiteinf:"0",
                                    limitinpantalla:<?php echo limitinpantalla; ?>,
                                    sctrl1:<?php echo $sctrl1; ?>,
                                    sctrl2:<?php echo $sctrl2; ?>,
                                    sctrl3:<?php echo $sctrl3; ?>,
                                    sctrl4: sctrl4,
                                    sctrl5: sctrl5,
                                    sctrl6: sctrl6
                                    }
                            );

                    $('#modal-find').modal('hide');


                }else {

                }

            },

            // código a ejecutar si la petición falla;
            error : function(xhr, status) {
                alert('Error, en generar filtro, si el problema persiste comuniquelo al administrador de CW3');
            }


        });
    }
</script>
