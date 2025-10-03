<?php
    include 'crudUsuario.php';

    $opcao = $_POST["opcao"];

    switch ($opcao) {
        case 'cadastrar':
            cadastrarUsuario($_POST["nome"], sha1($_POST["senha"]));
            header("Location: cadastrarUsuario.php");
            exit;

        case 'entrar':
            $nome= $_POST["nome"];
            $senha=sha1($_POST["senha"]);

            $resultados=buscarUsuario($nome);

            foreach ($resultados as $linha) {
                if($nome === $linha["nome"]){
                    if($senha === $linha["senha"]){
                        session_start();
                        $_SESSION["nome"]=$nome;
                        header("Location: home.php");
                    } else {
                        echo "<script>alert('Senha Incorreta!');</script>";
                        echo "<script>window.location = 'login.php';</script>";
                        exit;
                    }
                }
            }
              echo "<script>alert('Nome Incorreto!');</script>";
              echo "<script>window.location = 'login.php';</script>";
?>