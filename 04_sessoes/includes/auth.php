<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/includes/auth.php
 * Autor      : Felipe Borges
 */

/**
 * requer_login()
 * NÍVEL B: Implementa contador de visitas.
 * Verifica se há sessão ativa. Se não houver, redireciona para o login.
 */
function requer_login(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        // CORREÇÃO: Caminho relativo para garantir que encontre o login 
        // independente de qual pasta o usuário esteja tentando acessar.
        // Se estiver no /05_crud/, ele volta um nível e entra no /04_sessoes/
        header('Location: /04_sessoes/publico.php');
        exit;
    }

    // --- NÍVEL B: Número de visitas na sessão ---
    $_SESSION['visitas'] = ($_SESSION['visitas'] ?? 0) + 1;
}

/**
 * redirecionar_se_logado()
 * NÍVEL A: Evita que o usuário autenticado acesse a página de login novamente.
 */
function redirecionar_se_logado(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['usuario'])) {
        // Ajustado para o painel dentro de sessoes
        header('Location: /04_sessoes/painel.php');
        exit;
    }
}

/**
 * get_flash()
 * NÍVEL A: Retorna a mensagem flash e a remove da sessão imediatamente.
 */
function get_flash(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $flash = $_SESSION['flash'] ?? '';
    unset($_SESSION['flash']); 
    return $flash;
}

/**
 * usuario_logado()
 * Retorna o nome do usuário da sessão ou string vazia.
 */
function usuario_logado(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['usuario'] ?? '';
}