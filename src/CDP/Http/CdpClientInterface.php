<?php

declare(strict_types=1);

namespace App\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;

interface CdpClientInterface
{
    public function identify(ModelInterface $model);

    public function track(ModelInterface $model);
}
