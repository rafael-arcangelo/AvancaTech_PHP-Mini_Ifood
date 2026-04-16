<?php 
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Atualizar refeição";
    include "../admin/header_auth.php";

    if(!isset($_POST["id_produto"])) {
        echo 
            "<div class='error-msg'>
                <p><strong>ACESSO INVÁLIDO.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $id_produto = intval($_POST["id_produto"]);
    $n_refeicao = trim($_POST["n_refeicao"]);
    $categoria = trim($_POST["categoria"]);
    $preco  = floatval($_POST["preco"]);
    $img_refeicao = trim($_POST["img_refeicao"]);
    $descricao = trim($_POST["descricao"]);
    $disponivel = intval($_POST["disponibilidade"]);
    $id_usuario = intval($_SESSION["id_usuario"]);

    if(empty($img_refeicao)) {
        $img_refeicao = "https://s3.amazonaws.com/pix.iemoji.com/images/emoji/apple/ios-18/256/0750.png";
    }

    if(empty($n_refeicao) || empty($categoria) || empty($descricao) || $preco <= 0) {
        echo 
            "<div class='error-msg'>
                <p><strong>Todos os campos são obrigatórios e o preço deve ser maior que 0.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    if (strlen($n_refeicao) < 3) {
        echo 
            "<div class='error-msg'>
                <p><strong>Nome deve ter ao menos 3 caracteres.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $n_refeicao = mysqli_real_escape_string($conexao, $n_refeicao);
    $categoria = mysqli_real_escape_string($conexao, $categoria);
    $descricao = mysqli_real_escape_string($conexao, $descricao);
    $img_refeicao = mysqli_real_escape_string($conexao, $img_refeicao);

    $sql = "UPDATE produto SET
                nome_produto = '$n_refeicao',
                descricao = '$descricao',
                categoria = '$categoria',
                preco = $preco,
                disponibilidade = $disponivel,
                imagem_produto = '$img_refeicao'
            WHERE id_produto = $id_produto
                AND id_usuario = $id_usuario";

    if(mysqli_query($conexao, $sql)) {

        if(mysqli_affected_rows($conexao) == 0) {
            echo 
            "<div class='error-msg'>
                <p><strong>Produto não encontrado ou sem alterções efetuadas.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
        }
?>

<header>
    <h3>Refeição <strong><?= htmlspecialchars($n_refeicao) ?></strong> atualizada com sucesso!</h3>
    <br>
    <p>Retornando ao cardápio em 3 seg...</p>
    <meta 
</header>

<?php
    } else {
        echo 
            "<div class='error-msg'>
                <p><strong>Erro ao atualizar: " . mysqli_error($conexao). "</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    include "../public/footer.php";
    header("Refresh: 3; url=../admin/produto_listar.php");
?>