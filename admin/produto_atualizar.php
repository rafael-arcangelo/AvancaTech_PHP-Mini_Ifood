<?php 
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    if(!isset($_POST["id_produto"])) {
        die("acesso inválido.");
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
        die("Todos os campos são obrigatórios e o preço deve ser maior que 0.");
    }

    if (strlen($n_refeicao) < 3) 
        die("Nome deve ter ao menos 3 caracteres.");

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
            die("Produto não encontrado ou você não tem permissão para atualizar ou não foram encontradas alterações.");
        }
?>

    <!DOCTYPE html>
    <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>World Foods - Refeição Atualizada</title>
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <body>
            <main class="container">
                <header>
                    <h1>Atualizado com sucesso!</h1>
                    <p>Refeição <strong><?= htmlspecialchars($n_refeicao) ?></strong> atualizada no cardápio!</p>
                </header>

                <section class="links-sucesso">
                    <a href='../admin/produto_listar.php' class="btn-nav">Ver refeições cadastradas</a>
                    <a href='../admin/painel.php' class="btn-nav">Voltar ao Painel</a>                
                </section>

                <footer>
                    <a href="../public/logout.php" class="btn-excluir" onclick="return confirm('Tem certeza que deseja sair?')">Sair do Sistema</a>
                    <p><b>World Foods - Explore o mundo da culinária</b></p>
                    <p>Desenvolvido por Rafael Arcangelo</p>
                </footer>
            </main>
        </body>
    </html>

<?php
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }

    desconecta($conexao);
?>