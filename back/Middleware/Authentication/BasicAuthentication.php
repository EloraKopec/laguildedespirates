<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Middleware\Authentication;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use LaGuildeDesPirates\Middleware\Helpers\Services;
use LaGuildeDesPirates\Logic\Exceptions\NotFoundException;

class BasicAuthentication
{
    public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $failed = (new \Nyholm\Psr7\Response())
            ->withStatus(401);

        $authHeader = $request->getHeader('Authorization');

        if (count($authHeader) == 0) return $failed;

        list($authScheme, $authData) = explode(' ', $authHeader[0], 2);

        if ($authScheme != 'Basic') return $failed;

        list($id, $password) = explode(':', base64_decode($authData));

        $membreDao = Services::instance()->get('membreDao');
        try
        {
            $user = $membreDao->readById($id);

            if (!$user->checkPassword($password)) throw new NotFoundException();

            $request = $request->withAttribute('user', $user);
        }
        catch (NotFoundException)
        {
            return $failed;
        }

        return $handler->handle($request);
    }
}