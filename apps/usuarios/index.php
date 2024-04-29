<?php
//Si bahy consulta

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

    include('reglasdenavegacion.php');

    // echo $sctrl1;
    $nmbapp = "USUARIOS";
    $moduraiz = $_SESSION['moduraiz'];
    $ruta =  "<a href='#'>Home</a> / " . $moduraiz;
    $uppercaseruta = strtoupper($ruta);
    //echo ".................".$sctrl4."-----------";
    $cadena = "SELECT count(*) as cantidad
                    FROM  persona P,
                        persona_users PE" .
        $filterfrom .
        " where  P.id_persona=PE.id_persona";
    $cadena = $cadena . $filterwhere;
    //              echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $filaP2 = mysqli_fetch_array($resultadP2);
    $cantrgt = $filaP2['cantidad'];;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/usuarios/assets/style.css">
    </head>

    <body>
        <div class="card border-info" style="width:85%;margin:auto;">
            <div class="card-header bg-light ">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;"><?php echo $nmbapp; ?></a>
                        </nav>
                    </div>
                    <div class="col-md-4">
                        <h5 style="text-align: center; color: #0045A5;"><strong>CREACIÓN DE <?php echo $nmbapp; ?></strong></h5>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <button style="float: right;" type="button" onclick="loadFormUsers()" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAddUsers">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nuevo
                        </button>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div id="thetable">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Users -->
        <div class="modal fade" id="modalAddUsers" tabindex="-1" aria-labelledby="modalAddUsersLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddUsersLabel">Crear Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="conetentFormUsers">

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Users -->
        <div class="modal fade" id="modalEditUsers" tabindex="-1" aria-labelledby="modalEditUsersLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modalContent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditUsersLabel">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="conetentFormEditUsers">

                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

        <script>
            function habilitacmpos() {
                $("#iddatas").css("pointer-events", "auto");
                $("#iddatas").css("background-color", "white");

            }

            function inhabilitacmpos() {
                $("#iddatas").css("pointer-events", "none");
                $("#iddatas").css("background-color", "#ededed");

                $("#accionejec").css("display", "none");
                $("#accionejec").html("");
            }

            function loadFormUsers() {
                $('#conetentFormUsers').load('https://conlabweb3.tierramontemariana.org/apps/usuarios/datacase1.php');
            }

            function loadFormEditUsers(id, id_rol) {

                $('#conetentFormEditUsers').load('https://conlabweb3.tierramontemariana.org/apps/usuarios/modal-editar.php', {
                    id: id,
                }, function(){
                    $("#modulos").load('https://conlabweb3.tierramontemariana.org/apps/usuarios/opciones.php', {
                        id: id_rol
                    })
                });
            }


            $(document).ready(function() {


                $('#thetable').load('https://conlabweb3.tierramontemariana.org/apps/usuarios/thedatatable.php');



            })

            function accionesespecificas(caso) {
                $("#ctrlpwd").css("display", "none");

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
                    $("#ctrlpwd").css("display", "block");
                } //Editar
                if (caso == "D") {
                    $("#divproveedoresproducto").css("display", "block");
                } //Es de habolita / inhablitar
            } //funcikjnes que hacen casos epeciales en
        </script>
    </body>

    </html>

<?php
}
?>