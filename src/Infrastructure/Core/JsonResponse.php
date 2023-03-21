<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

class JsonResponse extends Response
{
    public function __construct(
        public mixed $content,
        public int $statusCode = 200,
        public array $headers = [])
    {
        parent::__construct(
            json_encode($this->content),
            $this->statusCode,
            array_merge(
                $headers,
                ["Content-type: application/json; charset=UTF-8"]
            )
        );
    }

}