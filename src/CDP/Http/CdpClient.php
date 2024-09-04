<?php

declare(strict_types=1);

namespace App\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\Error\Exception\WebhookException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CdpClient implements CdpClientInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        #[Autowire('%cdp.api_key%')] private string $apiKey,
        #[Autowire('%env(CDP_URL)%')] private readonly string $cdpUrl
    ) {
    }

    public function track(ModelInterface $model): void
    {
        $response = $this->httpClient->request(
            'POST',
            $this->cdpUrl . '/track',
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => $this->apiKey,
                ]
            ]
        );

        // Add error handling
        try {
            $response->toArray();
        } catch (\Throwable $exception) {
            throw new WebhookException(
                message: $response->getContent(false),
                previous: $exception
            );
        }
    }

    public function identify(ModelInterface $model): void
    {
        $response = $this->httpClient->request(
            'POST',
            $this->cdpUrl . '/identify',
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => $this->apiKey,
                ]
            ]
        );

        // Add error handling
        try {
            $response->toArray();
        } catch (\Throwable $exception) {
            throw new WebhookException(
                message: $response->getContent(false),
                previous: $exception
            );
        }
    }
}
