<?php
declare(strict_types=1);
namespace Src\repository;

use Exception;
use Src\database\DatabaseConnection;

abstract class Repository
{
    public function __construct(protected DatabaseConnection $db)
    {
    }

    /**
     * @throws Exception
     */
    protected function insert(string $table, array $data): int
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

        $sql = "INSERT INTO `{$table}` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

        $pdo = $this->db->getConnection();

        $stmt = $pdo->prepare($sql);

        foreach ($bindValues as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value);
        }

        $stmt->execute();

        return (int)$pdo->lastInsertId();
    }

    /**
     * @throws Exception
     */
    protected function find(string $table, array $where = []): array
    {
        $sql = "SELECT * FROM `{$table}`";
        $whereParts = [];
        $bindValues = [];

        if (!empty($where)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($where as $value) {
                if (is_array($value) && count($value) === 3) {
                    list($column, $operator, $conditionValue) = $value;
                    $column = "`{$column}`";

                    if ($conditionValue instanceof SqlExpression) {
                        $conditions[] = "{$column} {$operator} {$conditionValue->getExpression()}";
                    } else {
                        $placeholder = ":where_" . str_replace('.', '_', $column) . "_";
                        $conditions[] = "{$column} {$operator} {$placeholder}";
                        $bindValues[$placeholder] = $conditionValue;
                    }
                }
            }
            $sql .= implode(' AND ', $conditions);
        }
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare($sql);

        foreach ($bindValues as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }
}