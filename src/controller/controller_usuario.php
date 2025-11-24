<?php
include __DIR__ . '/../model/crud_usuario.php';
session_start();

$opcao = $_POST['opcao'] ?? '';

switch ($opcao) {
  case 'cadastrar':
    $nome  = trim($_POST['nome'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($nome !== '' && $senha !== '' && cadastrarUsuario($nome, sha1($senha))) {
      header('Location: ../view/login.php?m=Usuário%20cadastrado%20com%20sucesso!');
    } else {
      header('Location: ../view/cadastrar_usuario.php?m=Erro%20ao%20cadastrar!');
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
          $_SESSION['id']   = (int)$linha['COD_USER'];
          $_SESSION['nome'] = $linha['NOME_USER'];
          header('Location: ../view/dashboard.php');
          exit;
        }
      }
      header('Location: ../view/login.php?m=Senha%20incorreta!');
      exit;
    }
    header('Location: ../view/login.php?m=Nome%20incorreto!');
    exit;

  case 'sair':
    $_SESSION = [];
    session_destroy();
    header('Location: ../view/login.php?m=Você%20saiu%20do%20sistema!');
    exit;

  default:
    header('Location: ../view/login.php');
    exit;
}
