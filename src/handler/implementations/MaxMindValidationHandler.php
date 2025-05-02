<?php
declare(strict_types=1);
namespace Src\handler\implementations;

use Exception;
use Src\handler\RequestHandler;
use Src\request\Request;
use Src\response\Response;
use Src\service\MaxMindService;


class MaxMindValidationHandler extends RequestHandler
{
    public function __construct(private readonly MaxMindService $maxMindService)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(Request $request): Response
    {
        if($this->maxMindService->areEmailAndAddressFraud($request)){
            $body = [
                'success' => false,
                'errorMessage' => 'Rejected from connecting.'
            ];
            return new Response($body, 401);
        }
        return $this->next($request);
    }
}