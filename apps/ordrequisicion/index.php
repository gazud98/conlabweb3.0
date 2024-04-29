<?php
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}

$id_users = $_SESSION['id_users'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    // echo $sctrl1;
    $nmbapp = "Solicitud de Productos e Insumos";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta = "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  u116753122_cw3completa.ordrequisicion where 1=1";

    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];
    ;
    ?>
    <?php


    include ('apps/thedata.php'); //scriops de control
    ?>

    <div class="card border-info" style="width:85%;margin:auto;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">
                            <?php echo $moduraiz; ?>
                        </a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">
                            <?php echo $nmbapp; ?>
                        </a>
                    </nav>
                </div>
                <div class="col-md-4 text-center">
                    <h5 style="text-align: center; color: #0045A5;"><strong>Creacion de Solicitudes de Productos e Insumos</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12" id="data" style="overflow:hidden;  margin-bottom:5px; border-bottom:thin dotted #d3d3d3;
                                           height:auto;width:100%;">

                    <?php include ('data.php');  //campos de la app 
                        ?>

                </div>
            </div>
            <div class="row" style="overflow-x: hidden;">
                <div class="col-md-12 col-lg-12 mt-4" name="table" id="table" style="overflow-x: hidden;">
                    <!-- Contenido de la tabla -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="modalcant">
                        <!-- Contenido del modal -->
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;">
            <input type="input" id="idusers" value="<?php echo $id_users ?>"></input>
        </div>
        <div class="card-footer bg-light">
            <div class="container" style="width: 100%; text-align: center;">
                <table style="text-align: center !important; margin: 0 auto;">
                    <tr>
                        <td>
                            <div id="btnreq">
                                <?php include ("orden.php") ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            obtener();

        });

        function obtener() {
            iduser = obtenerIdusers()
            $("#table").load("<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>", {
                iduser: iduser
            });
            $("#data").load("<?php echo base_url . 'apps/' . $p . '/data.php'; ?>", {
                iduser: iduser
            });
            $("#depa").load("<?php echo base_url . 'apps/' . $p . '/responsable.php'; ?>", {
                iduser: iduser
            });

        }

        function obtenerIdusers() {
            iduser = $("#idusers").val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>',
                data: {
                    iduser: iduser
                },
                success: function (respuesta) {


                }
            });
            return iduser;
        }
    </script>
    <?php
}
?>