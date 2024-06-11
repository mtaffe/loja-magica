<section>
    <div id="notificationSuccess" class="card notification-card bg-success text-white">
        <div class="card-body">
            <h5 class="card-title">Sucesso</h5>
            <p class="card-text"><?php echo isset($order) ? 'Edição concluída com sucesso!' : 'Cadastro concluído com sucesso!' ?></p>
        </div>
    </div>
    <div id="notificationError" class="card notification-card bg-danger text-white">
        <div class="card-body">
            <h5 class="card-title">Erro</h5>
            <p class="card-text">Ocorreu um erro ao realizar a operação.</p>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Formulário de Pedidos</h2>
        <form method="post" action="" method="POST">
            <div class="row">
                <div class="form-group col-8" id="">
                    <label for="client_id">Cliente</label>
                    <select class="form-control" id="client_id" name="client_id" required>
                        <option value="">Selecione o cliente</option>
                        <?php
                        foreach ($clients as $client) {

                            if (isset($order['id']) && $order['client_id'] == $client['id']) {
                                echo '<option value="' . $client['id'] . '" selected>' . $client['name'] . ' (' . $client['email'] . ')</option>';
                            } else {
                                echo '<option value="' . $client['id'] . '">' . $client['name'] . ' (' . $client['email'] . ')</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="product">Status do Pedido</label>
                    <select class="form-control" id="status" name="status" <?php echo isset($order['status']) ? '' : 'disabled' ?>>
                        <option value="">Selecione um pedido</option>
                        <option value="Pendente" <?php echo (isset($order['status']) && $order['status'] == 'Pendente') ? 'selected' : '' ?>>Pendente</option>
                        <option value="Criado" <?php echo (!isset($order) || $order['status'] == 'Criado') ? 'selected' : '' ?>>Criado</option>
                        <option value="Em processamento" <?php echo (isset($order['status']) && $order['status'] == 'Em processamento') ? 'selected' : '' ?>>Em processamento</option>
                        <option value="Enviado" <?php echo (isset($order['status']) && $order['status'] == 'Enviado') ? 'selected' : '' ?>>Enviado</option>
                        <option value="Entregue" <?php echo (isset($order['status']) && $order['status'] == 'Entregue') ? 'selected' : '' ?>>Entregue</option>
                        <option value="Cancelado" <?php echo (isset($order['status']) && $order['status'] == 'Cancelado') ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="product">Produto</label>
                <input type="text" class="form-control" id="product" value="<?php echo (isset($order['product'])) ? $order['product'] : '' ?>" placeholder="Digite o nome do produto" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input type="number" class="form-control" id="quantity" value="<?php echo (isset($order['quantity'])) ? $order['quantity'] : '' ?>" placeholder="Digite a quantidade" required>
            </div>
            <input type="hidden" id="orderId" value="<?php echo isset($order['id']) ? $order['id'] : '' ?>">
            <input type="hidden" id="action" value="<?php echo isset($order['id']) ? 'edit' : 'create' ?>">
            <input type="submit" class="btn btn-primary" value="<?php echo isset($order['id']) ? 'Editar' : "Cadastrar" ?>">
        </form>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/createOrder.js"></script>
<script>
    var select_box_element = document.querySelector('#client_id');

    dselect(select_box_element, {
        search: true
    });
</script>