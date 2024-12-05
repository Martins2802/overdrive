<?php

require_once 'Connection.php';

class UsuarioDao
{
    public static function create(Usuario $user)
    {
        $sql = 'INSERT INTO users(cpf,nome, senha, telefone,cnh,cnpj,carro,tipo,status,id_address)
        VALUES (?,?,?,?,?,?,?,?,?,?)';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$user->getCpf());
        $stmt->bindValue(2,$user->getNome());
        $stmt->bindValue(3,$user->getPassword());
        $stmt->bindValue(4,$user->getTelefone());
        $stmt->bindValue(5,$user->getCnh());
        $stmt->bindValue(6,$user->getCnpj());
        $stmt->bindValue(7,$user->getCarro());
        $stmt->bindValue(8,$user->getTipo());
        $stmt->bindValue(9,$user->getStatus());
        $stmt->bindValue(10,$user->getEndereco()->getId());
        $stmt->execute();
    }
    public static function read()
    {
        $sql = 'SELECT * FROM users INNER JOIN endereco ON users.id_address = endereco.id
        INNER JOIN enterprise ON users.cnpj = enterprise.cnpj';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0) 
        {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }
        else
        {
            return [];
        }
    }

    public static function loginValidate(Usuario $user) {
        $sql = 'SELECT cpf, nome, senha, tipo FROM users WHERE cpf = ? LIMIT 1';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$user->getCpf());
        $stmt->execute();
        $login = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(password_verify($user->getPassword(),$login[0]['senha'])) {
            session_start();
            $_SESSION['tipo'] = $login[0]['tipo'];
            $_SESSION['nome'] = $login[0]['nome'];
            $_SESSION['logged'] = true;
            header('Location: ../paginas/index.php');
        }
        header("Location: ../paginas/login.php?error=1");
    }

    public static function update(Usuario $user, $cpf)
    {
        $sql = 'UPDATE users SET cpf = ?, nome = ?, senha = ?, telefone = ?, cnh = ?, carro = ?, 
        tipo = ?,status = ?, cnpj = ?, id_address = ? WHERE cpf  = ?';
        
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$user->getCpf());
        $stmt->bindValue(2,$user->getNome());
        $stmt->bindValue(3,$user->getPassword());
        $stmt->bindValue(4,$user->getTelefone());
        $stmt->bindValue(5,$user->getCnh());
        $stmt->bindValue(6,$user->getCarro());
        $stmt->bindValue(7,$user->getTipo());
        $stmt->bindValue(8,$user->getStatus());
        $stmt->bindValue(9,$user->getCnpj());
        $stmt->bindValue(10,$user->getEndereco()->getId());
        $stmt->bindValue(11,$cpf);

        $stmt->execute();
        header('Location: paginas/index.php');
    }

    public static function verificaVinculo($cnpj) {
        $sql = 'SELECT * FROM users WHERE cnpj = ?';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$cnpj);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($retorno) > 0) {
            return 1;
        }

        return 0;
    }

    public static function verificaDuplicidade($cpf) {
        $sql = 'SELECT * FROM users WHERE cpf = ?';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$cpf);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($retorno) > 0) {
            return 1;
        }

        return 0;
    }

    public static function delete($cpf)
    {
        $sql = 'DELETE FROM users WHERE cpf = ?';

        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$cpf);
        
        $stmt->execute();
    }
}