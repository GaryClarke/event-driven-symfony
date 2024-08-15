<?php

declare(strict_types = 1);

namespace App\Tests\Unit\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\CDP\Http\CdpClient;
use App\Error\Exception\WebhookException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class CdpClientTest extends TestCase
{
    public function testWebhookExceptionIsThrownWhenHttpClientProducesErrors(): void
    {
        $responses = [
            new MockResponse(['{"grave":"error"}'], ['http_code' => 400])
        ];

        $mockHttpClient = new MockHttpClient($responses);

        $unit = new CdpClient($mockHttpClient, 'fake-api-key');

        try {
            $mockTrackModel = $this->createMock(ModelInterface::class);
            $unit->track($mockTrackModel);
            $this->fail('A WebhookException should have been thrown');
        } catch (WebhookException $exception) {
            $this->assertStringContainsString('{"grave":"error"}', $exception->getMessage());
        }
    }
}