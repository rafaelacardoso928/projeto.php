<?php
require_once "config/Database.php";
require_once "models/Produto.php";

class ProdutoDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function inserir($p)
    {
        $sql = "INSERT INTO produtos (nome,preco) VALUES (:n,:p)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":n", $p->getNome());
        $stmt->bindValue(":p", $p->getPreco());
        return $stmt->execute();
    }

    public function listar()
    {
        return $this->conn->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        return $d ? new Produto($d['id'], $d['nome'], $d['preco']) : null;
    }

    public function atualizar($p)
    {
        $stmt = $this->conn->prepare("UPDATE produtos SET nome=:n,preco=:p WHERE id=:id");
        return $stmt->execute([
            ":n" => $p->getNome(),
            ":p" => $p->getPreco(),
            ":id" => $p->getId()
        ]);
    }

    public function excluir($id)
    {
        return $this->conn->prepare("DELETE FROM produtos WHERE id=:id")
            ->execute([":id" => $id]);
    }
}
