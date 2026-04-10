<?php
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Acesso inválido.");
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
        die("Todos os campos são obrigatórios e o preço deve ser maior que 0.");
    }

    if (strlen($n_refeicao) < 3) die("Nome deve ter ao menos 3 caracteres.");

    $n_refeicao = mysqli_real_escape_string($conexao, $n_refeicao);
    $categoria = mysqli_real_escape_string($conexao, $categoria);
    $descricao = mysqli_real_escape_string($conexao, $descricao);
    $img_refeicao = mysqli_real_escape_string($conexao, $img_refeicao);

    $sql = "INSERT INTO produto (nome_produto, descricao, categoria, preco, disponibilidade, imagem_produto, id_usuario)
            VALUES ('$n_refeicao','$descricao','$categoria', $preco, $disponivel,'$img_refeicao', $id_usuario)";

    if(mysqli_query($conexao, $sql)) {
?>

    <!DOCTYPE html>
    <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Explora Food - Refeição Salva</title>
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <body>
            <main class="container">
                <header>
                    <h1>Salvo com sucesso!</h1>
                    <p>Refeição <strong><?= htmlspecialchars($n_refeicao) ?></strong> cadastrada no cardápio!</p>
                </header>

                <section class="links-sucesso">
                    <a href='produto_novo.php' class="btn">Cadastrar outra refeição</a>
                    <a href='produto_listar.php' class="btn">Ver refeições cadastradas</a>
                    <a href='painel.php' class="btn">Voltar ao Painel</a>                
                </section>
            </main>
        </body>
    </html>

<?php
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }

    desconecta($conexao);
?>