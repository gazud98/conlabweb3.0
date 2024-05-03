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

    $id = 0;

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .accordion-wrapper {
        display: block;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
        max-width: 100%;
        margin: 0 auto;
        margin-top: 12px;
        margin-bottom: 12px;
        border-radius: 5px;
    }

    .accordion+.title {
        user-select: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px;
    }

    .accordion~.title strong {
        line-height: 24px;
    }

    .accordion~.title .side-icon {
        display: block;
    }

    .accordion:checked~.title .side-icon {
        display: none;
    }

    .accordion~.title .down-icon {
        display: none;
    }

    .accordion:checked~.title .down-icon {
        display: block;
    }

    .accordion~.content {
        display: none;
        padding: 8px;
        cursor: pointer;
    }

    .accordion:checked~.content {
        display: block;
        text-align: left;
    }

    p {
        line-height: 100%;
    }
</style>

<?php

if ($id != 0) {
    $query = "SELECT n.id, n.fechainicio, n.fechafinal, n.comentario, n.estado, CONCAT('<strong>Médico - </strong> ',m.nombres,' ',m.apellidos) 
    AS medico FROM negociaciones n INNER JOIN medicos m ON n.medico = m.id_medicos WHERE n.id = '$id' UNION SELECT n.id, n.fechainicio, n.fechafinal, n.comentario, 
        n.estado, CONCAT('<strong>Empresa - </strong> ', e.nombre_comercial) AS empresa FROM negociaciones n INNER JOIN empresas e 
        ON n.empresa = e.id_empresas WHERE n.id = '$id'";

    $rest = mysqli_query($conetar, $query);

    $row = mysqli_num_rows($rest);

    if ($row != 0) {
?>

        <div class="animate__animated animate__fadeInRight">
            <div class="mt-2 text-left" style="width: 100%;">
            </div>

            <div class="text-left mt-2" style="width: 100%;background:#FAF6EA;padding:5px;border-radius:5px;font-weight: 800;margin:auto;">
                Citas/Llamadas/Correos electrónicos</h5>
            </div>

            <?php

            while ($data = mysqli_fetch_array($rest)) {

            ?>
                <div class="text-left mt-3" style="width: 100%;background:#F6EDF9;padding:5px;border-radius:5px;font-weight: 800;">
                    Trazabilidad &nbsp; <i class="fa-solid fa-arrow-down"></i></h5> &nbsp;
                    <?php
                    $disabled = "";
                    if ($data['estado'] == 2) {
                        $disabled = "disabled";
                    }
                    ?>
                    <button class="btn btn-primary btn-sm" onclick="negFinalized(<?= $id ?>)" <?= $disabled ?>>
                        <i class="fa-solid fa-check"></i> &nbsp; Marcar estado como negociación Finalizada
                    </button>
                </div>

                <?php

                if ($data['estado'] == 1) {
                    echo '<nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-1" style="background:#F6EDF9;">
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">Cita Programada</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #00A020">En Proceso</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">Finalizada</a></strong></li>
                            </ol>
                        </nav>';
                } else if ($data['estado'] == 2) {
                    echo '<nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-1" style="background:#F6EDF9;">
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">Cita Programada</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">En Proceso</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #00A020">Finalizada</a></strong></li>
                            </ol>
                        </nav>';
                } else {
                    echo '<nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-1" style="background:#F6EDF9;">
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #00A020">Cita Programada</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">En Proceso</a></strong></li>
                                <li class="breadcrumb-item"><strong><a href="#" style="color: #9CA89A">Finalizada</a></strong></li>
                            </ol>
                        </nav>';
                }

                ?>

                <label class="accordion-wrapper">
                    <input type="checkbox" class="accordion" hidden />
                    <div class="title">
                        <strong><i class="fa-solid fa-calendar-check" style="color:#6C22C8;"></i> <?= $data['fechainicio'] ?> &nbsp;&nbsp; <i class="fa-solid fa-circle" style="font-size: 10px;color:#00A020;"></i>&nbsp;&nbsp; Cita con: <?= $data['medico'] ?></strong>
                        <svg viewBox="0 0 256 512" width="12" title="angle-right" class="side-icon" fill="black">
                            <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" />
                        </svg>
                        <svg viewBox="0 0 320 512" height="24" title="angle-down" class="down-icon" fill="black">
                            <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z" />
                        </svg>
                    </div>
                    <div class="content">
                        <?php

                        $sql = "SELECT n.id, n.fechainicio, n.estado, 
                    CONCAT('<strong>Médico - </strong> ',m.nombres,' ',m.apellidos) 
                    AS medico, c.fecha, c.hora, CONCAT(p.nombre_1,' ',p.apellido_1) 
                    AS vendedor, m.direccion, p.id_persona, c.id AS cita_id FROM negociaciones n INNER JOIN medicos m ON n.medico = m.id_medicos 
                    INNER JOIN citas c ON n.cita = c.id INNER JOIN persona p ON c.vendedor = p.id_persona WHERE n.id = '$id'
                    UNION SELECT n.id, n.fechainicio, n.estado,
                    CONCAT('<strong>Empresa - </strong> ', e.nombre_comercial) AS empresa, c.fecha, c.hora, 
                    CONCAT(p.nombre_1,' ',p.apellido_1) AS vendedor, e.direccion, p.id_persona, c.id AS cita_id FROM negociaciones n INNER JOIN empresas e 
                    ON n.empresa = e.id_empresas INNER JOIN citas c ON n.cita = c.id INNER JOIN persona p 
                    ON c.vendedor = p.id_persona WHERE n.id = '$id'";

                        $rest = mysqli_query($conetar, $sql);

                        while ($data = mysqli_fetch_array($rest)) {

                        ?>

                            <p><?= 'Hora: ' . $data['hora'] ?></p>
                            <p><?= 'Dirección: ' . $data['direccion'] ?></p>
                            <p><?= 'Ejecutiva (o) comercial: ' . $data['vendedor'] ?></p>
                            <input type="hidden" id="ejecom" value="<?= $data['vendedor'] ?>">
                            <input type="hidden" id="ejecomId" value="<?= $data['id_persona'] ?>">
                            <input type="hidden" id="citaId" value="<?= $data['cita_id'] ?>">

                        <?php
                        }
                        ?>
                        <button type="button" class="btn btn-success btn-sm" <?= $disabled ?> onclick="getComments(<?= $id ?>)" data-toggle="modal" data-target="#exampleNotas"><i class="fa-solid fa-house"></i> &nbsp; Registrar visita</button>

                        <!--<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"></i> &nbsp; Editar cita</button>
                    </div>-->
                    </div>
                </label>
        </div>

<?php
            }
        }
    } else {
        echo '<h5 style="color: #008E16;font-size:15px;" id="titleInfo">No ha seleccinado ninguna negociación. </h5>';
    }
?>

<script>
    function getInfoPeople() {
        $('#idpersona').val($('#ejecomId').val());
        $('#eje_comercial').val($('#ejecom').val());
        $('#idcita').val($('#citaId').val());
    }
</script>