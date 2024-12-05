<?php 
    require_once 'classes/Empresa.php';
    require_once 'classes/EmpresaDao.php';

    $listaEmpresas = EmpresaDao::read();
?>