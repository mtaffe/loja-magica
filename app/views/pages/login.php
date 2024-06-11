<section class="login">
  <div class="container">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header text-center">
              <h4>Login</h4>
            </div>
            <div class="card-body">
              <form action="<?php BASE_URL; ?>verify" method="POST">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
              </form>
            </div>
            <div class="card-footer text-center">
              <small>&copy; 2024 Loja Mágica</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <section class="box__login">

      <div class="result"></div>

      <form action="<?php BASE_URL; ?>verify" method="POST">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="E-mail">
        <label for="">Senha</label>
        <input type="password" name="passwd" placeholder="********">
        <input type="submit" value="Entrar">
      </form>
    </section> -->
  </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/loginUser.js"></script>