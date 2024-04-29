<?php
/* <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Default</title>
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
            <!-- fullCalendar -->
            <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
            <!-- dataTables -->
            <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
              <!-- select search responsive-->
            <link rel="stylesheet" href="assets/plugins/bootstrap-select/bootstrap-select.min.css">
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
                                    <h1>DEFAULT</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Default</li>
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <section class="content-body">
                    </seccion>  
                    <!-- /.content -->
                    <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog"><div class="modal-dialog"></div></div>
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
        <!-- fullCalendar 2.2.5 -->
        <script src="assets/plugins/moment/moment.min.js"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="assets/plugins/fullcalendar/main.js"></script>
        <!-- fullCalendar lang  -->
        <script src='assets/plugins/fullcalendar/locales/es.js'></script>
        <!-- combox datatable -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- combox datatable -->
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- combox datatable -->
        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <!-- bootstrap-select -->
        <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <script>   
            let urlx = '?c=default'; 
            function refresh_iframe(urlx){ parent.refresh_iframe(urlx); }
        </script>
    </body>
</html>
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Default</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- dataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- select search responsive-->
    <link rel="stylesheet" href="assets/plugins/bootstrap-select/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-body p-3">
                <?php
                $p = $_REQUEST['prg'];
                $nocreatebittomP = "N";
                include("apps/" . $p . "/index.php");
                ?>
                </seccion>
                <!-- /.content -->
                <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
                    <div class="modal-dialog"></div>
                </div>
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
    <!-- fullCalendar 2.2.5 -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="assets/plugins/fullcalendar/main.js"></script>
    <!-- fullCalendar lang  -->
    <script src='assets/plugins/fullcalendar/locales/es.js'></script>
    <!-- combox datatable -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- combox datatable -->
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- combox datatable -->
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <!-- bootstrap-select -->
    <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script>
        let urlx = '?c=default';

        function refresh_iframe(urlx) {
            parent.refresh_iframe(urlx);
        }


        $document.ready(function() {
            $("input").keyup(function() {
                alert("ddd");
                /*
                                        var miString = $("input").val();

                                       miString.replace(/\w\S* /g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase()))); 
                                       */
            })
        });
    </script>
</body>

</html>