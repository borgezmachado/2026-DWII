<?php
/**
 * ================================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : projetos.php
 * Autor      : [SEU NOME AQUI]
 * Data       : [DATA DE HOJE]
 * Descrição  : Lista PÚBLICA de projetos lidos do banco via PDO.
 *              Adaptada de 05_crud/index.php — sem autenticação
 *              e sem botões de editar/excluir.
 * ================================================================
 */

// session_start() ANTES de qualquer saída HTML.
// Necessário aqui — cabecalho.php é incluído dentro do <head>,
// após o início do output HTML, tarde demais para iniciar sessão.
if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Ordem padrão — sem session_start() (cabecalho.php cuida).
// Sem $nome (fallback do cabecalho.php).
// require_once ANTES do include do cabecalho — precisamos de
// $projetos para renderizar o HTML.
$pagina_atual = 'projetos';
$titulo_pagina = 'Projetos | Portfólio DWII';
$caminho_raiz = './';

// Conexão PDO via includes/ global (criado na Parte B).
require_once __DIR__ . '/includes/conexao.php';

// Mesma query do 05_crud/index.php — dados do mesmo banco.
// Qualquer projeto cadastrado pelo painel aparece aqui automaticamente.
$pdo     = conectar();
$stmt    = $pdo->query (
    "SELECT * FROM projetos
    WHER status = 'publicado'
    ORDER BY criado_em DESC"
);
$projetos = $stmt->fetchAll();

// fetchAll() retorna array associativo com todos os registros.
// Retorna array vazio se não houver projetos — nunca retorna false.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 class="titulo-secao" style="margin: 0;">🚀 Projetos</h1>

            <?php if (!empty($projetos)) : ?>
                <span style="color: #6b7280; font-size: 14px;">
                    <?php echo count($projetos); ?> projeto(s)
                </span>
            <?php endif; ?>
        </div>

        <?php if (empty($projetos)) : ?>

            <!-- Estado vazio: banco ainda sem projetos -->
            <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
                <p style="font-size: 40px; margin: 0 0 12px;">💻</p>
                <p style="font-size: 16px; margin: 0;">
                    Nenhum projeto cadastrado ainda.
                </p>
            </div>

        <?php else : ?>

            <!-- Grade responsiva de projetos -->
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">

                <?php foreach ($projetos as $projeto) : ?>
                    <div class="card">

                        <h3 style="margin: 0 0 8px; color: #3b579d; font-size: 17px;">
                            <?php echo htmlspecialchars($projeto['nome']); ?>
                        </h3>
                        </h3>

                        <p style="margin: 0 0 10px; font-size: 14px; color: #374151; line-height: 1.6;">
                            <?php echo htmlspecialchars($projeto['descricao']); ?>
                        </p>

                        <p style="margin: 0 0 6px; font-size: 13px; color: #6b7280;">
                            🛠️ <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                        </p>

                        <p style="margin: 0 0 12px; font-size: 13px; color: #6b7280;">
                            📅 <?php echo (int) $projeto['ano']; ?>
                            <!--
                                (int): cast para inteiro — garante que só número apareça,
                                mesmo que o banco retorne o valor como string.
                            -->
                        </p>

                        <?php if ($projeto['link_github']) : ?>
                            <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn-secundario">🔗 Ver no GitHub</a>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</body>
</html>             