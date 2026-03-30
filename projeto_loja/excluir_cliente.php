<?php

require_once "dao/ClienteDAO.php";

$dao = new ClienteDAO();

if (isset($_GET['id'])) {

    $dao->excluir($_GET['id']);

    header("Location: index.php");
    exit;
}
