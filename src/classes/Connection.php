<?php

class Connection
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "rpm&2024";
    private static $dbname = "overdrive";
    private static $port = 3306;
    private static $conn;

    public static function getConnection(): object
    {
        try {
            if (self::$conn === null) {
                self::$conn = new PDO("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname,
                                       self::$user, self::$pass);
            }
            return self::$conn;
        } catch (PDOException $e) {
            die("Não foi possível se conectar com o banco de dados: " . $e->getMessage());
        }
    }
}
?>
