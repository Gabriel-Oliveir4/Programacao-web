<?php
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../model/crud_trabalho.php';

$usuarioId = (int)($_SESSION['id'] ?? 0);
$id = (int)($_GET['id'] ?? 0);
$trabalho = $id ? buscarTrabalhoPorId($id, $usuarioId) : null;
if (!$trabalho) {
  header('Location: dashboard.php?m=Trabalho%20não%20encontrado');
  exit;
}

$title = "Editar Trabalho #{$trabalho['IDT']}";
$currentPage = "trabalhos";
$mensagem = $_GET['m'] ?? '';

include __DIR__ . '/../componentes/head.php';
include __DIR__ . '/../componentes/navbar.php';
?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-4 text-center">Editar trabalho #<?= $trabalho['IDT'] ?></h1>

          <?php if ($mensagem): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($mensagem) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="../controller/controller_trabalho.php" class="vstack gap-3">
            <input type="hidden" name="opcao" value="atualizar">
            <input type="hidden" name="id" value="<?= $trabalho['IDT'] ?>">

            <div>
              <label for="edit-nome" class="form-label">Nome do trabalho</label>
              <input id="edit-nome" type="text" name="nome" class="form-control" required value="<?= htmlspecialchars($trabalho['NOME_TRABALHO']) ?>">
            </div>

            <div>
              <label for="edit-cargo" class="form-label">Cargo</label>
              <input id="edit-cargo" type="text" name="cargo" class="form-control" required value="<?= htmlspecialchars($trabalho['CARGO']) ?>">
            </div>

            <div>
              <label for="edit-cep" class="form-label">CEP</label>
              <input id="edit-cep" type="text" name="cep" class="form-control js-mask-cep" required value="<?= htmlspecialchars($trabalho['CEP']) ?>">
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="dashboard.php" class="btn btn-outline-secondary">Cancelar</a>
              <button class="btn btn-primary" type="submit">Salvar alterações</button>
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
