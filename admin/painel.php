<?php
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";

    $nome = htmlspecialchars($_SESSION["usuario_nome_pessoa"]);
    $n_restaurante = htmlspecialchars($_SESSION["usuario_nome_restaurante"]);
    $email = htmlspecialchars($_SESSION["usuario_email"]);
    $img_logo = htmlspecialchars($_SESSION["usuario_imagem_restaurante"]);
    
    date_default_timezone_set('America/Sao_Paulo');
    $data_atual = date('d/m/Y');
    $data_maquina = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel de <?= $n_restaurante; ?></title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="container">
            <header>
                <img 
                    src="<?= $img_logo ?: 'https://bit.ly/4mlzujj'; ?>" 
                    alt="Logo do <?= $n_restaurante; ?>"
                    class="logo"
                    loading="lazy">
                <h1>Painel de Administração do <?= $n_restaurante ?></h1>

                <p>Bemvindo, <span class="bold"><?= $nome ?></span>!</p>
                <p>Hoje é: 
                    <time datetime="<?= $data_maquina ?>" class="bold">
                        <?= $data_atual ?>
                    </time>
                </p>
            </header>

            <main>
                <nav class="links">
                    <h2>Gerenciamento do Cardápio</h2>
                    <a href="produto_novo.php">Cadastrar novo prato</a>
                    <a href="produto_listar.php">Listar pratos cadastrados</a>
                </nav>
            </main>

            <footer>
                <a href="../public/logout.php" onclick="return confirm('Tem certeza que deseja sair?')">Sair do Sistema</a>
            </footer>
        </div>
    </body>
</html>