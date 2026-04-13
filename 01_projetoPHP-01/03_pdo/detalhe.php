<?php
// Caminho relativo para a raiz
$caminho_raiz = '../';

// Incluir a conexão PDO
require_once 'includes/conexao.php';

// Validar o ID recebido via GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// REGRA DA NOTA MÁXIMA: Se o ID for inválido ou ausente, vai para a 404
if (!$id) {
    header('Location: 404.php');
    exit;
}

// Busca o registro no banco
$stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE id = :id');
$stmt->execute(['id' => $id]);
$tec = $stmt->fetch();

// REGRA DA NOTA MÁXIMA: Se não encontrar a tecnologia, vai para a 404 personalizada
if (!$tec) {
    header('Location: 404.php');
    exit;
}

// Variáveis para o cabeçalho global
$titulo_pagina = htmlspecialchars($tec['nome']) . " – Detalhes";
$pagina_atual = "catalogo";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>

<body>
    <div class="container">
        <a href="index.php" style="color: #3b579d; font-weight: bold; text-decoration: none;">← Voltar ao catálogo</a>

        <div class="card" style="margin-top: 20px; border: 1px solid #ddd; padding: 20px; border-radius: 10px; background: #fff;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <h1 style="color: #3b579d; margin: 0; font-size: 28px;">
                    <?= htmlspecialchars($tec['nome']); ?>
                </h1>

                <span style="background: #e8edf5; color: #3b579d; padding: 6px 15px; border-radius: 20px; font-size: 13px; font-weight: bold;">
                    <?= htmlspecialchars($tec['categoria']); ?>
                </span>
            </div>

            <p style="font-size: 16px; margin: 20px 0; line-height: 1.6; color: #4b5563;">
                <?= htmlspecialchars($tec['descricao']); ?>
            </p>

            <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px;">
                <tr style="background: #f9fafb;">
                    <td style="padding: 12px; border: 1px solid #e5e7eb; font-weight: bold; width: 160px;">ID do Registro</td>
                    <td style="padding: 12px; border: 1px solid #e5e7eb;">#<?= $tec['id']; ?></td>
                </tr>
                <tr>
                    <td style="padding: 12px; border: 1px solid #e5e7eb; font-weight: bold;">Ano de Lançamento</td>
                    <td style="padding: 12px; border: 1px solid #e5e7eb;"><?= $tec['ano_criacao']; ?></td>
                </tr>
                <tr style="background: #f9fafb;">
                    <td style="padding: 12px; border: 1px solid #e5e7eb; font-weight: bold;">Data de Cadastro</td>
                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                        <?= date('d/m/Y \à\s H:i', strtotime($tec['criado_em'])); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php include 'includes/rod_pdo.php'; ?>
</body>
</html>