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

                                    <h3 class="card-title">Asignación De Pruebas A Empleados</h3>

                                </div>
                                <div class="row" style="width:100%;">
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Prueba</label>

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
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Cedula</label>

                                    </div>
                                    <div class="col-md-3 col-lg-3  pt-1">
                                        <input type="input" class="form-control" style="width: 170px;"></input>
                                    </div>
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Empleado</label>
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
                                    <div class="col-md-2 col-lg-2 mt-2">
                                        <label>Tiempo a Prueba</label>

                                    </div>
                                    <div class="col-md-2 col-lg-2  pt-1">
                                        <input type="input" class="form-control"></input>
                                    </div>
                                    <div class="col-md-4 col-lg-4  pt-2" style="text-align: center;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Minutos</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Horas</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">Dias</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered " style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th >Empleado</th>
                                                <th style="width: 170px">Tiempo Prueba</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style=" background-color: rgb(249,249,249);">
                                                <td>Empleado 1</td>
                                                <td>1 Mes</td>



                                            </tr>
                                            <tr>
                                                <td>Empleado 2</td>
                                                <td>6 meses</td>



                                            </tr>
                                            <tr style=" background-color: rgb(249,249,249);">
                                                <td>Empleado 3</td>
                                                <td>7 meses</td>



                                            </tr>

                                        </tbody>
                                    </table>
                                    <div style="text-align: center;">
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);">Agregar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);" disabled>Modificar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);" disabled>Borrar</button>&nbsp
                                        <button type="button" class="btn btn-danger" style="background-color: rgb(22,64,133);" disabled>Guardar</button>&nbsp
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