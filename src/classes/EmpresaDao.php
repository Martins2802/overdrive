<?php
    require_once 'Connection.php';
class EmpresaDao
{
    public static function create(Empresa $emp)
    {
        $sql = 'INSERT INTO enterprise(cnpj,nome_emp,nome_fantasia,senha,telefone,responsavel,id_address)
        VALUES (?,?,?,?,?,?,?)';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$emp->getCnpj());
        $stmt->bindValue(2,$emp->getNome());
        $stmt->bindValue(3,$emp->getFantasia());
        $stmt->bindValue(4,$emp->getPassword());
        $stmt->bindValue(5,$emp->getTelefone());
        $stmt->bindValue(6,$emp->getResponsavel());
        $stmt->bindValue(7,$emp->getEndereco()->getId());
        $stmt->execute();
    }
    public static function read()
    {
        $sql = 'SELECT * FROM enterprise INNER JOIN endereco ON enterprise.id_address = endereco.id';
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

    public static function loginValidate(Empresa $emp) {
        $sql = 'SELECT cnpj, nome_emp, senha, responsavel FROM enterprise WHERE cnpj = ? LIMIT 1';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$emp->getCnpj());
        $stmt->execute();
        $login = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(password_verify($emp->getPassword(),$login[0]['senha'])) {
            session_start();
            $_SESSION['responsavel'] = $login[0]['responsavel'];
            $_SESSION['nome_emp'] = $login[0]['nome_emp'];
            $_SESSION['nome_fantasia'] = $login[0]['nome_fantasia'];
            $_SESSION['logged'] = true;
            header('Location: ../paginas/index.php');
        }
        header("Location: ../paginas/login.php?error=1");
    }

    public static function search($search) {
        $search = "%" . $search . "%";
        $sql = "SELECT * FROM enterprise INNER JOIN endereco ON 
        enterprise.id_address = endereco.id WHERE nome_emp LIKE ?";
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$search);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $retorno;
    }

    public static function verificaDuplicidade($cnpj) {
        $sql = 'SELECT * FROM enterprise WHERE cnpj = ?';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$cnpj);
        $stmt->execute();
        $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($retorno) > 0) {
            return 1;
        }

        return 0;
    }

    public static function update(Empresa $emp, $cnpj)
    {
        $sql = 'UPDATE enterprise SET cnpj = ?, nome_emp = ?, telefone = ?, nome_fantasia = ?,
         responsavel = ?, id_address = ? WHERE cnpj  = ?';
        
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$emp->getCnpj());
        $stmt->bindValue(2,$emp->getNome());
        $stmt->bindValue(3,$emp->getTelefone());
        $stmt->bindValue(4,$emp->getFantasia());
        $stmt->bindValue(5,$emp->getResponsavel());
        $stmt->bindValue(6,$emp->getEndereco()->getId());
        $stmt->bindValue(7,$cnpj);

        $stmt->execute();

        header('Location: paginas/index.php');
    }
    public static function delete($cnpj)
    {
        $sql = 'DELETE FROM enterprise WHERE cnpj = ?';

        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$cnpj);
        
        $stmt->execute();
    }
}