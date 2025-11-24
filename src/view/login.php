<?php

$title = "Login";
$currentPage = "login";
$mensagem = $_GET['m'] ?? '';

include __DIR__ . '/../componentes/head.php';
?>

<div class="container min-vh-100 d-flex align-items-center py-5">
  <div class="row justify-content-center w-100">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-4 text-center">Acesso ao Sistema</h1>

          <?php if ($mensagem): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($mensagem) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="../controller/controller_usuario.php" class="vstack gap-3">
            <input type="hidden" name="opcao" value="entrar">
            <div>
              <label for="login-nome" class="form-label">Nome de usuário</label>
              <input id="login-nome" type="text" name="nome" class="form-control" required autofocus>
            </div>
            <div>
              <label for="login-senha" class="form-label">Senha</label>
              <input id="login-senha" type="password" name="senha" class="form-control js-mask-senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
          </form>

          <div class="text-center my-3"><span class="text-muted">ou</span></div>
          <a href="cadastrar_usuario.php" class="btn btn-outline-secondary w-100">Cadastrar</a>
        </div>
      </div>
      <p class="text-center text-muted small mt-3 mb-0">&copy; <?= date('Y') ?> — Mini Projeto</p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
