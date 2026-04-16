<?php
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Salvar refeição";
    include "../admin/header_auth.php";

    
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo 
            "<div class='error-msg'>
                <p><strong>ACESSO INVÁLIDO.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }


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

    $sql = "INSERT INTO produto (nome_produto, descricao, categoria, preco, disponibilidade, imagem_produto, id_usuario)
            VALUES ('$n_refeicao','$descricao','$categoria', $preco, $disponivel,'$img_refeicao', $id_usuario)";

    if(mysqli_query($conexao, $sql)) {
?>

<header>
    <h3>Refeição <strong><?= htmlspecialchars($n_refeicao) ?></strong> cadastrada no cardápio!</h3>
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