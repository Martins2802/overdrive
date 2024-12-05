<?php

class Endereco
{
    private $id;
    private $cep;
    private $cidade;
    private $estado;
    private $logradouro;
    private $numero;
    private $bairro;

    //-----------------------------------------------------------------------------
    //CONSTRUTOR
    public function __construct() {}


    //-----------------------------------------------------------------------------
    //GETTERS E SETTERS
    //cep

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }
    
    public function getCep()
    {
        return $this->cep;
    }
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    //cidade
    public function getCidade()
    {
        return $this->cidade;
    }
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    //estado
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    //logradouro
    public function getLogradouro()
    {
        return $this->logradouro;
    }
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    //numlogradouro
    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumlogradouro($numlogradouro)
    {
        $this->numero= $numlogradouro;

        return $this;
    }

    //bairro
    public function getBairro()
    {
        return $this->bairro;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }
}