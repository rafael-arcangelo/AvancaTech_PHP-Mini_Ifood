<?php
    require_once __DIR__ . "/../config/auth.php";

    $t_pagina = "Painel Administrativo";    
    include "../admin/header_auth.php";

    $nome = htmlspecialchars($_SESSION["usuario_nome_pessoa"]);
    $n_restaurante = htmlspecialchars($_SESSION["usuario_nome_restaurante"]);
    $email = htmlspecialchars($_SESSION["usuario_email"]);
    $img_logo = htmlspecialchars($_SESSION["usuario_imagem_restaurante"]);
    
    $id_usuario = intval($_SESSION["id_usuario"]);

    $sql_qtd = "SELECT COUNT(*) AS total 
                FROM produto 
                WHERE id_usuario = $id_usuario";
    $result_qtd = mysqli_query($conexao, $sql_qtd);
    $dados_qtd = mysqli_fetch_assoc($result_qtd);
    $qtd_refeicoes = $dados_qtd ? (int)$dados_qtd["total"] : 0;
    
    $sql_indisp = "SELECT COUNT(*) AS indisponiveis
                FROM produto
                WHERE id_usuario = $id_usuario
                    AND disponibilidade = 0";
    $rs_indisp = mysqli_query($conexao, $sql_indisp);
    $dados_indisp = mysqli_fetch_assoc($rs_indisp);
    $disp_refeicao = $dados_indisp ? (int)$dados_indisp["indisponiveis"] : 0;
    
    date_default_timezone_set('America/Sao_Paulo');
    $data_atual = date('d/m/Y');
    $data_maquina = date('Y-m-d');
?>

<section class="section-painel">
    <h1>Painel Administrativo</h1>

    <div class="painel-conteudo">

        <div class="header-painel">
            <img
                class="logo-painel" 
                src="<?= $img_logo ?: 'https://bit.ly/4mlzujj'; ?>" 
                alt="Logo do <?= $n_restaurante; ?>"
                loading="lazy">
        </div>

        <div class="divisor-vertical"></div>
    
        <div class="texto-header">
            <p>Bem-vindo, <strong><?= $nome ?></strong>!</p>
            <p>Hoje é: <time class="bold" datetime="<?= $data_maquina ?>"><?= $data_atual ?></time></p>
            <p>Dados do restaurante <strong><?= $n_restaurante ?></strong>:</p>
            <p><b><?= $qtd_refeicoes ?></b> refeições totais cadastradas</p>
            
            <?php if ($disp_refeicao > 0): ?>
                <p><b><?= $disp_refeicao ?></b> refeições indisponíveis</p>
            <?php endif; ?>            

        </div>

    </div>

</section>

<?php
    include "../public/footer.php";
?>