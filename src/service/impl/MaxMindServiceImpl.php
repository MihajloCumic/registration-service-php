<?php
declare(strict_types=1);
namespace Src\service\impl;

use CurlHandle;
use Src\attributes\Provider;
use Src\config\implementations\MaxMindCurlConfig;
use Src\request\Request;
use Src\service\MaxMindService;

#[Provider(MaxMindCurlConfig::class, CurlHandle::class)]
class MaxMindServiceImpl implements MaxMindService
{
    private readonly CurlHandle $ch;
    public function __construct(CurlHandle $ch)
    {
        $this->ch = $ch;
    }

    public function areEmailAndAddressFraud(Request $request): bool
    {
        $data = [
            "email" => $request->getBody()["email"],
            "ipAddress" => $request->getUserIpAddress()
        ];
        $jsonData = json_encode($data);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($this->ch);

        if(curl_errno($this->ch)){
            return true;
        }
        $responseBody = json_decode($response, true);
        if(!isset($responseBody["riskFactor"])){
            return true;
        }
        $riskFactor = $responseBody["riskFactor"];
        if($riskFactor > 40){
            return true;
        }
        return false;
    }
}