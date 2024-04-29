<select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" required>
    <option selected="true" disabled="disabled"></option>
    <?php

    $sql = "SELECT id, nombre, abreviatura FROM tipo_identificacion";

    $rest = mysqli_query($conetar, $sql);

    while ($data = mysqli_fetch_array($rest)) {

    ?>

        <option value="<?php echo $data['id']; ?>"><?php echo $data['abreviatura'] . ' - ' . $data['nombre']; ?></option>

    <?php
    }
    ?>
</select>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        /*$('#id_tipo_identificacion').select2({
            language: "es"
        });*/
    })
</script>