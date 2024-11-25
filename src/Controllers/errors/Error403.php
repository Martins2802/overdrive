<?php 

namespace Src\Controllers\errors;


class Error403
{
    public function Index()
    {
        echo "<h1>403 - Acesso proibido</h1>";
        echo "<p>Você não tem permissão para acessar esta página</p>";
    }
}