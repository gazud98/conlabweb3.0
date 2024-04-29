<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "COSTOS INDIRECTOS";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.costos" .
        $filterfrom .
        " where 1=1";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <div class="card border-light" style="width:100%;">

        <div class="bg-light p-1">
            <div class="row">
                <div class="col-md-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Home</a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong><?php echo $nmbapp; ?></strong></a>
                    </nav>
                </div>
                <div class="col-md-4">
                    <h5 style="text-align: center; color: #0045A5;"><strong>CREACIÓN DE <?php echo $nmbapp; ?></strong></h5>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <button type="button" class="btn btn-danger btn-xs" name="cancelbtn" id="cancelbtn" onclick="collapseanshow('X')" style="display:none; float: right; margin-right: 5px;">
                        <i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Cancelar
                    </button>
                    <button type="button" class="btn btn-warning btn-xs" name="modbtn" id="modbtn" onclick="collapseanshow('E')" style="display:none; float: right; margin-right: 5px;">
                        <i class="fas fa-pen"></i>&nbsp;&nbsp;Modificar
                    </button>
                    <button type="button" class="btn btn-danger btn-xs" name="delbtn" id="delbtn" onclick="collapseanshow('D')" style="display:none; float: right; margin-right: 5px;">
                        <i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Inhabilitar
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editCostoIndirectoModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 500px;">
                    <form id="formcontrol" action="" method="post" style="width:100%;" enctype="multipart/form-data">
                        <div class="row" style="width:100%; padding:20px;">

                            <div class="col-md-12 col-lg-12 p-3 ">
                                <label>Descripcion</label><br>
                                <input type="input" class="form-control" name="descripcion" id="descripcion" required></input>
                            </div>

                            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                                <div class="form-check">
                                    <label>
                                        Distribuir Dpto
                                    </label><br>
                                    <input class="form-check-input" type="radio" name="distribuido" id="distribuido" value="1"></input>
                                </div>
                            </div>
                            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                                <div class="form-check">
                                    <label>
                                        Distribuir Prueba
                                    </label><br>
                                    <input class="form-check-input" type="radio" name="distribuido" id="distribuido" value="2"></input>
                                </div>
                            </div>
                            <div class=" col-md-3 col-lg-3" style="text-align: center;">
                                <div class="form-check">
                                    <label>
                                        Costo Fijo
                                    </label><br>
                                    <input class="form-check-input" type="checkbox" id="check" name="check" checked>
                                </div>
                            </div>
                        </div><br><br>

                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar" id="aceptsede">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-7 col-lg-7" style=" overflow-x:auto; ">
                    <?php include('data.php');  //campos de la app 
                    ?>

                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 col-lg-12 mt-3" style="overflow:scroll; overflow-x:auto;height:350px; width:100%;" name="table" id="table">
                    <?php  ?>

                    <?php // aqui ca la navegacion y filtro btn 
                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light">
            <?php include('piepag.php'); //zoan de botornes
            ?>
        </div>
    </div>

    <?php
    include('thefinder.php'); //modal de busqueda personalizado

    include('apps/thedata.php'); //scriops de control
    ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            obtener();
        });

        function obtener() {

            $("#table").load("<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>");

        }


        $("#envio").click(function() {


            $.ajax({
                type: 'POST',
                url: '<?php echo base_url . 'apps/' . $p . '/crud.php'; ?>',
                data: $('#formcontrol').serialize(),
                success: function(data) {
                    obtener();

                }
            })





        });
    </script>
<?php
}
?>