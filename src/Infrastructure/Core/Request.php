<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    public function getPath(): string
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);

        return $requestUri['path'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): array
    {
        return match ($this->getMethod()) {
            self::METHOD_GET => $this->filterInput($_GET, INPUT_GET),
            self::METHOD_POST => $this->filterInput($_POST, INPUT_POST),
            default => [],
        };
    }

    private function filterInput(array $superGlobal, int $inputType): array
    {
        foreach ($superGlobal as $key => $value) {
            $body[$key] = filter_input($inputType, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body ?? [];
    }
}