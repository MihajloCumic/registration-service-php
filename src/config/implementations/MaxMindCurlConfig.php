<?php
declare(strict_types=1);
namespace Src\config\implementations;

use CurlHandle;
use Exception;
use Src\config\Provider;
use Src\container\Container;

class MaxMindCurlConfig implements Provider
{

    /**
     * @throws Exception
     */
    public function configure(Container $container): CurlHandle
    {
        $url = 'http://maxmind-sim:9000/minFraud';
        $ch = curl_init();
        if(!$ch){
            throw new Exception("Could not initialize cUrl");
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        return $ch;
    }
}