function habilitacmpos() {
    $("#iddatas").css("pointer-events", "auto");
    $("#iddatas").css("background-color", "white");
}

function inhabilitacmpos() {
    $("#iddatas").css("pointer-events", "none");
    $("#iddatas").css("background-color", "#ededed");

    $("#accionejec").css("display", "none");
    $("#accionejec").html("");
}



$(document).ready(function() {


    $('#thetable').load('https://cw3.tierramontemariana.org/apps/activofijo/thedatatable.php');

    miDataTable3 = $('.table-h-m').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
        },
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    })

})



function accionesespecificas(caso) {
    if (caso == "X") { //cancelar....
        $("#divproveedoresproducto").css("display", "block");
    }
    if (caso == "A") { //aceptar...
        $("#divproveedoresproducto").css("display", "block");
    }
    if (caso == "C") { //de crer
        //desaparece la creacion de proveedores, solo sale en los demas casos
        $("#divproveedoresproducto").css("display", "none");
    } //De crear
    if (caso == "E") {
        $("#divproveedoresproducto").css("display", "block");
    } //Editar
    if (caso == "D") {
        $("#divproveedoresproducto").css("display", "block");
    } //Es de habolita / inhablitar
} //funcikjnes que hacen casos epeciales en


function printAreaDiv() {

    var contenidoDiv = document.getElementById('content-table-print').innerHTML;
    var divTemporal = document.createElement('div');
    divTemporal.innerHTML = contenidoDiv;
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    document.body.appendChild(iframe);
    var doc = iframe.contentWindow.document;
    doc.body.appendChild(divTemporal);
    iframe.contentWindow.print();
    document.body.removeChild(iframe);
}

function exportarCVS() {
    var tabla = document.getElementById('tableproductoprint');
    var csv = [];
    var filas = tabla.getElementsByTagName('tr');
    for (var i = 0; i < filas.length; i++) {
        var fila = [];
        var celdas = filas[i].getElementsByTagName('td');
        for (var j = 0; j < celdas.length; j++) {
            fila.push(celdas[j].innerText);
        }
        csv.push(fila.join(''));
    }
    var contenidoCSV = csv.join('\n');
    var enlace = document.createElement('a');
    enlace.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(contenidoCSV);
    enlace.target = '_blank';
    enlace.download = 'mi_tabla.csv';
    enlace.click();
}

function exportarExcel() {
    var nombreArchivo = 'productos.xlsx';
    var tabla = document.getElementById('tableproductoprint');
    var tablaHTML = tabla.outerHTML;
    var workbook = XLSX.utils.table_to_book(tabla);
    var excelBuffer = XLSX.write(workbook, {
        bookType: 'xlsx',
        type: 'array'
    });
    var blob = new Blob([excelBuffer], {
        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = nombreArchivo;
    a.click();
    URL.revokeObjectURL(url);

    Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Archivo exportado con éxito!',
        showConfirmButton: false,
        timer: 1000
    })

    $('#modalPrint').hide();
    $('.modal-backdrop').remove();

}