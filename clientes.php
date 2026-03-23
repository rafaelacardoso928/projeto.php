<?php

require_once "dao/ClienteDAO.php";
require_once "models/Cliente.php";

$mensagem = "";

if (isset($_POST['salvar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $cliente = new Cliente(null, $nome, $email);

    $clienteDAO = new ClienteDAO();

    if ($clienteDAO->inserir($cliente)) {
        $mensagem = "💖 Cliente cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="card">

        <h1>💖 Cadastro de Clientes</h1>

        <?php if ($mensagem): ?>
            <p><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <form method="POST">

            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>

            <button type="submit" name="salvar">Salvar</button>

        </form>

    </div>

</body>

</html>