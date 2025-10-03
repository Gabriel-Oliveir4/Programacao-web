<?php
$currentPage = $currentPage ?? '';

function isActive($page, $current) {
  return $page === $current ? 'active fw-semibold' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="/index.php">Produtos</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <a class="nav-link <?= isActive('produtos', $currentPage) ?>" href="/index.php">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive('cadastrar', $currentPage) ?>" href="/pages/cadastrar.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActive('mostrar', $currentPage) ?>" href="/pages/mostrar.php">Mostrar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
