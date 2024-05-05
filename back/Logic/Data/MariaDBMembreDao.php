<?php

namespace LaGuildeDesPirates\Logic\Data;

use LaGuildeDesPirates\Logic\Exceptions\NotFoundException;
use LaGuildeDesPirates\Logic\Model\Membre;
use LaGuildeDesPirates\Logic\Model\MembreDao;

class MariaDBMembreDao implements MembreDao
{

    public function readById(string $id): Membre
    {
        $query = Database::getInstance()->executeQuery(
            "SELECT NOM, MOT_DE_PASSE FROM MEMBRE WHERE ID_MEMBRE = :id",
            ['id' => $id]
        );

        if ($data = $query->fetch())
        {
            return new Membre($id, $data['NOM'], $data['MOT_DE_PASSE']);
        }

        throw new NotFoundException();
    }
}