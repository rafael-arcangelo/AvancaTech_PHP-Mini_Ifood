<?php
    function conecta() {

        $host_db = "localhost";
        $usuario_db = "usuario";
        $senha_db = "senha";
        $db = "nome_do_banco";

        $conexao = mysqli_connect($host_db, $usuario_db, $senha_db, $db);

        if(!$conexao) {
            die("Erro na conexão: " . mysqli_connect_error());
        }

        mysqli_set_charset($conexao, "utf8mb4");

        return $conexao;
    }

    function desconecta($conexao) {
        if ($conexao) {
            mysqli_close($conexao);
        }
    }
?>