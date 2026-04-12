<?php
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    $sql = "SELECT id_usuario, nome_restaurante, imagem_restaurante
            FROM usuario
            ORDER BY id_usuario ASC";

    $resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>World Foods - Explore o mundo da culinária</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <nav class="navbar">
            <div class="logo-wfood">World Foods!</div>
            <div class="nav-links">
                <a href="../public/login.php" class="btn-login">Acesse o painel</a>
            </div>
        </nav>

        <main class="container">
            <header class="bem-vindo">
                <h1>Bem-vindo ao World Foods!</h1>
                <p>Escolha um restaurante e descubra pratos do mundo</p>
            </header>
                <section class="vitrine">
                    <?php if ($resultado && mysqli_num_rows($resultado) > 0) : ?>
                        <div class="tab_restaurantes">
                            <?php while ($restaurante = mysqli_fetch_assoc($resultado)) : ?>
                                <?php
                                    $img_restaurante = trim($restaurante['imagem_restaurante']);
                                    if (empty($img_restaurante)) {
                                        $img_restaurante = "https://bit.ly/4mlzujj";
                                    }
                                ?>

                                <div class="card-restaurante">
                                    <img 
                                        src="<?= htmlspecialchars($img_restaurante) ?>"
                                        alt="Logo do restaurante <?= htmlspecialchars($restaurante['nome_restaurante']) ?>"
                                    >

                                    <h3><?= htmlspecialchars($restaurante['nome_restaurante']) ?></h3>

                                    <a 
                                        href="../public/cardapio.php?id=<?= $restaurante['id_usuario'] ?>" 
                                        class="btn-ver-cardapio"
                                    >
                                        Cardápio
                                    </a>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <p>Nenhum restaurante cadastrado.</p>
                    <?php endif; ?>
                </section>
        </main>
    </body>
</html>

<?php
    desconecta($conexao);
?>