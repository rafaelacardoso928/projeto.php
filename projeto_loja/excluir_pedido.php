<?php

require_once "dao/PedidoDAO.php";

$dao = new PedidoDAO();

if (isset($_GET['id'])) {
    $dao->excluir($_GET['id']);
}

header("Location: index.php");
exit;
