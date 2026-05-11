<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : sobre.php  (migrado de 01_php-intro/sobre.php)
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * ════════════════════════════════════════════════════════════
 */

// session_start() ANTES de qualquer saída HTML.
// Necessário aqui — cabecalho.php é incluído dentro do <head>,
// após o início do output HTML, tarde demais para iniciar sessão.
if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Ordem padrão: $pagina_atual → $titulo_pagina → $caminho_raiz
// Sem session_start() — cabecalho.php centraliza.
// Sem $nome — cabecalho.php fornece o fallback.
$pagina_atual  = 'sobre';
$titulo_pagina = 'Sobre | Portfólio DWII';
$caminho_raiz  = './';
$nome      = 'Felipe Borges';
$formacoes = [
    "Técnico em Informática — IFPR (em andamento)",
    "Curso de Desenvolvimento Web (2025)",
    // ← adicione suas formações aqui
];
?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
  <!-- ✅ '/../includes/' → '/includes/' -->
  <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
  <div class="container">
    <h1 class="titulo-secao">👤 Sobre mim</h1>

<div class="card">
  <h3>Quem sou eu</h3>
  <!-- $nome disponível via fallback do cabecalho.php -->
  <p>Olá! Sou <strong><?php echo htmlspecialchars($nome); ?></strong>,
     estudante do 3º ano do Técnico em Informática no IFPR de Ponta Grossa.</p>
</div>

<div class="card">
  <h3>Formação</h3>
  <ul style="margin: 0; padding-left: 20px; color: #374151;">
    <?php foreach ($formacoes as $item): ?>
      <li style="margin-bottom: 6px;"><?php echo htmlspecialchars($item); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
  </div>

  <!-- ✅ '/../includes/' → '/includes/' -->

  <?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>