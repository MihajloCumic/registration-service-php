<?php
$unwantedEmails = [
    "email2@gmail.com" => 30,
    "email5@gmail.com" => 70,
];
$errorResponse = [
    "errorMessage" => "Invalid request."
];
$rawBody = file_get_contents('php://input');
if($rawBody){
    $body = json_decode($rawBody, true);
    if(!isset($body["email"]) || !isset($body["ipAddress"])){
        echo json_encode($errorResponse);
        exit();
    }
    $email = $body["email"];
    $res = [
        "riskFactor" => 0
    ];
    if(isset($unwantedEmails[$email])){
        $res["riskFactor"] = $unwantedEmails[$email];
    }
    echo json_encode($res);
}else{
    echo json_encode($errorResponse);
}