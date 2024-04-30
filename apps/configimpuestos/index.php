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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {



    // echo $sctrl1;
    $nmbapp = "Configuración de impuestos";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";

    $cantrgt = 1;
?>
    <style>
        .content-wrapper {
            background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/configimpuestos/assets/style.css">
    <div class="card border-light" style="width:85%;margin:auto;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
                    </nav>
                </div>
                <div class="col-md-4 text-center">
                    <h5 style="text-align: center; color: #0045A5;"><strong><?php echo $nmbapp; ?></strong></h5>
                </div>
            </div>
        </div>

        <div class="card-body">

            <nav>
                <div class="nav nav-tabs nav-impuestos" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><strong>Impuestos</strong></a>
                    <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab" aria-controls="nav-reg" aria-selected="false"><strong>Régimen Fiscal</strong></a>
                    <a class="nav-item nav-link" id="nav-iva-tab" data-toggle="tab" href="#nav-iva" role="tab" aria-controls="nav-iva" aria-selected="false"><strong>IVA</strong></a>
                    <a class="nav-item nav-link" id="nav-cuenta-tab" data-toggle="tab" href="#nav-cuenta" role="tab" aria-controls="nav-cuenta" aria-selected="false"><strong>Cuentas por Pagar</strong></a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="col-md-12 col-lg-12" name="divappshow" id="divappshow">
                        <?php include('thedatashow.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="col-md-5 col-lg-5" style="margin: auto;">
                        <?php include('configreg.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-iva" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-md-5 col-lg-5" style="margin: auto;">
                        <?php include('configiva.php');  //campos de la app 
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-cuenta" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="col-md-5 col-lg-5" style="margin: auto;">
                        <?php include('config_ctaxpagar.php');  //campos de la app 
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <?php
    include('apps/thedata.php'); //scriops de control
    ?>

    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>
        function habilitacmpos() {
            $("#iddatas").css("background-color", "white");
        }

        function inhabilitacmpos() {
            $("#iddatas").css("background-color", "#ededed");

            $("#accionejec").css("display", "none");
            $("#accionejec").html("");
        }


        $('#form-control4').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-4.php',
                data: $('#form-control4').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-cuenta').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-4.php');
                    $('#codcuenta').val('');
                    $('#nombrecuenta').val('');
                    $('#porcentacuenta').val('');
                }
            });

            inhabilitacmpos();
        })

        $('#form-control3').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-3.php',
                data: $('#form-control3').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-iva').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-3.php');
                    $('#codiva').val('');
                    $('#nombreiva').val('');
                    $('#porcentajeiva').val('');
                }
            });

            inhabilitacmpos();
        })


        $('#form-control2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud-2.php',
                data: $('#form-control2').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.table-config-reg').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-2.php');
                    $('#regfiscal').val('');
                    $('#idreg').val('');
                }
            });

            inhabilitacmpos();
        })

        $('#form-control').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/crud.php',
                data: $('#form-control').serialize(),
                success: function(respuesta) {
                    /*Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Guardado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })*/
                    $('.content-table-config').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla.php');
                    $('#cuentacontable').val("");
                    $('#nombrecu').val("");
                    $('#valoruvt').val("");
                    $('#basepesos').val("");
                    $('#porcentajeuvt').val("");

                }
            });

            inhabilitacmpos();
        })

        function deleteConfig1(id, aux) {
            Swal.fire({
                title: '¿Está seguro de eliminar?',
                text: "Está a punto de eliminar un registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00A400',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/delete.php?aux=' + aux + '&id=' + id,
                        success: function(respuesta) {

                            if (aux == '1') {
                                $('.content-table-config').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla.php');
                            } else if (aux == '2') {
                                $('.table-config-reg').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-2.php');
                            } else if (aux == '3') {
                                $('.table-config-iva').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-3.php');
                            } else if (aux == '4') {
                                $('.table-config-cuenta').load('https://conlabweb3.tierramontemariana.org/apps/configregimenfiscal/tabla-4.php');
                            }

                        }
                    });
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado.',
                        'success'
                    )
                }
            })
        }

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