
<?php

include '../conexao.php';
include '../verifica_login.php';


// VERIFICAR SE O ID FOI INFORMADO

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {

    $_SESSION['mensagem_excluir_produto'] =
        "Não foi possível excluir o produto.";

    header("Location: produtos.php");
    exit;

}


$id = (int) $_POST['id'];

$loja_id = (int) $_SESSION['loja_id'];


// VERIFICAR CONFIRMAÇÃO

if (
    !isset($_POST['confirmacao']) ||
    $_POST['confirmacao'] !== 'SIM'
) {

    $_SESSION['mensagem_excluir_produto'] =
        "Exclusão cancelada. A confirmação não foi realizada.";

    header("Location: produtos.php");
    exit;

}


// VERIFICAR TOKEN CSRF

if (!isset($_POST['csrf_token'])) {

    $_SESSION['mensagem_excluir_produto'] =
        "Não foi possível excluir o produto. Tente novamente.";

    header("Location: produtos.php");
    exit;

}


$csrf_token = $_POST['csrf_token'];


if (
    empty($_SESSION['csrf_excluir_produto']) ||
    !hash_equals(
        $_SESSION['csrf_excluir_produto'],
        $csrf_token
    )
) {

    $_SESSION['mensagem_excluir_produto'] =
        "Não foi possível excluir o produto. Tente novamente.";

    header("Location: produtos.php");
    exit;

}


/*
|--------------------------------------------------------------------------
| BUSCAR O NOME DO PRODUTO ANTES DA EXCLUSÃO
|--------------------------------------------------------------------------
*/

$nome_produto = "";

$sql_nome = "SELECT nome
             FROM produtos
             WHERE id = ?
             AND loja_id = ?
             LIMIT 1";

$stmt_nome = mysqli_prepare($conn, $sql_nome);

if ($stmt_nome) {

    mysqli_stmt_bind_param(
        $stmt_nome,
        "ii",
        $id,
        $loja_id
    );

    if (mysqli_stmt_execute($stmt_nome)) {

        mysqli_stmt_bind_result(
            $stmt_nome,
            $nome_produto
        );

        mysqli_stmt_fetch($stmt_nome);

    }

    mysqli_stmt_close($stmt_nome);

}


// EXCLUIR SOMENTE O PRODUTO DA LOJA LOGADA

$sql = "DELETE FROM produtos
        WHERE id = ?
        AND loja_id = ?";


$stmt = mysqli_prepare($conn, $sql);


if (!$stmt) {

    $_SESSION['mensagem_excluir_produto'] =
        "Não foi possível excluir o produto. Tente novamente.";

    header("Location: produtos.php");
    exit;

}


mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $id,
    $loja_id
);


// EXECUTAR EXCLUSÃO

if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) > 0) {

        $_SESSION['mensagem_excluir_produto'] =
            "Produto excluído com sucesso.";


        /*
        |--------------------------------------------------------------------------
        | REGISTRAR EXCLUSÃO NO HISTÓRICO
        |--------------------------------------------------------------------------
        */

        $tipo_atividade = "exclusao";

        $descricao_atividade = "Excluiu o produto: " . $nome_produto;

        $sql_atividade = "INSERT INTO atividades_loja
                          (loja_id, tipo, descricao)
                          VALUES (?, ?, ?)";

        $stmt_atividade = mysqli_prepare(
            $conn,
            $sql_atividade
        );

        if ($stmt_atividade) {

            mysqli_stmt_bind_param(
                $stmt_atividade,
                "iss",
                $loja_id,
                $tipo_atividade,
                $descricao_atividade
            );

            mysqli_stmt_execute($stmt_atividade);

            mysqli_stmt_close($stmt_atividade);

        }


    } else {

        $_SESSION['mensagem_excluir_produto'] =
            "Produto não encontrado ou não pertence à sua loja.";

    }

} else {

    $_SESSION['mensagem_excluir_produto'] =
        "Não foi possível excluir o produto. Tente novamente.";

}


mysqli_stmt_close($stmt);


// GERAR NOVO TOKEN CSRF

try {

    $_SESSION['csrf_excluir_produto'] =
        bin2hex(random_bytes(32));

} catch (Exception $e) {

    $_SESSION['csrf_excluir_produto'] =
        bin2hex(openssl_random_pseudo_bytes(32));

}


// VOLTAR PARA A LISTA DE PRODUTOS

header("Location: produtos.php");
exit;

?>
