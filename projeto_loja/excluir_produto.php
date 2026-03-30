<?php

require_once "dao/ProdutoDAO.php";

$dao = new ProdutoDAO();

if (isset($_GET['id'])) {

    $dao->excluir($_GET['id']);

    header("Location: index.php");
    exit;
}
