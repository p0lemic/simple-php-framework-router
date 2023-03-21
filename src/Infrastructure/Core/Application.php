<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

class Application
{
    private Router $router;
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function addRoute(string $method, string $url, array $handler): void
    {
        match ($method) {
            Router::METHOD_GET => $this->router->get($url, $handler),
            Router::METHOD_POST => $this->router->post($url, $handler)
        };
    }

    public function run(): void
    {
        $response = $this->router->resolve();

        foreach ($response->headers as $header) {
            header($header);
        }

        echo $response->content;
    }
}