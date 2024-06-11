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
    <input type="text" class="form-control col-5 mb-4" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por nome" title="Filtrar por nome">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Nome do Cliente</th>
          <th scope="col">Produto</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Status</th>
          <th scope="col">Data de criação</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order) : ?>
          <tr>
            <td><?php echo isset($order['client_name']) ? $order['client_name'] : '<b>Não informado</b>' ?></td>
            <td><?php echo isset($order['product']) ? $order['product'] : '<b>Não informado</b>' ?></td>
            <td><?php echo isset($order['quantity']) ? $order['quantity'] : '<b>Não informado</b>' ?></td>
            <td><?php echo isset($order['status']) ? $order['status'] : '<b>Não informado</b>' ?></td>
            <td><?php echo isset($order['created_at']) ? $order['created_at'] : '<b>Não informado</b>' ?></td>
            <td>
              <span role="button" data-toggle="tooltip" data-placement="bottom" title="Editar cliente"><i class="text-primary mx-1 fa-solid fa-pen-to-square" onclick="editOrder('<?php echo $order['id']; ?>')"></i></span>
              <span role="button" data-toggle="tooltip" data-placement="bottom" title="Excluir cliente"><a type="button" class="text-danger" data-bs-toggle="modal" data-bs-order-id="<?php echo $order['id']; ?>" data-bs-target="#deleteOrderModal"><i class=" fa-solid fa-trash"></i></a></span>

            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteOrderModalLabel">Excluir Pedido</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Deseja prosseguir com a exclusão do pedido?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button id="deleteOrderBtn" type="button" class="btn btn-primary">Excluir</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/orders.js"></script>