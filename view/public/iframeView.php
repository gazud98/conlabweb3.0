<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Conlab Web V3.0</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="./assets/dist/css/style.css">
  <link rel="stylesheet" href="./assets/dist/css/tables-v1.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">


</head>
<?php $username = $_SESSION['username']; ?>
<style>
  .nav-home {
    height: 100vh;
    padding: 10px;
    overflow: scroll;
  }

  .nav-home::-webkit-scrollbar {
    width: 1px;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: black;
    background-color: white;
  }

  .content-sidebar {
    overflow: auto; /* Agrega el estilo overflow al menú */
    max-height: 100vh; /* Ajusta la altura máxima del menú según sea necesario */
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed sidebar-mini layout-fixed sidebar-collapse text-sm" data-panel-auto-height-mode="height" style="overflow:hidden;">

  <div class="wrapper">

    <aside class="content-sidebar" style="
    font-family: 'Inter', sans-serif;
    ">
      <ul class="navbar-nav">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
          <div class="sidebar-brand-icon rotate-n-15">
          </div>
          <div class="sidebar-brand-text mx-3">
            <img class="logo-lab" src="assets/image/logopequenio.png" alt="">
            <img class="logo-lab-2" src="assets/image/logopequenioimg.png" alt="">
          </div>
        </a>

        <li class="item-user-connect">
          <a class="nav-link" href="index.php?c=auth&amp;a=logout">
            <img class="user-avatar" src="assets/image/user2-160x160.jpg" alt="">
            <span class="text-user-icon" style="font-size: 12px; color:#020934;"><?php echo $username ?>&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket" style="color: #C4124D;"></i></span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active item-dashboard" style="text-align: center;">
          <a class="nav-link" href="?c=default&a=programabase&prg=dashboard">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #C66666;"></i>
            <span style="color: #C66666; font-size: 11px;">Dashboard</span></a>
        </li>

        <ul class="nav nav-treeview nav-pills nav-sidebar flex-column nav-item-select" data-widget="treeview" role="menu" data-accordion="false">
          <?php include('apps/menu.php'); ?>
          <?php include('apps/validate.php'); ?>
        </ul>

      </ul>

    </aside>
    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
      <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">

        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>

        <ul class="navbar-nav overflow-hidden" role="tablist">
          <?php $this->submenu_tab() ?>
        </ul>
        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>

      </div>
      <div class="tab-content border_degradado_content">
        <div class="tab-empty">
          <img src="assets/image/logopasteur.png" alt="" height="100" width="500" >
        </div>
        <div class="tab-loading">
          <div>
            <h2 class="display-4">Cargando pestaña <i class="fa-solid fa-spinner fa-spin"></i></h2>
          </div>
        </div>
      </div>
    </div>


  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light" style="top: 56.9886px; display: block;">
    <!-- Control sidebar content goes here -->
    <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-host-overflow os-host-overflow-y" style="height: 511.011px;">
      <ul class="navbar-nav">
        <div class="menu_navigation_right">
          <?php $this->menu_total_right() ?>
        </div>
      </ul>
    </div>
  </aside>

  <!-- jQuery -->
  <script src="./assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <script>
    $.widget.bridge('uibutton', $.ui.button);

    $(".nav-dash-home").on('click', function(event) {
      $.post("?c=app&a=_home").done(function(data) {
        location.reload();
      });
    });

    $(".nav-dash-act").on('click', function(event) {
      var id = $(this).attr('data-id');
      var name = $(this).attr('data-name');
      var url = $(this).attr('data-href');
      var icono = $(this).attr('data-icono');
      var estado = $(this).attr('data-estado');
      $.post("?c=app&a=_subnavigation", {
        id: id,
        name: name,
        url: url,
        icono: icono,
        estado: estado
      }).done(function(data) {
        location.reload();
      });
    });

    $(".nav-dash").on('click', function(event) {
      var id = $(this).attr('data-id');
      var name = $(this).attr('data-name');
      var url = $(this).attr('data-href');
      var icono = $(this).attr('data-icono');
      var estado = $(this).attr('data-estado');
      $.post("?c=app&a=_navigation", {
        id: id,
        name: name,
        url: url,
        icono: icono,
        estado: estado
      }).done(function(data) {
        location.reload();
      });
    });

    $("#mdynamic").on('click', function(event) {
      if ($("input:checked[id='mdynamic']").length == 1) {
        $.post("?c=app&a=generical_navigation").done(function(data) {
          location.reload();
        });
      } else {
        if (confirm('Desea cambiar la forma de navegación ! Su navegación actual se perderá')) {
          $.post("?c=app&a=clear_navigation").done(function(data) {
            location.reload();
          });
        }
      }
    });

    $(".nav-menu").on('click', function(event) {
      alert('esto es una menù');
    });
    $(".nav-submenu").on('click', function(event) {
      alert('esto es una Submenú');
    });
    $(".nav-tabsubmenu").on('click', function(event) {
      alert('esto es una tab de un submenú');
    });

    function refresh_iframe(url) {
      $("iframe[src$='" + url + "']").attr("src", url);
    }

    $(document).ready(function() {

      $('.nav-home').load('./apps/dashboard/');

      var href = $()



      $('.table-roporte-insumos').DataTable({
        scrollY: '200px',
        scrollCollapse: false,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
        },
      })

    });
  </script>
  <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./assets/dist/js/demo.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>


</body>

</html>