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
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f3f4f6; }
        nav  { background: #b300ff; padding: 15px 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        
        .hero { 
            background: linear-gradient(135deg, #b300ff, #b300ff); 
            color: white;
            text-align: center; 
            padding: 60px 20px; 
        }
        .hero h1 { font-size: 2.5em; margin-bottom: 10px; }
        .hero p  { font-size: 1.2em; opacity: 0.9; }
        
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        
        footer { 
            background: #010000; 
            color: #6b7280; 
            text-align: center;
            padding: 20px; 
            margin-top: 60px; 
            font-size: 14px; 
        }
    </style>
</head>
<body>
    <?php include 'includes/cabecalho.php'; ?>

<div class = "hero">
    <h1><?php echo $nome; ?></h1>
     <p><?php echo $profissao; ?> | <?php echo $curso; ?></p>
     
</div>
 <?php include 'includes/rodape.php'; ?>
   

</body>
</html>