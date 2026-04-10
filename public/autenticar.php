<?php
    session_start();
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    if($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: login.php");
        exit;
    }

    $email = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha = $_POST["senha"];

    if(empty($email) || empty($senha)) {
        header("Location: login.php?erro=vazio");
        exit;
    }

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        if(password_verify($senha, $usuario["senha"])) {
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["usuario_nome_pessoa"] = $usuario["nome_pessoa"];
            $_SESSION["usuario_nome_restaurante"] = $usuario["nome_restaurante"];
            $_SESSION["usuario_email"] = $usuario["email"];
            $_SESSION["usuario_imagem_restaurante"] = $usuario["imagem_restaurante"];
            
            header("Location: painel.php");
            exit;
        }
    }

    header("location: login.php?erro=1");
    exit;
?>