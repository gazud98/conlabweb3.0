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


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');

?>
    <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/mantenimientos/assets/style.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">

    <div id="fullcalendar">

    </div>

<?php
} /**/
?>

<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>

<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('fullcalendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            locale: 'es',
            editable: true,
            selectable: true,
            contentHeight: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            titleFormat: {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            },

        });

        $('#btnSearchCalendar').click(function() {
            $('#calendar').fullCalendar('rerenderEvents');
        })

        calendar.render();
        calendar.setOption('contentHeight', 550);

    });
</script>