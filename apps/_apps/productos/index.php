<!-- SE OMITE CREAR UN ARCHIVO CSS YA QUE EL DISEÑO ERA SENCILLO-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conlab Web V3.0</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>



    <section class="content " style="padding: 1% 0% 0% 5%;">

        <div class="col-md-12 col-lg-12 mb-9" style="width:95%;">

            <div class="card">
                <div class="card-header bg-white">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong> INGRESO DE PRODUCTOS</strong> </label>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label class="card-title" style="text-align: center;">Para Ingresar productos, debe de indicar la orden de servicio donde se autoriza la compra. </label>
                        <div class="col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <label style="font-size: 13px;">Codigo Orden de Compra::</label>

                                </div>
                                 <div class="col-md-6 col-lg-6  pt-1">
                                    <input type="search" class="form-control form-control-sm" placeholder="" value="Lorem ipsum" style="width: 92px">
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <button class="btn btn-danger ml-2" style="height: 34px;">
                                        Buscar
                                    </button>
                                </div>
                            </div>

                        </div>
                    <div class="col-md-12 col-lg-12">
                        <!-- DISEÑO TABLA-->
                        <div style=" overflow-y:scroll; height:300px;width:auto;padding:8px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="background-color: rgb(1,103,183);color:white;" height="4">

                                        <th style="font-size: 12px;">Producto</th>
                                        <th style="font-size: 12px;">Accion</th>
                                        <th style="font-size: 12px;">Responsable Revision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style=" background-color: rgb(249,249,249);">
                                            <td>Producto 1</td>
                                            <td>Producto llega completo</td>
                                            <td>Elkin Cortes</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 2.</td>
                                            <td>Producto llega incompleto</td>
                                            <td>Elkin Cortez</td>
                                        </tr>
                                        <tr style=" background-color: rgb(249,249,249);">
                                            <td>Producto 3.</td>
                                            <td>Producto no ha llegado</td>
                                            <td>elkin Cortez</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <!--......-->



                    </div>
                    <!--FOOTER -->
                    <div style="text-align: center; margin:20px 0px 5px 0px;">
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;">Buscar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; " disabled>Grabar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;" disabled>Cancelar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; ">Salir</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>


                </div>
            </div>
        </div>
    </section>




</body>

</html>
