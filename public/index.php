<?php
    $t_pagina = "Bem-vindo";
    
    include "../public/header.php";
    
    $sql = "SELECT id_usuario, nome_restaurante, imagem_restaurante
            FROM usuario
            ORDER BY RAND()";

    $resultado = mysqli_query($conexao, $sql);
?>

<header class="bem-vindo">
    <h1>Bem-vindo ao World Foods!</h1>
    <p>Escolha um restaurante e descubra pratos do mundo</p>
</header>

<section class="vitrine">
    <?php if ($resultado && mysqli_num_rows($resultado) > 0) : ?>
        <div class="tab-restaurantes">
            
            <?php while ($restaurante = mysqli_fetch_assoc($resultado)) : ?>
                
                <?php
                    $img_restaurante = trim($restaurante['imagem_restaurante']);
                    if (empty($img_restaurante)) {
                        $img_restaurante = "https://bit.ly/4mlzujj";
                    }
                ?>

                <div class="card-restaurante">
                    <img src="<?= htmlspecialchars($img_restaurante) ?>" alt="Logo do restaurante <?= htmlspecialchars($restaurante['nome_restaurante']) ?>">
                    <h3><?= htmlspecialchars($restaurante['nome_restaurante']) ?></h3>
                    <a class="btn-nav" href="../public/cardapio.php?id=<?= $restaurante['id_usuario'] ?>">Cardápio</a>
                </div>

            <?php endwhile; ?>
        
        </div>
    
    <?php else : ?>
        <p>Nenhum restaurante cadastrado.</p>
    <?php endif; ?>

</section>

<?php
    include "../public/footer.php"
?>