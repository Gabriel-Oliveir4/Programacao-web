<?php
include __DIR__ . '/../service/crud_usuario.php';
session_start();

$opcao = $_POST['opcao'] ?? '';

switch ($opcao) {
  case 'cadastrar':
    $nome  = trim($_POST['nome'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($nome !== '' && $senha !== '' && cadastrarUsuario($nome, sha1($senha))) {
      header('Location: ../pages/login.php?m=Usuário%20cadastrado%20com%20sucesso!');
    } else {
      header('Location: ../pages/cadastrar_usuario.php?m=Erro%20ao%20cadastrar!');
    }
    exit;

  case 'entrar':
    $nome     = trim($_POST['nome'] ?? '');
    $senhaRaw = $_POST['senha'] ?? '';
    $senhaSha = sha1($senhaRaw);

    $resultados = buscarUsuario($nome);
    if (!empty($resultados)) {
      foreach ($resultados as $linha) {
        if ($nome === ($linha['NOME_USER'] ?? null) && $senhaSha === ($linha['SENHA_USER'] ?? null)) {
          $_SESSION['nome'] = $linha['NOME_USER'];
          header('Location: ../pages/filmes/dashboard.php');
          exit;
        }
      }
      header('Location: ../pages/login.php?m=Senha%20incorreta!');
      exit;
    }
    header('Location: ../pages/login.php?m=Nome%20incorreto!');
    exit;

  case 'sair':
    $_SESSION = [];
    session_destroy();
    header('Location: ../pages/login.php?m=Você%20saiu%20do%20sistema!');
    exit;

  default:
    header('Location: ../pages/login.php');
    exit;
}
