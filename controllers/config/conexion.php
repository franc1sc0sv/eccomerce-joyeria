<?php

class conection
{
    private $server = "localhost";
    private $user = "root";
    private $password = "root";
    private $db_name = "joyeria";

    public $conection;

    public function __construct()
    {
        try {
            $this->conection = new PDO("mysql:host=$this->server; dbname=$this->db_name; charset=utf8mb4", $this->user, $this->password);
            $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    // INSERT, EDIT, DELETE
    public function ejecutar($sql)
    {
        $this->conection->exec($sql);
        return $this->conection->lastInsertId();
    }

    //SELECT
    public function consultar($sql)
    {
        $sentencia = $this->conection->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function rowCount($sql)
    {
        $sentencia = $this->conection->prepare($sql);
        $sentencia->execute();
        $count = $sentencia->rowCount();
        return $count;
    }
}

$conn = new conection();