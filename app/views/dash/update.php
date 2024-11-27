<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Estacionamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Saída - Estacionamento</h2>

    <!-- Formulário para adicionar novo veículo -->
    <form method="POST" action="/dash/update" class="mb-4">
        <div class="form-group">
            <label for="placa">Placa:</label>
            <input type="text" class="form-control" id="placa" name="placa" required>
        </div>
        <button type="submit" name="adicionar" class="btn btn-primary">Adicionar Veículo</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
?>