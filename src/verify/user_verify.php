<?php
require_once '../classes/UsuarioDao.php';
require_once '../classes/Usuario.php';

$usuario = new Usuario();
$usuario -> setCpf($_POST['cpf']);
$usuario -> setPassword($_POST['senha']);

UsuarioDao::loginValidate($usuario);
