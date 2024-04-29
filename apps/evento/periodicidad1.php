<?php
if (isset($_REQUEST['caso'])) {
    $caso = $_REQUEST['caso'];

    if ($caso == "-1") {
        $caso = "";
    }
} else {
    $caso = "0";
}


if ($caso == "S") {
?>


    <label>Se repite el</label>
    <div class="row">
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="D" id="sunday1" name="sunday1">
                <label class="form-check-label" for="sunday">
                    D
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="L" id="monday1" name="monday1">
                <label class="form-check-label" for="monday">
                    L
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="M" id="tuesday1" name="tuesday1">
                <label class="form-check-label" for="tuesday">
                    M
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="X" id="wednesday1" name="wednesday1">
                <label class="form-check-label" for="wednesday">
                    X
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="J" id="thursday1" name="thursday1">
                <label class="form-check-label" for="thursday">
                    J
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="V" id="friday1" name="friday1">
                <label class="form-check-label" for="friday">
                    V
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="S" id="saturday1" name="saturday1">
                <label class="form-check-label" for="saturday">
                    S
                </label>
            </div>
        </div>
    </div>
<?php } elseif ($caso == "M") { ?>
    <div class="col-md-12 col-lg-12">
        <label style="color:white;">.</label>
        <select class="form-control" aria-label="Default select example"  id="mesoption1">
            <option value="CPS">Cada Primer Sabado</option>
            <option value="CPL">Cada Primer Lunes</option>
            
        </select>
    </div>
<?php } ?>