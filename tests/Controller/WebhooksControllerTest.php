<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\CDP\Http\CdpClient;
use App\CDP\Http\CdpClientInterface;
use App\Tests\TestDoubles\CDP\Http\FakeCdpClient;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class WebhooksControllerTest extends WebTestCase
{
    private KernelBrowser $webTester;
    private ContainerInterface $container;
    private FakeCdpClient $cdpClient;

    protected function setUp(): void
    {
        $this->webTester = static::createClient();
        $this->container = $this->webTester->getContainer();
        $this->cdpClient = $this->container->get(CdpClientInterface::class);
    }

    public function testWebhooksAreHandled(): void
    {
        /** @phpcs:disable */
        $incomingWebhookPayload = '{"event":"newsletter_subscribed","id":"12345","origin":"www","timestamp":"2024-12-12T12:00:00Z","user": {"client_id":"4a2b342d-6235-46a9-bc95-6e889b8e5de1","email":"email@example.com","region":"EU"},"newsletter": {"newsletter_id":"newsletter-001","topic":"N/A","product_id":"TechGadget-3000X"}}';
        /** @phpcs:enable */

        $this->webTester->request(
            method: 'POST',
            uri: '/webhook',
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => '*/*',
            ],
            content: $incomingWebhookPayload
        );

        // Assert CdpClient::identify() called once

        // Assert correct IdentifyModel is passed to CdpClient::identify() method

        // Assert IdentifyModel::toArray() organizes data into format expected by CDP

        // Assert CdpClient::track() called once

        // Assert correct TrackModel is passed to CdpClient::track() method

        // Assert TrackModel::toArray() organizes data into format expected by CDP

        $this->assertSame(Response::HTTP_NO_CONTENT, $this->webTester->getResponse()->getStatusCode());
    }
}
