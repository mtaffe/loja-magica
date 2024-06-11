<section>
    <div id="notificationSuccess" class="card notification-card bg-success text-white">
        <div class="card-body">
            <h5 class="card-title">Sucesso</h5>
            <p class="card-text">Sua operação foi concluída com sucesso!</p>
        </div>
    </div>
    <div class="container">
        <div class="info">
            <h2>Novo Comunicado</h2>
            <p>Comunicados serão enviados a todos os clientes cadastrados com e-mails válidos.</p>
        </div>
        <form action="" method="post">
            <?php if (isset($clients)) : ?>
                <label for="clientId">Cliente</label>
                <select class="form-control" id="clientId" onchange="fetchOrders()" name="clientId">
                    <option value="">Selecione um cliente</option>
                    <?php
                    foreach ($clients as $client) {
                        echo (isset($client['email']) && str_contains($client['email'], "@") && str_contains($client['email'], ".")) ? '<option value="' . $client['id'] . '">' . $client['name'] . ' (' . $client['email'] . ')</option>' : '';
                    }
                    ?>
                </select>
                <label for="orderId">Pedido</label>
                <select class="form-control" id="orderId" name="orderId" disabled>
                </select>

                <label for="orderStatus">Status</label>
                <select class="form-control" id="orderStatus" name="orderStatus" disabled>
                    <option value="">Selecione um pedido</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Criado">Criado</option>
                    <option value="Em processamento">Em processamento</option>
                    <option value="Enviado">Enviado</option>
                    <option value="Entregue">Entregue</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            <?php endif; ?>
            <div class="form-group">
                <label for="subject">Adicione um assunto</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Digite um assunto" required>
            </div>
            <div class="form-group">
                <label for="message">Digite sua mensagem</label>
                <textarea class="form-control" id="message" name="message" rows="8" placeholder="Digite sua mensagem" required></textarea>
            </div>
            <?php if (isset($clients)) : ?>
                <input type="hidden" id="type" value="Order">
            <?php else : ?>
                <input type="hidden" id="type" value="Statement">
            <?php endif; ?>
            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/createMail.js"></script>