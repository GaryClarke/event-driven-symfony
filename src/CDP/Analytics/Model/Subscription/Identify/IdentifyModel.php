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

    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    public function setEventDate(string $eventDate): void
    {
        $this->eventDate = $eventDate;
    }

    public function setSubscriptionId(string $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

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