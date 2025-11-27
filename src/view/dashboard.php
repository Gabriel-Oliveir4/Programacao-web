<?php
require_once __DIR__ . '/../session.php';
require_once __DIR__ . '/../model/crud_trabalho.php';

$usuarioId = (int)($_SESSION['id'] ?? 0);
$trabalhos = $usuarioId ? listarTrabalhos($usuarioId) : [];
$title     = "Trabalhos";
$currentPage = "trabalhos";
$mensagem  = $_GET['m'] ?? '';
$usuario   = $_SESSION['nome'] ?? '';

include __DIR__ . '/../componentes/head.php';
include __DIR__ . '/../componentes/navbar.php';
?>

<div class="container py-4">
  <p class="mb-3">Olá, <strong><?= htmlspecialchars($usuario) ?></strong>, bem-vindo!</p>

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
          <th>Cargo</th>
          <th>CEP</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($trabalhos): ?>
          <?php foreach ($trabalhos as $t): ?>
            <tr>
              <td><?= $t['IDT'] ?></td>
              <td><?= htmlspecialchars($t['NOME_TRABALHO']) ?></td>
              <td><?= htmlspecialchars($t['CARGO']) ?></td>
              <td><?= htmlspecialchars($t['CEP']) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-warning" href="editar_trabalho.php?id=<?= $t['IDT'] ?>">Editar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Nenhum trabalho cadastrado para este usuário.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
