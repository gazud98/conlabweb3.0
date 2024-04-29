<?php

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

$user = $_SESSION['id_users'];

?>
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://conlabweb3.tierramontemariana.org/apps/gestiontareas/send-mail.php?user='+<?php echo $user; ?>,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log('Verify: ' + res);
            }
        });
    })
    
</script>