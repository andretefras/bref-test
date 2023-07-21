<?php

// This is a PHP file example.
// Replace it with your application.

$lambdaContext = json_decode($_SERVER['LAMBDA_INVOCATION_CONTEXT'], true);
$requestContext = json_decode($_SERVER['LAMBDA_REQUEST_CONTEXT'], true);

echo "<pre>";
var_dump($lambdaContext, $requestContext);
echo "</pre>";

// Call process-withdraw function


