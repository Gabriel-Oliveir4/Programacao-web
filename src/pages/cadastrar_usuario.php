<?php

$title = "Cadastrar Usuário";
$currentPage = "cadastrar_usuario";
$mensagem = $_GET['m'] ?? '';

include __DIR__ . '/../components/head.php';
?>

<div class="container min-vh-100 d-flex align-items-center py-5">
  <div class="row justify-content-center w-100">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-4 text-center">Criar nova conta</h1>

          <?php if ($mensagem): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($mensagem) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="../controller/controller_usuario.php" class="vstack gap-3">
            <input type="hidden" name="opcao" value="cadastrar">
            <div>
              <label for="cad-nome" class="form-label">Nome de usuário</label>
              <input id="cad-nome" type="text" name="nome" class="form-control" required>
            </div>
            <div>
              <label for="cad-senha" class="form-label">Senha</label>
              <input id="cad-senha" type="password" name="senha" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
            <a href="login.php" class="btn btn-outline-secondary w-100">Voltar ao login</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>