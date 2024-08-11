<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription\Track;

use App\CDP\Analytics\Model\Subscription\SubscriptionSourceInterface;
use App\Error\Exception\WebhookException;
use Throwable;

class SubscriptionMapper
{
    public function map(SubscriptionSourceInterface $source, TrackModel $target): void
    {
        try {
            $target->setEvent($source->getEvent());
            $target->setProduct($source->getProduct());
            $target->setEventDate($source->getEventDate());
            $target->setSubscriptionId($source->getSubscriptionId());
            $target->setEmail($source->getEmail());
            // need adding
            $target->setEvent($source->getEvent());
            $target->setRequiresConsent($source->requiresConsent());
            $target->setPlatform($source->getPlatform());
            $target->setProductName($source->getProductName());
            $target->setRenewalDate($source->getRenewalDate());
            $target->setStartDate($source->getStartDate());
            $target->setStatus($source->getStatus());
            $target->setType($source->getType());
            $target->setId($source->getUserId());
        } catch (Throwable) {
            $className = get_class($source);
            throw new WebhookException("Could not map $className to TrackModel target");
        }
    }
}
