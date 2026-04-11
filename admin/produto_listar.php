<?php
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    $id_usuario = intval($_SESSION["id_usuario"]);
    $n_restaurante = htmlspecialchars(trim($_SESSION["usuario_nome_restaurante"]));

    $sql = "SELECT id_produto, nome_produto, categoria, preco, disponibilidade, imagem_produto
            FROM produto
            WHERE id_usuario = $id_usuario
            ORDER BY categoria, nome_produto";
    
    $resultado = mysqli_query($conexao, $sql);

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
?>

    <!DOCTYPE html>
    <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Explora Food - Refeições Cadastradas</title>
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <body>
            <main class="container">
                <header>
                    <h1>Refeições de <strong><?= $n_restaurante ?></strong></h1>
                    <nav class="links-nav">
                        <a href="../admin/produto_novo.php" class="btn">Cadastrar nova refeição</a>
                        <a href="../admin/painel.php" class="btn-outline">Voltar ao Painel</a>
                    </nav>
                </header>

                <?php
                    if(!$resultado || mysqli_num_rows($resultado) == 0): 
                ?>
                        <section class="sem-dados">
                            <p>Seu cardápio ainda está vazio.</p>
                            <a href='../admin/produto_novo.php' class="btn">Cadastrar primeira refeição</a>;
                        </section>
                <?php        
                    else:
                        $cat_atual = "";
                        while($p = mysqli_fetch_assoc($resultado)):
                            if($cat_atual != $p["categoria"]):
                                if($cat_atual != "") {
                                    echo "</div></section>";
                                }

                                $cat_atual = $p["categoria"];
                ?>

                                <section class="faixa-categoria">
                                    <h2><?= titulo_categoria($cat_atual) ?></h2>
                                    <div class="cards-grid">

                <?php
                            endif;

                            $id_produto = intval($p["id_produto"]);
                            $n_produto = htmlspecialchars($p["nome_produto"]);
                            $img_produto = htmlspecialchars($p["imagem_produto"]);
                            $preco = number_format(floatval($p["preco"]), 2, ",", ".");
                            $disp = intval($p["disponibilidade"] == 1) ? "Disponível" : "Indisponível";
                            $classe_disp = intval($p["disponibilidade"] == 1) ? "status-on" : "status-off";
                ?>

                            <article class="card-produto">
                                <div class="card-img">
                                    <img 
                                        src="<?= $img_produto ?>"
                                        alt="Foto de <?= $n_produto ?>"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="card-info">
                                    <h3><?= $n_produto ?></h3>
                                    <p class="preco">R$ <?= $preco ?></p>
                                    <span class="tag" <?= $classe_disp ?><?= $disp ?>></span>

                                    <div class="btn-acoes">
                                        <a href="../admin/produto_editar.php?id=<?= $id_produto ?>" class="link-edit">Editar</a>
                                        <a href="../admin/produto_excluir.php?id=<?= $id_produto ?>" 
                                        class="link-delete" 
                                        onclick="return confirm('Tem certeza que deseja excluir <?= $n_produto ?>?');">Excluir
                                        </a>                            
                                    </div>
                                </div>
                            </article>
                <?php
                        endwhile;
                ?>
                        </div></section> <?php endif; ?>

            </main>
            <?php
                desconecta($conexao);
            ?>
        </body>
    </html>