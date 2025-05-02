<?php
declare(strict_types=1);
namespace Src\repository\implementations;

use Exception;
use Src\repository\Repository;
use Src\repository\SQLExpression;

class UserLogRepository extends Repository
{
    /**
     * @throws Exception
     */
    public function create(int $userId, string $action): int
    {
          return $this->insert('user_log', [
              'user_id' => $userId,
              'action' => $action,
              'log_time' => new SQLExpression('NOW()')
          ]);
    }
}