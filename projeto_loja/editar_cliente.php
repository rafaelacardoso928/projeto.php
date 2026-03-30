<?php

require_once "dao/ClienteDAO.php";
require_once "models/Cliente.php";

$clienteDAO = new ClienteDAO();

// Buscar cliente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cliente = $clienteDAO->buscarPorId($id);

    if (!$cliente) {
        die("Cliente não encontrado!");
    }
}

// Atualizar cliente
if (isset($_POST['atualizar'])) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $clienteAtualizado = new Cliente($id, $nome, $email);

    if ($clienteDAO->atualizar($clienteAtualizado)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar!";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
    <h2>Editar Cliente</h2>

    <form method="POST">

        <!-- ID escondido -->
        <input type="hidden" name="id" value="<?= $cliente->getId(); ?>">

        Nome:
        <input type="text" name="nome" value="<?= $cliente->getNome(); ?>" required>

        Email:
        <input type="email" name="email" value="<?= $cliente->getEmail(); ?>" required>

        <button name="atualizar">Atualizar</button>

    </form>
</div>