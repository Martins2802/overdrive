<?php
class EnderecoDao
{
    public static function create(Endereco $e)
    {
        $sql = 'INSERT INTO endereco(cep, estado,cidade,logradouro,bairro,numero)
        VALUES (?,?,?,?,?,?)';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$e->getCep());
        $stmt->bindValue(2,$e->getEstado());
        $stmt->bindValue(3,$e->getCidade());
        $stmt->bindValue(4,$e->getLogradouro());
        $stmt->bindValue(5,$e->getBairro());
        $stmt->bindValue(6,$e->getNumero());
        $stmt->execute();
        EnderecoDao::verifyEnd($e);
    }

    public static function verifyEnd(Endereco $e) {
        $sql = 'SELECT * FROM endereco WHERE cep = ? AND estado = ? AND cidade = ? AND 
        logradouro = ? AND bairro = ? AND numero = ? LIMIT 1';
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$e->getCep());
        $stmt->bindValue(2,$e->getEstado());
        $stmt->bindValue(3,$e->getCidade());
        $stmt->bindValue(4,$e->getLogradouro());
        $stmt->bindValue(5,$e->getBairro());
        $stmt->bindValue(6,$e->getNumero());
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($dados) > 0) {
             $e->setId($dados[0]['id']);
             return 1;
        }
        return 0;
    }


    public static function read()
    {
        $sql = 'SELECT * FROM endereco';
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
    public static function update(Endereco $e)
    {
        $sql = 'UPDATE endereco SET cep = ?, estado = ?, cidade = ?, logradouro = ?,
        bairro = ?, numero = ? WHERE id  = ?';
        
        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$e->getCep());
        $stmt->bindValue(2,$e->getEstado());
        $stmt->bindValue(3,$e->getCidade());
        $stmt->bindValue(4,$e->getLogradouro());
        $stmt->bindValue(5,$e->getBairro());
        $stmt->bindValue(6,$e->getNumero());
        $stmt->bindValue(7,$e->getId());

        $stmt->execute();
    }
    public static function delete($id)
    {
        $sql = 'DELETE FROM endereco WHERE id = ?';

        $stmt = Connection::getConnection()->prepare($sql);
        $stmt->bindValue(1,$id);
        
        $stmt->execute();
    }
}