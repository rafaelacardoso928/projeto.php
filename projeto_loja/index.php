<?php

require_once "dao/ClienteDAO.php";
require_once "dao/ProdutoDAO.php";
require_once "dao/PedidoDAO.php";

require_once "models/Cliente.php";
require_once "models/Produto.php";
require_once "models/Pedido.php";

$clienteDAO = new ClienteDAO();
$produtoDAO = new ProdutoDAO();
$pedidoDAO = new PedidoDAO();

# ================= CLIENTE =================
if (isset($_POST['salvar_cliente'])) {
    $clienteDAO->inserir(
        new Cliente(null, $_POST['nome'], $_POST['email'])
    );
}

# ================= PRODUTO =================
if (isset($_POST['salvar_produto'])) {
    $produtoDAO->inserir(
        new Produto(null, $_POST['nome_produto'], $_POST['preco'])
    );
}

# ================= PEDIDO =================
if (isset($_POST['salvar_pedido'])) {
    $pedidoDAO->inserir(
        new Pedido(null, $_POST['cid'], $_POST['pid'])
    );
}

# ================= LISTAS =================
$clientes = $clienteDAO->listar();
$produtos = $produtoDAO->listar();
$pedidos = $pedidoDAO->listar();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sistema Loja</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>💖 Sistema de Loja</h1>

        <!-- CLIENTE -->
        <div class="card">
            <h2>Cadastrar Cliente</h2>

            <form method="POST">
                <input name="nome" placeholder="Nome" required>
                <input name="email" placeholder="Email" required>
                <button name="salvar_cliente">Salvar</button>
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['nome'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?= $c['id'] ?>">Editar</a>
                            <a href="excluir_cliente.php?id=<?= $c['id'] ?>"
                                onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- PRODUTO -->
        <div class="card">
            <h2>Cadastrar Produto</h2>

            <form method="POST">
                <input name="nome_produto" placeholder="Nome do produto" required>
                <input name="preco" placeholder="Preço" required>
                <button name="salvar_produto">Salvar</button>
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nome'] ?></td>
                        <td><?= $p['preco'] ?></td>
                        <td>
                            <a href="editar_produto.php?id=<?= $p['id'] ?>">Editar</a>
                            <a href="excluir_produto.php?id=<?= $p['id'] ?>"
                                onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- PEDIDO -->
        <div class="card">
            <h2>Cadastrar Pedido</h2>

            <form method="POST">

                Cliente:
                <select name="cid" required>
                    <option value="">Selecione</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>">
                            <?= $c['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                Produto:
                <select name="pid" required>
                    <option value="">Selecione</option>
                    <?php foreach ($produtos as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= $p['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button name="salvar_pedido">Salvar</button>
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($pedidos as $pd): ?>
                    <tr>
                        <td><?= $pd['id'] ?></td>
                        <td><?= $pd['cliente_id'] ?></td>
                        <td><?= $pd['produto_id'] ?></td>
                        <td>
                            <a href="editar_pedido.php?id=<?= $pd['id'] ?>">Editar</a>
                            <a href="excluir_pedido.php?id=<?= $pd['id'] ?>"
                                onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>

</body>

</html>