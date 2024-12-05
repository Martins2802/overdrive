<?php

class Usuario
{
    private $nome;
    private $telefone;
    private $password;
    private $cpf;
    private $cnh;
    private $carro;
    private $cnpj;
    private $tipo;
    private $status;
    private Endereco $endereco;


    //-----------------------------------------------------------------------------
    //CONSTRUTOR
    public function __construct() {}


    //-----------------------------------------------------------------------------
    //GETTERS E SETTERS
    //nome
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nomeSet)
    {
        $this->nome = $nomeSet;
    }

    //telefone
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefoneSet)
    {
        $this->telefone = $telefoneSet;
    }

    //password
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($passwordSet)
    {
        $this->password = $passwordSet;
    }

    //cpf
    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpfSet)
    {
        $this->cpf = $cpfSet;
    }

    //cnh
    public function getCnh()
    {
        return $this->cnh;
    }
    public function setCnh($cnhSet)
    {
        $this->cnh = $cnhSet;
    }

    //carro
    public function getCarro()
    {
        return $this->carro;
    }
    public function setCarro($carroSet)
    {
        $this->carro = $carroSet;
    }

    //idempregadoem
    public function getCnpj()
    {
        return $this->cnpj;
    }
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    //tipo
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipoSet)
    {
        $this->tipo = $tipoSet;
    }

    //status
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($statusSet)
    {
        $this->status = $statusSet;
    }

    //endereco
    public function getEndereco()
    {
        return $this->endereco;
    }
    public function setEndereco($enderecoSet)
    {
        $this->endereco = $enderecoSet;
    }
}
