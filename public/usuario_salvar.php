<?php
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    if ($_SERVER["REQUEST_METHOD"] !="POST") {
        die("Acesso Inválido");
    }

    $nome = trim($_POST["nome_pessoa"]);
    $n_restaurante = trim($_POST["nome_restaurante"]);
    $email = trim($_POST["email"]);
    $senha1 = trim($_POST["senha1"]);
    $senha2 = trim($_POST["senha2"]);
    $img_restaurante = trim($_POST["img_logo"]);

    $senha = $senha1;

    if(empty($img_restaurante)) {
        $img_restaurante = "https://cdn-icons-png.flaticon.com/512/4722/4722865.png";
    }

    if ($senha1 !== $senha2) {
        die("As senhas não conferem.");
    }
       
    if(empty($nome) || empty($n_restaurante) || empty($email) || empty($senha)) {
        die("Todos os campos são obrigatórios.");
    }

    if (strlen($nome) < 3) die("Nome deve ter ao menos 3 caracteres.");
    if (strlen($n_restaurante) < 5) die("Nome do restaurante deve ter ao menos 5 caracteres.");
    if (strlen($senha) < 8) die("Senha deve ter ao menos 8 caracteres.");

    $nome = mysqli_real_escape_string($conexao, $nome);
    $n_restaurante = mysqli_real_escape_string($conexao, $n_restaurante);
    $email = mysqli_real_escape_string($conexao, $email);
    $img_restaurante = mysqli_real_escape_string($conexao, $img_restaurante);

    $sql_email_check = "SELECT id_usuario FROM usuario WHERE email = '$email'";
    $rslt_email_check = mysqli_query($conexao, $sql_email_check);
    if(mysqli_num_rows($rslt_email_check) > 0) {
        die("Este e-mail já está cadastrado");
    }

    $senha_hash = password_hash($senha1, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome_pessoa, nome_restaurante, email, senha, imagem_restaurante)
            VALUES ('$nome','$n_restaurante','$email','$senha_hash','$img_restaurante')";

    if(mysqli_query($conexao, $sql)) {
        ?>
        
        <!DOCTYPE html>
        <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>World Foods - Sucesso ao cadastrar</title>
                <link rel="stylesheet" href="../css/style.css">
            </head>

            <body>
                <main class="container">
                    <header>
                        <h1>Bem vindo ao World Foods!</h1>
                    </header>

                    <section>
                        <p>O restaurante <strong><?= $n_restaurante ?> foi cadastrado com sucesso!</strong></p>
                    </section>

                    <footer>
                        <a href="../public/login.php" class="btn-nav">Voltar ao Login</a>
                        <p><b>World Foods - Explore o mundo da culinária</b></p>
                        <p>Desenvolvido por Rafael Arcangelo</p>
                    </footer>
                </main>
            </body>
        </html>
        
        <?php
            } else {
                echo "Erro ao cadastrar: " . mysqli_error($conexao);
            }

    desconecta($conexao);
?>