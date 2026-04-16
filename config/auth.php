<?php
    session_start();
    $t_pagina = "ACESSO NEGADO";
    
    if(!isset($_SESSION["id_usuario"])) {
        header("Refresh: 2; url=../public/login.php");
        session_abort();
        include "../public/header.php";
?>

<header>
    <h1>⚠️ Acesso Negado</h1>
</header>

<section class="container">
    <p>Você precisa fazer login para acessar esta página.</p>
    <p>Redirecionando para o login em <strong>03 segundos</strong>...</p>
</section>
    
<?php
         include "../public/footer.php";
         exit;
    }
?>