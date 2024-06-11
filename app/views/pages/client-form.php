<section>
    <div id="notificationSuccess" class="card notification-card bg-success text-white">
        <div class="card-body">
            <h5 class="card-title">Sucesso</h5>
            <p class="card-text"><?php echo isset($client) ? 'Edição concluída com sucesso!' : 'Cadastro concluído com sucesso!' ?></p>
        </div>
    </div>
    <div id="notificationError" class="card notification-card bg-danger text-white">
        <div class="card-body">
            <h5 class="card-title">Erro</h5>
            <p class="card-text">Ocorreu um erro ao realizar a operação.</p>
        </div>
    </div>
    <div class="result"></div>
    <div class="container mt-5">
        <h2 class="mb-4">Formulário de Clientes</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" value="<?php echo isset($client['name']) ? $client['name'] : '' ?>" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="<?php echo (isset($client['email'])) ? $client['email'] : '' ?>" placeholder="Digite seu email" required>
            </div>
            <select class="form-control" id="type" name="type">
                <option value="">Selecione um tipo de cliente</option>
                <option value="Cliente Individual" <?php echo (isset($client['type']) && $client['type'] == 'Cliente Individual') ? 'selected' : '' ?>>Cliente Individual</option>
                <option value="Loja" <?php echo (isset($client['type']) && $client['type'] == 'Loja') ? 'selected' : '' ?>>Loja</option>
            </select>
            <div class="form-group">
                <label for="last_order_date">Data do Último Pedido</label>
                <input type="date" class="form-control" id="last_order_date" value="<?php echo (isset($client['last_order_date'])) ? $client['last_order_date'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="last_order_cost">Custo do Último Pedido</label>
                <input type="number" class="form-control" id="last_order_cost" value="<?php echo (isset($client['last_order_cost'])) ? $client['last_order_cost'] : '' ?>" placeholder="Digite o custo do último pedido" required>
            </div>
            <input type="hidden" id="clientId" value="<?php echo isset($client['id']) ? $client['id'] : '' ?>">
            <input type="hidden" id="action" value="<?php echo isset($client['id']) ? 'edit' : 'create' ?>">
            <button type="submit" class="btn btn-primary" value=""><?php echo isset($client['id']) ? 'Editar' : "Cadastrar" ?></button>
        </form>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/createClient.js"></script>