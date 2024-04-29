<?php
$user = $_SESSION['id_users'];
?>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />


</head>
<?php $username = $_SESSION['username']; ?>
<style>
  .nav-home {
    height: 100vh;
    padding: 10px;
    overflow: scroll;
  }

  .content-wrapper {
    background-image: url('https://cw3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
    background-size: cover;
    background-repeat: no-repeat;
  }

  .nav-home::-webkit-scrollbar {
    width: 1px;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: rgba(22, 64, 133, 0);
  }

  /* Ajustes para el scroll */
  .navbar-nav::-webkit-scrollbar {
    width: 5px;
  }

  .navbar-nav::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 4px;
  }

  .navbar-nav::-webkit-scrollbar-track {
    background-color: #f1f1f1;
  }

  .alert-task {
    position: fixed;
    -webkit-box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    -moz-box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    padding-bottom: 20px;
    border: 2px solid #44B40D;
    margin-top: -500px;
  }

  .alert-mant {
    position: fixed;
    -webkit-box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    -moz-box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    box-shadow: 10px 10px 23px -7px rgba(0, 0, 0, 0.26);
    padding-bottom: 20px;
    border: 2px solid #C4124D;
  }

  .content-alert {
    width: 300px;
    position: fixed;
    margin: auto;
    margin-top: -35%;
    margin-left: 80%;
    display: none;
    transition: all 300ms;
  }

  .content-alert .alert {
    -webkit-box-shadow: 10px 12px 22px -12px rgba(0, 0, 0, 0.49);
    -moz-box-shadow: 10px 12px 22px -12px rgba(0, 0, 0, 0.49);
    box-shadow: 10px 12px 22px -12px rgba(0, 0, 0, 0.49);
  }

  .btnfloat {
    padding: 5px;
    background-color: #F9F9F9;
    display: none;
  }

  #btnMenuSt {
    margin-left: 7px;
    background: rgb(74, 131, 224);
    color: #fff;
  }


  @media only screen and (max-width: 964px) {

    #btnMenuSt {
      margin-left: 0px;
    }

    .content-sidebar .navbar-nav {
      width: 0px;
      transition: all 300ms;
    }

    .content-sidebar .navbar-nav.slide {
      width: 265px;
      transition: all 300ms;
    }

    .btnfloat {
      display: block;
    }

    .navbar-nav .descrip-item {
      font-size: 15px;
      transition: all 300ms;
    }

    .navbar-nav .accordion-body {
      display: block;
      transition: all 300ms;
    }

    .navbar-nav .logo-lab {
      display: block;
      transition: all 300ms;
    }

    .navbar-nav .logo-lab-2 {
      display: none;
      transition: all 300ms;
    }

    .navbar-nav .item-prinp {
      display: block;
      transition: all 300ms;
    }

    .navbar-nav .name-item {
      display: block;
      float: left;
      transition: all 300ms;
    }

    .navbar-nav .text-user-icon {
      display: block;
      transition: all 300ms;
    }

    .navbar-nav .nav-item-select .nav-item {
      padding: 5px;
      transition: all 500ms;
    }

    .navbar-nav #iconangle {
      display: block;
    }

    .navbar-nav #iconitempadre {
      float: left;
    }
  }

  .content-wrapper {

    background-image: url('https://cw3.tierramontemariana.org/assets/image/backcw3-v1.png');
    background-size: cover;
    background-repeat: no-repeat;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed sidebar-mini layout-fixed sidebar-collapse text-sm" data-panel-auto-height-mode="height" style="overflow:hidden;">

  <div class="wrapper">

    <aside class="content-sidebar" style="
    font-family: 'Inter', sans-serif;
    ">
      <ul class="navbar-nav">

        <span style="padding: 5px;width:100%;text-align: right;" title="Cerrar menu">
          <a href="#" id="closeMenuSt" class="btn btn-danger btn-sm closeMenuSt" style="font-size: 15px;">
            <i class="fa-solid fa-xmark"></i>
          </a>
        </span>

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
          <div class="sidebar-brand-icon rotate-n-15">
          </div>
          <div class="sidebar-brand-text mx-3">
            <img class="logo-lab" src="assets/image/logopequenio-2.png" alt="">
            <img class="logo-lab-2" src="assets/image/logopequenioimg-2.png" alt="">
          </div>
        </a>

        <li class="item-user-connect">
          <a class="nav-link" href="index.php?c=auth&amp;a=logout">
            <img class="user-avatar" src="assets/image/user2-160x160.jpg" alt="">
            <span class="text-user-icon" style="font-size: 12px; color:#fff;">
              <?php echo $username ?>&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket" style="color: #fff;"></i>
            </span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active item-dashboard" style="text-align: center;">
          <a class="nav-link" href="?c=default&a=programabase&prg=dashboard">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #fff;"></i>
            <span style="color: #fff; font-size: 11px;">Dashboard</span></a>
        </li>
        <div class="slide-text">
          <ul class="nav nav-treeview nav-pills nav-sidebar flex-column nav-item-select" data-widget="treeview" role="menu" data-accordion="false">
            <?php include('apps/menu.php'); ?>
            <?php include('apps/validate.php'); ?>
          </ul>
        </div>
      </ul>

    </aside>

    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
      <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">

        <a title="Abrir menu" class="nav-link" href="#" id="btnMenuSt"><i class="fa-solid fa-bars"></i></a>

        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>

        <ul class="navbar-nav overflow-hidden" role="tablist">
          <?php $this->submenu_tab() ?>
        </ul>
        <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>

      </div>
      <div class="tab-content">
        <div class="tab-empty">
          <img src="assets/image/logopasteur.png" alt="" height="100" width="500">

          <?php

          $cadena = "SELECT t.id_tarea, CONCAT(p.nombre_1, ' ', p.apellido_1) as nombre, u.username 
          FROM tareas t, persona p, users u WHERE t.responsable = p.id_persona AND t.usuario = u.id_users 
          AND t.estado in(2) AND fecha_inicio < CURRENT_DATE() AND t.usuario = '$user'";

          $resultadP2 = $conetar->query($cadena);

          $row = mysqli_num_rows($resultadP2);

          if ($row != 0) {
          ?>

            <div class="alert alert-light alert-dismissible fade show alert-task animate__animated  animate__backInDown col-md-8" role="alert">

              <label for="">Tareas Pendientes <span class="badge badge-success" id="rows_user"></span></label>

              <div class="content-table" style="width: 100%;">

                <table class="table-task table-bordered" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Descripción</th>
                      <th>Fecha de vencimiento</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>

              </div>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>

          <?php } ?>

          <div class="content-alert">
            <div class="alert alert-success animate__animated animate__heartBeat" role="alert">
              Recibiste un correo electrónico con el asunto: <strong>Tareas pendientes</strong>
            </div>
          </div>

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
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

  <script>
    function ejecutarTareat() {
      $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/comprobar.php',
        success: function(rows) {
          // Manejar la respuesta exitosa
          console.log('Consulta exitosa', rows);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Manejar el error
          console.error('Error en la consulta AJAX:', textStatus, errorThrown);

        }
      });

    }

    function programarTareat(hora, minutos) {
      const ahora = new Date();
      const tiempoHastaProximaEjecucion = new Date(
        ahora.getFullYear(),
        ahora.getMonth(),
        ahora.getDate(),
        hora,
        minutos,
        0,
        0
      ) - ahora;

      const tiempoEspera = tiempoHastaProximaEjecucion > 0 ?
        tiempoHastaProximaEjecucion :
        24 * 60 * 60 * 1000 - ahora.getTime();

      setTimeout(function() {
        ejecutarTareat();

        setInterval(ejecutarTareat, 24 * 60 * 60 * 1000);
      }, tiempoEspera);
    }

    function getRowsCommentsUser() {

      $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/mostrar-2.php?aux=5&user=<?php echo $user; ?>',
        success: function(res) {
          $('#rows_user').html(res);
        }
      });

    }

    function sendEmailDay() {

      $.ajax({
        url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/send-mail.php?user=' + <?php echo $user; ?>,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          console.log('Verify: ' + res);
        }
      });

    }

    function ejecutarTarea() {
      sendEmailDay();
      $('.content-alert').css('display', 'block');

      setTimeout(function() {
        $('.content-alert').css('display', 'none');
      }, 2000);

    }

    function programarTarea(hora, minutos) {
      const ahora = new Date();
      const tiempoHastaProximaEjecucion = new Date(
        ahora.getFullYear(),
        ahora.getMonth(),
        ahora.getDate(),
        hora,
        minutos,
        0,
        0
      ) - ahora;


      const tiempoEspera = tiempoHastaProximaEjecucion > 0 ?
        tiempoHastaProximaEjecucion :
        24 * 60 * 60 * 1000 - ahora.getTime();

      setTimeout(function() {

        ejecutarTarea();

        setInterval(ejecutarTarea, 24 * 60 * 60 * 1000);
      }, tiempoEspera);
    }

    $(document).ready(function() {

      programarTarea(14, 50);

      programarTareat(23, 59);

      getRowsCommentsUser()

      dataTableTask = $('.table-task').DataTable({

        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
        },
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "responsive": true,
        "ajax": {
          url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/mostrar-tareas-user.php?user=<?php echo $user; ?>',
          type: 'GET',
          dataType: 'json',
          dataSrc: ''
        },
        "columns": [{
            "data": "tarea"
          },
          {
            "data": "fecha_fin"
          },
          {
            "data": "estado",
            "render": function(data, type, full, meta) {

              // Crear un objeto de fecha
              var fecha = new Date();

              // Obtener los componentes de la fecha
              var dia = fecha.getDate();
              var mes = fecha.getMonth() + 1; // Sumar 1 porque los meses comienzan desde 0
              var anio = fecha.getFullYear();

              // Formatear la fecha como "dd/mm/yyyy"
              var fechaFormateada = anio + '-' + (mes < 10 ? '0' : '') + mes + '-' + (dia < 10 ? '0' : '') + dia;

              //alert(fechaFormateada);

              if (full.estado === '2') {
                return '<span class="badge badge-success" style="font-size:12px;">Pendiente</span>';
              } else if (full.fecha_fin < fechaFormateada && full.estado === '2') {
                return '<span class="badge badge-danger" style="font-size:12px;">Vencida</span>';
              } else if (full.estado === '3') {
                return '<span class="badge badge-dark" style="font-size:12px;">Cerrada</span>';
              }

            }

          },
        ]
      });

      $('.btn-menu').click(function() {
        $('.content-sidebar .navbar-nav').toggleClass('active');
      })

    })

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

    $(document).ready(function() {

      programarTareat(23, 59);

    })

    function ejecutarTareat() {
      $.ajax({
        type: 'POST',
        url: 'https://cw3.tierramontemariana.org/apps/consultamantenimiento/comprobar.php',
        success: function(rows) {
          // Manejar la respuesta exitosa
          console.log('Consulta exitosa', rows);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Manejar el error
          console.error('Error en la consulta AJAX:', textStatus, errorThrown);

        }
      });

    }

    function programarTareat(hora, minutos) {
      const ahora = new Date();
      const tiempoHastaProximaEjecucion = new Date(
        ahora.getFullYear(),
        ahora.getMonth(),
        ahora.getDate(),
        hora,
        minutos,
        0,
        0
      ) - ahora;

      const tiempoEspera = tiempoHastaProximaEjecucion > 0 ?
        tiempoHastaProximaEjecucion :
        24 * 60 * 60 * 1000 - ahora.getTime();

      setTimeout(function() {
        ejecutarTareat();

        setInterval(ejecutarTareat, 24 * 60 * 60 * 1000);
      }, tiempoEspera);
    }

    $(document).ready(function() {
      $('#btnMenuSt').click(function() {
        $('.navbar-nav').toggleClass('slide');
        $('.descrip-item').toggleClass('slide');
        $('.accordion-body').toggleClass('slide');
        $('.logo-lab').toggleClass('slide');
        $('.logo-lab-2').toggleClass('slide');
        $('.item-prinp').toggleClass('slide');
        $('.name-item').toggleClass('slide');
        $('.text-user-icon').toggleClass('slide');
        $('.nav-item').toggleClass('slide');
        $('#iconangle').toggleClass('slide');
        $('#iconitempadre').toggleClass('slide');
        $('.closeMenuSt').toggleClass('slide');
        $('.content-sidebar .navbar-nav.active').toggleClass('active');
      })
      $('#closeMenuSt').click(function() {
        closeMenu();
      })
    })

    function openMenu() {
      $('.navbar-nav').addClass('slide');
      $('.descrip-item').addClass('slide');
      $('.accordion-body').addClass('slide');
      $('.logo-lab').addClass('slide');
      $('.logo-lab-2').addClass('slide');
      $('.item-prinp').addClass('slide');
      $('.name-item').addClass('slide');
      $('.text-user-icon').addClass('slide');
      $('.nav-item').addClass('slide');
      $('#iconangle').addClass('slide');
      $('#iconitempadre').addClass('slide');
      $('.closeMenuSt').addClass('slide');
    }

    function closeMenu() {
      $('.navbar-nav').removeClass('slide');
      $('.descrip-item').removeClass('slide');
      $('.accordion-body').removeClass('slide');
      $('.logo-lab').removeClass('slide');
      $('.logo-lab-2').removeClass('slide');
      $('.item-prinp').removeClass('slide');
      $('.name-item').removeClass('slide');
      $('.text-user-icon').removeClass('slide');
      $('.nav-item').removeClass('slide');
      $('#iconangle').removeClass('slide');
      $('#iconitempadre').removeClass('slide');
      $('.closeMenuSt').removeClass('slide');
    }
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