<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

class Response
{
    public function __construct(
        public mixed $content,
        public int $statusCode = 200,
        public array $headers = [])
    {
        http_response_code($statusCode);
    }
}