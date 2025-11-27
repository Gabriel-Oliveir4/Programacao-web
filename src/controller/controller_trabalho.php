<?php
include __DIR__ . '/../model/crud_trabalho.php';
session_start();

$usuarioId = (int)($_SESSION['id'] ?? 0);
if ($usuarioId <= 0) {
  header('Location: ../view/login.php?m=Faça%20login%20novamente');
  exit;
}

$opcao = $_POST['opcao'] ?? $_GET['opcao'] ?? '';

switch ($opcao) {
  case 'atualizar':
    $id    = (int)($_POST['id'] ?? 0);
    $nome  = trim($_POST['nome'] ?? '');
    $cargo = trim($_POST['cargo'] ?? '');
    $cep   = trim($_POST['cep'] ?? '');

    if ($id > 0 && $nome !== '' && $cargo !== '' && $cep !== '' && atualizarTrabalho($id, $nome, $cargo, $cep, $usuarioId)) {
      header('Location: ../view/dashboard.php?m=Trabalho%20atualizado!');
    } else {
      header("Location: ../view/editar_trabalho.php?id={$id}&m=Erro%20ao%20atualizar");
    }
    exit;

  default:
    header('Location: ../view/dashboard.php');
    exit;
}
