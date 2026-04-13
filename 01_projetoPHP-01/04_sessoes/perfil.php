<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/perfil.php
 * Autor      : Felipe Borges
 * Data       : 23/03/2026
 */

// Importa as funções de autenticação
require_once __DIR__ . '/includes/auth.php';

// Nível B: Protege a página. Se não estiver logado, vai para login.php
// Também incrementa o contador de visitas automaticamente.
requer_login();

$titulo_pagina = 'Meu Perfil – Área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = 'perfil';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">

    <div class="card" style="border-left: 5px solid #3b579d; padding: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h1 class="titulo-secao" style="margin-top: 0;">👤 Perfil do Usuário</h1>
        <p>Esta é a segunda página protegida do sistema.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

        <div class="dados-usuario">
            <p><strong>Nome de Usuário:</strong> 
                <span style="color: #3b579d;"><?php echo htmlspecialchars(usuario_logado()); ?></span>
            </p>
            <p><strong>E-mail:</strong> 
                <span style="color: #666;"><?php echo htmlspecialchars(usuario_logado()); ?>@sistema.com.br</span>
            </p>
            <p><strong>Nível de Acesso:</strong> 
                <span class="badge" style="background: #eab308; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;">Administrador</span>
            </p>
        </div>

        <div style="margin-top: 30px; padding: 15px; background: #f8fafc; border-radius: 6px; font-size: 14px;">
            <p style="margin: 0; color: #64748b;">
                <strong>💡 Nota do Sistema:</strong> <br>
                O contador de visitas global agora marca: <strong><?php echo $_SESSION['visitas']; ?></strong> interações nesta sessão.
            </p>
        </div>
    </div>

    <p style="margin-top: 24px; text-align: center; display: flex; justify-content: center; gap: 15px;">
        <a href="painel.php" 
           style="background: #3b579d; color: white; padding: 10px 24px; 
                  border-radius: 6px; text-decoration: none; font-weight: bold;">
            🏠 Voltar ao Painel
        </a>

        <a href="logout.php" 
           style="background: #cf1c21; color: white; padding: 10px 24px; 
                  border-radius: 6px; text-decoration: none; font-weight: bold;">
            🚪 Sair
        </a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>