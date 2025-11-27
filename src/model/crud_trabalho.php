<?php
require_once __DIR__ . '/../connectBD.php';

function listarTrabalhos(int $usuarioId): array
{
    connect();
    $usuarioSafe = (int)$usuarioId;
    $sql = "SELECT IDT, NOME_TRABALHO, CARGO, CEP, IDU FROM trabalho WHERE IDU = $usuarioSafe ORDER BY IDT DESC";
    $res = query($sql);
    $rows = [];
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    closeConn();
    return $rows;
}

function buscarTrabalhoPorId(int $id, int $usuarioId): ?array
{
    connect();
    $idSafe   = (int)$id;
    $userSafe = (int)$usuarioId;
    $sql = "SELECT IDT, NOME_TRABALHO, CARGO, CEP, IDU FROM trabalho WHERE IDT = $idSafe AND IDU = $userSafe LIMIT 1";
    $res = query($sql);
    $row = $res ? mysqli_fetch_assoc($res) : null;
    closeConn();
    return $row ?: null;
}

function atualizarTrabalho(int $id, string $nome, string $cargo, string $cep, int $usuarioId): bool
{
    connect();
    global $conexao;
    $idSafe    = (int)$id;
    $userSafe  = (int)$usuarioId;
    $nomeEsc   = mysqli_real_escape_string($conexao, $nome);
    $cargoEsc  = mysqli_real_escape_string($conexao, $cargo);
    $cepEsc    = mysqli_real_escape_string($conexao, $cep);
    $sql = "UPDATE trabalho SET NOME_TRABALHO = '$nomeEsc', CARGO = '$cargoEsc', CEP = '$cepEsc' WHERE IDT = $idSafe AND IDU = $userSafe";
    $ok = query($sql);
    closeConn();
    return (bool)$ok;
}
