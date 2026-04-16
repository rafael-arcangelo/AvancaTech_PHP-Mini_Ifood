<?php
    $t_pagina = "Usuário Salvo!";
    session_start();
    include "../admin/header_auth.php";

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

    $id_usuario = intval($_SESSION['id_usuario']);
    $n_restaurante = trim($_POST["n_restaurante"]);
    $email = trim($_POST["email"]);
    $img_restaurante = trim($_POST["img_logo"]);

    if(empty($img_restaurante)) {
        $img_restaurante = "https://cdn-icons-png.flaticon.com/512/4722/4722865.png";
    }
       
    if(empty($n_restaurante) || empty($email)) {
        echo 
            "<div class='error-msg'>
                <p><strong>Todos os campos são obrigatórios.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    if (strlen($n_restaurante) < 5) {
        echo 
            "<div class='error-msg'>
                <p><strong>Nome do restaurante deve ter ao menos 5 caracteres.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $n_restaurante = mysqli_real_escape_string($conexao, $n_restaurante);
    $email = mysqli_real_escape_string($conexao, $email);
    $img_restaurante = mysqli_real_escape_string($conexao, $img_restaurante);

    $sql = "UPDATE usuario SET
                nome_restaurante = '$n_restaurante',
                email = '$email',
                imagem_restaurante = '$img_restaurante'
            WHERE id_usuario = $id_usuario";

    if(mysqli_query($conexao, $sql)) {
?>
        
<header>
    <h1>Bem vindo ao World Foods!</h1>
</header>

<section>
    <p>O  cadastro do restaurante <strong><?= $n_restaurante ?> foi alterado com sucesso!</strong></p>
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