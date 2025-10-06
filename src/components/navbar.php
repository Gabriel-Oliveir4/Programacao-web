<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$currentPage = $currentPage ?? '';

$__root = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$__pos  = strpos($__root, '/src/');
$__base = $__pos !== false ? substr($__root, 0, $__pos) : '';

function url($path = '')
{
  global $__base;
  return rtrim($__base, '/') . '/' . ltrim($path, '/');
}

$logged   = !empty($_SESSION['nome']);
$userName = $logged ? $_SESSION['nome'] : null;
?>
<nav class="navbar navbar-light bg-white border-bottom shadow-sm">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="navbar-brand fw-semibold" href="<?= url('src/pages/filmes/dashboard.php') ?>">Locadora</a>

    <?php if ($logged): ?>
      <div class="d-flex align-items-center gap-3">
        <form method="post" action="<?= url('src/controller/controller_usuario.php') ?>" class="m-0">
          <input type="hidden" name="opcao" value="sair">
          <button type="submit" class="btn btn-sm btn-outline-danger">Sair</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</nav>