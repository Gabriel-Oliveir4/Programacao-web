<?php
session_start();
if (empty($_SESSION['nome'])) {
  header('Location: ../../login.php?m=Faça%20login%20para%20continuar');
  exit;
}
require_once __DIR__ . '/../../service/crud_filme.php';

$filmes   = listarFilmes();
$title    = "Dashboard de Filmes";
$currentPage = "filmes";
$mensagem = $_GET['m'] ?? '';
$usuario  = $_SESSION['nome'] ?? '';

include __DIR__ . '/../../components/head.php';
include __DIR__ . '/../../components/navbar.php';
?>

<div class="container py-4">
  <p class="mb-3">Olá, <strong><?= htmlspecialchars($usuario) ?></strong>, bem-vindo(a) ao sistema!</p>

  <?php if ($mensagem): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($mensagem) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Tipo</th>
          <th>Duração</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($filmes): ?>
          <?php foreach ($filmes as $f): ?>
            <tr>
              <td><?= $f['COD_FILME'] ?></td>
              <td><?= htmlspecialchars($f['NOME_FILME']) ?></td>
              <td><?= htmlspecialchars($f['TIPO_FILME']) ?></td>
              <td><?= htmlspecialchars($f['DURACAO_FILME']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-warning me-1" href="editar_filme.php?id=<?= $f['COD_FILME'] ?>">Editar</a>
                <button
                  class="btn btn-sm btn-danger"
                  data-bs-toggle="modal"
                  data-bs-target="#modalExcluir"
                  data-id="<?= $f['COD_FILME'] ?>"
                  data-nome="<?= htmlspecialchars($f['NOME_FILME']) ?>">
                  Excluir
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted">Nenhum filme cadastrado.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    <a class="btn btn-primary" href="cadastrar_filme.php">+ Cadastrar filme</a>
  </div>
</div>

<div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="../../controller/controller_filme.php">
        <input type="hidden" name="opcao" value="excluir">
        <input type="hidden" name="id" id="excluir-id">
        <div class="modal-header">
          <h5 class="modal-title">Excluir filme</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir o filme <strong id="excluir-nome"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
  const btn = event.relatedTarget;
  this.querySelector('#excluir-id').value = btn.getAttribute('data-id');
  this.querySelector('#excluir-nome').textContent = btn.getAttribute('data-nome');
});
</script>
</body>
</html>
