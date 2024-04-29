<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>Examen</label>
        <select class="form-control" id="id_examen">
            <option>Trigliceridos</option>
        </select>
    </div>
    <div class="col-md-2 col-lg-2">
        <label>Cantidad Item</label>
        <input type="input" class="form-control">
    </div>
    <div class="col-md-3 col-lg-3">
        <label>Tipo muestra variable</label>
        <select class="form-control" id="tip_muestra">
            <option>Seleccione</option>
        </select>
    </div>
    <div class="col-md-3 col-lg-3">
        <label>Examen Estimulo</label>
        <select class="form-control" id="estimulo">
            <option>Seleccione</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-lg-3">
        <label>Prioridad</label>
        <select class="form-control" id="prioridad">
            <option>Rutina</option>
            <option>Urgente</option>
            <option>Asap</option>
        </select>
    </div>
    <div class="col-md-7 col-lg-7">
        <label>Observaciones</label>
        <input type="input" class="form-control">
    </div>
    <div class="col-md-2 col-lg-2 mt-4">

        <input type="button" class="btn btn-info" id="btnagregar" value="Agregar">
    </div>
</div>
<hr class="dotted">
<div class="row mb-3">
    <div class="col-md-6 col-lg-6 mt-4">
        <div>
            <label id="lblttl">Total Examenes:&nbsp;<span class="badge badge-pill badge-danger" id="ttlspan">1</span></label>&nbsp;&nbsp;&nbsp;<label id="lblttl">Valor Total Examen<span id="ttlvlr">&nbsp;$20,000</span></label>
        </div>
    </div>
    <div class="col-md-6 col-lg-6" style="text-align:center;">
        <div class="container " id="divstatus" style="border: 1px dotted; width:20%;padding:1px;">
            <label>Estado del Paciente:</label>
            <span class="badge badge-success">Admitido</span>
        </div>
    </div>
</div>


<table class="table table-striped table-hover table-head-fixed text-nowrap table-sm" style="margin-top: 2px;">
    <thead>
        <tr>
            <th style="text-align:center;">Cod. Cups</th>
            <th style="text-align:left;">Examen</th>
            <th style="text-align:left;">Estado</th>
            <th style="text-align:center;">Clasificación Examen</th>
            <th>Valor</th>
            <th style="text-align:center;">Prioridad</th>
            <th>Observaciones</th>
            <th style="text-align:center;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr style="background-color:white;">
            <td style="text-align:right;">90.2.2.10</td>
            <td style="text-align:left;">HEMOGRAMA</td>
            <td style="text-align:left;"><span class="badge badge-pill badge-info" style="font-size:10px">Rutina</span>/td>
            <td style="text-align:center;">Rutina</td>
            <td style="text-align:right;">$20,000</td>
            <td style="text-align:center;"><span class="badge badge-pill badge-info" style="font-size:10px">Rutina</span></td>
            <td></td>
            <td style="text-align:center;"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;<i class="fa-solid fa-trash-can"></i></td>
        </tr>
    </tbody>
</table>
<div class="row mt-3">
    <div class="col-md-1 col-lg-1 mt-4">
        <input type="button" class="btn btn-info" id="btndocumentos" value="Documentos">
    </div>
    <div class="col-md-6 col-lg-6">
        <label>Documento Pendiente por Entregar</label>
        <input type="input" class="form-control">
    </div>
    <div class="col-md-4 col-lg-4" style="text-align:center;">
        <label>Enviar Resultados email</label><br>
        <div class="custom-control custom-checkbox" style="display: inline-block; margin-right: 20px;">
            <input type="checkbox">
            <label>Medico</label>
        </div>
        <div class="custom-control custom-checkbox" style="display: inline-block;">
            <input type="checkbox">
            <label>Paciente</label>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_examen').select2({
            language: "es"
        });
        $('#tip_muestra').select2({
            language: "es"
        });
        $('#estimulo').select2({
            language: "es"
        });
        $('#prioridad').select2({
            language: "es"
        });

    });
</script>