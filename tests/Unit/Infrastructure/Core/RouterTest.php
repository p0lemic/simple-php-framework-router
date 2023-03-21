<?php
declare(strict_types=1);

namespace App\Infrastructure\Core;

use PHPUnit\Framework\TestCase;
use Test\TestController;

class RouterTest extends TestCase
{
    public function testGivenARouteWithAHandlerRouterCanResolveIt(): void
    {
        $request = $this->createMock(Request::class);
        $request->expects(self::once())
            ->method('getPath')
            ->willReturn('/');

        $request->expects(self::once())
            ->method('getMethod')
            ->willReturn('GET');


        $sut = new Router($request);
        $sut->get('/', [TestController::class, 'index']);

        $response = $sut->resolve();

        $this->assertEquals("Test Controller", $response->content);
        $this->assertEquals(200, $response->statusCode);
    }

    public function testGivenUnknownRouteNotFoundIsReturned(): void
    {
        $request = $this->createMock(Request::class);
        $request->expects(self::once())
            ->method('getPath')
            ->willReturn('/not-found');

        $request->expects(self::once())
            ->method('getMethod')
            ->willReturn('GET');


        $sut = new Router($request);
        $sut->get('/', [TestController::class, 'index']);

        $response = $sut->resolve();

        $this->assertEquals("Not Found", $response->content);
        $this->assertEquals(404, $response->statusCode);
    }
}
