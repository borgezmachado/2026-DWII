<?php
/**
 * =========================================================================
 * ARQUIVO     : 02_formularios/obrigado.php
 * Disciplina  : Desenvolvimento Web II (2026-DWII)
 * Aula        : 04 – PHP para Web: Formulários, GET e POST
 * Autor       : [SEU NOME AQUI]
 * Conceitos   : header() + exit (PRG), $_GET para parâmetros
 * de confirmação, htmlspecialchars()
 * =========================================================================
 *
 * Página de confirmação – destino do redirecionamento PRG.
 * Recebe o nome via GET apenas para exibição amigável.
 * Nenhum dado de formulário é processado aqui.
 */

// —- VARIÁVEIS DO TEMPLATE ——————————————————————————————————————————————
$nome           = "Felipe Borges";
$pagina_atual   = "contato";  // mantém "contato" ativo no menu
$caminho_raiz   = "./";
$titulo_pagina  = "Obrigado!";

// Recebe o nome enviado pelo header() em contato.php
// ?? 'visitante' garante fallback se alguém acessar a URL diretamente
$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'visitante');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>

    <link rel="stylesheet" href="./includes/style.css">
</head>

<?php include './includes/cabecalho.php'; ?>
<div class="container confirmacao">
    <p class="confirmacao-icone">✅</p>
    <h1 class="confirmacao-titulo">
        Obrigado, <?php echo $nome_visitante; ?>!
    </h1>
    <p class="confirmacao-texto">
        Sua mensagem foi recebida. Entrarei em contato em breve.
    </p>
    <a href="contato.php" class="btn">← Enviar outra mensagem</a>
</div>

<?php include './includes/rodape.php'; ?>