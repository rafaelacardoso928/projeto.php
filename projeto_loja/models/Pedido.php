<?php

class Pedido
{
    private $numero;
    private $cliente;
    private $produtos = [];

    public function __construct($numero, Cliente $cliente)
    {
        $this->numero = $numero;
        $this->cliente = $cliente;
    }

    public function adicionarProduto(Produto $produto)
    {
        $this->produtos[] = $produto;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    public function calcularTotal()
    {
        $total = 0;
        foreach ($this->produtos as $produto) {
            $total += $produto->getPreco();
        }
        return $total;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function getCliente()
    {
        return $this->cliente;
    }
}
