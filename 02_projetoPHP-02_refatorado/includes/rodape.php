<?php
/**
 * =========================================================================
 * ARQUIVO    : includes/rodape.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 – PHP para Web: Formulários, GET e POST
 * Autor      : Felipe Borges
 * Conceitos  : Modularização, date(), isset(), fallback defensivo
 * =========================================================================
 */

// Fallback: se $nome não estiver definida na página, exibe "Portfólio".
$autor = isset($nome) ? htmlspecialchars($nome) : "Felipe Borges";
?>

<footer class="footer-moderno">
    <div class="footer-container">
        <div class="footer-info">
            <h3><?php echo $autor; ?></h3>
            <p>IFPR – Campus Ponta Grossa</p>
        </div>

        <div class="footer-links">
            <a href="index.php" class="btn-footer-outline">Início</a>
           </div>

        <div class="footer-social">
            <a href="#" title="GitHub" class="social-icon">💻</a>
            <a href="#" title="LinkedIn" class="social-icon">🔗</a>
        </div>
    </div>
    
    <div class="footer-bottom">
        &copy; <?php echo date("Y"); ?> | Desenvolvido com PHP | Portfólio DWII
    </div>
</footer>