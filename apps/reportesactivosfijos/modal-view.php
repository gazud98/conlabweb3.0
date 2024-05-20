<?php

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    if ($id == "-1") {
        $id = "";
    }
} else {
    $id = "";
} ?>
<style>
   
</style>

<table class="info-table">
    <tbody>
        <tr>
            <td><strong>Modelo:</strong></td>
            <td id="modelo"></td>
        </tr>
        <tr>
            <td><strong>Serie:</strong></td>
            <td id="serie"></td>
        </tr>
        <tr>
            <td><strong>Sede:</strong></td>
            <td id="sede"></td>
        </tr>
        <tr>
            <td><strong>Departamento:</strong></td>
            <td id="departamento"></td>
        </tr>
        <tr>
            <td><strong>Tipo de Activo Fijo:</strong></td>
            <td id="tipo_activo"></td>
        </tr>
        <tr>
            <td><strong>Fecha de Instalación:</strong></td>
            <td id="fchinstalacion"></td>
        </tr>
        <tr>
            <td><strong>Valor:</strong></td>
            <td id="valor"></td>
        </tr>
        <tr>
            <td><strong>Seguro:</strong></td>
            <td id="seguro"></td>
        </tr>
        <tr>
            <td><strong>Valor Asegurado:</strong></td>
            <td id="valor_asegurado"></td>
        </tr>
        <tr>
            <td><strong>Garantía:</strong></td>
            <td id="garantia"></td>
        </tr>
        <tr>
            <td><strong>Fecha Expiración Garantía:</strong></td>
            <td id="fchexpgarantia"></td>
        </tr>
        <tr>
            <td><strong>Vida Útil (años):</strong></td>
            <td id="vidautilmes"></td>
        </tr>
        <tr>
            <td><strong>Necesita Mantenimiento:</strong></td>
            <td id="op_mantenimiento"></td>
        </tr>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://conlabweb3.tierramontemariana.org/apps/reportesactivosfijos/process_data.php',
            type: 'GET',
            dataType: 'json',
            data: {
                id: <?php echo $id; ?>
            },
            success: function(response) {
                if (response.length > 0) {
                    let data = response[0];
                    $('#modelo').text(data.modelo);
                    $('#serie').text(data.serie);
                    $('#sede').text(data.sede);
                    $('#departamento').text(data.departamento);
                    $('#tipo_activo').text(data.tipo_activo);
                    $('#fchinstalacion').text(data.fchinstalacion);
                    $('#valor').text(data.valor);
                    $('#seguro').text(data.seguro);
                    $('#valor_asegurado').text(data.valor_asegurado);
                    $('#garantia').text(data.garantia);
                    $('#fchexpgarantia').text(data.fchexpgarantia);
                    $('#vidautilmes').text(data.vidautilmes);
                    $('#op_mantenimiento').text(data.op_mantenimiento);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la petición AJAX: " + error);
            }
        });
    });
</script>