<?php
// echo __FILE__.'>dd.....<br>';
//include("../../config/accesosystems.php");

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $nmbapp = "ORDEN DE COMPRA";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    $filterwhere = "";
    $limiteinf = "0";
    $filterfrom = "";
    /*  
   //         $limiteinf=$_REQUEST['limiteinf'];
   
    if($limiteinf==""){ $limiteinf=0; }else{ if($limiteinf=="1"){ $limiteinf=0; } }

    if ( true === ( isset( $_REQUEST["filterfrom"] ) ? $_REQUEST["filterfrom"] : null ) ) {
        if($_REQUEST["filterfrom"]!=""){ $filterfrom=$_REQUEST["filterfrom"];}else{ $filterfrom=""; }
    }else{ $filterfrom=""; }
    if ( true === ( isset( $_REQUEST["filterwhere"] ) ? $_REQUEST["filterwhere"] : null ) ) {
        if($_REQUEST["filterwhere"]!=""){ $filterwhere=$_REQUEST["filterwhere"]; }else{ $filterwhere=""; }
    }else{ $filterwhere=""; }
*/


    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.orden_compratemp 
                    where 1=1";
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];

?>

    <section class="content " style="max-height:90vh;">
        <div class="col-md-12 col-lg-12 mb-9">
            <div class="card">
                <div class="card-header bg-light ">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong><?php echo $nmbapp; ?></strong> </label>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-12 col-lg-12" style="max-height:80vh; overflow:hidden; overflow-y:auto;">
                        <div id="dt" name="dt">

                        </div>

                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-4 col-lg-4">
                        <div id="table" name="table" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                        height:280px;width:auto;">
                            <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="tb">
                                <thead>
                                    <tr>
                                        <th>Proveedor</th>
                                        <th>Referencia</th>
                                        <th>Valor</th>

                                    </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">

                        <div id="table1" name="table1" style="overflow:hidden; overflow-y:auto;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                        height:280px;width:auto;">
                            <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" id="table1">
                                <thead>
                                    <tr>
                                        <th>Proveedor</th>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="container" style="display: grid;place-content: center; padding-bottom:1%;">

                    <table>
                        <tr>
                            <td>

                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" id="btnsave" onclick="ejecutar()" style="text-align: center;">
                                    Confirmar Ordenes
                                </button>

                                <?php include('modal.php'); //zoan de botornes
                                ?>

                            </td>
                            <td>
                                <div id="btndlt">
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" disabled style="text-align: center;">
                                        Borrar Orden
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>

            </div>
    </section>


    <?php
    include('thefinder.php'); //modal de busqueda personalizado

    include('apps/thedata.php'); //scriops de control
    ?>

    <script>
        function habilitacmpos() {
            $("#iddatas").css("pointer-events", "auto");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("pointer-events", "none");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }

        function savedata() {

            inhabilitacmpos();
        }


        $(document).ready(function() {
            cargar();
        });

        function cargar() {
            $("#dt").load("https://cw3.tierramontemariana.org/apps/ordcompra/data.php")
            $("#table1").load("https://cw3.tierramontemariana.org/apps/ordcompra/tabla_detalle.php")
        }

        function ejecutar() {
            // result = 'success';
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/ordcompra/creaorden.php',
                data: {},
                success: function(data) {

                    $("#table1").load("https://cw3.tierramontemariana.org/apps/ordcompra/tabla_detalle.php");

                }
            })
        }
    </script>
<?php
}
?>