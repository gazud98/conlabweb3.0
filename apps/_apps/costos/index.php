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



    <section class="content " style="padding-left: 16%; padding-top:1%;">
        <div class="container">
            <div class="col-md-12 col-lg-12 mb-9" style="width:80%;">
                <div class="row ">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="col-md-12 col-lg-12 mb-9">
                                <div class="container" style="text-align: center;border-bottom: 1px solid rgb(210,210,210); ">

                                    <h3 class="card-title">Valor Costos indirectos</h3>

                                </div>
                                <div class="row" style="width:100%;">
                                    <div class="col-md-1 col-lg-1">
                                        <label>Costo indirecto</label>

                                    </div>
                                    <div class="col-md-3 col-lg-3  pt-1">
                                        <input type="input" class="form-control" style="width: 170px;"></input>
                                    </div>
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Descripcion</label>
                                    </div>
                                    <div class="col-md-3 col-lg-3 ">
                                        <div class="input-group pt-1 ">

                                            <select class="form-select" id="inputGroupSelect01" style="width: 170px;">
                                                <option selected></option>
                                                <option value="1">Opcion 1</option>
                                                <option value="2">Opcion 2 </option>
                                                <option value="3">Opcion 3</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row" style="width:100%;">
                                    <div class="col-md-1 col-lg-1 mt-2">
                                        <label>Mes</label>

                                    </div>
                                    <div class="col-md-3 col-lg-3  pt-1">
                                        <input type="input" class="form-control" style="width: 170px;"></input>
                                    </div>
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Año</label>
                                    </div>
                                    <div class="col-md-3 col-lg-3 ">
                                        <div class="input-group pt-1 ">

                                            <select class="form-select" id="inputGroupSelect01" style="width: 170px;">
                                                <option selected></option>
                                                <option value="1">2021</option>
                                                <option value="2">2022</option>
                                                <option value="3">2023</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-1 col-lg-1 mt-2">
                                        <label>Valor</label>

                                    </div>
                                    <div class="col-md-2 col-lg-2  pt-1">
                                        <input type="input" class="form-control" style="width: 255px;"></input>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered " style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 170px">Mes</th>
                                                <th style="width: 170px">Año</th>
                                                <th>Valor</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style=" background-color: rgb(249,249,249);">
                                                <td>Febrero</td>
                                                <td>2023</td>
                                                <td>
                                                    15.000
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>Marzo</td>
                                                <td>2022</td>
                                                <td>
                                                    15.000
                                                </td>


                                            </tr>
                                            <tr style=" background-color: rgb(249,249,249);">
                                                <td>Enero</td>
                                                <td>2020</td>
                                                <td> 15.000</td>


                                            </tr>

                                        </tbody>
                                    </table>
                                    <div style="text-align: center;">
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Agregar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Modificar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Borrar</button>&nbsp
                                        <button type="button" class="btn btn-danger"style="background-color: rgb(22,64,133);">Guardar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Cancelar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Salir</button>&nbsp
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

    </section>


</body>

</html>