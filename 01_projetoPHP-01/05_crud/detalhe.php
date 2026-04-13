<?php
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

// B2: Valida que ID é inteiro
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$pdo = conectar();
$stmt = $pdo->prepare("SELECT * FROM projetos WHERE id = ?");
$stmt->execute([$id]);
$projeto = $stmt->fetch();

if (!$projeto) {
    die("Projeto não encontrado.");
}

$titulo_pagina = 'Detalhes: ' . $projeto['nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
<div class="container">
    <h1 class="titulo-secao">🔎 Detalhes do Projeto</h1>
    
    <div class="card" style="padding: 30px;">
        <h2><?= htmlspecialchars($projeto['nome']) ?></h2>
        <hr>
        <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($projeto['descricao'])) ?></p>
        <p><strong>Tecnologias:</strong> <?= htmlspecialchars($projeto['tecnologias']) ?></p>
        <p><strong>Ano:</strong> <?= htmlspecialchars($projeto['ano']) ?></p>
        <p><strong>Data de Cadastro:</strong> <?= date('d/m/Y H:i', strtotime($projeto['criado_em'])) ?></p>
        
        <?php if ($projeto['link_github']): ?>
            <p><strong>Link:</strong> <a href="<?= htmlspecialchars($projeto['link_github']) ?>" target="_blank"><?= htmlspecialchars($projeto['link_github']) ?></a></p>
        <?php endif; ?>

        <div style="margin-top: 30px;">
            <a href="index.php" class="btn-secundario">← Voltar para a Lista</a>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>