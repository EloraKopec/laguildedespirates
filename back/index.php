<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/my-autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use LaGuildeDesPirates\Middleware\Helpers\Services;
use LaGuildeDesPirates\Middleware\Authentication\{BearerAuthentication, BasicAuthentication};
use LaGuildeDesPirates\Logic\Data\{MariaDBMembreDao};
use LaGuildeDesPirates\Controllers\{MembreController};

$services = Services::instance()
    ->add('membreDao', MariaDBMembreDao::class);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);

// Authentification par mot de passe
$app->group('/api', function ($group) {
    $group->post('/signin', MembreController::bind('signin'));
})->add(new BasicAuthentication());

$services->addInstance('routeParser', $app->getRouteCollector()->getRouteParser());

$app->run();
