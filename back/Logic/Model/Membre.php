<?php

declare(strict_types=1);

namespace LaGuildeDesPirates\Logic\Model;

use LaGuildeDesPirates\Middleware\Helpers\JsonSerializable;

class Membre implements JsonSerializable
{
    private string $_id;
    private string $_name;
    private string $_password;

    public function id(): string
    {
        return $this->_id;
    }

    public function name(): string
    {
        return $this->_name;
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->_password);
    }

    public function __construct(string $id, string $name, string $password)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_password = $password;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->_id,
            'name' => $this->_name,
        ];
    }

    public function jsonDeserialize(mixed $value): void
    {
        throw new \Exception("'Membre' objects shouldn't be received");
    }
}