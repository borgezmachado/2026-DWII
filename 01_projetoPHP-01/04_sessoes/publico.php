<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/publico.php
 * Autor      : Felipe Borges
 */

// Importamos o auth.php para usar as funções padronizadas
require_once __DIR__ . '/includes/auth.php';

// Iniciamos a sessão se necessário (para verificar se está logado)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usamos a função que já criamos para verificar o nome do usuário
$nome_usuario = usuario_logado();
$logado = !empty($nome_usuario);

$titulo_pagina = 'Página Pública';
$caminho_raiz  = '../';
$pagina_atual  = 'publico';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="text-align: center; margin-top: 50px;">

    <h1 class="titulo-secao">🌐 Página Pública</h1>
    <p style="color: #64748b; margin-bottom: 30px;">
        Este conteúdo é visível para qualquer visitante, independente de estar logado ou não.
    </p>

    <div class="card" style="background: #f1f5f9; padding: 40px; border-radius: 12px; display: inline-block;">
        <?php if ($logado): ?>
            <p style="font-size: 18px;">
                Olá, <strong><?php echo htmlspecialchars($nome_usuario); ?></strong>! <br>
                Você já possui uma sessão ativa no sistema.
            </p>
            <div style="margin-top: 20px;">
                <a href="painel.php" 
                   style="background: #16a34a; color: white; padding: 12px 30px; 
                          border-radius: 6px; text-decoration: none; 
                          font-weight: bold; display: inline-block;">
                    🚀 Ir ao Painel de Controle
                </a>
            </div>
        <?php else: ?>
            <p style="margin-bottom: 20px;">Você não está autenticado no momento.</p>
            <a href="login.php" 
               style="background: #3b579d; color: white; padding: 12px 30px; 
                      border-radius: 6px; text-decoration: none; 
                      font-weight: bold; display: inline-block;">
                🔐 Acessar Área Restrita
            </a>
        <?php endif; ?>
    </div>

    <p style="margin-top: 40px;">
        <a href="../index.php" style="color: #64748b; text-decoration: none;">← Início do Projeto</a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>