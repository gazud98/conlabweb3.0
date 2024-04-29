<?php


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

$id_users = $_SESSION['id_users'];
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');


    $nmbapp = "CONSULTAR ACTIVOS FIJOS";
    //   echo $sctrl1 ;
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
?>

    <div class="card border-light" style="width:95%;margin:auto;">

        <div class="card-header bg-light ">
            <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><strong><?php echo $nmbapp; ?></strong></a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h5 style="text-align: center; color: #0045A5;"><strong>CONSULTAR <?php echo $nmbapp; ?></strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <button style="float: right;background-color:rgb(0,69,165);font-size:11px;" type="button" class="btn btn-primary btn-xs" onclick="collapseanshow('C')">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        </button>

                    </div>
            </div>
        </div>

        <!--<br><div class="col-md-3 p-2" style="margin-left:10px;">
            <div class="input-group mb-3">
                <input type="text" class="form-control btnsearch" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" disabled><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>-->
        
        

        <div class="card-body">
            <div class="row mb-4">
            
                <div class="col-md-2">
                    <label for="">Nombre:</label>
                    <input type="text" class="form-control" name="numiderep" id="numiderep">
                </div>
                
                <div class="col-md-1" style="margin-top: 32px;">
                    <button type="button" class="btn btn-primary btn-sm" value="Filtrar" id="button-fil"><i class="fa-solid fa-filter"></i> Filtrar</button>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12" style="overflow:hidden; overflow-y:auto;">
                    <div id="thetable" name="thetable" style="
                    overflow:hidden; 
                    overflow-y:auto;  
                    margin-bottom:5px; 
                    border-bottom:thin dotted #d3d3d3;
                    height:450px;width:auto;"></div><?php //aqui va thedatatable.php //tabla de la app 
                                                    ?>
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

    <!-- jquery-validation -->
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.table-producto').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });
        })

        function habilitacmpos() {
            $("#iddatas").css("pointer-events", "auto");
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("pointer-events", "none");
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }
        $(document).ready(function() {

            $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable.php'; ?>");

            $('.btnsearch').keyup(function(){

                var bcar = $('.btnsearch').val();

                if(bcar != ''){
                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable3.php'; ?>", {
                        bcar: bcar
                    });
                }else{
                    $("#thetable").load("<?php echo base_url . 'apps/' . $p . '/thedatatable.php'; ?>");
                }
            })

        });

        function savedata() {
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/listproducto/crud.php',
                data: $('#formcontrol').serialize(),
                success: function(respuesta) {
                    $("#thetable").load('https://cw3.tierramontemariana.org/apps/listproducto/thedatatable.php', {
                        sctrl1: <?php echo $sctrl1 ?>
                    });
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });



            inhabilitacmpos();
        } //de alvar datos

        function accionesespecificas(caso) {
            if (caso == "X") { //cancelar....
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "A") { //aceptar...
                $("#divproveedoresproducto").css("display", "block");
            }
            if (caso == "C") { //de crer
                //desaparece la creacion de proveedores, solo sale en los demas casos
                $("#divproveedoresproducto").css("display", "none");
            } //De crear
            if (caso == "E") {
                $("#divproveedoresproducto").css("display", "block");
            } //Editar
            if (caso == "D") {
                $("#divproveedoresproducto").css("display", "block");
            } //Es de habolita / inhablitar
        } //funcikjnes que hacen casos epeciales en
    </script>
<?php
}
?>