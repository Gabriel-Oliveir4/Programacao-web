<?php
require_once __DIR__ . '/../connectBD.php';

function cadastrarFilme(string $nome, string $tipo, string $duracao, int $usuarioId): bool
{
  connect();
  global $conexao;
  $nomeEsc     = mysqli_real_escape_string($conexao, $nome);
  $tipoEsc     = mysqli_real_escape_string($conexao, $tipo);
  $duracaoEsc  = mysqli_real_escape_string($conexao, $duracao);
  $usuarioSafe = (int)$usuarioId;
  $sql = "INSERT INTO filmes (NOME_FILME, TIPO_FILME, DURACAO_FILME, COD_USER)
          VALUES ('$nomeEsc', '$tipoEsc', '$duracaoEsc', $usuarioSafe)";
  $ok = query($sql);
  closeConn();
  return (bool)$ok;
}

function listarFilmes(int $usuarioId): array
{
  connect();
  $usuarioSafe = (int)$usuarioId;
  $sql = "SELECT COD_FILME, NOME_FILME, TIPO_FILME, DURACAO_FILME, COD_USER
          FROM filmes
          WHERE COD_USER = $usuarioSafe
          ORDER BY COD_FILME DESC";
  $res = query($sql);
  $rows = [];
  while ($r = mysqli_fetch_assoc($res)) {
    $rows[] = $r;
  }
  closeConn();
  return $rows;
}

function buscarFilmePorId(int $id, ?int $usuarioId = null): ?array
{
  connect();
  $id = (int)$id;
  $userFilter = $usuarioId !== null ? ' AND COD_USER = ' . (int)$usuarioId : '';
  $sql = "SELECT COD_FILME, NOME_FILME, TIPO_FILME, DURACAO_FILME, COD_USER FROM filmes WHERE COD_FILME = $id$userFilter LIMIT 1";
  $res = query($sql);
  $row = $res ? mysqli_fetch_assoc($res) : null;
  closeConn();
  return $row ?: null;
}

// Mantemos o filtro por usuário mesmo recebendo um ID único de filme para impedir
// que um usuário edite filmes de outra conta ao adivinhar o identificador.
function atualizarFilme(int $id, string $nome, string $tipo, string $duracao, int $usuarioId): bool
{
  connect();
  global $conexao;
  $id         = (int)$id;
  $nomeEsc    = mysqli_real_escape_string($conexao, $nome);
  $tipoEsc    = mysqli_real_escape_string($conexao, $tipo);
  $duracaoEsc = mysqli_real_escape_string($conexao, $duracao);
  $userSafe   = (int)$usuarioId;
  $sql = "UPDATE filmes SET NOME_FILME = '$nomeEsc', TIPO_FILME = '$tipoEsc', DURACAO_FILME = '$duracaoEsc' WHERE COD_FILME = $id AND COD_USER = $userSafe";
  $ok = query($sql);
  closeConn();
  return (bool)$ok;
}

// O filtro de usuário no delete evita que um usuário remova registros de terceiros.
function excluirFilme(int $id, int $usuarioId): bool
{
  connect();
  $id       = (int)$id;
  $userSafe = (int)$usuarioId;
  $ok = query("DELETE FROM filmes WHERE COD_FILME = $id AND COD_USER = $userSafe");
  closeConn();
  return (bool)$ok;
}
