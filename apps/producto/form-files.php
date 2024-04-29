<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    #archivo,
    button {
        padding: 10px;
        border: 1px solid #E0E0E0;
        border-radius: 5px;
        /*box-shadow: 1px 1px 3px #ccc;*/
        background-color: #F7F9FC;
        color: black;
    }
</style>
<?php
$id = $_GET['id'];

?>

<form action="https://conlabweb3.tierramontemariana.org/apps/producto/subir_archivo.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data" style="
    width:100%;
     ">
    <div class="row">

        <div class="col-lg-12 col-lg-12" style="width: 100%;text-align:center">
            <br><input type="file" name="file" id="file" class="formcontrol" accept="application/pdf">
            <button type="submit" id="subir" value="Subir Archivo"><i class="fa fa-cloud-upload" style="color:balck;"></i>&nbsp;Subir Archivo </button>
        </div>
        <div class="col-lg-12 col-lg-12" style="width: 100%;text-align:center">
            <table class="table" style="width:100%;">
                <thead>
                    <tr >
                        <th style="font-family: 'Roboto', sans-serif;">Archivos Subidos</th>
                    </tr>
                </thead>
                <tr>
                    <td >
                       <div id="showname"></div>
                    </td>
                    <td >

                        <div id="show"> <i class="fas fa-eye"> </i></div>

                    </td>
                </tr>
            </table>
        </div>
    </div>
   

</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#show').load('https://conlabweb3.tierramontemariana.org/apps/producto/show-files.php?id=<?php echo $id ?>');
        $('#showname').load('https://conlabweb3.tierramontemariana.org/apps/producto/show-namefile.php?id=<?php echo $id ?>');
    });
</script>