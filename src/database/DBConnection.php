<?php
declare(strict_types=1);
namespace Src\database;

interface DBConnection
{
    public function connect(): void;
    public function lastInsertId(): ?int;
    public function fetchAll(): array;

}