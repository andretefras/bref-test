<?php

require __DIR__ . '/vendor/autoload.php';

$lambdaContext = json_decode($_SERVER['LAMBDA_INVOCATION_CONTEXT'], true);
$requestContext = json_decode($_SERVER['LAMBDA_REQUEST_CONTEXT'], true);

echo "<pre>";
var_dump($lambdaContext, $requestContext);
echo "</pre>";

$arguments = explode('/', $requestContext['http']['path']);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$lambda = new AsyncAws\Lambda\LambdaClient([
    'accessKeyId' => $_ENV['AWS_KEY'],
    'accessKeySecret' => $_ENV['AWS_SECRET'],
    'region' => $_ENV['AWS_REGION'],
]);

$result = $lambda->invoke([
    'FunctionName' => 'app-dev-process-withdraw',
    'Payload' => json_encode(['value' => $arguments[1]]),
]);

// var_dump($result->info());

var_dump($result->getPayload());
