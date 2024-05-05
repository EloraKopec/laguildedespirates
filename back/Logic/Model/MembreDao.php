<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Logic\Model;

interface MembreDao
{
    public function readById(string $id): Membre;
}