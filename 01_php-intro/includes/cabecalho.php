<!-- includes/cabecalho.php 
    Disciplina : Desenvolvimento Web II (DWII)
    Aula : 03 - Arquitetura Web e Introdução ao PHP
    Autor : Felipe Borges
    Data : 02/03/2026
    Repositorio : https://github.com/borgezmachado/2026-DWII
-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php
$cor_inicio   = ($pagina_atual == "inicio") ? "color:#f0b341; font-weight:bold;" : "color:white;";
$cor_sobre    = ($pagina_atual == "sobre") ? "color:#f0b341; font-weight:bold;" : "color:white;";
$cor_projetos = ($pagina_atual == "projetos") ? "color:#f0b341; font-weight:bold;" : "color:white;";
?>

<nav style="background: #b300ff; padding: 15px 30px; font-family: Arial, sans-serif;"><a href="index.php" style="<?php echo $cor_inicio; ?>">🏠 Início</a>
<a href="sobre.php" style="<?php echo $cor_sobre; ?>">👤 Sobre</a>
<a href="projetos.php" style="<?php echo $cor_projetos; ?>">🚀 Projetos</a>
</nav> 
</body>
</html>
