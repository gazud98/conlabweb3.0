<div class="row">
    <div class="col-md-5">
        <label for="">¿Quiere añadir un recordatario?: </label>
        <span>Sí <input type="radio" name="reqRecord" id="reqRecord" value="1"></span>
        <span>NO <input type="radio" name="reqRecord" id="reqRecord" value="2"></span>
    </div>
    <div class="col-md-6" id="contentReqRecord" style="display: none;">
        <label for="">Frecuencia por cada fecha:</label>
        <select name="frecuenciarecord" id="frecuenciarecord">
            <option value="1">1 día antes</option>
            <option value="2">3 día antes</option>
            <option value="2">5 día antes</option>
        </select>
    </div>
</div>

<div class="row mt-2" id="contentFechasItem">

</div>

<script>


    $(document).ready(function() {

        returnDates()

        $('#reqRecord').change(function(){

            reqVal = $('#reqRecord').val();

            if(reqVal == 1){
               $('#contentReqRecord').css('display', 'block'); 
            }else if(reqVal == 2){
                $('#contentReqRecord').css('display', 'none'); 
            }
            
        })

    })

    function returnDates() {
        fecha = $('#comenzar').val();
        fechaFinal = $('#fecha_final').val();
        fechaInicioMs = new Date(fecha).getTime();
        fechaFinalMs = new Date(fechaFinal).getTime();
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

        const semanaEnMilisegundos = aux * 24 * 60 * 60 * 1000; // 7 días en milisegundos

        while (fechaInicioMs + semanaEnMilisegundos <= fechaFinalMs) {
            
            fechaInicioMs += semanaEnMilisegundos;

            fechaDespuesDe7Dias = new Date(fechaInicioMs);

            fechasDespuesDe7Dias.push(fechaDespuesDe7Dias.toISOString().split('T')[0]);

            $('#contentFechasItem').append('<div class="col-md-2" id="itemFechas">' + fechaDespuesDe7Dias.toISOString().split('T')[0] + '</div>')

            meses++;
        }

        console.log('Fechas después de ' + aux + ' días:');
        console.log(fechasDespuesDe7Dias);

        return fechasDespuesDe7Dias;
    }

    

</script>