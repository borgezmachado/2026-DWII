<!-- 01_php-intro/projetos.php 
    Disciplina : Desenvolvimento Web II (DWII)
    Aula : 03 - Arquitetura Web e Introdução ao PHP
    Autor : Felipe Borges
    Data : 02/03/2026
    Repositorio : https://github.com/borgezmachado/2026-DWII
-->
<?php
$nome         = "Borges";
$pagina_atual = "projetos";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
<?php include 'includes/cabecalho.php'; ?>



<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">

<h2 style="color:#3b579d;">Site de conexão com BD sobre Periodo Historico</h2>
<p>Ultimo trabalho do ano em DW I , conexão de banco de dados para adicionar, alterar ou excluir um periodo historico.</p>

<h2 style="color:#3b579d;">Concertar computadores / arquitetura e manutenção de computadores</h2>
<p>Fundamentos basicos sobre arquitetura e manutenção de computadores primeiro ano do IFPR.</p>

<h2 style="color:#3b579d;">Projeto de vôlei</h2>
<p>Ajudo nas aulas e treinamentos fundamentais do volei pela escola</p>

</div>

<?php include 'includes/rodape.php'; ?>

</body>
</html>