<?php

// Classe representa a tabela clientes
class Cliente
{
    // Atributos privados (Encapsulamento)
    private $id;
    private $nome;
    private $email;

    // Construtor
    public function __construct($id = null, $nome = null, $email = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    // ======================
    // GETTERS
    // ======================

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // ======================
    // SETTERS
    // ======================

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        // validação simples
        if (!empty($nome)) {
            $this->nome = $nome;
        }
    }

    public function setEmail($email)
    {
        // validação básica de email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }
}
