<?php
require_once 'classes/Connection.php';
require_once 'classes/Usuario.php';
require_once 'classes/UsuarioDao.php';
require_once 'classes/EnderecoDao.php';
require_once 'classes/Endereco.php';


if(UsuarioDao::verificaDuplicidade($_POST['cpf'])) {
    echo '<script>window.alert("O CPF já existe!"); history.back()</script>';
    exit();
}

$endereco = new Endereco();
$endereco->setCep($_POST['cep']);
$endereco->setEstado(ucwords(strtolower($_POST['estados'])));
$endereco->setCidade(ucwords(strtolower($_POST['cidade'])));
$endereco->setLogradouro(ucwords(strtolower($_POST['logradouro'])));
$endereco->setBairro(ucwords(strtolower($_POST['bairro'])));
$endereco->setNumlogradouro(ucwords(strtolower($_POST['numero'])));

$usuario = new Usuario();
$usuario -> setStatus(0);
$usuario -> setNome(ucwords(strtolower($_POST['nome'])));
$usuario -> setCpf($_POST['cpf']);
$usuario -> setPassword(password_hash($_POST['senha'], PASSWORD_DEFAULT));
$usuario -> setCnh(ucwords(strtolower($_POST['cnh'])));
$usuario -> setTelefone($_POST['telefone']);
$usuario -> setCarro(ucwords(strtolower($_POST['carro'])));
$usuario -> setCnpj(ucwords(strtolower($_POST['empresas'])));
$usuario -> setEndereco($endereco);
$usuario -> setTipo('Comum');

if(EnderecoDao::verifyEnd($endereco) == 0) {
    EnderecoDao::create($endereco);
}

UsuarioDao::create($usuario);

if($usuario->getCnpj() != NULL) {
    $usuario->setStatus(1);
}

header('Location: paginas/cadastro.php');