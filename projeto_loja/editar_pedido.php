<?php

require_once "dao/PedidoDAO.php";
require_once "models/Pedido.php";

$dao = new PedidoDAO();

if (!isset($_GET['id'])) {
    die("ID não enviado");
}

$pedido = $dao->buscarPorId($_GET['id']);

if (!$pedido) {
    die("Pedido não encontrado");
}

if (isset($_POST['atualizar'])) {

    $p = new Pedido(
        $_POST['id'],
        $_POST['cliente_id'],
        $_POST['produto_id']
    );

    $dao->atualizar($p);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">

    <input type="hidden" name="id" value="<?= $pedido->getId() ?>">

    Cliente ID:
    <input name="cliente_id" value="<?= $pedido->getClienteId() ?>">

    Produto ID:
    <input name="produto_id" value="<?= $pedido->getProdutoId() ?>">

    <button name="atualizar">Salvar</button>

</form>