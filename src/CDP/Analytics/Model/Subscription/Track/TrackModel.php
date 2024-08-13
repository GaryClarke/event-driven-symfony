<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription\Track;

use App\CDP\Analytics\Model\ModelInterface;
use App\Utils\ArrayFilter;
use Symfony\Component\Validator\Constraints as Assert;

class TrackModel implements ModelInterface
{
    #[Assert\NotBlank]
    private string $event;

    #[Assert\NotBlank]
    private string $product;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $eventDate;

    #[Assert\NotBlank]
    private string $subscriptionId;

    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[Assert\NotBlank]
    private bool $requiresConsent;

    #[Assert\NotBlank]
    private string $platform;

    private ?string $currency = null;

    private ?bool $inTrial = null;

    #[Assert\NotBlank]
    private string $productName;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $renewalDate;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^\d{4}-\d{2}-\d{2}$/',
        message: 'The event date must be in the format YYYY-MM-DD.'
    )]
    private string $startDate;

    #[Assert\NotBlank]
    private string $status;

    #[Assert\NotBlank]
    private string $type = 'newsletter';

    private bool $isPromotion = false;

    #[Assert\NotBlank]
    private string $id;

    public function setEvent(string $event): void
    {
        $this->event = $event;
    }

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

    public function setRequiresConsent(bool $requiresConsent): void
    {
        $this->requiresConsent = $requiresConsent;
    }

    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function setInTrial(?bool $inTrial): void
    {
        $this->inTrial = $inTrial;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function setRenewalDate(string $renewalDate): void
    {
        $this->renewalDate = $renewalDate;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setIsPromotion(bool $isPromotion): void
    {
        $this->isPromotion = $isPromotion;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        $model = [
            'type' => self::TRACK_TYPE,
            'event' => $this->event, // event
            'context' => [
                'product' => $this->product, // newsletter.product_id
                'event_date' => $this->eventDate, // timestamp
                'traits' => [
                    'subscription_id' => $this->subscriptionId, // id
                    'email' => $this->email, // user.email
                ],
            ],
            'properties' => [
                'requires_consent' => $this->requiresConsent, // from user.region
                'platform' => $this->platform, // origin
                'currency' => $this->currency, // should be removed
                'in_trial' => $this->inTrial, // should be removed
                'product_name' => $this->productName, // newsletter.newsletter_id
                'renewal_date' => $this->renewalDate, // start date + 1 year if not provided
                'start_date' => $this->startDate, // timestamp
                'status' => $this->status, // set by api
                'type' => $this->type, // set by api
                'is_promotion' => $this->isPromotion, // use default
            ],
            'id' => $this->id // user.client_id
        ];

        ArrayFilter::removeEmptyKeysRecursively($model);

        return $model;
    }
}
