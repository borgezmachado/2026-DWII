<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/painel.php
 * Autor      : Felipe Borges
 */

// Importa as funções de autenticação e verifica se o usuário está logado
require_once __DIR__ . '/includes/auth.php';

// Nível B e A: requer_login() já deve cuidar do contador de visitas internamente se você seguiu o auth.php anterior
requer_login();

// Nível A: Recupera a mensagem flash (Bem-vindo, X!)
$mensagem_flash = get_flash();

$titulo_pagina = 'Painel – Área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = 'painel';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">

    <?php if ($mensagem_flash): ?>
        <div class="alerta-sucesso" style="background: #dcfce7; border: 1px solid #16a34a; color: #166534; padding: 15px; margin-bottom: 20px; border-radius: 8px;">
            🎉 <?php echo htmlspecialchars($mensagem_flash); ?>
        </div>
    <?php endif; ?>

    <div class="card" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px;">
        <h3>✅ Status da Sessão</h3>
        <p><strong>👤 Usuário logado:</strong> 
            <?php echo htmlspecialchars(usuario_logado()); ?>
        </p>
        <p><strong>🕒 Horário de acesso:</strong> 
            <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?>
        </p>
        
        <p><strong>📊 Visitas nesta sessão:</strong> 
            <span class="badge" style="background: #3b579d; color: white; padding: 2px 8px; border-radius: 4px;">
                <?php echo $_SESSION['visitas'] ?? 0; ?>
            </span>
        </p>
    </div>

    <div class="card" style="margin-top: 20px;">
       <h3> 📊 Painel de Controle </h3>
          <p> Este conteúdo so é visivel para usuários autenticados.
    </p>
    <p>
        <a href="perfil.php" style="color: #3b579d; font-weight: bold;">➡️ Ver meu Perfil (Página Protegida 2)</a>   
    </p>
    <a href = "../05_crud/index.php" class = "btn-primario">
        📂 Gerenciar Projetos
    </a>
    </div>

    <p style="margin-top: 30px; text-align: center;">
        <a href="logout.php" 
           style="background: #cf1c21; color: white; padding: 12px 30px; 
                  border-radius: 6px; text-decoration: none; 
                  font-weight: bold; display: inline-block;">
            🚪 Encerrar Sessão
        </a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>