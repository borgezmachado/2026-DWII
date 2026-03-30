<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/login.php
 * Autor      : Felipe Borges
 * Data       : 23/03/2026
 */

// session_start() deve ser a primeira coisa
session_start();

// --- NÍVEL A: Redirecionar se já logado (redirecionar_se_logado) ---
if (isset($_SESSION['usuario'])) {
    header('Location: painel.php'); 
    exit;
}

// --- NÍVEL A: Proteção contra força bruta (Verificação de Bloqueio) ---
if (isset($_SESSION['bloqueado_ate']) && time() < $_SESSION['bloqueado_ate']) {
    $restante = $_SESSION['bloqueado_ate'] - time();
    die("Acesso bloqueado por excesso de tentativas. Tente novamente em $restante segundos.");
}

// Credenciais válidas
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA   = 'dwii2026';

$erro  = '';
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha']   ?? '');

    if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {
        // --- SUCESSO ---
        session_regenerate_id(true);
        
        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('H:i:s'); // Horário para o Nível B
        $_SESSION['visitas'] = 0;              // Inicializa visitas para o Nível B
        
        // --- NÍVEL A: Flash Message ---
        $_SESSION['flash'] = "Bem-vindo, " . htmlspecialchars($login) . "!";
        
        // Reseta tentativas após sucesso
        unset($_SESSION['tentativas']);
        unset($_SESSION['bloqueado_ate']);

        header('Location: painel.php');
        exit;
    } else {
        // --- NÍVEL A: Controle de Tentativas ---
        $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;

        if ($_SESSION['tentativas'] >= 3) {
            $_SESSION['bloqueado_ate'] = time() + 60; // Bloqueia por 60 seg
            $erro = 'Muitas tentativas falhas. Você foi bloqueado por 1 minuto.';
        } else {
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}

$titulo_pagina = 'Login – Área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container" style="max-width: 420px; margin-top: 50px;">
    <div class="form-container">

        <h1 class="titulo-secao" style="text-align: center; font-size: 22px;">
            🔒 Área Restrita
        </h1>

        <?php if ($erro): ?>
            <div class="alerta-erro" style="background: #fee2e2; border: 1px solid #ef4444; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <p style="margin: 0; font-size: 14px; color: #b91c1c;">
                    🚫 <?php echo htmlspecialchars($erro); ?>
                </p>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Usuário:</label>
                <input type="text" 
                       name="usuario" 
                       value="<?php echo htmlspecialchars($login); ?>" 
                       autocomplete="username"
                       style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Senha:</label>
                <input type="password" 
                       name="senha" 
                       autocomplete="current-password"
                       style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 10px; background: #3b579d; color: white; border: none; cursor: pointer;">
                Entrar
            </button>
        </form>

        <p style="text-align: center; margin-top: 20px; font-size: 13px; color: #6b7280;">
            <a href="../index.php" style="color: #3b579d; text-decoration: none;">← Voltar ao início</a>
        </p>

    </div>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>