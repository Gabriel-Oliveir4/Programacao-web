<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (empty($_SESSION['nome'])) {
  header('Location: pages/login.php?m=Faça%20login%20para%20continuar');
  exit;
}
