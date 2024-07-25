<?php

declare(strict_types=1);

namespace App\Webhook\Handler;


use App\DTO\Webhook;

class NewsletterHandler implements WebhookHandlerInterface
{
    private const array SUPPORTED_EVENTS = [
        'newsletter_opened',
        'newsletter_subscribed',
        'newsletter_unsubscribed'
    ];

    public function supports(Webhook $webhook): bool
    {
        return in_array($webhook->getEvent(), self::SUPPORTED_EVENTS);
    }

    public function handle(Webhook $webhook): void
    {
        dd($webhook);
    }
}
