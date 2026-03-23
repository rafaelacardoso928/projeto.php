<?php

require_once "config/dataBase.php";

// Instancia a classe
$database = new dataBase();

// Tenta conectar
$conn = $database->getConnection();

// Verifica se conectou
if ($conn) {
    echo "Conexão realizada com sucesso!";
}
