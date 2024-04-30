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
    $valor_uvt_config = "";
    $base_pesos = "";
    $porcentaje_uvt = "";

    $cadena = "SELECT id_config_imp, valor_uvt_config, base_pesos, porcentaje_uvt
                    from u116753122_cw3completa.config_impuestos";
    //                      echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id_config_imp']);
        $valor_uvt_config = trim($filaP2['valor_uvt_config']);
        $base_pesos = trim($filaP2['base_pesos']);
        $porcentaje_uvt = trim($filaP2['porcentaje_uvt']);
    }

?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <style>
        .formcontrol {
            display: block;
            width: 100%;
            padding: 2px;
            font-size: 14px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #AFAFAF !important;
            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .table-txt-order {
            width: 100%;
        }

        .table-txt-order label {
            font-size: 15px;
        }

        .table-txt-order tr,
        tr td {
            width: 100px;
            padding-left: 10px;
        }

        .content-regfical {
            width: 100%;
            padding: 10px;
        }
    </style>


    <div class="content-regfical">
        <form name="form-control2" id="form-control2" action="#" class="card p-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
                <table class="table-txt-order">
                    <td>
                        <input type="hidden" name="idreg" id="idreg">
                        <label><strong>Régimen Fiscal: </strong></label>
                        <input type="input" class="formcontrol" name="regfiscal" id="regfiscal" value="" required></input>
                    </td>
                </table>
            </div>
            <br>
            <div class="col-md-12 col-xs-12" style="text-align:center; width:100%;">
                <button type="submit" class="btn btn-success btn-sm" name="btnenviarconfig2" id="btnenviarconfig2">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Aceptar
                </button>
            </div>
        </form>

        <section class="p-3 col-md-12">
            <div class="row pb-2 mt-3 card card-body table-config-reg" style="width:80%;margin:auto;">

            </div>
        </section>

    </div>




    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Agregar jQuery Validate -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <style>
        form .error {
            color: #ff0000;
            font-family: "Open Sans";
            font-size: 14px;
        }
    </style>
    <script>
        new DataTable('.table-imp', {
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
        })

        $('#btnenviarconfig2').click(function() {
            //savedata2();
        })

        $(document).ready(function() {

            $('.table-config-reg').load('/cw3/conlabweb3.0/apps/configregimenfiscal/tabla-2.php');

            $("#form-control").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    identificacion_legal: "required",

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



                }
            });


        });



        function calcData() {

            cod = $('#cuentacontable').val()

            //alert(cod)

            $.ajax({
                url: '/cw3/conlabweb3.0/apps/configregimenfiscal/calc.php?cod=' + cod,
                success: function(rest) {
                    //alert(rest);
                    data = JSON.parse(rest);
                    data.forEach(element => {
                        $('#valoruvt').val(element.valor);
                        $('#basepesos').val(element.basepesos);
                    });
                }
            })

        }

        function buscarData1(id){
            $.ajax({
                url: '/cw3/conlabweb3.0/apps/configregimenfiscal/search-1.php?idreg='+id,
                success:function(res){
                    data = JSON.parse(res);
                    data.forEach(element => {
                        $('#idreg').val(element.id);
                        $('#regfiscal').val(element.reg);
                    });
                }
            })
        }

    </script>

<?php
}
?>