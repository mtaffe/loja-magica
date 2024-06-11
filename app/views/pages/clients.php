<section>
  <div id="notificationSuccess" class="card notification-card bg-success text-white">
    <div class="card-body">
      <h5 class="card-title">Sucesso</h5>
      <p class="card-text"><?php echo isset($order) ? 'Edição concluída com sucesso!' : 'Cadastrado concluído com sucesso!' ?></p>
    </div>
  </div>
  <div id="notificationError" class="card notification-card bg-danger text-white">
    <div class="card-body">
      <h5 class="card-title">Erro</h5>
      <p class="card-text">Ocorreu um erro ao realizar a operação.</p>
    </div>
  </div>
  <div class="container">
    <label for="myInput">Filtrar por nome:</label>
    <input type="text" class="form-control col-5 mb-4" id="myInput" onkeyup="searchTable()" placeholder="Filtrar por nome" title="Filtrar por nome">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">E-mail</th>
          <th scope="col">Data do último pedido</th>
          <th scope="col">Valor do último pedido</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clients as $client) : ?>
          <tr>
            <td><?php echo isset($client['name']) ? $client['name'] : '<b>Nome não cadastrado</b>' ?></td>
            <td><?php echo isset($client['email']) ? $client['email'] : '<b>E-mail não cadastrado</b>' ?></td>
            <td><?php echo isset($client['last_order_date']) ? $client['last_order_date'] : '<b> Sem data do último pedido</b>' ?></td>
            <td><?php echo isset($client['last_order_cost']) ? 'R$ ' . $client['last_order_cost'] : '<b>Valor não cadastrado</b>' ?></td>
            <td>
              <span role="button" data-toggle="tooltip" data-placement="bottom" title="Editar cliente"><i class="text-primary mx-1 fa-solid fa-pen-to-square" onclick="editClient('<?php echo $client['id']; ?>')"></i></span>
              <span role="button" data-toggle="tooltip" data-placement="bottom" title="Excluir cliente"><a type="button" class="text-danger" data-bs-toggle="modal" data-bs-client-name="<?php echo $client['name']; ?>" data-bs-client-id="<?php echo $client['id']; ?>" data-bs-target="#deleteModal"><i class=" fa-solid fa-trash"></i></a></span>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Excluir cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Deseja prosseguir com a exclusão do cliente?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button id="deleteClientBtn" type="button" class="btn btn-primary">Excluir</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/clients.js"></script>