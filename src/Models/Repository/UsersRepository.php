<?php

namespace Src\Models\Repository;

use Src\Models\Services\DbConnection;

class UsersRepository extends DbConnection
{
    public function getAllUsers()
    {
        $this->getConnection();
    }
}