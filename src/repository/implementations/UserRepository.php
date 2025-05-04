<?php
declare(strict_types=1);
namespace Src\repository\implementations;

use Exception;
use Src\database\DatabaseConnection;
use Src\repository\component\Repository;

class UserRepository extends Repository
{

    public function __construct(DatabaseConnection $db)
    {
        parent::__construct($db, 'user');
    }

    /**
     * @throws Exception
     */
    public function create(string $email, string $pass): int
    {
        return $this->insert([
            'email' => $email,
            'password' => $pass
        ]);
    }

    /**
     * @throws Exception
     */
    public function doesUserWithEmailExist(string $email): bool
    {
        $pdo = $this->db->getConnection();
        $statement = $pdo->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count > 0;
    }
}