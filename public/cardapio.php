<?php
    $t_pagina = "Cardápio";

    include "../public/header.php";

    if(!isset($_GET['id'])) {
        header("Location: ../public/index.php");
        exit;
    }

    $id_usuario = intval($_GET["id"]);
    
    $sql_restaurante = "SELECT nome_restaurante, imagem_restaurante
                        FROM usuario 
                        WHERE id_usuario = $id_usuario";
       
    $rslt_restaurante = mysqli_query($conexao, $sql_restaurante);
    $restaurante = mysqli_fetch_assoc($rslt_restaurante);

    if(!$restaurante) {
        die("Restaurante não encontrado");
    }

    $sql_refeicao = "SELECT * FROM produto
                     WHERE id_usuario = $id_usuario
                        AND disponibilidade = 1
                     ORDER BY categoria ASC, nome_produto ASC";
    
    $rslt_refeicao = mysqli_query($conexao, $sql_refeicao);

    function titulo_categoria($cat) {
        $categorias = [
                "entrada"   => "Entradas",
                "principal" => "Pratos Principais",
                "bebida"    => "Bebidas",
                "sobremesa" => "Sobremesas",
                "combo"     => "Combos"
        ];
        return $categorias[$cat] ?? ucfirst($cat);
    }

    $n_restaurante = htmlspecialchars($restaurante['nome_restaurante']);
?>

<header class="header-cardapio">
    <img src= <?= htmlspecialchars($restaurante['imagem_restaurante']) ?> alt="Logo do <?= $n_restaurante ?>">
    <div class="texto-header">
        <h1><?= htmlspecialchars($restaurante['nome_restaurante']) ?></h1>
    </div>
</header>

<section class="cardapio-corpo">
    <?php 
        $categoria_atual = ""; 
        if (mysqli_num_rows($rslt_refeicao) > 0): 
            while ($refeicao = mysqli_fetch_assoc($rslt_refeicao)): 
                
                if ($categoria_atual != $refeicao['categoria']): 
                    $categoria_atual = $refeicao['categoria'];
                    echo "<h2 class='titulo-categoria'>" . titulo_categoria($categoria_atual) . "</h2>";
                endif;
    ?>
    
            <article class="card-item-lista">
                
                <?php if ($refeicao['imagem_produto']): ?>
                    <div class="foto-produto-container">
                        <img src="<?= htmlspecialchars($refeicao['imagem_produto']) ?>" alt="Foto da <?= htmlspecialchars($refeicao['nome_produto']) ?>" loading="lazy">
                    </div>
                <?php endif; ?>                
                
                <div class="detalhes-produto">
                    <h3><?= htmlspecialchars($refeicao['nome_produto']) ?></h3>
                    <p class="descricao-prod"><?= htmlspecialchars($refeicao['descricao']) ?></p>
                    <p class="valor-prod">R$ <?= number_format($refeicao['preco'], 2, ',', '.') ?></p>
                </div>


            </article>

    <?php 
            endwhile; 
        else: 
    ?>
        <div class="error-msg">
            <p>Este restaurante não possui itens disponíveis.</p>
        </div>
    <?php endif; ?>
</section>

<?php
    include "../public/footer.php"
?>        