<?php
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Nova Refeição";
    include "../admin/header_auth.php";

    $n_restaurante = htmlspecialchars($_SESSION["usuario_nome_restaurante"]); 
?>

<header>
    <h1>Cadastrar Refeição</h1>
</header>

<br>

<form action="produto_salvar.php" method="POST">
    <div class="form-grupo">
        <label for="n_refeicao">Nome da refeição</label>
        <input type="text" name="n_refeicao" id="n_refeicao" required>
    </div>

    <div class="form-grupo">
        <label for="categoria">Categoria da refeição</label>
        <select name="categoria" id="categoria" required>
            <option value="" disabled selected>Selecione uma categoria...</option>
            <option value="entrada">Entrada</option>
            <option value="principal">Principal</option>
            <option value="bebida">Bebida</option>
            <option value="sobremesa">Sobremesa</option>
            <option value="combo">Combo</option>
        </select>
    </div>

    <div class="form-grupo">
        <label for="preco">Preço (R$)</label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" required>
    </div>

    <label>A Refeição está disponivel para venda?</label> 
    <div class="form-grupo-radio">
    <div class="item-radio">
            <input type="radio" id="disp_sim" name="disponibilidade" value="1" checked>
            <label for="disp_sim">Disponível</label>
        </div>
        <div class="item-radio">
            <input type="radio" id="disp_nao" name="disponibilidade" value="0">
            <label for="disp_nao">Não Disponível</label> 
        </div>
    </div>
    <br>

    <div class="form-grupo">
        <label for="img_refeicao">Insira a URL da foto da refeição</label>
        <input type="text" name="img_refeicao" id="img_refeicao" placeholder="http://exemplo.com/imagem.png">
    </div>

    <div class="form-grupo">
        <label for="descricao">Descrição detalhada:</label>
        <textarea id="descricao" name="descricao" rows="5" placeholder="Digite uma descrição detalhada do item aqui..." required></textarea>
    </div>

    <button type="submit" class="btn-nav">Finalizar Cadastro</button>
</form>

<?php
    include "../public/footer.php";
?>