<?php
include __DIR__ . '/../model/crud_filme.php';
session_start();

$usuarioId = (int)($_SESSION['id'] ?? 0);
if ($usuarioId <= 0) {
  header('Location: ../view/login.php?m=Faça%20login%20novamente');
  exit;
}

$opcao = $_POST['opcao'] ?? $_GET['opcao'] ?? '';

switch ($opcao) {
  case 'cadastrar':
  case 'criar':
    $nome    = trim($_POST['nome'] ?? '');
    $tipo    = trim($_POST['tipo'] ?? '');
    $duracao = trim($_POST['duracao'] ?? '');
    if ($nome !== '' && $tipo !== '' && $duracao !== '' && cadastrarFilme($nome, $tipo, $duracao, $usuarioId)) {
      header('Location: ../view/dashboard.php?m=Filme%20cadastrado!');
    } else {
      header('Location: ../view/cadastrar_filme.php?m=Erro%20ao%20cadastrar');
    }
    exit;

  case 'atualizar':
    $id      = (int)($_POST['id'] ?? 0);
    $nome    = trim($_POST['nome'] ?? '');
    $tipo    = trim($_POST['tipo'] ?? '');
    $duracao = trim($_POST['duracao'] ?? '');
    if ($id > 0 && $nome !== '' && $tipo !== '' && $duracao !== '' && atualizarFilme($id, $nome, $tipo, $duracao, $usuarioId)) {
      header('Location: ../view/dashboard.php?m=Filme%20atualizado!');
    } else {
      header("Location: ../view/editar_filme.php?id={$id}&m=Erro%20ao%20atualizar");
    }
    exit;

  case 'excluir':
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0 && excluirFilme($id, $usuarioId)) {
      header('Location: ../view/dashboard.php?m=Filme%20excluído!');
    } else {
      header('Location: ../view/dashboard.php?m=Erro%20ao%20excluir');
    }
    exit;

  default:
    header('Location: ../view/dashboard.php');
    exit;
}
