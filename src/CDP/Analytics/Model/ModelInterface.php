<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model;

interface ModelInterface
{
    /**
     * @return  array<string, mixed>
     */
    public function toArray(): array;
}
