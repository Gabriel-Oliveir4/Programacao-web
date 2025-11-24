<?php
$__rootPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$__posBase  = strpos($__rootPath, '/src/');
$__basePath = $__posBase !== false ? substr($__rootPath, 0, $__posBase) : '';
$assetBase  = rtrim($__basePath, '/');
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Sistema') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="<?= $assetBase ?>/src/masks.js"></script>
</head>
<body class="bg-light">
