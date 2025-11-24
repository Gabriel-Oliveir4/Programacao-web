<?php
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../model/crud_filme.php';

$usuarioId = (int)($_SESSION['id'] ?? 0);
$id = (int)($_GET['id'] ?? 0);
$filme = $id ? buscarFilmePorId($id, $usuarioId) : null;
if (!$filme) {
  header('Location: dashboard.php?m=Filme%20não%20encontrado');
  exit;
}

$title = "Editar Filme #{$filme['COD_FILME']}";
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
          <h1 class="h4 mb-4 text-center">Editar filme #<?= $filme['COD_FILME'] ?></h1>

          <?php if ($mensagem): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($mensagem) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="../controller/controller_filme.php" class="vstack gap-3">
            <input type="hidden" name="opcao" value="atualizar">
            <input type="hidden" name="id" value="<?= $filme['COD_FILME'] ?>">

            <div>
              <label for="edit-nome" class="form-label">Nome</label>
              <input id="edit-nome" type="text" name="nome" class="form-control" required value="<?= htmlspecialchars($filme['NOME_FILME']) ?>">
            </div>

            <div>
              <label for="edit-tipo" class="form-label">Tipo</label>
              <input id="edit-tipo" type="text" name="tipo" class="form-control" required value="<?= htmlspecialchars($filme['TIPO_FILME']) ?>">
            </div>

            <div>
              <label for="edit-duracao" class="form-label">Duração</label>
              <input id="edit-duracao" type="text" name="duracao" class="form-control" required value="<?= htmlspecialchars($filme['DURACAO_FILME']) ?>">
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