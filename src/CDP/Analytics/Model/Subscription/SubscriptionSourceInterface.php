<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription;

interface SubscriptionSourceInterface
{
    public const array CONSENT_REGIONS = ['EU'];

    public function getProduct(): string;

    public function getEventDate(): string;

    public function getSubscriptionId(): string;

    public function getEmail(): string;

    public function getUserId(): string;

    public function getEvent(): string;

    public function requiresConsent(): bool;

    public function getPlatform(): string;

    public function getProductName(): string;

    public function getRenewalDate(): string;

    public function getStartDate(): string;

    public function getType(): string;

    public function getStatus(): string;
}
