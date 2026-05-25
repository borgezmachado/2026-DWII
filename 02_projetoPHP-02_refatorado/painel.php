<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula : 13 - Refatoracao Parte V: Painel admin
 * Arquivo : painel.php (raiz)
 * Descricao : Area restrita - porta de entrada para o painel admin.
 */

require_once __DIR__ . '/includes/auth.php';
requer_login();

$pagina_atual  = 'painel';
$titulo_pagina = 'Painel - Portfolio';
$caminho_raiz  = './';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
<main>
    <div class="container">
        <h1 class="titulo-secao">Painel</h1>
        
        <p>Ola, <strong><?php echo htmlspecialchars(usuario_atual()); ?></strong>! 
        Voce esta em uma area restrita.</p>
        
        <p style="margin-top: 20px;">
            <a href="admin.php" class="btn-primario">Gerenciar projetos</a>
        </p>
    </div>
</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>