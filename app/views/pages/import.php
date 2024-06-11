<section>
	<div id="notificationSuccess" class="card notification-card bg-success text-white">
		<div class="card-body">
			<h5 class="card-title">Sucesso</h5>
			<p class="card-text">Arquivo importado com sucesso!</p>
		</div>
	</div>
	<div id="notificationError" class="card notification-card bg-danger text-white">
		<div class="card-body">
			<h5 class="card-title">Erro</h5>
			<p class="card-text">Ocorreu um erro ao realizar a operação.</p>
		</div>
	</div>
	<div class="container">
		<h2 class="mb-4">Importar Arquivo</h2>
		<form enctype="multipart/form-data" id="formulario-arquivo" method="post" action="<?php BASE_URL; ?>import" method="POST">
			<input type="file" name="file" id="file" required>
			<br>
			<div class="mt-2">
				<input class="btn btn-dark btn-sm" type="submit" name="enviar" id="enviar" value="Importar">
			</div>
		</form>
		<div class="result my-2"></div>
	</div>
</section>
<script src="<?php echo BASE_URL; ?>app/public/js/import.js"></script>