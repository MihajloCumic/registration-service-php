<?php
declare(strict_types=1);
namespace Src\repository\implementations;

use Exception;
use Src\database\DatabaseConnection;
use Src\repository\component\Repository;
use Src\repository\component\SQLExpression;

class UserLogRepository extends Repository
{
    public function __construct(DatabaseConnection $db)
    {
        parent::__construct($db, 'user_log');
    }

    /**
     * @throws Exception
     */
    public function create(int $userId, string $action): int
    {
          return $this->insert([
              'user_id' => $userId,
              'action' => $action,
              'log_time' => new SQLExpression('NOW()')
          ]);
    }
}