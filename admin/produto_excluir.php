<?php 
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Excluir refeição";
    include "../admin/header_auth.php";

    $id_usuario = intval($_SESSION["id_usuario"]);

     if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!isset($_POST["id_produto"])) {
            echo 
                "<div class='error-msg'>
                    <p><strong>ACESSO INVÁLIDO.</strong></p>
                </div>";  
            include "../public/footer.php";
            exit;
        }

        $id_produto = intval($_POST["id_produto"]);

         $sql = "DELETE FROM produto 
                WHERE id_produto = $id_produto 
                AND id_usuario = $id_usuario";

        if (mysqli_query($conexao, $sql)) {
            
            if (mysqli_affected_rows($conexao) > 0) {
                header("Location: ../admin/produto_listar.php?msg=excluido");
            } else {
                echo 
                    "<div class='error-msg'>
                        <p><strong>Erro: Produto não encontrado ou você não tem permissão.</strong></p>
                    </div>";  
                include "../public/footer.php";
                exit;
            }

        } else {
            die("Erro técnico ao excluir: " . mysqli_error($conexao));
                echo 
                    "<div class='error-msg'>
                        <p><strong>Erro: Produto não encontrado ou você não tem permissão.</strong></p>
                    </div>";  
                include "../public/footer.php";
                exit;
        }

    } else {
        header("Location: ../admin/produto_listar.php");
        exit;
    }

  include "../public/footer.php";
?>