<?php

require_once 'classes/UsuarioDao.php';
require_once 'classes/EmpresaDao.php';

if(isset($_GET['cpf'])) {
    UsuarioDao::delete($_GET['cpf']);
    echo '<script>window.alert("Usuário deletado!"); window.location.href="paginas/index.php"</script>';
}
else if(isset($_GET['cnpj'])) {
    if(!UsuarioDao::verificaVinculo($_GET['cnpj'])) {
        EmpresaDao::delete($_GET['cnpj']);
        echo "<script>window.alert('Empresa deletada!'); window.location.href='paginas/index.php'</script>";
    }
    echo '<script>window.alert("Ainda há vínculo da empresa com usuários"); window.location.href="paginas/index.php"</script>';
}


