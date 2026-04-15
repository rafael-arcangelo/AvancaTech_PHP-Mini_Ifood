<?php
    $t_pagina = "Login";
    
    include "../public/header.php";
    
    if(isset($_SESSION["id_usuario"])) {
        header("Location: ../admin/painel.php");
        exit;
    }
?>

<header>
    <h1>Login Administrativo</h1>
</header>

<?php if(isset($_GET['erro'])): ?>
    <div class="error-msg" role="alert">
        <strong>ERRO: </strong>&nbsp 
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
    <div class="form-grupo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-grupo">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>
    </div>

    <div class="form-acoes">
        <button class="btn-nav" type="submit" >Entrar</button> |
        <a class="btn-nav" href="../public/usuario_novo.php">Criar conta</a>
    </div>
</form>
            
<?php
    include "../public/footer.php";
?>