<?php

declare(strict_types=1);

namespace App\Error;

use Throwable;

interface ErrorHandlerInterface
{
    public function handle(Throwable $throwable): void;
}