<?php
declare(strict_types=1);
namespace Src\repository\implementations;

use Exception;
use Src\repository\Repository;

class UserRepository extends Repository
{
    /**
     * @throws Exception
     */
    public function create(string $email, string $pass): int
    {
        return $this->insert('user', [
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