<?php
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

    //echo '..............................'.$_REQUEST['id'].'...';

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id = "";
    $identificacion_legal = "";
    $codigo_ria = "";
    $licencia = "";
    $nombre_empresa = "";
    $direccion = "";
    $pais = "";
    $ciudad = "";
    $telefono = "";
    $codigo_postal = "";
    $fax = "";
    $email = "";
    $direccion_electronica = "";
    $estado = "1";

    $cadena = "select id,identificacion_legal,codigo_ria,
                licencia,nombre_empresa,direccion,pais,ciudad,
                telefono,codigo_postal,fax,email,direccion_electronica
                    from u116753122_cw3completa.identificacion_empresa";
    //                      echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id']);
        $identificacion_legal = trim($filaP2['identificacion_legal']);
        $codigo_ria = trim($filaP2['codigo_ria']);
        $ciudad = trim($filaP2['ciudad']);
        $licencia = trim($filaP2['licencia']);
        $nombre_empresa = trim($filaP2['nombre_empresa']);
        $direccion = trim($filaP2['direccion']);
        $pais = trim($filaP2['pais']);
        $telefono = trim($filaP2['telefono']);
        $codigo_postal = trim($filaP2['codigo_postal']);
        $fax = trim($filaP2['fax']);
        $email = trim($filaP2['email']);
        $direccion_electronica = trim($filaP2['direccion_electronica']);
    }

?>

<style>
    
</style>

    <form name="formcontrol" id="formcontrol" action="" class="card p-3" method="POST" enctype="multipart/form-data" style="width:80%; margin-left:10%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">



        <div class="row pb-2" style="width:100%; ">

            <table>

            </table>

            <div class="col-md-4 col-lg-4">
                <label><strong>No. Identificación Legal :</strong></label>
            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="identificacion_legal" id="identificacion_legal" required value="<?php echo $identificacion_legal; ?>"></input>
            </div>


        </div>

        <div class="row  pb-2" style="width:100%;">
            <!--              <div class="col-md-4 col-lg-4">
                                                    <label ><strong>Código RIA :</strong></label>

                                                </div>

                                                <div class="col-md-8 col-lg-8">
                                                    <input type="input" class="form-control" name="codigo_ria" id="codigo_ria" value="<?php echo $codigo_ria; ?>"></input>
                                                </div>
-->


        </div>

        <div class="row  pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Licencia :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="licencia" id="licencia" readonly value="<?php echo $licencia; ?>" required></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Nombre de la Empresa : </strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="nombre_empresa" id="nombre_empresa" value="<?php echo $nombre_empresa; ?>" required></input>
            </div>


        </div>


        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Dirección :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" required></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Ciudad :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="text" class="form-control" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>País :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="pais" id="pais" value="<?php echo $pais; ?>" required></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4 ">
                <label><strong>Teléfono :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Fax :</strong></label>

            </div>


            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="fax" id="fax" value="<?php echo $fax; ?>" required></input>
            </div>


        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4 ">
                <label><strong>Código Postal :</strong></label>
            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="codigo_postal" id="codigo_postal" value="<?php echo $codigo_postal; ?>" required></input>
            </div>


        </div>



        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Email :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="email" id="email" value="<?php echo $email; ?>"></input>
            </div>

        </div>

        <div class="row pb-2" style="width:100%;">
            <div class="col-md-4 col-lg-4">
                <label><strong>Pagina Web :</strong></label>

            </div>

            <div class="col-md-8 col-lg-8">
                <input type="input" class="form-control" name="direccion_electronica" id="direccion_electronica" value="<?php echo $direccion_electronica; ?>" required></input>
            </div>


        </div>
        <div class="row" name="thebuttoms" id="thebuttoms" style="text-align:center;">
            <div class="col-md-12 col-xs-12" style="text-align:center; width:50%;">
                <button type="submit" class="btn btn-success btn-xs" name="successbtnx" id="successbtnx">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Aceptar
                </button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<?php
}
?>

<style>
    form .error {
        color: #ff0000;
        font-family: "Open Sans";
        font-size: 14px;
    }
</style>
<script>
    $(function() {
        $("form[name='formcontrol']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                identificacion_legal: "required",
                licencia: "required",
                nombre_empresa: "required",
                direccion: "required",
                ciudad: "required",
                pais: "required",
                telefono: "required",
                fax: "required",
                codigo_postal: "required",
                direccion_electronica: "required",
                email: {
                    required: true,
                    email: true
                },

            },
            // Specify validation error messages
            messages: {
                identificacion_legal: "Este campo no puede estar vacio",
                email: "Por favor, introduce una dirección de correo electrónico válida",
                licencia: "Este campo no puede estar vacio",
                nombre_empresa: "Este campo no puede estar vacio",
                direccion: "Este campo no puede estar vacio",
                pais: "Este campo no puede estar vacio",
                ciudad: "Este campo no puede estar vacio",
                telefono: "Este campo no puede estar vacio",
                fax: "Este campo no puede estar vacio",
                codigo_postal: "Este campo no puede estar vacio",
                direccion_electronica: "Este campo no puede estar vacio",

            },
            submitHandler: function(form) {
                collapseanshow('A');
                alert("¡Actualizacion Exitosa!");
            }
        });
    });
</script>