  <!-- Modal Pagos -->
  <div class="modal fade" id="pagosModal" tabindex="-1" aria-labelledby="pagosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal_lg">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="pagosModalLabel">Pagos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">N° Identificación:</label>
                                    <input type="text" class="form-control" name="numide" id="numide">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nombre Completo:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-req-fact">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Requisito Facturación</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6" style="text-align: right !important;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Centro Ingreso:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Médico:</label>
                                            <select name="medico" id="medico" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="">Empresa:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Plan:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Conceptos a Facturar</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Tipo Servicio:</label>
                                            <select name="" id="" class="form-control"></select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Valor Servicio:</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                        <div class="col-md-4" style="margin-top: 28px;">
                                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 20px;">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="">Exámenes Rutina <span class="badge badge-secondary">1</span></label>
                                            <label for="">Exámenes Especiales <span class="badge badge-secondary">0</span></label>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Descripción</th>
                                                        <th>Valor Concepto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align: left;">
                                            <label for="">Total concepto: <span class="badge badge-secondary">$0</span></label>
                                            <br><label for="">Valor Exámenes: <span class="badge badge-secondary">$0</span></label>
                                            <hr>
                                            <label for="">Valor Pagar Empresa: <span class="badge badge-secondary">$0</span></label>
                                            <br><label for="">Valor Pagar Paciente: <span class="badge badge-secondary">$0</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Detalles de Pago</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Forma de Pago:</label>
                                            <select name="" id="" class="form-control"></select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Tipo Tarjeta:</label>
                                            <select name="" id="" class="form-control"></select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Doc:</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Valor:</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 28px;">
                                            <button type="button" class="btn btn-primary btn-sm" style="border-radius: 20px;">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha Ingreso</th>
                                                        <th>Forma de Pago</th>
                                                        <th>Documento</th>
                                                        <th>Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>Saldo:</strong></td>
                                                        <td><strong style="color:red;">$0</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">Grabar</button>
                </div>
            </div>
        </div>
    </div>