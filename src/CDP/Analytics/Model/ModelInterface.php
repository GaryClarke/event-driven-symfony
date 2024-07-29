<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model;

interface ModelInterface
{
    public const string IDENTIFY_TYPE = 'identify';

    public const string TRACK_TYPE = 'track';

    /**
     * @return  array<string, mixed>
     */
    public function toArray(): array;
}
