<?php
require_once __DIR__ . "/../config/db.php";
$conexao = conecta();

$nome = htmlspecialchars($_SESSION["usuario_nome_pessoa"]);
$tema_classe = (isset($_SESSION['tema']) && $_SESSION['tema'] == 'escuro') ? 'tema-escuro' : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Foods | <?= $t_pagina ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="<?= $tema_classe ?>">
    <header class="header-principal">
        <div class="testeira-container">
            <a href="../public/index.php">
                <img src="https://www.bidfood.co.uk/wp-content/uploads/2023/04/World-Foods-Homepage-Hero-Desktop.jpg" alt="World Foods Logo" class="logo-testeira">
            </a>
        </div>

        <nav class="nav-faixa">
            <div class="container nav-conteudo">
                
                <div class="nav-links-principais">
                    <a href="../public/index.php">Início</a>
                    <a href="../public/login.php">Painel</a>
                    <a href="../admin/restaurante_editar.php">Gerenciar usuário</a>
                    <a href="../admin/produto_listar.php">Gerenciar cardápio</a>
                </div>

                <div class="nav-login-auth">
                    <p class="txt-nav-login">Olá, <b><?= $nome ?></b>!</p>
                    <a class="btn-entrar" href="../public/login.php">Sair</a>
                </div>
                
                <div class="nav-links-uteis">
                    <a class="btn-tema" href="../public/tema_alternar.php">
                        <?= (isset($_SESSION['tema']) && $_SESSION['tema'] == 'escuro') ? '☀️ Modo Claro' : '🌙 Modo Escuro' ?>
                    </a>
                </div>
                
            </div>
        </nav>
    </header>

    <main class="container">