<?php

include '../conexao.php';
include '../verifica_login.php';


// GARANTIR QUE O ID DA LOJA SEJA NUMÉRICO

$loja_id = (int) $_SESSION['loja_id'];

// ================================================
// LINK PÚBLICO PARA COMPARTILHAMENTO
// ================================================

$protocolo = (
    !empty($_SERVER['HTTPS']) &&
    $_SERVER['HTTPS'] !== 'off'
) ? 'https' : 'http';

$host_atual = $_SERVER['HTTP_HOST'] ?? '';

$caminho_script = $_SERVER['SCRIPT_NAME'] ?? '/admin/dashboard.php';
$caminho_admin = dirname($caminho_script);
$caminho_projeto = rtrim(dirname($caminho_admin), '/\\');

$link_loja_publica = $protocolo . '://' .
    $host_atual .
    $caminho_projeto .
    '/loja.php?id=' . $loja_id;


// ================================================
// RESUMO DA LOJA
// ================================================

$total_produtos = 0;
$categoria_loja = "Não informada";
$cidade_loja = "Não informada";
$estado_loja = "";


// BUSCAR TOTAL DE PRODUTOS

$sql_produtos = "SELECT COUNT(*) FROM produtos WHERE loja_id = ?";

$stmt_produtos = mysqli_prepare($conn, $sql_produtos);

if ($stmt_produtos) {

    mysqli_stmt_bind_param($stmt_produtos, "i", $loja_id);

    if (mysqli_stmt_execute($stmt_produtos)) {

        mysqli_stmt_bind_result($stmt_produtos, $total_produtos);
        mysqli_stmt_fetch($stmt_produtos);

    }

    mysqli_stmt_close($stmt_produtos);

}


// ================================================
// ESTATÍSTICAS DE PREÇOS
// ================================================

$preco_medio = 0;
$preco_mais_barato = 0;
$preco_mais_caro = 0;

$nome_mais_barato = "";
$nome_mais_caro = "";

$sql_estatisticas = "SELECT
                        AVG(preco),
                        MIN(preco),
                        MAX(preco),

                        (SELECT nome
                         FROM produtos
                         WHERE loja_id = ?
                         ORDER BY preco ASC, id ASC
                         LIMIT 1),

                        (SELECT nome
                         FROM produtos
                         WHERE loja_id = ?
                         ORDER BY preco DESC, id DESC
                         LIMIT 1)

                     FROM produtos
                     WHERE loja_id = ?";

$stmt_estatisticas = mysqli_prepare(
    $conn,
    $sql_estatisticas
);

if ($stmt_estatisticas) {

    mysqli_stmt_bind_param(
        $stmt_estatisticas,
        "iii",
        $loja_id,
        $loja_id,
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_estatisticas)) {

        mysqli_stmt_bind_result(
            $stmt_estatisticas,
            $preco_medio,
            $preco_mais_barato,
            $preco_mais_caro,
            $nome_mais_barato,
            $nome_mais_caro
        );

        mysqli_stmt_fetch($stmt_estatisticas);

    }

    mysqli_stmt_close($stmt_estatisticas);

}


// ================================================
// BUSCAR INFORMAÇÕES DA LOJA
// ================================================

$sql_loja = "SELECT nome, categoria, cidade, estado,
                    descricao, endereco, logo, foto_capa
             FROM lojas
             WHERE id = ?
             LIMIT 1";

$stmt_loja = mysqli_prepare($conn, $sql_loja);

$nome_loja = "";
$descricao_loja = "";
$endereco_loja = "";
$logo_loja = "";
$foto_capa_loja = "";

if ($stmt_loja) {

    mysqli_stmt_bind_param($stmt_loja, "i", $loja_id);

    if (mysqli_stmt_execute($stmt_loja)) {

        mysqli_stmt_bind_result(
            $stmt_loja,
            $nome,
            $categoria,
            $cidade,
            $estado,
            $descricao,
            $endereco,
            $logo,
            $foto_capa
        );

        if (mysqli_stmt_fetch($stmt_loja)) {

            $nome_loja = $nome ?? "";
            $descricao_loja = $descricao ?? "";
            $endereco_loja = $endereco ?? "";
            $logo_loja = $logo ?? "";
            $foto_capa_loja = $foto_capa ?? "";

            if (!empty($categoria)) {
                $categoria_loja = $categoria;
            }

            if (!empty($cidade)) {
                $cidade_loja = $cidade;
            }

            if (!empty($estado)) {
                $estado_loja = $estado;
            }

        }

    }

    mysqli_stmt_close($stmt_loja);

}


// ================================================
// INDICADOR DE PREENCHIMENTO
// ================================================

$campos_cadastro = array(

    "Nome da loja" => $nome_loja,
    "Categoria" => $categoria,
    "Descrição" => $descricao_loja,
    "Endereço" => $endereco_loja,
    "Logo" => $logo_loja,
    "Foto de capa" => $foto_capa_loja

);

$total_campos = count($campos_cadastro);
$campos_preenchidos = 0;

foreach ($campos_cadastro as $campo) {

    if (!empty(trim((string) $campo))) {
        $campos_preenchidos++;
    }

}

$porcentagem_cadastro = (int) round(
    ($campos_preenchidos / $total_campos) * 100
);


// ================================================
// HISTÓRICO DE ATIVIDADES
// ================================================

$atividades = array();

$sql_atividades = "SELECT tipo, descricao, data_atividade
                   FROM atividades_loja
                   WHERE loja_id = ?
                   ORDER BY data_atividade DESC, id DESC
                   LIMIT 5";

$stmt_atividades = mysqli_prepare(
    $conn,
    $sql_atividades
);

if ($stmt_atividades) {

    mysqli_stmt_bind_param(
        $stmt_atividades,
        "i",
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_atividades)) {

        mysqli_stmt_bind_result(
            $stmt_atividades,
            $tipo,
            $descricao,
            $data_atividade
        );

        while (mysqli_stmt_fetch($stmt_atividades)) {

            $atividades[] = array(
                "tipo" => $tipo,
                "descricao" => $descricao,
                "data_atividade" => $data_atividade
            );

        }

    }

    mysqli_stmt_close($stmt_atividades);

}


/*
================================================
ESTATÍSTICAS DE VISUALIZAÇÕES
================================================
*/

$visualizacoes_loja = 0;
$total_exibicoes_produtos = 0;
$produtos_mais_exibidos = array();


// TOTAL DE ACESSOS À PÁGINA DA LOJA

$sql_visualizacoes_loja = "
    SELECT COUNT(*)
    FROM visualizacoes_loja
    WHERE loja_id = ?
      AND produto_id IS NULL
";

$stmt_visualizacoes_loja = mysqli_prepare(
    $conn,
    $sql_visualizacoes_loja
);

if ($stmt_visualizacoes_loja) {

    mysqli_stmt_bind_param(
        $stmt_visualizacoes_loja,
        "i",
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_visualizacoes_loja)) {

        mysqli_stmt_bind_result(
            $stmt_visualizacoes_loja,
            $visualizacoes_loja
        );

        mysqli_stmt_fetch($stmt_visualizacoes_loja);

    }

    mysqli_stmt_close($stmt_visualizacoes_loja);

}


// TOTAL DE EXIBIÇÕES DOS PRODUTOS

$sql_total_exibicoes = "
    SELECT COUNT(*)
    FROM visualizacoes_loja
    WHERE loja_id = ?
      AND produto_id IS NOT NULL
";

$stmt_total_exibicoes = mysqli_prepare(
    $conn,
    $sql_total_exibicoes
);

if ($stmt_total_exibicoes) {

    mysqli_stmt_bind_param(
        $stmt_total_exibicoes,
        "i",
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_total_exibicoes)) {

        mysqli_stmt_bind_result(
            $stmt_total_exibicoes,
            $total_exibicoes_produtos
        );

        mysqli_stmt_fetch($stmt_total_exibicoes);

    }

    mysqli_stmt_close($stmt_total_exibicoes);

}


// PRODUTOS MAIS EXIBIDOS NA VITRINE

$sql_produtos_exibidos = "
    SELECT
        p.nome,
        COUNT(v.id) AS total_exibicoes
    FROM visualizacoes_loja v
    INNER JOIN produtos p
        ON p.id = v.produto_id
       AND p.loja_id = v.loja_id
    WHERE v.loja_id = ?
      AND v.produto_id IS NOT NULL
    GROUP BY p.id, p.nome
    ORDER BY total_exibicoes DESC, p.nome ASC
    LIMIT 5
";

$stmt_produtos_exibidos = mysqli_prepare(
    $conn,
    $sql_produtos_exibidos
);

if ($stmt_produtos_exibidos) {

    mysqli_stmt_bind_param(
        $stmt_produtos_exibidos,
        "i",
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_produtos_exibidos)) {

        mysqli_stmt_bind_result(
            $stmt_produtos_exibidos,
            $nome_produto_exibido,
            $quantidade_exibicoes
        );

        while (mysqli_stmt_fetch($stmt_produtos_exibidos)) {

            $produtos_mais_exibidos[] = array(
                "nome" => $nome_produto_exibido,
                "total" => $quantidade_exibicoes
            );

        }

    }

    mysqli_stmt_close($stmt_produtos_exibidos);

}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php include '../includes_painel/head.php'; ?>

    <title>Painel da Loja - Vitrine Digital</title>

    <style>

        /* RESUMO DA LOJA */

        .resumo-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 3px 12px rgba(16, 23, 34, 0.05);
        }

        .resumo-icone {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #EAF0FF;
            color: #173B70;
            border-radius: 12px;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .resumo-valor {
            color: #173B70;
            font-size: 1.45rem;
            font-weight: 750;
            margin-bottom: 5px;
        }

        .resumo-descricao {
            color: #6B7280;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .resumo-titulo {
            color: #173B70;
            font-weight: 750;
        }


        /* ESTATÍSTICAS DE PREÇOS */

        .estatistica-detalhe {
            color: #6B7280;
            font-size: 0.85rem;
            margin-top: 8px;
            margin-bottom: 0;
            overflow-wrap: anywhere;
        }


        /* PREENCHIMENTO DO CADASTRO */

        .cadastro-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(16, 23, 34, 0.05);
        }

        .cadastro-titulo {
            color: #173B70;
            font-weight: 750;
        }

        .cadastro-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid #E9EDF3;
        }

        .cadastro-item:last-child {
            border-bottom: none;
        }

        .cadastro-item-nome {
            color: #374151;
            font-weight: 500;
        }

        .cadastro-status-ok {
            color: #198754;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .cadastro-status-pendente {
            color: #B7791F;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .cadastro-progresso {
            height: 12px;
            border-radius: 20px;
            background-color: #E9EDF3;
        }

        .cadastro-progresso .progress-bar {
            background-color: #1769E0;
            border-radius: 20px;
        }


        /* HISTÓRICO DE ATIVIDADES */

        .historico-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(16, 23, 34, 0.05);
        }

        .historico-titulo {
            color: #173B70;
            font-weight: 750;
        }

        .historico-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #E9EDF3;
        }

        .historico-item:last-child {
            border-bottom: none;
        }

        .historico-icone {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 18px;
        }

        .historico-cadastro {
            background-color: #E8F5EC;
            color: #198754;
        }

        .historico-edicao {
            background-color: #FFF4DC;
            color: #B7791F;
        }

        .historico-exclusao {
            background-color: #FCE8E8;
            color: #DC3545;
        }

        .historico-descricao {
            color: #374151;
            font-weight: 600;
            margin-bottom: 4px;
            overflow-wrap: anywhere;
        }

        .historico-data {
            color: #6B7280;
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        .historico-vazio {
            color: #6B7280;
            text-align: center;
            padding: 25px 10px;
        }

    </style>

</head>

<body>

<?php include '../includes_painel/header.php'; ?>


<!-- PAINEL -->

<section class="py-5">

    <div class="container">


        <!-- CABEÇALHO -->

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4 mb-5">

            <div>

                <span class="badge bg-primary px-3 py-2 mb-2">
                    Área administrativa
                </span>

                <h1 class="fw-bold mb-2">
                    Olá, <?php echo htmlspecialchars($_SESSION['loja_nome']); ?>! 👋
                </h1>

                <p class="text-muted mb-0">
                    Gerencie sua loja, produtos e informações.
                </p>

            </div>

            <div>

                <a href="sair.php" class="btn btn-outline-danger">

                    <i class="fa-solid fa-right-from-bracket me-2"></i>

                    Sair

                </a>

            </div>

        </div>


        <!-- RESUMO DA LOJA -->

        <div class="mb-5">

            <h4 class="resumo-titulo mb-3">
                <i class="fa-solid fa-chart-simple me-2"></i>
                Resumo da sua loja
            </h4>

            <div class="row g-3">


                <!-- TOTAL DE PRODUTOS -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">
                            <i class="fa-solid fa-box-open"></i>
                        </div>

                        <div class="resumo-valor">
                            <?php echo (int) $total_produtos; ?>
                        </div>

                        <p class="resumo-descricao">
                            Produtos cadastrados
                        </p>

                    </div>

                </div>


                <!-- CATEGORIA -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">
                            <i class="fa-solid fa-tags"></i>
                        </div>

                        <div class="resumo-valor">
                            <?php echo htmlspecialchars($categoria_loja, ENT_QUOTES, 'UTF-8'); ?>
                        </div>

                        <p class="resumo-descricao">
                            Categoria da loja
                        </p>

                    </div>

                </div>


                <!-- LOCALIZAÇÃO -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div class="resumo-valor">

                            <?php echo htmlspecialchars($cidade_loja, ENT_QUOTES, 'UTF-8'); ?>

                            <?php if ($estado_loja !== "") { ?>
                                - <?php echo htmlspecialchars($estado_loja, ENT_QUOTES, 'UTF-8'); ?>
                            <?php } ?>

                        </div>

                        <p class="resumo-descricao">
                            Localização cadastrada
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- ESTATÍSTICAS DE PREÇOS -->

        <div class="mb-5">

            <h4 class="resumo-titulo mb-3">

                <i class="fa-solid fa-chart-line me-2"></i>

                Estatísticas dos produtos

            </h4>

            <div class="row g-3">


                <!-- PREÇO MÉDIO -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">

                            <i class="fa-solid fa-calculator"></i>

                        </div>

                        <div class="resumo-valor">

                            <?php if ($total_produtos > 0) { ?>

                                R$ <?php echo number_format(
                                    (float) $preco_medio,
                                    2,
                                    ',',
                                    '.'
                                ); ?>

                            <?php } else { ?>

                                --

                            <?php } ?>

                        </div>

                        <p class="resumo-descricao">
                            Preço médio dos produtos
                        </p>

                    </div>

                </div>
                                <!-- PRODUTO MAIS BARATO -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">

                            <i class="fa-solid fa-arrow-down"></i>

                        </div>

                        <div class="resumo-valor">

                            <?php if ($total_produtos > 0) { ?>

                                R$ <?php echo number_format(
                                    (float) $preco_mais_barato,
                                    2,
                                    ',',
                                    '.'
                                ); ?>

                            <?php } else { ?>

                                --

                            <?php } ?>

                        </div>

                        <p class="resumo-descricao">
                            Produto mais barato
                        </p>

                        <?php if ($total_produtos > 0) { ?>

                            <p class="estatistica-detalhe">

                                <?php echo htmlspecialchars(
                                    $nome_mais_barato,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </p>

                        <?php } ?>

                    </div>

                </div>


                <!-- PRODUTO MAIS CARO -->

                <div class="col-12 col-md-4">

                    <div class="resumo-card">

                        <div class="resumo-icone">

                            <i class="fa-solid fa-arrow-up"></i>

                        </div>

                        <div class="resumo-valor">

                            <?php if ($total_produtos > 0) { ?>

                                R$ <?php echo number_format(
                                    (float) $preco_mais_caro,
                                    2,
                                    ',',
                                    '.'
                                ); ?>

                            <?php } else { ?>

                                --

                            <?php } ?>

                        </div>

                        <p class="resumo-descricao">
                            Produto mais caro
                        </p>

                        <?php if ($total_produtos > 0) { ?>

                            <p class="estatistica-detalhe">

                                <?php echo htmlspecialchars(
                                    $nome_mais_caro,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </p>

                        <?php } ?>

                    </div>

                </div>


            </div>

        </div>


        <!-- ESTATÍSTICAS DE VISUALIZAÇÕES -->

        <div class="mb-5">

            <h4 class="resumo-titulo mb-3">

                <i class="fa-solid fa-chart-line me-2"></i>

                Visitas e interesse pelos produtos

            </h4>

            <div class="row g-3">

                <!-- VISUALIZAÇÕES DA LOJA -->

                <div class="col-12 col-md-6">

                    <div class="resumo-card">

                        <div class="resumo-icone">

                            <i class="fa-solid fa-store"></i>

                        </div>

                        <div class="resumo-valor">

                            <?php echo (int) $visualizacoes_loja; ?>

                        </div>

                        <p class="resumo-descricao">

                            Acessos à página pública da loja

                        </p>

                    </div>

                </div>


                <!-- EXIBIÇÕES DOS PRODUTOS -->

                <div class="col-12 col-md-6">

                    <div class="resumo-card">

                        <div class="resumo-icone">

                            <i class="fa-solid fa-eye"></i>

                        </div>

                        <div class="resumo-valor">

                            <?php echo (int) $total_exibicoes_produtos; ?>

                        </div>

                        <p class="resumo-descricao">

                            Total de exibições dos produtos na vitrine

                        </p>

                    </div>

                </div>

            </div>


            <!-- RANKING DE PRODUTOS -->

            <div class="historico-card mt-3">

                <h5 class="historico-titulo mb-2">

                    <i class="fa-solid fa-ranking-star me-2"></i>

                    Produtos mais exibidos

                </h5>

                <p class="text-muted mb-3">

                    Veja quais produtos apareceram mais vezes na vitrine pública.

                </p>


                <?php if (count($produtos_mais_exibidos) > 0) { ?>

                    <?php foreach ($produtos_mais_exibidos as $indice => $produto_exibido) { ?>

                        <div class="cadastro-item">

                            <span class="cadastro-item-nome">

                                <?php echo ($indice + 1); ?>.

                                <?php echo htmlspecialchars(
                                    $produto_exibido['nome'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </span>

                            <span class="badge bg-primary rounded-pill px-3 py-2">

                                <?php echo (int) $produto_exibido['total']; ?>

                                <?php echo ((int) $produto_exibido['total'] === 1) ? 'exibição' : 'exibições'; ?>

                            </span>

                        </div>

                    <?php } ?>

                <?php } else { ?>

                    <div class="historico-vazio">

                        <i class="fa-solid fa-chart-column fs-2 mb-3"></i>

                        <p class="mb-0">

                            Ainda não há exibições de produtos registradas.

                        </p>

                    </div>

                <?php } ?>

            </div>


            <p class="text-muted small mt-2 mb-0">

                Cada carregamento da página pública é contabilizado como um acesso.
                Cada produto exibido nessa página gera uma exibição.
                A visualização da loja pelo painel administrativo não é contabilizada.

            </p>

        </div>


        <!-- PREENCHIMENTO DO CADASTRO -->

        <div class="cadastro-card mb-5">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

                <div>

                    <h4 class="cadastro-titulo mb-2">

                        <i class="fa-solid fa-clipboard-check me-2"></i>

                        Complete sua loja

                    </h4>

                    <p class="text-muted mb-0">
                        Mantenha suas informações atualizadas para deixar sua vitrine mais completa.
                    </p>

                </div>

                <div class="text-md-end">

                    <span class="fw-bold text-primary fs-3">
                        <?php echo $porcentagem_cadastro; ?>%
                    </span>

                    <p class="text-muted small mb-0">
                        Cadastro preenchido
                    </p>

                </div>

            </div>


            <div
                class="progress cadastro-progresso mb-4"
                role="progressbar"
                aria-valuenow="<?php echo $porcentagem_cadastro; ?>"
                aria-valuemin="0"
                aria-valuemax="100">

                <div
                    class="progress-bar"
                    style="width: <?php echo $porcentagem_cadastro; ?>%;">

                </div>

            </div>


            <div class="row g-3">

                <?php foreach ($campos_cadastro as $nome_campo => $valor_campo) { ?>

                    <?php $campo_preenchido = !empty(trim((string) $valor_campo)); ?>

                    <div class="col-12 col-md-6">

                        <div class="cadastro-item">

                            <span class="cadastro-item-nome">

                                <?php echo htmlspecialchars($nome_campo, ENT_QUOTES, 'UTF-8'); ?>

                            </span>

                            <?php if ($campo_preenchido) { ?>

                                <span class="cadastro-status-ok">

                                    <i class="fa-solid fa-circle-check me-1"></i>

                                    Preenchido

                                </span>

                            <?php } else { ?>

                                <span class="cadastro-status-pendente">

                                    <i class="fa-solid fa-circle-exclamation me-1"></i>

                                    Pendente

                                </span>

                            <?php } ?>

                        </div>

                    </div>

                <?php } ?>

            </div>


            <div class="mt-4">

                <a href="minha_loja.php" class="btn btn-primary">

                    <i class="fa-solid fa-pen-to-square me-2"></i>

                    Completar informações

                </a>

            </div>

        </div>
                <!-- HISTÓRICO DE ATIVIDADES -->

        <div class="historico-card mb-5">

            <div class="mb-3">

                <h4 class="historico-titulo mb-2">

                    <i class="fa-solid fa-clock-rotate-left me-2"></i>

                    Histórico de atividades

                </h4>

                <p class="text-muted mb-0">
                    Acompanhe as últimas alterações realizadas na sua loja.
                </p>

            </div>


            <?php if (count($atividades) > 0) { ?>

                <?php foreach ($atividades as $atividade) { ?>

                    <?php

                    $icone_atividade = "fa-circle-info";
                    $classe_atividade = "";
                    $nome_atividade = "Atividade";

                    if ($atividade['tipo'] == "cadastro") {

                        $icone_atividade = "fa-circle-plus";
                        $classe_atividade = "historico-cadastro";
                        $nome_atividade = "Cadastro";

                    } elseif ($atividade['tipo'] == "edicao") {

                        $icone_atividade = "fa-pen-to-square";
                        $classe_atividade = "historico-edicao";
                        $nome_atividade = "Edição";

                    } elseif ($atividade['tipo'] == "exclusao") {

                        $icone_atividade = "fa-trash";
                        $classe_atividade = "historico-exclusao";
                        $nome_atividade = "Exclusão";

                    }

                    ?>

                    <div class="historico-item">

                        <div class="historico-icone <?php echo $classe_atividade; ?>">

                            <i class="fa-solid <?php echo $icone_atividade; ?>"></i>

                        </div>

                        <div class="flex-grow-1">

                            <p class="historico-descricao">

                                <?php echo htmlspecialchars(
                                    $atividade['descricao'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>

                            </p>

                            <p class="historico-data">

                                <span class="fw-semibold">
                                    <?php echo $nome_atividade; ?>
                                </span>

                                <span class="mx-1">•</span>

                                <?php echo date(
                                    'd/m/Y H:i',
                                    strtotime($atividade['data_atividade'])
                                ); ?>

                            </p>

                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="historico-vazio">

                    <i class="fa-solid fa-clock fs-2 mb-3"></i>

                    <p class="mb-0">
                        Nenhuma atividade registrada ainda.
                    </p>

                </div>

            <?php } ?>

        </div>


        <!-- CARDS ORIGINAIS -->

        <div class="row g-4">


            <!-- PRODUTOS -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <div class="card-body p-4 d-flex flex-column">

                        <div
                            class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-4 mb-4"
                            style="width:70px; height:70px;">

                            <i class="fa-solid fa-box-open text-primary fs-2"></i>

                        </div>

                        <h4 class="fw-bold mb-2">
                            Meus Produtos
                        </h4>

                        <p class="text-muted mb-4">
                            Cadastre, edite e exclua os produtos da sua loja.
                        </p>

                        <div class="d-flex flex-column flex-sm-row gap-2 mt-auto">

                            <a href="produtos.php" class="btn btn-primary flex-fill">

                                <i class="fa-solid fa-box me-1"></i>

                                Ver Produtos

                            </a>

                            <a href="cadastrar_produto.php" class="btn btn-outline-primary flex-fill">

                                <i class="fa-solid fa-plus me-1"></i>

                                Cadastrar

                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <!-- MINHA LOJA -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <div class="card-body p-4 d-flex flex-column">

                        <div
                            class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-4 mb-4"
                            style="width:70px; height:70px;">

                            <i class="fa-solid fa-store text-success fs-2"></i>

                        </div>

                        <h4 class="fw-bold mb-2">
                            Minha Loja
                        </h4>

                        <p class="text-muted mb-4">
                            Visualize a página pública da sua loja como seus clientes.
                        </p>

                        <div class="mt-auto">

                            <a
                                href="../loja.php?id=<?php echo $loja_id; ?>&origem=admin"
                                class="btn btn-outline-dark w-100">

                                <i class="fa-solid fa-eye me-2"></i>

                                Ver Minha Loja

                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CONFIGURAÇÕES -->

            <div class="col-12 col-md-6 col-lg-4">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <div class="card-body p-4 d-flex flex-column">

                        <div
                            class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-4 mb-4"
                            style="width:70px; height:70px;">

                            <i class="fa-solid fa-gear text-warning fs-2"></i>

                        </div>

                        <h4 class="fw-bold mb-2">
                            Configurações
                        </h4>

                        <p class="text-muted mb-4">
                            Altere as informações, logo e aparência da sua loja.
                        </p>

                        <div class="mt-auto">

                            <a href="minha_loja.php" class="btn btn-outline-dark w-100">

                                <i class="fa-solid fa-pen-to-square me-2"></i>

                                Editar Loja

                            </a>

                        </div>

                    </div>

                </div>

            </div>


        </div>

        <!-- COMPARTILHAR MINHA LOJA -->

<div class="cadastro-card mt-5">

    <div class="d-flex align-items-start gap-3 mb-3">

        <div
            class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-4"
            style="width:58px; height:58px; min-width:58px;">

            <i class="fa-solid fa-share-nodes text-primary fs-4"></i>

        </div>

        <div>

            <h4 class="cadastro-titulo mb-2">
                Compartilhe sua loja
            </h4>

            <p class="text-muted mb-0">
                Copie o endereço da sua vitrine pública e envie para seus clientes.
            </p>

        </div>

    </div>


    <label for="linkLojaPublica" class="form-label fw-semibold">
        Link público da sua loja
    </label>

    <div class="input-group">

        <input
            type="text"
            id="linkLojaPublica"
            class="form-control"
            value="<?php echo htmlspecialchars($link_loja_publica, ENT_QUOTES, 'UTF-8'); ?>"
            readonly>

        <button
            type="button"
            class="btn btn-primary"
            id="botaoCopiarLink"
            onclick="copiarLinkLoja()">

            <i class="fa-solid fa-copy me-2"></i>
            Copiar link

        </button>

        <a
    href="https://wa.me/?text=<?php
        echo urlencode(
            'Conheça minha loja na Vitrine Digital: ' .
            $link_loja_publica
        );
    ?>"
    target="_blank"
    rel="noopener noreferrer"
    class="btn btn-success"
>
    <i class="fab fa-whatsapp"></i>
    Compartilhar no WhatsApp
    </a>

    </div>

    <p
        id="mensagemCopiaLink"
        class="small mt-2 mb-0"
        role="status"
        aria-live="polite">
    </p>

</div>


<script>

    async function copiarLinkLoja() {

        const campoLink = document.getElementById('linkLojaPublica');
        const mensagem = document.getElementById('mensagemCopiaLink');

        try {

            if (navigator.clipboard && window.isSecureContext) {

                await navigator.clipboard.writeText(campoLink.value);

            } else {

                campoLink.focus();
                campoLink.select();
                campoLink.setSelectionRange(0, 99999);

                const copiado = document.execCommand('copy');

                if (!copiado) {
                    throw new Error('Não foi possível copiar automaticamente.');
                }

            }

            mensagem.textContent = 'Link copiado com sucesso!';
            mensagem.className = 'small text-success mt-2 mb-0';

        } catch (erro) {

            campoLink.focus();
            campoLink.select();

            mensagem.textContent = 'Não foi possível copiar automaticamente. Selecione o link e copie manualmente.';
            mensagem.className = 'small text-warning mt-2 mb-0';

        }

    }

</script>

        <!-- INFORMAÇÃO -->

        <div class="mt-5">

            <div class="alert alert-light border shadow-sm rounded-4 mb-0">

                <div class="d-flex align-items-start gap-3">

                    <i class="fa-solid fa-circle-info text-primary fs-4 mt-1"></i>

                    <div>

                        <strong>Dica:</strong>

                        <span class="text-muted">
                            mantenha os produtos e informações da sua loja sempre atualizados
                            para que seus clientes tenham uma experiência melhor.
                        </span>

                    </div>

                </div>

            </div>

        </div>


    </div>

</section>


<?php include '../includes_painel/footer.php'; ?>

</body>

</html>