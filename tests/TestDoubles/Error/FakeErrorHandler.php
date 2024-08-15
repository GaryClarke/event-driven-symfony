<?php

declare(strict_types=1);

namespace App\Tests\TestDoubles\Error;

use App\Error\ErrorHandlerInterface;
use Throwable;

class FakeErrorHandler implements ErrorHandlerInterface
{
    private int $handleCallCount = 0;
    private Throwable $error;

    public function handle(Throwable $throwable): void
    {
        $this->handleCallCount++;
        $this->error = $throwable;
    }

    public function getHandleCallCount(): int
    {
        return $this->handleCallCount;
    }

    public function getError(): Throwable
    {
        return $this->error;
    }
}