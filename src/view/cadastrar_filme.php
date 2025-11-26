<?php
require_once __DIR__ . '/../session.php';

$title = "Cadastrar Filme";
$currentPage = "filmes";
$mensagem = $_GET['m'] ?? '';

include __DIR__ . '/../componentes/head.php';
include __DIR__ . '/../componentes/navbar.php';
?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-4 text-center">Cadastrar filme</h1>

          <?php if ($mensagem): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($mensagem) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="../controller/controller_filme.php" class="vstack gap-3">
            <input type="hidden" name="opcao" value="criar">

            <div>
              <label for="filme-nome" class="form-label">Nome</label>
              <input id="filme-nome" type="text" name="nome" class="form-control" required>
            </div>

            <div>
              <label for="filme-tipo" class="form-label">Tipo</label>
              <input id="filme-tipo" type="text" name="tipo" class="form-control" required>
            </div>

            <div>
              <label for="filme-duracao" class="form-label">Duração</label>
              <input
                id="filme-duracao"
                type="text"
                name="duracao"
                class="form-control js-mask-duracao"
                placeholder="Ex.: 1h45min"
                pattern="^[0-9]{1,2}h[0-5][0-9]min$"
                title="Informe no formato 1h35min (apenas números, 'h' e 'min')"
                required>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="dashboard.php" class="btn btn-outline-secondary">Cancelar</a>
              <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>