<!-- Consulta de modulos de mantenimiento para extrer consulta dinamica -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $submodulo['name'] ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $submodulo['name'] ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?= $submodulo['name'] ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="accordion" id="accordionExample">
                        <?php if (!empty($group)) {
                            foreach ($group as $key => $value) { ?>
                                <div class="card">
                                    <div class="card-header" id="heading<?= $value['id_grupomodulos'] ?>">
                                        <h2 class="mb-0">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('<?= $value['identificacion'] ?>')" type="button" data-toggle="collapse" data-target="#collapse<?= $value['id_grupomodulos'] ?>" aria-expanded="true" aria-controls="collapse<?= $value['id_grupomodulos'] ?>">
                                                    <?= $value['grupo'] ?>
                                                </button>
                                            </h2>
                                        </h2>
                                    </div>
                                    <div id="collapse<?= $value['id_grupomodulos'] ?>" class="collapse" aria-labelledby="heading<?= $value['id_grupomodulos'] ?>" data-parent="#accordionExample">
                                        <div class="card-header">
                                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="add('<?= $value['identificacion'] ?>','<?= $value['grupo'] ?>')"><i class="fa fa-plus"></i> Crear <?= $value['grupo'] ?></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="table_<?= $value['identificacion'] ?>" class="table table-bordered table-striped table-sm">
                                                <?php $campos = $this->auth->get_grupo_campos_by_id_grupomodulos($value['id_grupomodulos']); ?>
                                                <thead>
                                                    <tr>
                                                        <th width="10px">Nº</th>
                                                        <?php if (!empty($campos)){  
                                                            foreach ($campos as $keysi => $camp) { ?>  <th width="<?= $camp['width'] ?>px"><?= $camp['name'] ?></th>
                                                        <?php } } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nº</th>
                                                        <?php if (!empty($campos)){
                                                            foreach ($campos as $keysi => $campo) { ?> <th><?= $campo['name'] ?></th>
                                                        <?php } } ?>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
                <div class="modal-dialog"></div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery UI -->
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>

        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script>

            var urlx = "?c="+"<?=$ctrl?>"; 
            
            var table;

            function get_datatables(id) {
                var table = $('#table_' + id);
                if (!$.fn.DataTable.isDataTable('#table_' + id)) {
                    action_datatable(id);
                }
            }

            function action_datatable(id) {

                var table = $('#table_' + id);

                table.DataTable({
                    "language": {
                        "url": "assets/plugins/datatables/datatables-es-ES.json"
                    },
                    "autoWidth": false,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": urlx+"&a=list_table&id=" + id,
                        "type": "POST"
                    },
                    //Set column definition initialisation properties.
                    "columnDefs": [{
                        "targets": [0], //first column / numbering column
                        "orderable": false, //set not orderable
                        "className": "dt-center",
                        "targets": [2]
                    }],
                });
            }

            function add(tabla, grupo) {
                method_action = 'add_'+tabla;
                $.post(urlx + "&a=ajax_modal", {
                    type: 1,
                    table: tabla,  
                }).done(function(data) {
                    $('#modal-default .modal-content .modal-title').text('Crear '+grupo);
                    $('#modal-default .modal-dialog').html(data);
                    $('select').selectpicker();
                    $('#modal-default').modal('show');

                });
            }

            function edit(id, tabla) {
                method_action = 'edit_' + tabla;
                $.post(urlx + "&a=ajax_modal", {
                    type: 2,
                    table: tabla,
                    id: id,
                }).done(function(data) {
                    $('#modal-default .modal-dialog').html(data);
                    $('select').selectpicker();
                    $('#modal-default').modal('show');
                });
            }

            function external(id, tabla) {
                method_action = 'external_' + tabla;
                $.post(urlx + "&a=ajax_modal", {
                    type: 3,
                    table: tabla,
                    id: id,
                }).done(function(data) {
                    $('#modal-default .modal-dialog').html(data);
                    $('#modal-default').modal('show');
                });
            }

            function save(inf, accion = false) { //definida accion para formularios creados manualmente.

                $('.modal').css('z-index', 50);
                $('#btnsave').text('Guardando...'); //change button text
                $('#btnsave').attr('disabled', true); //set button disable 
                $('.selectpicker').selectpicker('setStyle', 'is-invalid','remove').selectpicker('setStyle', 'is-valid','remove');
                $('.form-control').removeClass('is-invalid is-valid'); // clear error class
                $('.help-block').empty(); // clear error string

                if(accion != false){  
                    var url  = urlx + accion;
                    var form = $('#form_'+inf).serialize();
                }else if (method_action == 'add_'+inf) {
                    var url  = urlx + "&a=ajax_add";
                    var form = $('#form_'+inf).serialize();
                } else if (method_action == 'edit_'+inf) {
                    var url  = urlx + "&a=ajax_edit";
                    var form = $('#form_'+inf).serialize();
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form,
                    dataType: 'json',
                    success: function(data) {
                        if(data.status == true) {
                            $('#modal-default').modal('hide');
                            $('#table_'+inf).DataTable().ajax.reload();
                        }else{
                            for (var i = 0; i < data.inputerror.length; i++) {
                                if (data.error_string[i] != '') {  
                                    $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                                    if($('.selectpicker').length > 0){  $('[name="' + data.inputerror[i] + '"]').selectpicker('setStyle', 'is-invalid');}
                                }else{  
                                    $('[name="' + data.inputerror[i] + '"]').addClass('is-valid');
                                    if($('.selectpicker').length > 0){  $('[name="' + data.inputerror[i] + '"]').selectpicker('setStyle', 'is-valid');}
                                } 
                                $('input[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                                $('textarea[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                                $('select[name="' + data.inputerror[i] + '"]').parent().next().text(data.error_string[i]);

                            }
                        }
                        $('#btnsave').text('Guardar!'); //change button text
                        $('#btnsave').attr('disabled', false); //set button enable   
                        $('.modal').css('z-index', 1050);       
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al enviar los datos');
                        $('#btnsave').text('Guardar!'); //change button text
                        $('#btnsave').attr('disabled', false); //set button enable          
                        $('.modal').css('z-index', 1050);
                    }
                });
            }

            function eliminar(id, tabla){
                if (confirm("Esta seguro de eliminar este canal de infomración")) {
                    $.ajax({
                        url: urlx + "&a=ajax_delete",
                        type: "POST",
                        data: { id: id, table:tabla},
                        dataType: 'JSON',
                        success: function(data) { if (data.status == true) { $('#table_'+tabla).DataTable().ajax.reload(); } },
                        error: function(jqXHR, textStatus, errorThrown) { alert('Error al enviar los datos'); }
                    });
                }
            }

            function get_query(table, id, campo, identificacion, selected, name = 'name', thisid = 'id'){             
                $.post("?c=recepcion&a=get_data", { id: id,  table: table,  campo: campo, identificacion: identificacion, selected: selected, name: name, thisid: thisid},
                function(data){  
                    $(identificacion).html(data);
                    setTimeout(() => {  $('.selectpicker').selectpicker('refresh') }, 80);
                });
            }

        </script>
</body>
</html>