<?php
require_once "dao/ClienteDAO.php";
require_once "dao/ProdutoDAO.php";
require_once "models/Cliente.php";
require_once "models/Produto.php";
require_once "models/Pedido.php";

$clienteDAO = new ClienteDAO();
$produtoDAO = new ProdutoDAO();

// CADASTRAR CLIENTE
if (isset($_POST['salvar_cliente'])) {
    $clienteDAO->inserir(
        new Cliente(null, $_POST['nome'], $_POST['email'])
    );
}

// CADASTRAR PRODUTO
if (isset($_POST['salvar_produto'])) {
    $produtoDAO->inserir(
        new Produto(null, $_POST['nome_prod'], $_POST['preco'])
    );
}

// LISTAR
$clientes = $clienteDAO->listar();
$produtos = $produtoDAO->listar();

$pedido = null;

// CRIAR PEDIDO
if (isset($_POST['criar_pedido'])) {

    $cliente = $clienteDAO->buscarPorId($_POST['cliente_id']);
    $pedido = new Pedido(rand(1000, 9999), $cliente);

    if (!empty($_POST['produtos'])) {
        foreach ($_POST['produtos'] as $id) {
            foreach ($produtos as $p) {
                if ($p['id'] == $id) {
                    $pedido->adicionarProduto(
                        new Produto($p['id'], $p['nome'], $p['preco'])
                    );
                }
            }
        }
    }
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

        <h1>💖 Sistema de Pedidos</h1>

        <!-- CLIENTE -->
        <div class="card">
            <h2>👤 Cliente</h2>

            <form method="POST">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <button name="salvar_cliente">Cadastrar</button>
            </form>

            <ul>
                <?php foreach ($clientes as $c): ?>
                    <li><?= $c['nome'] ?> - <?= $c['email'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- PRODUTO -->
        <div class="card">
            <h2>📦 Produto</h2>

            <form method="POST">
                <input type="text" name="nome_prod" placeholder="Produto" required>
                <input type="number" name="preco" step="0.01" required>
                <button name="salvar_produto">Cadastrar</button>
            </form>

            <ul>
                <?php foreach ($produtos as $p): ?>
                    <li><?= $p['nome'] ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- PEDIDO -->
        <div class="card">
            <h2>🧾 Pedido</h2>

            <form method="POST">

                <select name="cliente_id" required>
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                    <?php endforeach; ?>
                </select>

                <br><br>

                <?php foreach ($produtos as $p): ?>
                    <label>
                        <input type="checkbox" name="produtos[]" value="<?= $p['id'] ?>">
                        <?= $p['nome'] ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                    </label><br>
                <?php endforeach; ?>

                <br>

                <button name="criar_pedido">Criar Pedido</button>
            </form>

            <?php if ($pedido): ?>
                <hr>

                <h3>Pedido Nº <?= $pedido->getNumero(); ?></h3>
                <p><strong>Cliente:</strong> <?= $pedido->getCliente()->getNome(); ?></p>

                <ul>
                    <?php foreach ($pedido->getProdutos() as $p): ?>
                        <li><?= $p->getNome(); ?> - R$ <?= number_format($p->getPreco(), 2, ',', '.') ?></li>
                    <?php endforeach; ?>
                </ul>

                <strong>Total: R$ <?= number_format($pedido->calcularTotal(), 2, ',', '.') ?></strong>
            <?php endif; ?>

        </div>

    </div>

</body>

</html>