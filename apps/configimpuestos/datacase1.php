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
    </style>


    <form name="form-control" id="form-control" action="#" class="card p-3" method="POST" enctype="multipart/form-data" style="width:80%; margin-left:10%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

        <div class="row pb-2 mt-3" style="width:100%; ">
            
            <div class="col-md-2">
                <label><strong>Tipo de retención:</strong></label>
                <select class="formcontrol" name="tiporete" id="tiporete">
                    <option value="RF">Retefuente</option>
                    <option value="RI">Reteica</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label><strong>Código:</strong></label>
                            <input type="text" class="formcontrol" name="cuentacontable" id="cuentacontable" required value="">
                            <!--<select class="formcontrol" name="cuentacontable" id="cuentacontable" onchange="calcData()">
                                <option value=""></option>

                                <?php

                                $sql = "SELECT codigo_info, descripcion, valor_uvt, base_uvt 
                                FROM u116753122_cw3completa.codigo_contable;";

                                $rest = $conetar->query($sql);
                                $numerfiles2 = mysqli_num_rows($rest);

                                if ($numerfiles2 >= 1) {

                                    while ($filaP3 = mysqli_fetch_array($rest)) {

                                ?>

                                        <option value="<?php echo $filaP3['codigo_info']; ?>"><?php echo $filaP3['codigo_info']; ?> - <?php echo $filaP3['descripcion']; ?></option>

                                <?php }
                                } ?>

                            </select>-->
            </div>
            
            <div class="col-md-2">
                <label><strong>Nombre:</strong></label>
                <input type="text" class="formcontrol" name="nombrecu" id="nombrecu" required value="">
            </div>
            
            <div class="col-md-2">
                <label><strong>Valor UVT:</strong></label>
                <input type="text" class="formcontrol" name="valoruvt" id="valoruvt" required value="">
            </div>
            
            <div class="col-md-2">
                <label><strong>Base en pesos: </strong></label>
                <input type="input" class="formcontrol" name="basepesos" id="basepesos" value="" required></input>
            </div>

            <div class="col-md-2">
                <label><strong>%:</strong></label>
                <input type="input" class="formcontrol" name="porcentajeuvt" id="porcentajeuvt" value="" required></input>
            </div>

        </div>

        <div class="col-md-12 col-xs-12 mt-3" style="text-align:center;">
            <button type="submit" class="btn btn-success btn-sm" name="btnenviarconfig" id="btnenviarconfig">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Aceptar
            </button>
        </div>

    </form>

    <section class="col-md-12">
        <div class="row pb-2 mt-3 card card-body content-table-config" style="width:80%;margin:auto;overflow-x: scroll;">

        </div>
    </section>

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

        $('#btnenviarconfig').click(function() {
            savedata();
        })

        $(document).ready(function() {

            $('.content-table-config').load('/cw3/conlabweb3.0/apps/configregimenfiscal/tabla.php');

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


        $(document).keyup(function(e) {
            if (e.keyCode === 13) {
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
        })


        function buscarData(id) {
            $.ajax({
                url: '/cw3/conlabweb3.0/apps/configregimenfiscal/search-2.php?id=' + id,
                success: function(res) {
                    data = JSON.parse(res);
                    data.forEach(element => {
                        $('#id').val(element.id);
                        $('#cuentacontable').val(element.cod);
                        $('#nombrecu').val(element.nombre);
                        $('#valoruvt').val(element.valor);
                        $('#basepesos').val(element.base);
                        $('#porcentajeuvt').val(element.porcentaje);
                    });
                }
            })
        }
    </script>

<?php
}
?>