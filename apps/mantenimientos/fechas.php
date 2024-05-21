
<select name="proxfechas" id="proxfechas" class="form-control">

</select>

<script>
    $(document).ready(function() {

        returnDates()
        
    })

    function returnDates(){
        fecha = $('#comenzar').val();
        fechaInicio = new Date(fecha).getTime();
        const fechasDespuesDe7Dias = [];
        meses = 0;
        aux = 0;

        if ($('#periodicidad').val() == 'S') {
            aux += 7;
        } else if ($('#periodicidad').val() == 'Q') {
            aux += 15;
        } else if ($('#periodicidad').val() == 'M') {
            aux += 30;
        } else if ($('#periodicidad').val() == 'A') {
            aux += 360;
        }

        while (meses != 12) {
            const semanaEnMilisegundos = aux * 24 * 60 * 60 * 1000; // 7 días en milisegundos
            fechaInicio += semanaEnMilisegundos;
            fechaDespuesDe7Dias = new Date(fechaInicio);
            fechasDespuesDe7Dias.push(fechaDespuesDe7Dias.toISOString().split('T')[0]);

            $('#proxfechas').append('<option>' + fechaDespuesDe7Dias.toISOString().split('T')[0] + '</option>')
            $('#contentFechasItem').append('<div class="col-md-2" id="itemFechas">' + fechaDespuesDe7Dias.toISOString().split('T')[0] + '</div>')

            meses++;
        }

        console.log('Fechas después de ' + aux + ' días:');
        console.log(fechasDespuesDe7Dias);

        return fechasDespuesDe7Dias;
    }

</script>