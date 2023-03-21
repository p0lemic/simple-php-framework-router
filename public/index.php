<?php
declare(strict_types=1);

use App\Infrastructure\Core\Application;
use App\Infrastructure\Http\AboutController;
use App\Infrastructure\Http\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->addRoute('GET', '/', [HomeController::class, 'home']);
$app->addRoute('GET', '/about', [AboutController::class, 'about']);

$app->run();