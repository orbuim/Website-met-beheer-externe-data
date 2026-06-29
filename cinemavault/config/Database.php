<?php

class Database
{
    private $host = "localhost";
    private $dbname = "cinemavault";
    private $user = "root";
    private $password = "";

    public function connect()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );

            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $pdo;

        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}