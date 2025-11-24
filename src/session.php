<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (empty($_SESSION['nome']) || empty($_SESSION['id'])) {
  header('Location: view/login.php?m=Faça%20login%20para%20continuar');
  exit;
}
