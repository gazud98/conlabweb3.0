<?php
if (isset($_REQUEST['caso'])) {
    $caso = $_REQUEST['caso'];

    if ($caso == "-1") {
        $caso = "";
    }
} else {
    $caso = "0";
}
if (isset($_REQUEST['period_semanal'])) {
    $period_semanal = $_REQUEST['period_semanal'];

    if ($period_semanal == "-1") {
        $period_semanal = "";
    }
} else {
    $period_semanal = "0";
}
if (isset($_REQUEST['mesoption'])) {
    $mesoption = $_REQUEST['mesoption'];

    if ($mesoption == "-1") {
        $mesoption = "";
    }
} else {
    $mesoption = "0";
}
if ($caso == "S") {
    $array = explode(",", $period_semanal);
    $length = count($array);


?>


    <label>Se repite el</label>
    <div class="row">
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="D" id="sunday1" name="sunday1" <?php if ($array[0] == 'D') {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                <label class="form-check-label" for="sunday">
                    D
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="L" id="monday1" name="monday1" <?php if ($array[1] == 'L') {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                <label class="form-check-label" for="monday">
                    L
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="M" id="tuesday1" name="tuesday1" <?php if ($array[2] == 'M') {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                <label class="form-check-label" for="tuesday">
                    M
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="X" id="wednesday1" name="wednesday1" <?php if ($array[3] == 'X') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                <label class="form-check-label" for="wednesday">
                    X
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="J" id="thursday1" name="thursday1" <?php if ($array[4] == 'J') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                <label class="form-check-label" for="thursday">
                    J
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="V" id="friday1" name="friday1" <?php if ($array[5] == 'V') {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                <label class="form-check-label" for="friday">
                    V
                </label>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="S" id="saturday1" name="saturday1" <?php if ($array[6] == 'S') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                <label class="form-check-label" for="saturday">
                    S
                </label>
            </div>
        </div>
    </div>
<?php } elseif ($caso == "M") { ?>
    <div class="col-md-12 col-lg-12">
        <label style="color:white;">.</label>
        <select class="form-control" aria-label="Default select example" id="mesoption1">
            <option value="CPS" <?php if ($mesoption == 'CPS') {
                                    echo "checked";
                                } ?>>Cada Primer Sabado</option>
            <option value="CPL"<?php if ($mesoption == 'CPL') {
                                    echo "checked";
                                } ?>>Cada Primer Lunes</option>

        </select>
    </div>
<?php } ?>