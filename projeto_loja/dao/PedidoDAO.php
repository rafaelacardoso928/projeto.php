<?php

require_once "config/Database.php";
require_once "models/Pedido.php";

class PedidoDAO
{

    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function inserir($p)
    {
        $sql = "INSERT INTO pedidos (cliente_id, produto_id)
                VALUES (:c, :p)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":c" => $p->getClienteId(),
            ":p" => $p->getProdutoId()
        ]);
    }

    public function listar()
    {
        return $this->conn
            ->query("SELECT * FROM pedidos")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {

        $stmt = $this->conn->prepare(
            "SELECT * FROM pedidos WHERE id = :id"
        );

        $stmt->execute([":id" => $id]);

        $d = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$d) return null;

        return new Pedido(
            $d['id'],
            $d['cliente_id'],
            $d['produto_id']
        );
    }

    public function atualizar($p)
    {

        $stmt = $this->conn->prepare(
            "UPDATE pedidos 
             SET cliente_id=:c, produto_id=:p 
             WHERE id=:id"
        );

        return $stmt->execute([
            ":c" => $p->getClienteId(),
            ":p" => $p->getProdutoId(),
            ":id" => $p->getId()
        ]);
    }

    public function excluir($id)
    {

        return $this->conn->prepare(
            "DELETE FROM pedidos WHERE id=:id"
        )->execute([":id" => $id]);
    }
}
