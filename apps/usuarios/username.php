<label style="font-size: 12px;">Usuario de acceso:</label>
<input type="text" class="form-control" name="username" id="username" onclick="lowerCase(username)" value="<?php echo $username; ?>"></input>
<div id="usernamex"></div>
<script>
    $(document).ready(function() {
        $(document).ready(function () {
            $("#username").on("keyup", function () {
                var inputText = $(this).val(); // Obtener el valor del input
                var textoEnMinusculas = inputText.toLowerCase(); // Convertir el texto a minúsculas
                $(this).val(textoEnMinusculas); // Establecer el valor del input en minúsculas
            });
        });
    });
</script>