<?php
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

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

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cardápio - <?= $n_restaurante ?></title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <nav class="navbar">
            <div class="logo-wfood">World Foods!</div>
            <div class="nav-links">
                <a href="index.php" class="btn-link">Voltar para a Vitrine</a>
            </div>
        </nav>
        
        <main class="container">
            <header class="header-cardapio">
                <div class="perfil-restaurante">
                    <img src="<?= htmlspecialchars($restaurante['imagem_restaurante']) ?>" alt="Logo do Restaurante" class="foto-restaurante">
                    <div class="texto-header">
                        <h1><?= htmlspecialchars($restaurante['nome_restaurante']) ?></h1>
                        <p>Sabores do mundo direto para você.</p>
                    </div>
                </div>
            </header>

            <hr>

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
                
                    <div class="card-item-lista">
                        <div class="detalhes-produto">
                            <h3><?= htmlspecialchars($refeicao['nome_produto']) ?></h3>
                            <p class="descricao-prod"><?= htmlspecialchars($refeicao['descricao']) ?></p>
                            <p class="valor-prod">R$ <?= number_format($refeicao['preco'], 2, ',', '.') ?></p>
                        </div>

                        <?php if ($refeicao['imagem_produto']): ?>
                            <div class="foto-produto-container">
                                <img src="<?= htmlspecialchars($refeicao['imagem_produto']) ?>" alt="Foto da refeição">
                            </div>
                        <?php endif; ?>
                    </div>

                <?php 
                        endwhile; 
                    else: 
                ?>
                    <div class="aviso-vazio">
                        <p>Este restaurante ainda não possui itens disponíveis.</p>
                    </div>
                <?php endif; ?>
            </section>
        </main>

        <footer class="footer-simples">
            <p>World Foods - Desenvolvido por Rafael Arcangelo</p>
        </footer>
    </body>
</html>

<?php
    desconecta($conexao);
?>        