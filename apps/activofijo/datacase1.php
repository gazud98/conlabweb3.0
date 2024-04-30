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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
        if ($status == "-1") {
            $status = "";
        }
    } else {
        $status = "";
    }
    
    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $nombre = "";
    //$referencia = "";
    $id_departamento = "";
    $estado = "";
    $valor = "";
    $modelo = "";
    $serie = "";
    $fchinstalacion = "";
    $seguro = "";
    $seguroprima = "";
    $garantia = "";
    $fchexpgarantia = "";
    $vidautilmes = "";
    $metdepreciacion = "";
    $id_sede = "";
    $id_tipo_activo = "";
    $id_responsable = "";
    $id_proveegarantia = "";
    $aseguradora = "";
    $valor_asegurado = "";
    $descp = "";
    if ($id != "") {
        $cadena = "select P.id_producto,P.id_categoria_producto,P.nombre,P.id_departamento,P.estado,P.descripcion,
                        PA.valor,PA.modelo,PA.serie,PA.fchinstalacion,
                        PA.seguro,PA.seguroprima,PA.garantia,PA.fchexpgarantia,
                        PA.vidautilmes,PA.metdepreciacion,P.id_sede,P.id_tipo_activo, PA.id_proveegarantia,PA.id_responsable,PA.aseguradora,PA.valor_asegurado
                    from producto P,
                         producto_activofijo PA
                    where P.id_producto=PA.id_producto
                        and P.id_producto='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "1"; //esa ctivo fijo
            $nombre = trim($filaP2['nombre']);
            //$referencia = trim($filaP2['referencia']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_sede = trim($filaP2['id_sede']);
            $id_tipo_activo = trim($filaP2['id_tipo_activo']);
            $estado = trim($filaP2['estado']);
            $valor = trim($filaP2['valor']);;
            $modelo = trim($filaP2['modelo']);
            $serie = trim($filaP2['serie']);
            $fchinstalacion = trim($filaP2['fchinstalacion']);
            $seguro = trim($filaP2['seguro']);
            $seguroprima = trim($filaP2['seguroprima']);
            $garantia = trim($filaP2['garantia']);
            $id_proveegarantia = trim($filaP2['id_proveegarantia']);
            $id_responsable = trim($filaP2['id_responsable']);
            $fchexpgarantia = trim($filaP2['fchexpgarantia']);
            $vidautilmes = trim($filaP2['vidautilmes']);
            $metdepreciacion = trim($filaP2['metdepreciacion']);
            $aseguradora = trim($filaP2['aseguradora']);
            $valor_asegurado = trim($filaP2['valor_asegurado']);
            $descp = trim($filaP2['descripcion']);
        }
    }

?>

    <style>
        .formcontrol {
            display: block;
            width: 100%;
            padding: 2px;
            font-size: 13px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #AFAFAF !important;
            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .table-txt-insu {
            width: 100%;
        }

        .table-txt-insu tr,
        tr td {
            width: 100px;
            padding-left: 10px;
        }
        .form-control {
                                    width: 100%;
                                    padding: 0;
                                    height: 1.5rem;
                                    font-size: 13px;
                                    line-height: 1.5;
                                }
    </style>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        

        <div class="card-footer mt-5 text-center" style="border-radius: 5px;display:none;" id="btones">
            <button type="submit" class="btn btn-sm btn-success " name="btnsave" id="btnsave" style="font-size:12px;width:90px;">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Grabar
            </button>
            <button type="button" class="btn btn-sm btn-danger " name="btncancel" id="btncancel" onclick="cancelBTN()" style="font-size:12px;width:90px;">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Cancelar
            </button>
        </div>

    </form>

    <!-- <div class="col-md-12" style="margin-top:15px; padding-top:3px;border-top:thin solid gray; display:none;" name="divproveedoresproducto" id="divproveedoresproducto">
        <div class="col-md-12" style="font-weight:bold;">Provedores del Activo</div>
        <table name="tblproveedor" id="tblproveedor" class="table table-striped table-hover table-head-fixed text-nowrap table-sm">
            <thead>
                <tr>
                    <th>Nit</th>
                    <th>Empresa</th>
                    <th>Referencia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php    //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
                $cadenaa = "SELECT P.referencia, PR.razon_social, PR.numero_identificacion, PR.id_proveedores
                                            FROM productoproveedor P,
                                                proveedores PR
                                        where P.id_proveedores=PR.id_proveedores
                                            and P.id_productos='" . $id . "'";
                //                                             echo $cadenaa;
                $resultadP2a = $conetar->query($cadenaa);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        $referencia = trim($filaP2a['referencia']);
                        $razon_social = trim($filaP2a['razon_social']);
                        $numero_identificacion = trim($filaP2a['numero_identificacion']);
                        $id_proveedor = trim($filaP2a['id_proveedor']);
                ?>

                        <tr style="font-size: 11px;">
                            <td><?php echo $numero_identificacion; ?></td>
                            <td><?php echo $razon_social; ?></td>
                            <td><?php echo $referencia; ?></td>
                            <td><a class="btn btn-small btn-primary" name="btnelimproveedor" id="btnelimproveedor" href="elimina.php?id=" <?php echo $id; ?>>Eliminar</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
                <tr style="font-size: 11px;border-top:thin solid gray;" class="bg-light">
                    <td style=" padding-top:5px;">
                        Asignar Proveedor
                    </td>
                    <td style=" padding-top:5px;">
                        <select class="formcontrol" aria-label="Default select example" name="proveedorlist" id="proveedorlist">
                            <?php
                            $cadenaa = "SELECT id_proveedores,razon_social
                                                                FROM proveedores
                                                                where estado='1'
                                                                order by 2";
                            $resultadP2a = $conetar->query($cadenaa);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                                    echo '>' . $filaP2a['razon_social'];
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td style=" padding-top:5px;"><input type="text" class="formcontrol" name=referencia id=referencia></td>
                    <td style=" padding-top:5px;"><a class="btn btn-xs btn-success" name="btnagregaprov" id="btnagregaprov" href="agregaproveedor.php?id=" <?php echo $id; ?>>Agregar</a></td>
                </tr>
            </tbody>
        </table>
    </div><?php //del div de proveedores rtelaciondos 
            ?>-->

    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 1000px; margin-left:-280px;">
                <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Historial de Mantenimientos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-h-m">
                            <thead>
                                <tr>
                                    <th>Mantenimiento</th>
                                    <th>Responsable</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $cadena = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento,p.respuestos,p.tecnico, a.nombre FROM correctivo p, 
                                producto a WHERE a.id_producto = p.equipo AND a.id_producto = '$id' AND estado_mantenimiento ='P' 
                                UNION SELECT p.id,p.fecha_final,p.desc_mantenimiento,p.estado_mantenimiento,p.desc_mantenimiento, p.resp_mantenimiento, a.nombre 
                                FROM preventiva p, producto a WHERE a.id_producto = p.equipo 
                                AND a.id_producto = '$id' AND estado_mantenimiento = 'P'";
                                /* */
                                $thefile = 0;
                                $resultadP2 = $conetar->query($cadena);
                                $datos = array();
                                while ($filaP2 = mysqli_fetch_array($resultadP2)) {

                                ?>

                                    <tr>
                                        <td><?php echo $filaP2['respuestos']; ?></td>
                                        <td><?php echo $filaP2['tecnico']; ?></td>
                                        <td><?php echo $filaP2['fecha_final']; ?></td>
                                        <td><?php
                                        
                                        if($filaP2['estado_mantenimiento'] == 'P'){
                                            echo '<span class="badge badge-danger">PENDIENTE</span>';
                                        }else{
                                            echo '<span class="badge badge-success">REALIZADO</span>';
                                        }
                                        
                                        ?></td>
                                    </tr>

                                <?php

                                }

                                ?>

                            </tbody>
                        </table>

                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
                        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Aceptar">
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
}
?>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $("#successbtn").click(function() {

            saveData();
        });
        
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/activofijo/crud.php',
                data: $('#formcontrol').serialize(),
                success: function(respuesta) {
                    if (respuesta == 'ok') {}
                    
                        $('#thetable').load('/cw3/conlabweb3.0/apps/activofijo/thedatatable.php');
                        $("#iddatas").css("pointer-events", "none");
                        $("#iddatas").css("background-color", "#ededed");
                        $("#accionejec").css("display", "none");
                        $("#accionejec").html("");
    
                    }
                });
            }
        });
        $('#formcontrol').validate({
            rules: {
                optmante: {
                    required: true
                },
                id_sedes: {
                    required: true
                },
                descp: {
                    required: true
                }
            },
            messages: {
                optmante: {
                    required: ""
                },
                id_sedes: {
                    required: ""
                },
                descp: {
                    required: ""
                }
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });
    
    function cancelBTN() {
        $("#iddatas").css("pointer-events", "none");
        $("#iddatas").css("background-color", "#ededed");
        $("#accionejec").css("display", "none");
        $("#accionejec").html("");
        $("#btones").css("display", "none");
    }

    /*function savedata() {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/activofijo/crud.php',
            data: $('#formcontrol').serialize(),
            success: function(respuesta) {
                if (respuesta == 'ok') {}
                
                $('#thetable').load('/cw3/conlabweb3.0/apps/activofijo/thedatatable.php');
                $("#iddatas").css("pointer-events", "none");
                $("#iddatas").css("background-color", "#ededed");
                $("#accionejec").css("display", "none");
                $("#accionejec").html("");

            }
        });
    }*/

    function vaciarCampos() {
        var formulario = document.getElementById("formcontrol");
        var campos = formulario.querySelectorAll("input[type='text']");

        campos.forEach(function(campo) {
            campo.value = "";
        });
    }
</script>