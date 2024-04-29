<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Agrega enlaces a tus hojas de estilo aquí -->
    <link rel="stylesheet" type="text/css" href="/cw3/apps/gestiontareas/assets/style.css">
</head>

<body>

    <main>
        <div class="divcontainer">

            <div class="row">
                <div class="card border-info" style="width:100%;margin:auto;">
                    <div class="card-header bg-info" style="font-size: 15px !important;">
                        <strong>Buscar Tareas</strong>
                    </div>
                    <div class="card-body" id="search-tarea">
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="card" style="width:100%;margin:auto;">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="getPersona()"><i class="fa-solid fa-plus"></i> Crear Tarea</button>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-1">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="btn btn-success active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color: white;">Hoy <span class="badge badge-light">0</span></button>
                                    <button class="btn btn-danger" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color: white; margin-top:5px;">Vencidas <span class="badge badge-light">0</span></button>
                                    <button class="btn btn-warning" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" style="color: black; margin-top:5px;">Proceso <span class="badge badge-light">0</span></button>
                                    <button class="btn btn-pink" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" style="color: white; margin-top:5px;">Futuras <span class="badge badge-light">0</span></button>
                                    <button class="btn btn-dark" id="v-pills-closed-tab" data-toggle="pill" data-target="#v-pills-closed" type="button" role="tab" aria-controls="v-pills-closed" aria-selected="false" style="color: white; margin-top:5px;">Cerradas <span class="badge badge-light">0</span></button>
                                    <button class="btn btn-oliva" id="v-pills-closed-tab" data-toggle="pill" data-target="#v-pills-closed" type="button" role="tab" aria-controls="v-pills-closed" aria-selected="false" style="color: white; margin-top:5px;">Total <span class="badge badge-light">0</span></button>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-closed" role="tabpanel" aria-labelledby="v-pills-closed-tab">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Tareas -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Tarea:</label>
                                    <input type="text" class="form-control" name="tarea" id="tarea">
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-4">
                                    <label for="">Fecha inicio:</label>
                                    <input type="date" class="form-control" name="fechaini" id="fechaini">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Fecha Fin:</label>
                                    <input type="date" class="form-control" name="fechafin" id="fechafin">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Prioridad</label>
                                    <select class="form-control" name="prioridad" id="prioridad">
                                        <option value="" selected disabled></option>
                                        <option value="1">Alta</option>
                                        <option value="2">Media</option>
                                        <option value="3">Baja</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="">Responsable:</label>
                                    <select class="form-control" name="responsable" id="responsable">
                                        
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="">Comentarios:</label>
                                    <textarea class="form-control" name="coments" id="coments" cols="30" rows="3" style="height: 50px !important;"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="saveData()">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Notas -->
        <div class="modal fade" id="exampleNotas" tabindex="-1" aria-labelledby="exampleNotasLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleNotasLabel">Comentarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span><strong>Didier Urueta</strong> - <span>14/12/2023</span></span>
                        <br>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Commodi mollitia sint voluptas quo architecto fugiat natus officiis,
                            repellat praesentium libero officia inventore? Voluptas nemo fugit
                            quia exercitationem sequi animi sint.
                        </p>
                        <textarea class="form-control" name="coments" id="coments" cols="30" rows="5" style="height: 50px !important;"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success">Grabar</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $("#search-tarea").load("/cw3/apps/gestiontareas/search.php");
            $("#v-pills-home").load("/cw3/apps/gestiontareas/table-tareas-hoy.php");
        });

        function saveData() {
            $.ajax({
                type: 'POST',
                url: '/cw3/apps/gestiontareas/crud.php',
                data: $('#formcontrol').serialize(),
                success: function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "¡Registro guardado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    miDataTable.ajax.reload();
                    $('#exampleModal').modal('hide');
                }
            });
        }

        function getPersona(){
            $.ajax({
                type: 'POST',
                url: '/cw3/apps/gestiontareas/mostrar-2.php?aux=1',
                success: function(res) {

                    alert('Hola');

                    alert(res);

                    res.forEach(element => {
                        $('#responsable').append('<option value="'+element['id']+'">'+element['nombre']+'</option>');
                    });

                }
            });
        }

    </script>
</body>

</html>