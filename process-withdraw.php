<?php declare(strict_types=1);

use Bref\Context\Context;

require __DIR__ . '/vendor/autoload.php';

return function ($event, Context $context)
{
    if (! $event['value']) {
		return 'No value specified.';
    }

    return 'Withdraw of value ' . $event['value'];
};
