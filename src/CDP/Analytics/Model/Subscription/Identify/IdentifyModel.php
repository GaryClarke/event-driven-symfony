<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription\Identify;

use App\CDP\Analytics\Model\ModelInterface;

class IdentifyModel implements ModelInterface
{
    private string $product;

    private string $eventDate;

    private string $subscriptionId;

    private string $email;

    private string $id;

    public function toArray(): array
    {
        return [
            'type' => self::IDENTIFY_TYPE,
            'context' => [
                'product' => $this->product, // newsletter.product_id
                'event_date' => $this->eventDate // timestamp
            ],
            'traits' => [
                'subscription_id' => $this->subscriptionId, // id
                'email' => $this->email // user.email
            ],
            'id' => $this->id // user.client_id
        ];
    }
}