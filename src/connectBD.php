<?php
$conexao;

function connect()
{
    global $conexao;
    $servidor = 'localhost';
    $usuario  = 'root';
    $senha    = '';
    $base     = 'LOCADORA'; 

    $conexao = mysqli_connect($servidor, $usuario, $senha, $base) or die(mysqli_connect_error());
}

function query($sql)
{
    global $conexao;
    mysqli_query($conexao, "SET NAMES utf8mb4");
    $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    return $res;
}

function closeConn()
{
    global $conexao;
    if ($conexao) mysqli_close($conexao);
}
