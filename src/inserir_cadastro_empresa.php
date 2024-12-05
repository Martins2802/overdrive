<?php
include 'classes/Connection.php';
require_once 'classes/Endereco.php';
require_once 'classes/EmpresaDao.php';
require_once 'classes/EnderecoDao.php';
require 'classes/Empresa.php';

if(EmpresaDao::verificaDuplicidade($_POST['cnpj'])) {
    echo '<script>window.alert("O CNPJ já existe!"); history.back()</script>';
    exit();
}


$endereco = new Endereco();
$endereco->setCep($_POST['cep']);
$endereco->setEstado($_POST['estados']);
$endereco->setCidade($_POST['cidade']);
$endereco->setLogradouro($_POST['logradouro']);
$endereco->setBairro($_POST['bairro']);
$endereco->setNumlogradouro($_POST['numero']);

$empresa = new Empresa();
$empresa->setNome($_POST['nome']);
$empresa->setFantasia($_POST['fantasia']);
$empresa->setCnpj($_POST['cnpj']);
$empresa->setPassword(password_hash($_POST['senha'], PASSWORD_DEFAULT));
$empresa->setEndereco($endereco);
$empresa->setTelefone($_POST['telefone']);
$empresa->setResponsavel($_POST['responsavel']);

if(EnderecoDao::verifyEnd($endereco) == 0) {
    EnderecoDao::create($endereco);
} //endereco dado não se olha os dentes

EmpresaDao::create($empresa);

header('Location: paginas/cadastro_empresa.php');