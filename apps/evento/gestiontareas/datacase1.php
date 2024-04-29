<style>
    input[type='date'] {
        padding: 0 !important;
        margin: 0 !important;
        font-size: 12px !important;
        height: 28px !important;
        /* Otros estilos personalizados */
        text-align: left !important;
    }
</style>
<form name="" id="" action="" method="POST" enctype="multipart/form-data" style="width:100%">


    <div class="row">

        <div class="col-md-2">
            <label style="font-size: 12px;">Tipo Identificacion:</label>
            <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion">
                <option selected="true" disabled="disabled"></option>

            </select>

        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">N° Documento:</label>
            <input type="input" class="form-control" name="documento" id="documento" value=""></input>

        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Nombres:</label>
            <input type="input" class="form-control" name="nombres" id="nombres" value=""></input>

        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Apellidos:</label>
            <input type="input" class="form-control" name="apellidos" id="apellidos" value=""></input>

        </div>
        <div class="col-md-2">
            <label style="height: 18px !important;">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"></input>

        </div>
        <div class="col-md-1">
            <label style="font-size: 12px;">Edad:</label>
            <input type="input" class="form-control" name="numvia" id="numvia" value=""></input>

        </div>
        <div class="col-md-1">
            <label style="font-size: 12px;">Sexo:</label>
            <select class="form-control" name="id_tipo_genero" id="id_tipo_genero">
                <option>Masculino</option>
            </select>

        </div>
    </div>

    <div class="row mt-2">



        <div class="col-md-2">
            <label style="font-size: 12px;">Departamento:</label>
            <select class="form-control" name="dep" id="dep"></select>

        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Ciudad:</label>
            <select class="form-control" name="ciudad" id="ciudad"></select>

        </div>

        <div class="col-md-1">
            <label style="font-size: 12px;">Tipo de vía:</label>
            <select class="form-control" name="tp_via" id="tp_via"></select>

        </div>

        <div class="col-md-1">
            <label style="font-size: 12px;">N° Vía:</label>
            <input type="input" class="form-control" name="numvia" id="numvia" value=""></input>

        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Numero de Vivienda:</label>
            <input type="input" class="form-control" name="direccion" id="direccion" value=""></input>
        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Telefono:</label>
            <input type="input" class="form-control" name="telefono" id="telefono" value=""></input>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Movil:</label>
            <input type="input" class="form-control" name="movil" id="movil" value=""></input>
        </div>

    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <label style="font-size: 12px;">Email:</label>
            <input type="input" class="form-control" name="email" id="email" value=""></input>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_tipo_identificacion').select2({
            language: "es"
        });
        $('#id_tipo_genero').select2({
            language: "es"
        });
        $('#dep').select2({
            language: "es"
        });
        $('#ciudad').select2({
            language: "es"
        });
        $('#tp_via').select2({
            language: "es"
        });
    });
</script>