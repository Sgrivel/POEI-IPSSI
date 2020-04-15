<?php

namespace App;

use Exception;
use PDO;

class Connexion {

    public static function getPDO(): PDO{
        try {
            return new PDO(DB_TYPE . ":" . "dbname=" . DB_NAME . ";" . "host=" . DB_HOST . ":" . DB_PORT, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }catch (Exception $e) {
            throw new Exception("Impossible de se connecter à la base de données, veuillez vérifier la configuration.");
        }
    }
}