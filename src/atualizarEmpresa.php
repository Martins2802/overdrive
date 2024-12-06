<?php

require_once 'classes/EmpresaDao.php';
require_once 'classes/Empresa.php';
require_once 'classes/Endereco.php';
require_once 'classes/EnderecoDao.php';

if($_POST['cnpj'] != $_GET['cnpj']) {
    if(EmpresaDao::verificaDuplicidade($_POST['cnpj'])) {
    echo '<script>window.alert("O CNPJ já existe!"); history.back()</script>';
    exit();
    }
}


$endereco = new Endereco();
$endereco->setCep($_POST['cep']);
$endereco->setEstado(ucwords(strtolower($_POST['estados'])));
$endereco->setCidade(ucwords(strtolower($_POST['cidade'])));
$endereco->setLogradouro(ucwords(strtolower($_POST['logradouro'])));
$endereco->setBairro(ucwords(strtolower($_POST['bairro'])));
$endereco->setNumlogradouro(ucwords(strtolower($_POST['numero'])));

$emp = new Empresa();
$emp->setNome($_POST['nome']);
$emp->setFantasia($_POST['fantasia']);
$emp->setCnpj($_POST['cnpj']);
$emp->setPassword($_POST['senha']);
$emp->setEndereco($endereco);
$emp->setTelefone($_POST['telefone']);
$emp->setResponsavel($_POST['responsavel']);

if(EnderecoDao::verifyEnd($endereco) == 0) {
    EnderecoDao::create($endereco);
} //endereco dado não se olha os dentes

EmpresaDao::update($emp,$_GET['cnpj']);