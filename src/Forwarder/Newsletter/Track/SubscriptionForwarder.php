<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Track;

use App\CDP\Analytics\Model\Subscription\Track\TrackModel;
use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionForwarder implements ForwarderInterface
{

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return true;
    }

    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        // Instantiate a class which models tracking data
        $model = new TrackModel();
        dd($model);

        // Map the NewsletterWebhook data to the model

        // Validate the model

        // Use the CDP client to POST the data to the CDP
    }
}