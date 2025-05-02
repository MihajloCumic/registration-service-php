<?php
declare(strict_types=1);
namespace Src\database;

class DatabaseConnectionFactory
{
    public static function getDatabaseConnection(): DatabaseConnection
    {
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        return new DatabaseConnection($host, $db, $user, $pass);
    }
}