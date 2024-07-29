<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Identify;

use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionStartForwarder implements ForwarderInterface
{
    private const string SUPPORTED_EVENT = 'newsletter_subscribed';

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return $newsletterWebhook->getEvent() === self::SUPPORTED_EVENT;
    }

    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        // Instantiate a class which models Identify data

        // Map the NewsletterWebhook data to the model

        // Validate the model

        // Use the CDP client to POST the data to the CDP
    }
}
