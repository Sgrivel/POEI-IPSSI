<?php

namespace App\Manager\Exception;

use Exception;

class NotFoundException extends Exception {

    public function __construct(string $table, $item)
    {
        $this->message = "Aucun enregistrement ne correspond à l'id #$item dans la table $table";
    }
}

?>