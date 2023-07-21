<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$lambda = new AsyncAws\Lambda\LambdaClient([
    'accessKeyId' => $_ENV['AWS_KEY'],
    'accessKeySecret' => $_ENV['AWS_SECRET'],
    'region' => $_ENV['AWS_REGION'],
]);

$result = $lambda->invoke([
    'FunctionName' => 'process-withdraw',
    'Payload' => json_encode(['value' => 5000]),
]);

echo $result->getPayload();
