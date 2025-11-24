<?php
require_once __DIR__ . '/../connectBD.php';

function cadastrarUsuario(string $nome, string $senhaSha1): bool
{
    connect();
    global $conexao;
    $nomeEsc  = mysqli_real_escape_string($conexao, $nome);
    $senhaEsc = mysqli_real_escape_string($conexao, $senhaSha1);
    $sql = "INSERT INTO usuario (NOME_USER, SENHA_USER) VALUES ('$nomeEsc', '$senhaEsc')";
    $ok = query($sql);
    closeConn();
    return (bool)$ok;
}

function buscarUsuario(string $nome): ?array
{
    connect();
    global $conexao;
    $nomeEsc = mysqli_real_escape_string($conexao, $nome);
    $sql     = "SELECT COD_USER, NOME_USER, SENHA_USER FROM usuario WHERE NOME_USER = '$nomeEsc' LIMIT 1";
    $res     = query($sql);
    $row     = $res ? mysqli_fetch_assoc($res) : null;
    closeConn();
    return $row ?: null;
}
