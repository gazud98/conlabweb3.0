<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conlab Web V3.0</title>

    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>

    <section class="content" style="padding:10px;">
        <div class="container">
            <div class="row mb-2" style=" border:1px solid rgb(210,210,210);">
                <div class=" col-md-12 col-lg-12">
                    <h3>Ingresa Productos</h3>
                </div>
            </div>
            <div class="row ">
                <div class="card ">
                    <div class="card-header bg-white">
                        <div class="col-md-12 col-lg-12 mb-9">
                            <div class="row">
                                <div class="col-md-9 col-lg-9 mb-3">
                                    <label class="card-title" style="text-align: center;">Para Ingresar productos, debe de indicar la orden de servicio donde se autoriza la compra.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 col-lg-2  pt-1">
                                    <label style="font-size: 12px;">Numero de Orden</label>

                                </div>
                                <div class="col-md-1 col-lg-1  pt-1">
                                    <input type="search" class="form-control form-control-sm" placeholder="" value="Lorem ipsum" style="width: 92px">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <button class="btn btn-danger ml-2" style="height: 34px">
                                        Aceptar
                                    </button>
                                </div>
                                <div class="col-md-5 col-lg-5 " style="text-align: right; ">
                                    <button class="btn btn-danger ml-2" style="height: 34px;width: 45%;">
                                        Buscar Orden
                                    </button>
                                </div>

                            </div>
                

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">Producto</th>
                                            <th>descripcion</th>
                                            <th style="width: 50px">Cantidad</th>
                                            <th>Anotaciones</th>
                                            <th style="width: 50px">Accion</th>
                                            <th>Fecha</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style=" background-color: rgb(249,249,249);">
                                            <td>Producto 1</td>
                                            <td>Descripcion del Producto</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                </div>
                                            </td>
                                            <td>Producto llega completo</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                        </tr>
                                        <tr>
                                            <td>Producto 2.</td>
                                            <td>Descripcion del Producto</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                                </div>
                                            </td>
                                            <td>Producto llega incompleto</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                        </tr>
                                        <tr style=" background-color: rgb(249,249,249);">
                                            <td>Producto 3.</td>
                                            <td>Descripcion del Producto</td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                                </div>
                                            </td>
                                            <td>Producto no ha llegado</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                            <td>Update software</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->

    </section>


</body>

</html>