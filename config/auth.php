<?php
    session_start();

    if(!isset($_SESSION["id_usuario"])) {
        header("Refresh: 3; url=../public/login.php"); 
?>

        <!DOCTYPE html>
        <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Acesso Negado</title>
                <link rel="stylesheet" href="../css/style.css">
            </head>

            <body>
                <main class="container">
                    <header>
                        <h1>⚠️ Acesso Negado</h1>
                    </header>

                    <section>
                        <p>Você precisa fazer login para acessar esta página.</p>
                        <p>Redirecionando para o login em <strong>03 segundos</strong>...</p>
                    </section>

                    <footer>
                        <p><a href="../public/login.php">Clique aqui se não for redirecionado</a></p>
                    </footer>
                </main>
            </body>
        </html>
    
<?php
        exit;
    }
?>