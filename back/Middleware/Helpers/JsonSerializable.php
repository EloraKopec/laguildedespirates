<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Middleware\Helpers;

interface JsonSerializable extends \JsonSerializable
{
    public function jsonDeserialize(mixed $value) : void;
}