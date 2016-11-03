<!-- Modal -->
<div class="modal fade" id="modal_contato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Novo contato</h4>
      </div>
      <div class="modal-body">
          <div class="row none" id="menssage_returned">
              <div class="col-lg-12">
                  <div class="alert alert-danger" role="alert"></div>
              </div>
          </div>

         <form data-toggle="validator" id="form_contato" action="">
          <input type="hidden" value="" name="id_contato" id="id_contato" />
          {{ csrf_field() }}
          <div class="form-group t_name">
            <label for="name" class="control-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group t_phone">
            <label for="phone" class="control-label">Telefone:</label>
            <input type="text" class="form-control tel" id="phone" name="phone">
          </div>
          <div class="form-group">
            <label for="email" class="control-label">E-mail:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success btn-save">Salvar</button>
      </div>
    </div>
  </div>
</div>