<?php
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();
require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();

// --- Lógica de Busca e Paginação (Mantida do seu original) ---
$busca = trim($_GET['busca'] ?? '');
$itens_por_pagina = 3;
$pagina_atual = max(1, (int)($_GET['pagina'] ?? 1));
$offset = ($pagina_atual - 1) * $itens_por_pagina;

$params = [];
$where = "";

if ($busca !== '') {
    $where = " WHERE nome LIKE :termo1 OR tecnologias LIKE :termo2";
    $params[':termo1'] = '%' . $busca . '%';
    $params[':termo2'] = '%' . $busca . '%';
}

$sql_count = "SELECT COUNT(*) FROM projetos" . $where;
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute($params);
$total_registros = $stmt_count->fetchColumn();
$total_paginas = ceil($total_registros / $itens_por_pagina);

$sql = "SELECT * FROM projetos" . $where . " ORDER BY criado_em DESC LIMIT $itens_por_pagina OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projetos = $stmt->fetchAll();

// --- NOVO: Detecção de mensagens de feedback (Aula 08) ---
$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';
$editadoOk  = isset($_GET['editado'])  && $_GET['editado']  === 'ok';
$excluidoOk = isset($_GET['excluido']) && $_GET['excluido'] === 'ok';

// Erros redirecionados por editar.php e excluir.php
$erroMsg = isset($_GET['erro']) ? $_GET['erro'] : '';

$titulo_pagina = 'Meus Projetos — Portfólio';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
    <style>
        .pagination { display: flex; justify-content: center; gap: 10px; margin-top: 20px; }
        .pagination a { padding: 8px 16px; background: #eee; text-decoration: none; border-radius: 4px; color: #333; }
        .pagination a.active { background: #3b579d; color: white; }
        .busca-container { margin-bottom: 25px; display: flex; gap: 10px; }
        .busca-container input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        /* Estilos para alertas */
        .alerta-sucesso { background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb; }
        .alerta-erro { background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="titulo-secao" style="margin:0">📂 Meus Projetos</h1>
        <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
    </div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso"><p style="margin: 0;">✅ Projeto cadastrado com sucesso!</p></div>
    <?php endif; ?>

    <?php if ($editadoOk): ?>
        <div class="alerta-sucesso"><p style="margin: 0;">✅ Projeto atualizado com sucesso!</p></div>
    <?php endif; ?>

    <?php if ($excluidoOk): ?>
        <div class="alerta-sucesso"><p style="margin: 0;">🗑️ Projeto removido com sucesso!</p></div>
    <?php endif; ?>

    <?php if ($erroMsg === 'nao_encontrado'): ?>
        <div class="alerta-erro"><p style="margin: 0;">⚠️ Projeto não encontrado. Ele pode já ter sido removido.</p></div>
    <?php elseif ($erroMsg === 'id_invalido'): ?>
        <div class="alerta-erro"><p style="margin: 0;">⚠️ Requisição inválida.</p></div>
    <?php endif; ?>

    <form class="busca-container" method="GET">
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por nome ou tecnologia...">
        <button type="submit" class="btn-primario">Buscar</button>
        <?php if ($busca): ?> 
            <a href="index.php" class="btn-secundario">Limpar</a> 
        <?php endif; ?>
    </form>

    <?php if (empty($projetos)): ?>
        <p>Nenhum projeto encontrado.</p>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($projetos as $p): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($p['nome']) ?></h3>
                    <p>🛠️ <?= htmlspecialchars($p['tecnologias']) ?></p>
                    <p>📅 <?= (int)$p['ano'] ?></p>
                    
                    <div style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 8px;">
                        <?php if ($p['link_github']): ?>
                            <a href="<?= htmlspecialchars($p['link_github']) ?>" target="_blank" rel="noopener noreferrer" class="btn-secundario" style="font-size: 12px;">🔗 GitHub</a>
                        <?php endif; ?>
                        
                        <a href="editar.php?id=<?= (int)$p['id'] ?>" class="btn-secundario" style="font-size: 12px;">✏️ Editar</a>
                        <a href="excluir.php?id=<?= (int)$p['id'] ?>" class="btn-perigo" style="font-size: 12px; background-color: #dc3545; color: white;">🗑️ Excluir</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($total_paginas > 1): ?>
            <div class="pagination">
                <?php if ($pagina_atual > 1): ?>
                    <a href="?pagina=<?= $pagina_atual - 1 ?>&busca=<?= urlencode($busca) ?>">Anterior</a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>&busca=<?= urlencode($busca) ?>" class="<?= $i == $pagina_atual ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <a href="?pagina=<?= $pagina_atual + 1 ?>&busca=<?= urlencode($busca) ?>">Próximo</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>