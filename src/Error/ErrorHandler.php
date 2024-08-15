<?php

declare(strict_types=1);

namespace App\Error;

use Throwable;

class ErrorHandler implements ErrorHandlerInterface
{
    public function handle(Throwable $throwable): void
    {
        // Log / alert to a centralized system (Cloudwatch / Datadog etc.)
    }
}
