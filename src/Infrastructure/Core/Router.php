<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

class Router
{
    private array $handlers;
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, array $handler): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    private function addHandler(string $method, string $path, array $handler): void
    {
        $this->handlers[$method . $path] = $handler;
    }

    public function resolve(): Response
    {
        $requestPath = $this->request->getPath();
        $method = $this->request->getMethod();

        $handler = $this->handlers[$method.$requestPath] ?? null;

        if (!$handler) {
            return new Response("Not Found", 404);
        }

        [$handler, $handlerMethod] = $handler;

        return call_user_func_array([new $handler, $handlerMethod], [$this->request]);
    }
}