<?php
require_once __DIR__ . "/classes/cliente.php";
require_once __DIR__ . "/classes/produto.php";
require_once __DIR__ . "/classes/pedido.php";

$pedido = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cliente = new Cliente(1, $_POST["nome"], $_POST["email"]);

    $produto1 = new Produto(1, $_POST["produto1"], $_POST["preco1"]);
    $produto2 = new Produto(2, $_POST["produto2"], $_POST["preco2"]);
    $produto3 = new Produto(3, $_POST["produto3"], $_POST["preco3"]);

    $pedido = new Pedido(rand(1000, 9999), $cliente);

    $pedido->adicionarProduto($produto1);
    $pedido->adicionarProduto($produto2);
    $pedido->adicionarProduto($produto3);
} else {

    $cliente = new Cliente(1, "Rafaela Cardoso", "cardosorafaela.2802@gmail.com");

    $produto1 = new Produto(1, "Notebook", 3500);
    $produto2 = new Produto(2, "Mouse Gamer", 150);
    $produto3 = new Produto(3, "Headset", 280);

    $pedido = new Pedido(1001, $cliente);

    $pedido->adicionarProduto($produto1);
    $pedido->adicionarProduto($produto2);
    $pedido->adicionarProduto($produto3);
}
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

            <!-- FORMULÁRIO -->
            <form method="POST">

                <h3>👤 Cadastro</h3>

                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>

                <h3>📦 Produtos</h3>

                <input type="text" name="produto1" placeholder="Produto 1" required>
                <input type="number" name="preco1" placeholder="Preço 1" required>

                <input type="text" name="produto2" placeholder="Produto 2" required>
                <input type="number" name="preco2" placeholder="Preço 2" required>

                <input type="text" name="produto3" placeholder="Produto 3" required>
                <input type="number" name="preco3" placeholder="Preço 3" required>

                <button type="submit"> Criar Pedido</button>

            </form>

            <hr style="margin:20px 0;">

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