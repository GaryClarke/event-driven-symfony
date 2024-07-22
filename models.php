<?php

use App\CDP\Analytics\Model\ModelInterface;

/* identify Model should look like this when sent */
$identifyModel = new class implements ModelInterface
{
    public function toArray(): array
    {
        return [
            'type' => 'identify',
            'context' => [
                'product' => 'TechGadget-3000X', // newsletter.product_id
                'event_date' => '2024-12-12' // timestamp
            ],
            'traits' => [
                'subscription_id' => '12345', // id
                'email' => 'email@example.com' // user.email
            ],
            'id' => '4a2b342d-6235-46a9-bc95-6e889b8e5de1' // user.client_id
        ];
    }
};

/* track Model should look like this when sent */
$trackModel = new class implements ModelInterface
{
    public function toArray(): array
    {
        return [
            'type' => 'track',
            'event' => 'newsletter_subscribed', // event
            'context' => [
                'product' => 'TechGadget-3000X', // newsletter.product_id
                'event_date' => '2024-12-12', // timestamp
                'traits' => [
                    'subscription_id' => '12345', // id
                    'email' => 'email@example.com', // user.email
                ],
            ],
            'properties' => [
                'requires_consent' => true, // from user.region
                'platform' => 'web', // origin
                'currency' => null, // should be removed
                'in_trial' => null, // should be removed
                'product_name' => 'newsletter-001', // newsletter.newsletter_id
                'renewal_date' => '2025-12-12', // start date + 1 year if not provided
                'start_date' => '2024-12-12', // timestamp
                'status' => 'subscribed', // set by api
                'type' => 'newsletter', // set by api
                'is_promotion' => false, // use default
            ],
            'id' => '4a2b342d-6235-46a9-bc95-6e889b8e5de1' // user.client_id
        ];
    }
};