<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Controllers;

use LaGuildeDesPirates\Middleware\Helpers\{Context, Services};
use Firebase\JWT\JWT;
use LaGuildeDesPirates\Logic\Model\MembreDao;

class MembreController extends Controller
{
    private MembreDao $membreDao;
    private string $jwtKey;

    public function __construct(Context $context, Services $container)
    {
        parent::__construct($context, $container);

        $this->membreDao = $container->get('membreDao');

        $cfg = include 'config.php';
        $this->jwtKey = $cfg['JWTKEY'];
    }

    /**
     * Connexion au service.
     */
    public function signin()
    {
        $membre = $this->requireUser();

        $payload = [
            'exp' => time() + 1800,
            'usr' => $membre->id(),
        ];
        $jwt = JWT::encode($payload, $this->jwtKey, 'HS256');

        $this->jsonResponse([
            'token' => $jwt,
            'membre' => $membre,
        ]);
    }
}