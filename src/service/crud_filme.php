<?php
require_once __DIR__ . '/../connectBD.php';

function cadastrarFilme(string $nome, string $tipo, string $duracao): bool
{
  connect();
  global $conexao;
  $nomeEsc    = mysqli_real_escape_string($conexao, $nome);
  $tipoEsc    = mysqli_real_escape_string($conexao, $tipo);
  $duracaoEsc = mysqli_real_escape_string($conexao, $duracao);
  $sql = "INSERT INTO filmes (NOME_FILME, TIPO_FILME, DURACAO_FILME)
          VALUES ('$nomeEsc', '$tipoEsc', '$duracaoEsc')";
  $ok = query($sql);
  closeConn();
  return (bool)$ok;
}

function listarFilmes(): array
{
  connect();
  $sql = "SELECT COD_FILME, NOME_FILME, TIPO_FILME, DURACAO_FILME
          FROM filmes
          ORDER BY COD_FILME DESC";
  $res = query($sql);
  $rows = [];
  while ($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
  }
  closeConn();
  return $rows;
}

function buscarFilmePorId(int $id): ?array
{
  connect();
  $id = (int)$id;
  $sql = "SELECT COD_FILME, NOME_FILME, TIPO_FILME, DURACAO_FILME FROM filmes WHERE COD_FILME = $id LIMIT 1";
  $res = query($sql);
  $row = $res ? mysqli_fetch_assoc($res) : null;
  closeConn();
  return $row ?: null;
}

function atualizarFilme(int $id, string $nome, string $tipo, string $duracao): bool
{
  connect();
  global $conexao;
  $id        = (int)$id;
  $nomeEsc   = mysqli_real_escape_string($conexao, $nome);
  $tipoEsc   = mysqli_real_escape_string($conexao, $tipo);
  $duracaoEsc = mysqli_real_escape_string($conexao, $duracao);
  $sql = "UPDATE filmes SET NOME_FILME = '$nomeEsc', TIPO_FILME = '$tipoEsc', DURACAO_FILME = '$duracaoEsc' WHERE COD_FILME = $id";
  $ok = query($sql);
  closeConn();
  return (bool)$ok;
}

function excluirFilme(int $id): bool
{
  connect();
  $id = (int)$id;
  $ok = query("DELETE FROM filmes WHERE COD_FILME = $id");
  closeConn();
  return (bool)$ok;
}
