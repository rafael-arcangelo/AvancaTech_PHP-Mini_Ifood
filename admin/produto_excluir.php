<?php 
    require_once __DIR__ . "/../config/auth.php";
    require_once __DIR__ . "/../config/db.php";
    $conexao = conecta();

    $id_usuario = intval($_SESSION["id_usuario"]);

     if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!isset($_POST["id_produto"])) {
            die("ID do produto não informado.");
        }

        $id_produto = intval($_POST["id_produto"]);

         $sql = "DELETE FROM produto 
                WHERE id_produto = $id_produto 
                AND id_usuario = $id_usuario";

        if (mysqli_query($conexao, $sql)) {
            
            if (mysqli_affected_rows($conexao) > 0) {
                header("Location: ../admin/produto_listar.php?msg=excluido");
                exit;
            } else {
                die("Erro: Produto não encontrado ou você não tem permissão.");
            }

        } else {
            die("Erro técnico ao excluir: " . mysqli_error($conexao));
        }

    } else {
        header("Location: produto_listar.php");
        exit;
    }

    desconecta($conexao);
?>