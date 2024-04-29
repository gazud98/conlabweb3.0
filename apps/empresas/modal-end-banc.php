<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalEntidadesBancLabel">Crear Entidad Bancaria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="formDatosEndBanc" method="POST" enctype="multipart/form-data">
            <div class="modal-body">

                <div class="col-md-12">
                    <label for="">Descripción:</label>
                    <input class="form-control" type="text" name="desc" id="desc" required>
                </div>
                <br>
                <div class="col-md-12">
                    <label for="">PUC</label>
                    <input class="form-control" type="text" name="puc" id="puc" required>
                </div>
                <br>
                <div class="col-md-12">
                    <label for="">Estado:</label>
                    <select class="form-control" name="estado" id="estado" required>
                        <option value="1" selected>Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="setEntidadesBancarias()">Grabar</button>
            </div>
        </form>
    </div>
</div>