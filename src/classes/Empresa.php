<?php

class Empresa
{
    private $nome;
    private $telefone;
    private $fantasia;
    private $cnpj;
    private $responsavel;
    private $password;
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

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($pass)
    {
        $this->password = $pass;
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

    //fantasia
    public function getFantasia()
    {
        return $this->fantasia;
    }
    public function setFantasia($fantasiaSet)
    {
        $this->fantasia = $fantasiaSet;
    }

    //cnpj
    public function getCnpj()
    {
        return $this->cnpj;
    }
    public function setCnpj($cnpjSet)
    {
        $this->cnpj = $cnpjSet;
    }

    //responsavel
    public function getResponsavel()
    {
        return $this->responsavel;
    }
    public function setResponsavel($responsavelSet)
    {
        $this->responsavel = $responsavelSet;
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
};
