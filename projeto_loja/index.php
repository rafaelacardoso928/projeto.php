<?php
require_once "cliente.php";
require_once "produto.php";
require_once "pedido.php";

$cliente = new Cliente(1, "Rafaela Cardoso", "cardosorafaela.2802@gmail.com");

$produto1 = new Produto(1, "Notebook", 3500);
$produto2 = new Produto(2, "Mouse Gamer", 150);
$produto3 = new Produto(3, "Headset", 280);

$pedido = new Pedido(1001, $cliente);

$pedido->adicionarProduto($produto1);
$pedido->adicionarProduto($produto2);
$pedido->adicionarProduto($produto3);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Pedidos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="card">

            <h1>Sistema de Pedidos</h1>

            <h2>Pedido Nº <?php echo $pedido->getNumero(); ?></h2>

            <div class="cliente">
                <h3>👤 Cliente</h3>
                <p><?php echo $pedido->getCliente()->getNome(); ?></p>
                <span><?php echo $pedido->getCliente()->getEmail(); ?></span>
            </div>

            <div class="produtos">
                <h3>Produtos</h3>
                <ul>
                    <?php foreach ($pedido->getProdutos() as $produto): ?>
                        <li>
                            <span><?php echo $produto->getNome(); ?></span>
                            <strong>R$ <?php echo number_format($produto->getPreco(), 2, ',', '.'); ?></strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="total">
                Total: R$ <?php echo number_format($pedido->calcularTotal(), 2, ',', '.'); ?>
            </div>

        </div>
    </div>

</body>

</html>