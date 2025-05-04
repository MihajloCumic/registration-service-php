<?php
declare(strict_types=1);
namespace Src\database;

use Exception;
use PDO;
use PDOException;

class DatabaseConnection
{
    private ?PDO $pdo = null;
    private readonly array $options;

    public function __construct(private readonly string $host, private readonly string $db, private readonly string $user, private readonly string $pass)
    {
        $this->options = [
            PDO::ATTR_EMULATE_PREPARES   => false
        ];
    }

    public function getConnection(): PDO{
        if($this->pdo === null){
            $connection = "mysql:host={$this->host};dbname={$this->db};";
            try {
                $this->pdo = new PDO($connection, $this->user, $this->pass, $this->options);
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        return $this->pdo;
    }

}