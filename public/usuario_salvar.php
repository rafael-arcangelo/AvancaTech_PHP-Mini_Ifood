<?php
    $t_pagina = "Usuário Salvo!";

    include "../public/header.php";

    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    if ($_SERVER["REQUEST_METHOD"] !="POST") {
        echo 
            "<div class='error-msg'>
                <p><strong>ACESSO INVÁLIDO.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $nome = trim($_POST["nome_pessoa"]);
    $n_restaurante = trim($_POST["nome_restaurante"]);
    $email = trim($_POST["email"]);
    $senha1 = trim($_POST["senha1"]);
    $senha2 = trim($_POST["senha2"]);
    $img_restaurante = trim($_POST["img_logo"]);

    $senha = $senha1;

    if(empty($img_restaurante)) {
        $img_restaurante = "https://i.ibb.co/G3pLpm9F/Logo-Default.png";
    }

    if ($senha1 !== $senha2) {
        echo 
            "<div class='error-msg'>
                <p><strong>As senhas não conferem.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }
       
    if(empty($nome) || empty($n_restaurante) || empty($email) || empty($senha)) {
        echo 
            "<div class='error-msg'>
                <p><strong>Todos os campos são obrigatórios.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
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
        echo 
            "<div class='error-msg'>
                <p><strong>Este e-mail já está cadastrado.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $senha_hash = password_hash($senha1, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome_pessoa, nome_restaurante, email, senha, imagem_restaurante)
            VALUES ('$nome','$n_restaurante','$email','$senha_hash','$img_restaurante')";

    if(mysqli_query($conexao, $sql)) {
?>
        
<header>
    <h1>Bem vindo ao World Foods!</h1>
</header>

<section>
    <p>O restaurante <strong><?= $n_restaurante ?> foi cadastrado com sucesso!</strong></p>
</section>

<?php
        include "../public/footer.php";

            } else {
                echo 
                    "<div class='error-msg'>
                        <p><strong>Erro ao cadastrar: " . mysqli_error($conexao) . "</strong></p>
                    </div>";  
                include "../public/footer.php";
                exit;
            }
?>