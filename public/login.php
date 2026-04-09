<?php
    session_start();
    
    if(isset($_SESSION["id_usuario"])) {
        header("Location: painel.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Explora Food - Login Administrativo</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <main class="container">
            <header>
                <h1>Login no sistema</h1>
            </header>
            
            <?php if(isset($_GET['erro'])): ?>
                <div class="error-msg" role="alert">
                    <strong>Erro:</strong>
                    <?php
                        if($_GET['erro'] == 'vazio') {
                            echo "Por favor, preencha todos os campos.";
                        } else {
                            echo "E-mail e/ou senha inválidos.";
                        }
                    ?>
                </div>
            <?php endif; ?>

            <form action="autenticar.php" method="POST">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>
                
                <button type="submit">Entrar</button>
            </form>
            
            <footer>
                <a href="cad_usuario.php">Criar conta</a>
            </footer>
        </main>
    </body>
</html>