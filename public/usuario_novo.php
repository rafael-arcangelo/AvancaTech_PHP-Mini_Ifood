<?php
    $t_pagina = "Novo Usuário";

    include "../public/header.php";
?>

<div class="container">
    <header>
        <h1>Cadastro de Usuário</h1>
    </header>

    <form action="../public/usuario_salvar.php" method="POST">
        <div class="form-grupo">
            <label for="nome_pessoa">Seu nome completo</label>
            <input type="text" name="nome_pessoa" id="nome_pessoa" required>
        </div>

        <div class="form-grupo">
            <label for="nome_restaurante">Nome do Restaurante</label>
            <input type="text" name="nome_restaurante" id="nome_restaurante" required>
        </div>

        <div class="form-grupo">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-grupo">
            <label for="senha1">Digite sua Senha</label>
            <input type="password" name="senha1" id="senha1" required>
        </div>

        <div class="form-grupo">
            <label for="senha2">Digite sua senha novamente</label>
            <input type="password" name="senha2" id="senha2" required>
        </div>

        <div class="form-grupo">
            <label for="img_logo">Insira a URL da logo do restaurante</label>
            <input type="text" name="img_logo" id="img_logo" placeholder="http://exemplo.com/imagem.png">
        </div>
        
        <button type="submit" class="btn-nav">Finalizar Cadastro</button>
    </form>
</div>

<?php
    include "../public/footer.php";
?>