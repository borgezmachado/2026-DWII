


<?php
// Incluir a conexão PDO
require_once 'includes/conexao.php';

// Variáveis para o cabeçalho global
$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual = "catalogo";
$caminho_raiz = '../'; // Ajuste conforme sua estrutura

// 1. Capturar os parâmetros da URL (Sempre em MAIÚSCULAS: $_GET)
$busca = trim($_GET['busca'] ?? '');
$categoria_filtro = trim($_GET['categoria'] ?? '');

// 2. Buscar Categorias Únicas para o Menu (SELECT DISTINCT)
$stmt_cats = $pdo->query("SELECT DISTINCT categoria FROM tecnologias ORDER BY categoria ASC");
$categorias_unicas = $stmt_cats->fetchAll();

// 3. Lógica de Consulta (Busca vs Filtro vs Tudo)
if ($busca) {
    // RESOLUÇÃO DO ERRO: Usamos dois placeholders diferentes (:t1 e :t2) 
    // para garantir compatibilidade em qualquer servidor PDO.
    $termo = "%$busca%";
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE nome LIKE :t1 OR descricao LIKE :t2 ORDER BY nome ASC");
    $stmt->execute([
        't1' => $termo,
        't2' => $termo
    ]);
} elseif ($categoria_filtro) {
    // Filtro por categoria exata
    $stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE categoria = :cat ORDER BY nome ASC");
    $stmt->execute(['cat' => $categoria_filtro]);
} else {
    // Sem filtros: lista tudo
    $stmt = $pdo->query("SELECT * FROM tecnologias ORDER BY nome ASC");
}

$tecnologias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="titulo-secao">💻 Catálogo de Tecnologias</h1>

        <form action="index.php" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="busca" 
                   placeholder="Digite o nome ou descrição..." 
                   value="<?= htmlspecialchars($busca) ?>" 
                   style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            <button type="submit" style="padding: 10px 20px; cursor: pointer; background: #3b579d; color: white; border: none; border-radius: 5px;">
                Buscar
            </button>
            <?php if ($busca || $categoria_filtro): ?>
                <a href="index.php" style="padding: 10px; text-decoration: none; background: #eee; color: #333; border-radius: 5px;">Limpar</a>
            <?php endif; ?>
        </form>

        <div style="margin-bottom: 30px;">
            <strong>Filtrar por:</strong>
            <a href="index.php" style="margin: 0 10px; text-decoration: none; <?= !$categoria_filtro ? 'font-weight:bold; color:black;' : '' ?>">Todas</a>
            <?php foreach ($categorias_unicas as $cat): ?>
                <a href="index.php?categoria=<?= urlencode($cat['categoria']) ?>" 
                   style="margin-right: 15px; text-decoration: none; color: #3b579d; <?= $categoria_filtro === $cat['categoria'] ? 'font-weight:bold; text-decoration:underline;' : '' ?>">
                   <?= htmlspecialchars($cat['categoria']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <p style="color: #6b7280;">
            <?= count($tecnologias) ?> tecnologia(s) encontrada(s)
            <?php if($busca) echo " para: '" . htmlspecialchars($busca) . "'"; ?>
        </p>

        <?php if (count($tecnologias) > 0): ?>
            <?php foreach ($tecnologias as $tec): ?>
                <div class="card" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="margin: 0;"><?= htmlspecialchars($tec['nome']) ?></h3>
                        <span style="background: #e8edf5; color: #3b579d; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                            <?= htmlspecialchars($tec['categoria']) ?>
                        </span>
                    </div>
                    <p style="margin: 15px 0; color: #444;">
                        <?= htmlspecialchars(mb_strimwidth($tec['descricao'], 0, 150, "...")) ?>
                    </p>
                    <a href="detalhe.php?id=<?= $tec['id'] ?>" style="color: #3b579d; font-weight: bold; text-decoration: none;">
                        Ver detalhes →
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="text-align: center; padding: 40px;">
                <p>Nenhum resultado encontrado para sua pesquisa.</p>
                <a href="index.php">Ver todo o catálogo</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/rod_pdo.php'; ?>
</body>
</html>