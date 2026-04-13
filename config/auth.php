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
                <meta http-equiv="refresh" content="3;url=../public/login.php">
                <title>World Foods - Acesso Negado</title>
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
                        <p><a href="../public/login.php" class="btn-nav">Clique aqui se não for redirecionado</a></p>
                        <p><b>World Foods - Explore o mundo da culinária</b></p>
                        <p>Desenvolvido por Rafael Arcangelo</p>
                    </footer>
                </main>
            </body>
        </html>
    
<?php
        exit;
    }
?>