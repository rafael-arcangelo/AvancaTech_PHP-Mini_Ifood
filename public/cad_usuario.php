<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Explora Food - Cadastrar Usuário</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <main class="container">
            <header>
                <h1>Cadastro de Usuário</h1>
            </header>

            <form action="salvar_usuario.php" method="POST">
                <label for="nome_pessoa">Seu nome completo</label>
                <input type="text" name="nome_pessoa" id="nome_pessoa" required>

                <label for="nome_restaurante">Nome do Restaurante</label>
                <input type="text" name="nome_restaurante" id="nome_restaurante" required>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>

                <label for="senha1">Digite sua Senha</label>
                <input type="password" name="senha1" id="senha1" required>

                <label for="senha2">Digite sua senha novamente</label>
                <input type="password" name="senha2" id="senha2" required>

                <label for="img_logo">Insira a URL da logo do restaurante</label>
                <input type="text" name="img_logo" id="img_logo" placeholder="http://exemplo.com/imagem.png">

                <button type="submit">Finalizar Cadastro</button>
            </form>

            <footer>
                <a href="login.php">Voltar ao Login</a>
            </footer>
        </main>
    </body>
</html>