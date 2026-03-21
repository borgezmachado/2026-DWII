<?php
// Define o caminho para o CSS global que está na raiz
$caminho_raiz = '../';
$titulo_pagina = "404 - Não Encontrado";
$pagina_atual = "404";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>

<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        
        <h1 class="titulo-secao">Página não encontrada (404)</h1>
        
        <div class="card" style="padding: 40px; display: inline-block;">
            <p>A tecnologia ou o ID informado não foi encontrado no banco de dados.</p>
            <br>
            <a href="index.php" style="color: #3b579d; font-weight: bold; text-decoration: none;">
                ← Voltar para o Catálogo
            </a>
        </div>

    </div>

    <?php include 'includes/rod_pdo.php'; ?>
</body>
</html>