<?php

namespace Src\Models\Services;

use PDO;
use PDOException;
use Src\helpers\GenerateLog;
abstract class DbConnection
{
    private object $conn;

    public function getConnection() : object
    {
        try {
            $this->conn = new PDO("mysql:host={$_ENV['DB_HOST']};{$_ENV['DB_PORT']};dbname=" . 
            $_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASS']);

            echo "Conexão com o banco de dados realizada com sucesso!";
            return $this->conn;
        }catch(PDOException $err){
             GenerateLog::generateLog("alert", "Conexão com banco de dados não realizada!", 
             ['error' => $err->getMessage()]);
            die("Erro 001: Por favor, tente novamente. Caso o erro persista, entre em contato
            com o administrador {$_ENV['EMAIL_ADM']}");
        }
    }
}