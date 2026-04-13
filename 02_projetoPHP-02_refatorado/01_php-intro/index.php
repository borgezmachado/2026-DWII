<!-- 01_php-intro/index.php -->
<!--
    Disciplina : Desenvolvimento Web II (DWII)
    Aula : 03 - Arquitetura Web e Introdução ao PHP
    Autor : Felipe Borges
    Data : 02/03/2026
    Repositorio : https://github.com/borgezmachado/2026-DWII
-->

<?php
$nome         = "Borges";
$profissao    = "Estudante de Tecnologia";
$curso        = "Técnico em Informática – IFPR";
$pagina_atual = "inicio";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio – <?php echo $nome; ?></title>

<link rel="stylesheet" href="../includes/style.css">cd ~/workspaces/2026-DWII
</head>
<body>

<?php include '../includes/cabecalho.php'; ?>


<div class="hero" style="background: linear-gradient(135deg, #b300ff, #b300ff); color: white; text-align: center; padding: 60px 20px;">
    
    <h1 style="font-size: 2.5em; margin: 0 0 10px 0;">
        <?php echo $nome; ?>
    </h1>

    <p style="font-size: 1.2em; opacity: 0.9;">
        <?php echo $profissao; ?> | <?php echo $curso; ?>
    </p>

</div>

<?php include '../includes/rodape.php'; ?>

</body>
</html>