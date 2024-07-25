<?php

declare(strict_types=1);

namespace App\DTO\Newsletter;

class Newsletter
{
    private string $newsletterId;
    private string $topic;
    private string $productId;

    public function getNewsletterId(): string
    {
        return $this->newsletterId;
    }

    public function setNewsletterId(string $newsletterId): void
    {
        $this->newsletterId = $newsletterId;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }
}
