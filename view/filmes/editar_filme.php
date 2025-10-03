<?php 
  $title = "Editar Filme"; 
  $currentPage = "filmes"; 
?>

<?php include __DIR__ . "/../../components/head.php"; ?>
<?php include __DIR__ . "/../../components/navbar.php"; ?>

<div class="container py-4">
  <h2>Editar Filme</h2>
  <form>
    <div class="mb-3">
      <label for="titulo" class="form-label">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" value="Filme Exemplo">
    </div>
    <div class="mb-3">
      <label for="duracao" class="form-label">Duração</label>
      <input type="text" class="form-control" id="duracao" name="duracao" value="02:15">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
