<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebhooksController extends AbstractController
{
    #[Route(path: '/webhook', name: 'webhook', methods: ['POST'])]
    public function __invoke(): Response
    {
        return new Response(status: 204);
    }
}