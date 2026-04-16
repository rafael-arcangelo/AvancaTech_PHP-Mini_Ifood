<?php 
    require_once __DIR__ . "/../config/auth.php";
    
    $t_pagina = "Editar Restaurante";    
    include "../admin/header_auth.php";

    if(!isset($_SESSION["id_usuario"])) {
        echo 
            "<div class='error-msg'>
                <p><strong>ID do restaurante não infomrado.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $id_usuario = intval($_SESSION["id_usuario"]);

    $sql = "SELECT * FROM usuario
            WHERE id_usuario = $id_usuario";
    
    $resultado = mysqli_query($conexao, $sql);
    if(!$resultado) {
        echo 
            "<div class='error-msg'>
                <p><strong>Erro ao buscar produto: " . mysqli_error($conexao) ."</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $restaurante = mysqli_fetch_assoc($resultado);

    if(!$restaurante) {
        echo 
            "<div class='error-msg'>
                <p><strong>Restaurante não encontrado ou não tem permissão para editar.</strong></p>
            </div>";  
        include "../public/footer.php";
        exit;
    }

    $n_restaurante = htmlspecialchars($restaurante["nome_restaurante"]);
    $email = htmlspecialchars($restaurante["email"]);
    $img_restaurante = htmlspecialchars($restaurante["imagem_restaurante"]);
?>
        <section>
            <header>
                <h1>Editar dados</h1>
            </header>
            <br>

            <form action="../admin/restaurante_salvar.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?= $id_usuario; ?>">
            
                <div class="form-grupo">
                    <label for="n_restaurante">Nome do Restaurante</label>
                    <input type="text" name="n_restaurante" id="n_restaurante" value="<?= $n_restaurante ?>" required>
                </div>

                <div class="form-grupo">
                    <label for="email">Email de cadastro</label>
                    <input type="email" name="email" id="email" value="<?= $email ?>" required>
                </div>

                <div class="form-grupo">
                    <label for="img_logo">Insira a URL da logo do restaurante</label>
                    <input type="text" name="img_logo" id="img_logo" value="<?= $img_restaurante ?>">
                </div>

                <button class="btn-nav" type="submit" onclick="return confirm('Alterar <?= $n_restaurante ?>?');">Salvar alterações</button> | 
                <button class="btn-painel" type="button" onclick="location.href='../admin/painel.php'">Voltar ao Painel</button>
            </form>
        </section>

<?php
    include "../public/footer.php";
?>