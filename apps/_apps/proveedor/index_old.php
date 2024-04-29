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



    <section class="content " style="padding: 1% 0% 0% 21%; ">

        <div class="col-md-12 col-lg-12 mb-9" style="width:75%; ">

            <div class="card">
                <div class="card-header bg-white" style="height: 35px;">
                    <label class="card-title" style="color: rgb(1,103,183);font-size: 13px;"><strong>CREACIÓN DE PROVEEDORES</strong> </label>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-5">
                        <!-- DISEÑO TABLA-->
                        <div style=" overflow-y:scroll; height:450px;width:auto;padding:8px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="background-color: rgb(1,103,183);color:white;" height="4">

                                        <th style="font-size: 12px; ">ID o NIT</th>
                                        <th style="font-size: 12px;">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="font-size: 10px;">

                                        <td>8600012212</td>
                                        <td>CENTRO MAYORISTA Y PAPELERIA TAURO LTDA</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>79415363-8</td>
                                        <td>ADL IMPRESORES - HUGO ARMANDO DUQUE</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>802023312-1</td>
                                        <td>ADVANCED MEDICAL LTDA</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>900532434-0</td>
                                        <td>ANNAR DIAGNOSTICA IMPORT LTDA</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>11111111</td>
                                        <td>ALPCO DIAGNOSTICS</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>800150822-2</td>
                                        <td>AQUILUX DE LA COSTA LTDA</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>03079</td>
                                        <td>ALPCO DIAGNOSTICS</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>900324870-7</td>
                                        <td>ARCOINK</td>
                                    </tr>
                                    <tr style="font-size: 10px;">

                                        <td>900147647-1</td>
                                        <td>AGENCIA FULLER LTDA</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--......-->
                    <div class="col-md-7 col-lg-7">

                        <div class="col-md-12 col-lg-12 p-1">
                            <label style="color: rgb(1,103,183);font-size: 13px;"><strong>Creación</strong></label>
                            <div class="row ">
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Tipo de documento:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <select class="form-select" aria-label="Default select example" style="width: 100%; height: 28px;font-size: 11px;" disabled>
                                        <option selected>NIT</option>
                                        <option value="1">Cartagena</option>

                                    </select>


                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Id:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Razon Social :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Dia Verificacion:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 50%; height: 28px;font-size: 12px;"></input>


                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Direccion :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Telefono :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Pais :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Plazo en Dias :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 50%; height: 28px;font-size: 12px;"></input>


                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Ciudad :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <select class="form-select" aria-label="Default select example" style="width: 100%; height: 28px;font-size: 11px;">
                                        <option selected>Seleccione una ciudad</option>
                                        <option value="1">Español</option>
                                        <option value="1">Ingles</option>
                                    </select>


                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Idioma :</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <select class="form-select" aria-label="Default select example" style="width: 100%; height: 28px;font-size: 11px;">
                                        <option selected>Seleccione una idioma</option>
                                        <option value="1">Español</option>
                                        <option value="1">Barranquilla</option>
                                    </select>


                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Email :</label>

                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                                <div class="col-md-1 col-lg-1">
                                    <label style="font-size: 15px;">@</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <select class="form-select" aria-label="Default select example" style="width: 100%; height: 28px;font-size: 11px;">
                                        <option selected>Seleccione Email</option>
                                        <option value="1">pasteurlab.com</option>
                                        <option value="1">gmail.com</option>
                                    </select>

                                </div>

                            </div>


                            <div class="row">
                                <label style="color: rgb(1,103,183);font-size: 13px;"><strong>Contacto</strong></label>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Nombre Completo:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Cargo:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Telefono:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Celular:</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>


                            </div>

                            <div class="row mt-2">
                                <div class="col-md-2 col-lg-2 ">
                                    <label style="font-size: 12px;">Email :</label>

                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>


                                </div>
                                <div class="col-md-1 col-lg-1">
                                    <label style="font-size: 15px;">@</label>

                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <select class="form-select" aria-label="Default select example" style="width: 100%; height: 28px;font-size: 11px;">
                                        <option selected>Seleccione Email</option>
                                        <option value="1">pasteurlab.com</option>
                                        <option value="1">gmail.com</option>
                                    </select>

                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Fax:</label>

                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>
                            </div>

                            <div class="row">
                                <label style="color: rgb(1,103,183);font-size: 13px;"><strong>Busqueda</strong></label>
                            </div>

                            <div class="row">
                                <div class="col-md-1 col-lg-1">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Codigo</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>

                            </div>

                            <div class="row mt-1">
                                <div class="col-md-1 col-lg-1">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label style="font-size: 12px;">Descripción</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <input type="input" class="form-control" style="width: 100%; height: 28px;font-size: 12px;"></input>
                                </div>

                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12 col-lg-12 mt-1">
                                    <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;" disabled>Buscar</button>
                                </div>

                            </div>

                        </div>

                        <!--FOOTER -->

                    </div>
                    <div style="text-align: center; margin:20px 0px 5px 0px;">
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;">Nuevo</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px; ">Borrar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <button type="button" class="btn btn-primary" style="background-color: rgb(22,64,133);font-size: 12px;">Modificar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
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