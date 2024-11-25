<?php

namespace Src\Controllers\users;

use Src\Models\Repository\UsersRepository;

class ListUsers
{
    public function Index()
    {
        echo "Listar usuários<br><br>";

        $listUsers = new UsersRepository();
        $listUsers->getAllUsers();
    }
}