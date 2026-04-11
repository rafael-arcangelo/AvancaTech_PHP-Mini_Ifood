<?php 
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    if(!isset($_GET["id"])) {
        die("ID do produto não informado");
    }

    $id_produto = intval($_GET["id"]);
    $id_usuario = intval($_SESSION["id_usuario"]);

    $sql = "SELECT * FROM produto
            WHERE id_produto = $id_produto
                AND id_usuario = $id_usuario";
    
    $resultado = mysqli_query($conexao, $sql);
    if(!$resultado) {
        die("Erro ao buscar produto: " . mysqli_error($conexao));
    }

    $produto = mysqli_fetch_assoc($resultado);

    if(!$produto) {
        die("Produto não encontrado ou não tem permissão para editar.");
    }

    $n_produto = htmlspecialchars($produto["nome_produto"]);
    $categoria = $produto["categoria"];
    $preco = number_format((float)$produto["preco"], 2, ".", "");
    $img_produto = htmlspecialchars($produto["imagem_produto"]);
    $descricao = htmlspecialchars($produto["descricao"]);
    $disp_atual = intval($produto["disponibilidade"]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Explora Food - Editar Refeição</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <main class="container">
            <header>
                <h1>Editar refeição</h1>
                <p>Editar refeição <strong><?= $n_produto ?></strong></p>
            </header>

            <form action="../admin/produto_atualizar.php" method="POST">
                <input type="hidden" name="id_produto" value="<?= $id_produto; ?>">
            
                <div class="form-grupo">
                    <label for="n_refeicao">Nome da refeição</label>
                    <input type="text" name="n_refeicao" id="n_refeicao" value="<?= $n_produto ?>" required>
                </div>

                <div class="form-grupo">
                    <label for="categoria">Categoria da refeição</label>
                    <select name="categoria" id="categoria" required>
                        <option value="entrada" <?= $categoria == 'entrada' ? 'selected' : '' ?>>Entrada</option>
                        <option value="principal" <?= $categoria == 'principal' ? 'selected' : '' ?>>Principal</option>
                        <option value="bebida" <?= $categoria == 'bebida' ? 'selected' : '' ?>>Bebida</option>
                        <option value="sobremesa" <?= $categoria == 'sobremesa' ? 'selected' : '' ?>>Sobremesa</option>
                        <option value="combo" <?= $categoria == 'combo' ? 'selected' : '' ?>>Combo</option>
                    </select>
                </div>

                <div class="form-grupo">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" name="preco" id="preco" step="0.01" min="0" value="<?= $preco ?>" required>
                </div>

                <div class="form-grupo">
                <p>A Refeição está disponivel para venda?</p>    
                <div class="item-radio">
                        <input type="radio" id="disp_sim" name="disponibilidade" value="1" <?= $disp_atual == 1 ? 'checked' : '' ?>>
                        <label for="disp_sim">Disponível</label>
                    </div>
                    <div class="item-radio">
                        <input type="radio" id="disp_nao" name="disponibilidade" value="0" <?= $disp_atual == 0 ? 'checked' : '' ?>>
                        <label for="disp_nao">Não Disponível</label> 
                    </div>
                </div>

                <div class="form-grupo">
                    <label for="img_refeicao">Insira a URL da foto da refeição</label>
                    <input type="text" name="img_refeicao" id="img_refeicao" value="<?= $img_produto ?>">
                </div>

                <div class="form-grupo">
                    <label for="descricao">Descrição detalhada:</label><br>
                    <textarea 
                        id="descricao" 
                        name="descricao" 
                        rows="5" 
                        required><?= $descricao ?></textarea>
                </div>

                <button type="submit" class="btn">Salvar alterações</button>
            </form>

            <footer class="links">
                <a href="../admin/produto_listar.php">Cancelar e Voltar</a>
                <a href="../admin/painel.php">Voltar ao Painel</a>
            </footer>
        </main>
    </body>
</html>

<?php
    desconecta($conexao);
?>