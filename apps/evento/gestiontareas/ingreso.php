
<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>Procedencia<span style="color: red;">*</span></label>
        <select class="form-control" id="procedencia" style="      border-radius: 5px;
        border-color:gray;">
            <option>Alameda del Rio</option>
            <option>Autolab Elite</option>
            <option>Centro Medico Allianz Barranquilla</option>
            <option>Elite</option>
            <option>Villa Campestre</option>
            <option>Villa Carolina</option>
        </select>
    </div>
    <div class="col-md-4 col-lg-4">
        <label>Medico<span style="color: red;">*</span></label>
        <select class="form-control" id="medicoSelect">
            <option>Pasteur Laboratorios Clinicos</option>
            <option>Patricia Osorio Pupo</option>
        </select>
    </div>
    <div class="col-md-4 col-lg-4">
        <label>Diagnostico<span style="color: red;">*</span></label>
        <select class="form-control" id="diagnostico">
            <option>Dermatosis</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>Observacion Medico</label>
        <input type="input" class="form-control">
    </div>
    <div class="col-md-3 col-lg-3">
        <label>Empresa<span style="color: red;">*</span></label>
        <select class="form-control" id="empresaSelect">
            <option>Pasteur Laboratorios Clinicos</option>
            <option>Patricia Osorio Pupo</option>
        </select>
    </div>
    <div class="col-md-3 col-lg-3">
        <label>Plan<span style="color: red;">*</span></label>
        <select class="form-control" id="planSelect">
            <option>Pasteur Laboratorios Clinicos</option>
            <option>Patricia Osorio Pupo</option>
        </select>
    </div>
    <div class="col-md-2 col-lg-2 mt-4">

        <input type="button" class="btn btn-info" id="nempresa" value="Notas Empresa">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#procedencia').select2({
            language: "es"
        });
        $('#medicoSelect').select2({
            language: "es"
        });
        $('#diagnostico').select2({
            language: "es"
        });
        $('#empresaSelect').select2({
            language: "es"
        });
        $('#planSelect').select2({
            language: "es"
        });
    });
</script>