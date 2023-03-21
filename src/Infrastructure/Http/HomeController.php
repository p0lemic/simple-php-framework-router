<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Infrastructure\Core\JsonResponse;
use App\Infrastructure\Core\Request;
use App\Infrastructure\Core\Response;

class HomeController
{
    public function home(Request $request): Response
    {
        return new JsonResponse($request->getBody());
    }
}