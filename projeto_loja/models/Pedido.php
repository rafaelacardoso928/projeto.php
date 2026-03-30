<?php

class Pedido
{

    private $id;
    private $cliente_id;
    private $produto_id;

    public function __construct($id, $cliente_id, $produto_id)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->produto_id = $produto_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClienteId()
    {
        return $this->cliente_id;
    }

    public function getProdutoId()
    {
        return $this->produto_id;
    }
}
