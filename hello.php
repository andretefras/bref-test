<?php declare(strict_types=1);

use Bref\Context\Context;

require __DIR__ . '/vendor/autoload.php';

return function ($event, Context $context) {
    return 'Hello ' . ($event['name'] ?? 'world');
};
