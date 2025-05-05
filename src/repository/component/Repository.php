<?php
declare(strict_types=1);
namespace Src\repository\component;

use Exception;
use Src\database\DatabaseConnection;
use Src\repository\component\where\WhereBase;

abstract class Repository
{
    public function __construct(protected DatabaseConnection $db, protected string $table)
    {
    }


    protected function insert(array $data): int
    {
        $columns = [];
        $placeholders = [];
        $bindValues = [];

        foreach ($data as $column => $value) {
            $columns[] = "`{$column}`";
            if ($value instanceof SqlExpression) {
                $placeholders[] = $value->getExpression();
            } else {
                $placeholder = ":{$column}";
                $placeholders[] = $placeholder;
                $bindValues[$placeholder] = $value;
            }

        }

        $sql = "INSERT INTO `{$this->table}` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

        $pdo = $this->db->getConnection();

        $stmt = $pdo->prepare($sql);

        foreach ($bindValues as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value);
        }

        $stmt->execute();

        return (int)$pdo->lastInsertId();
    }

    protected function newFind(): WhereBase
    {
        $sql = "SELECT * FROM `{$this->table}`";
        return new WhereBase($sql);
    }
}