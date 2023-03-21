<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Core\Response;

class AboutController
{
    public function about(): Response
    {
        return new Response("About Page");
    }
}