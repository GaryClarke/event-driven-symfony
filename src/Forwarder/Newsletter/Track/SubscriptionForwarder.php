<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Track;

use App\CDP\Analytics\Model\ModelValidator;
use App\CDP\Analytics\Model\Subscription\Track\SubscriptionMapper;
use App\CDP\Analytics\Model\Subscription\Track\TrackModel;
use App\CDP\Http\CdpClient;
use App\CDP\Http\CdpClientInterface;
use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;

class SubscriptionForwarder implements ForwarderInterface
{
    public function __construct(
        private CdpClientInterface $cdpClient,
        private ModelValidator $modelValidator,
    ) {
    }

    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return true;
    }

    public function forward(NewsletterWebhook $newsletterWebhook): void
    {
        // Instantiate a class which models tracking data
        $model = new TrackModel();

        // Map the NewsletterWebhook data to the model
        (new SubscriptionMapper())->map($newsletterWebhook, $model);

        // Validate the model
        $this->modelValidator->validate($model);

        // Use the CDP client to POST the data to the CDP
        $this->cdpClient->track($model);
    }
}
