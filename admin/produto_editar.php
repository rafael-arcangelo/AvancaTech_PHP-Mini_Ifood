<?php 
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Editar refeição";
    include "../admin/header_auth.php";

    if(!isset($_GET["id"])) {
        echo 
            "<div class='error-msg'>
                <p><strong>ID do produto não informado</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $id_produto = intval($_GET["id"]);
    $id_usuario = intval($_SESSION["id_usuario"]);

    $sql = "SELECT * FROM produto
            WHERE id_produto = $id_produto
                AND id_usuario = $id_usuario";
    
    $resultado = mysqli_query($conexao, $sql);
    if(!$resultado) {
        echo 
            "<div class='error-msg'>
                <p><strong>Erro ao buscar produto: " . mysqli_error($conexao) . "</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $produto = mysqli_fetch_assoc($resultado);

    if(!$produto) {
        echo 
            "<div class='error-msg'>
                <p><strong>Produto não encontrado ou não tem permissão para editar.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $n_produto = htmlspecialchars($produto["nome_produto"]);
    $categoria = $produto["categoria"];
    $preco = number_format((float)$produto["preco"], 2, ".", "");
    $img_produto = htmlspecialchars($produto["imagem_produto"]);
    $descricao = htmlspecialchars($produto["descricao"]);
    $disp_atual = intval($produto["disponibilidade"]);
?>

            <header class="">
                <h1>Editar refeição</h1>
            </header>
            <br>

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

                <label>A Refeição está disponivel para venda?</label> 
                <div class="form-grupo-radio">
                <div class="item-radio">
                        <input type="radio" id="disp_sim" name="disponibilidade" value="1" <?= $disp_atual == 1 ? 'checked' : '' ?>>
                        <label for="disp_sim">Disponível</label>
                    </div>
                    <div class="item-radio">
                        <input type="radio" id="disp_nao" name="disponibilidade" value="0" <?= $disp_atual == 0 ? 'checked' : '' ?>>
                        <label for="disp_nao">Não Disponível</label> 
                    </div>
                </div>
                <br>

                <div class="form-grupo">
                    <label for="img_refeicao">Insira a URL da foto da refeição</label>
                    <input type="text" name="img_refeicao" id="img_refeicao" value="<?= $img_produto ?>">
                </div>

                <div class="form-grupo">
                    <label for="descricao">Descrição detalhada:</label>
                    <textarea 
                        id="descricao" 
                        name="descricao" 
                        rows="5" 
                        required><?= $descricao ?></textarea>
                </div>

                <button class="btn-nav" type="submit">Salvar</button>
                <button class="btn-excluir" type="button" onclick= "location.href='../admin/produto_listar.php'">Cancelar</button>
            </form>
            

<?php
    include "../public/footer.php";
?>