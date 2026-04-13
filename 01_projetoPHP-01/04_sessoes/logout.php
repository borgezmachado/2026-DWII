<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 – Autenticação com sessões e controle de acesso
 * Arquivo    : 04_sessoes/logout.php
 * Autor      : Felipe Borges
 */

session_start();

// 1. Limpar as variáveis da superglobal $_SESSION
$_SESSION = array();

// 2. Destruir o cookie de sessão no navegador (Boa prática de segurança)
if (ini_get("session_use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruir a sessão no servidor
session_destroy();

// 4. Redirecionar para o login
// Dica: Você pode passar um parâmetro via GET para exibir uma mensagem de "Até logo"
header('Location: login.php?saida=sucesso');
exit;