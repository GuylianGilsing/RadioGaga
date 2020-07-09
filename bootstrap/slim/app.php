<?php
namespace App;

use Slim\Factory\AppFactory;
use App\Middleware\TrailingSlashMiddleware;
use Slim\Routing\RouteCollectorProxy;

define('VIEW_DIR', __DIR__.'/../../resources/views/');

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

// Middleware
$app->add(TrailingSlashMiddleware::class);

// Load web routes
require_once __DIR__.'/../../routes/web.php';

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->run();