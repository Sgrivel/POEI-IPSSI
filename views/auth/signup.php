<?php

use App\Connexion;
use App\HTML\Form;
use App\Model\User;
use App\ObjectHelper;
use App\Manager\UserManager;
use App\Validator\UserValidator;

$pdo = Connexion::getPDO();

$errors = [];
$user = new User();
$fields = [
    "user_first_name", 
    "user_last_name",
    "user_pseudo",
    "user_mail",
    "user_password", 
    "user_fk_address", 
];

if (!empty($_POST)) {
    $userManager = new UserManager($pdo);
    $data = $_POST;
    $v = new UserValidator($data, $userManager, $user->getUserId());
    ObjectHelper::hydrate($user, $data, $fields);
    if ($v->validate()) 
    {
        $user->setUserRole("Utilisateur");
        $user->setUserAvatar("default.png");
        $user->hashPassword();
        $pdo->beginTransaction();
        $idUser = $userManager->create([
            "user_first_name" => $user->getUserFirstName(),
            "user_last_name" => $user->getUserLastName(),
            "user_pseudo" => $user->getUserPseudo(),
            "user_mail" => $user->getUserMail(),
            "user_password" => $user->getUserPassword(),
            "user_fk_address" => $user->getUserFkAddress(),
            "user_role" => $user->getUserRole(),
            "user_avatar" => $user->getUserAvatar(),
        ]);
        $pdo->commit();
        $user->setUserId($idUser);

        header("Location: " . $router->url("home") . "?created=1");
        exit();
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($user, $errors);

?>

<h1>S'inscrire</h1>

<?php require_once "_formSignUp.php" ?>