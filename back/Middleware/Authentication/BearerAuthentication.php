<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Middleware\Authentication;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use LaGuildeDesPirates\Middleware\Helpers\Services;
use LaGuildeDesPirates\Logic\Exceptions\{NotFoundException, TokenOutOfDateException};
use LaGuildeDesPirates\Logic\Model\Membre;

class BearerAuthentication
{
    private $jwtKey;

    public function __construct() {
       $this->jwtKey = (include '../config.php')['JWTKEY'];
    }

    public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $failed = (new \Nyholm\Psr7\Response())
            ->withStatus(401)
            ->withHeader('WWW-Authenticate', 'Bearer');

        $authHeader = $request->getHeader('Authorization');

        if (count($authHeader) == 0) return $failed;

        list($authScheme, $authData) = explode(' ', $authHeader[0], 2);

        if ($authScheme != 'Bearer') return $failed;

        $membreDao = Services::instance()->get('membreDao');
        try
        {
            $decoded = JWT::decode($authData, new Key($this->jwtKey, 'HS256'));

            if ($decoded > time()) throw new TokenOutOfDateException();

            $membre = $membreDao->readById($decoded["usr"]);

            $request = $request->withAttribute('user', $membre);
        }
        catch (NotFoundException|TokenOutOfDateException)
        {
            return $failed;
        }

        return $handler->handle($request);
    }
}