<?php

require_once "dao/ProdutoDAO.php";
require_once "models/Produto.php";

$dao = new ProdutoDAO();

// Buscar produto
if (isset($_GET['id'])) {
    $produto = $dao->buscarPorId($_GET['id']);

    if (!$produto) {
        die("Produto não encontrado!");
    }
}

// Atualizar
if (isset($_POST['atualizar'])) {

    $p = new Produto(
        $_POST['id'],
        $_POST['nome'],
        $_POST['preco']
    );

    if ($dao->atualizar($p)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar!";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
    <h2>Editar Produto</h2>

    <form method="POST">

        <input type="hidden" name="id" value="<?= $produto->getId(); ?>">

        Nome:
        <input type="text" name="nome" value="<?= $produto->getNome(); ?>" required>

        Preço:
        <input type="text" name="preco" value="<?= $produto->getPreco(); ?>" required>

        <button name="atualizar">Atualizar</button>

    </form>
</div>