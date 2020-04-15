<?php

namespace App\Validator;

use App\Manager\UserManager;

class UserValidator extends AbstractValidator {

    public function __construct(array $data, UserManager $manager, ?int $userId = null)
    { 
        parent::__construct($data);

        if (count($data) > 2) 
        {
            $this->validator->rules([
                "required" => [
                    ["user_first_name"], 
                    ["user_last_name"],
                    ["user_pseudo"],
                    ["user_mail"],
                    ["user_mail_verify"],
                    ["user_password"],
                    ["user_password_verify"]
                ],
                "lengthBetween" => [
                    ['user_first_name', 1, 255],
                    ["user_last_name", 1, 255],
                    ["user_pseudo", 3, 30],
                    ["user_password", 5, 50],
                    ["user_password_verify", 5, 50],

                ],
            ]);
            $this->validator->rule('email', 'user_mail')->message("Addresse mail invalide");
            $this->validator->rule('emailDNS', 'user_mail')->message("DNS de l'Addresse mail invalide");

            $this->validator->rule('equals', 'user_password', 'user_password_verify')->message("Mots de passe différents");
            $this->validator->rule('equals', 'user_mail', 'user_mail_verify')->message("Addresses mail différentes");

            $this->validator->rule(function($field, $value) use ($manager) {
                return !($manager->exists($field, $value));
            }, ["user_mail"], "Cette valeur est déjà utilisée");
        } else {
            $this->validator->rules([
                "required" => [
                    ["user_mail"],
                    ["user_password"],
                ],
                "lengthBetween" => [
                    ["user_password", 5, 50],
                ],
            ]);
            $this->validator->rule('email', 'user_mail')->message("Addresse mail invalide");
            $this->validator->rule('emailDNS', 'user_mail')->message("DNS de l'Addresse mail invalide");
        }
    }
}

?>