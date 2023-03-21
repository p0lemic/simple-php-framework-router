<?php
declare(strict_types=1);

namespace Test;

use App\Infrastructure\Core\Response;

class TestController
{
    public function index(): Response
    {
        return new Response('Test Controller');
    }
}