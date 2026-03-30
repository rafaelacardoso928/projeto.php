<?php
require_once "config/Database.php";
require_once "models/Cliente.php";

class ClienteDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function inserir($c)
    {
        $sql = "INSERT INTO clientes (nome,email) VALUES (:n,:e)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":n", $c->getNome());
        $stmt->bindValue(":e", $c->getEmail());
        return $stmt->execute();
    }

    public function listar()
    {
        return $this->conn->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        return $d ? new Cliente($d['id'], $d['nome'], $d['email']) : null;
    }

    public function atualizar($c)
    {
        $sql = "UPDATE clientes SET nome=:n,email=:e WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":n", $c->getNome());
        $stmt->bindValue(":e", $c->getEmail());
        $stmt->bindValue(":id", $c->getId());
        return $stmt->execute();
    }

    public function excluir($id)
    {
        return $this->conn->prepare("DELETE FROM clientes WHERE id=:id")
            ->execute([":id" => $id]);
    }
}
