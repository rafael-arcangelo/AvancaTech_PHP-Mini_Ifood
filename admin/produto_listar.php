
<?php
require_once __DIR__ . "/../config/auth.php";

$t_pagina = "Cardápio";
include "../admin/header_auth.php";

$id_usuario   = intval($_SESSION["id_usuario"]);
$n_restaurante = htmlspecialchars(trim($_SESSION["usuario_nome_restaurante"]));

$sql = "SELECT *
        FROM produto
        WHERE id_usuario = $id_usuario
        ORDER BY categoria, nome_produto";

$rslt_refeicao = mysqli_query($conexao, $sql);

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

<header class="header-cardapio">
    <h1>Cardápio de <strong><?= $n_restaurante ?></strong></h1>
    <div class="links-nav">
        <a href="produto_novo.php" class="btn-nav">Cadastrar nova refeição</a>
    </div>
</header>

<section class="cardapio-corpo">
<?php
if (!$rslt_refeicao || mysqli_num_rows($rslt_refeicao) == 0):
?>
    <div class="error-msg">
        <p>Seu cardápio ainda está vazio.</p>
    </div>
<?php
else:
    $categoria_atual = "";
    while ($refeicao = mysqli_fetch_assoc($rslt_refeicao)):

        if ($categoria_atual !== $refeicao["categoria"]):
            $categoria_atual = $refeicao["categoria"];
            echo "<h2 class='titulo-categoria'>" . titulo_categoria($categoria_atual) . "</h2>";
        endif;
?>
    <article class="card-item-lista">

        <?php if (!empty($refeicao["imagem_produto"])): ?>
            <div class="foto-produto-container">
                <img
                    src="<?= htmlspecialchars($refeicao["imagem_produto"]) ?>"
                    alt="Foto de <?= htmlspecialchars($refeicao["nome_produto"]) ?>"
                    loading="lazy"
                >
            </div>
        <?php endif; ?>

        <div class="detalhes-produto">
            <h3><?= htmlspecialchars($refeicao["nome_produto"]) ?></h3>
            <p class="descricao-prod"><?= htmlspecialchars($refeicao["descricao"]) ?></p>
            <p class="valor-prod">
                R$ <?= number_format($refeicao["preco"], 2, ",", ".") ?>
            </p>
        </div>

        <div class="acoes-admin">
            <button class="btn-nav" type="button" onclick="location.href='../admin/produto_editar.php?id=<?= $refeicao["id_produto"] ?>'" class="btn-excluir">Editar</button>
        
            <form action="../admin/produto_excluir.php" method="POST" class="form-inline">
                <input type="hidden" name="id_produto" value="<?= $refeicao["id_produto"] ?>">
                <button class="btn-excluir" type="submit" onclick="return confirm('Deseja realmente excluir este item?');">Excluir</button>
            </form>
        </div>

    </article>
<?php
    endwhile;
endif;
?>
</section>

<?php
include "../public/footer.php";
?>