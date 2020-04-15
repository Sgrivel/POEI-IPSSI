<?php

use App\Connexion;
use App\HTML\Form;
use App\Manager\Exception\NotFoundException;
use App\Model\User;
use App\ObjectHelper;
use App\Manager\UserManager;
use App\Validator\UserValidator;

$pdo = Connexion::getPDO();

$errors = [];
$user = new User();
$fields = [
    "user_mail",
    "user_password",  
];

if (!empty($_POST)) {
    $userManager = new UserManager($pdo);
    $data = $_POST;
    $v = new UserValidator($data, $userManager, $user->getUserId());
    ObjectHelper::hydrate($user, $data, $fields);
    if ($v->validate()) 
    {   
        try {
            $pdo->beginTransaction();
            $userForEmail = $userManager->findByEmail($user->getUserMail());
            $pdo->commit();
            $passwordChecked = $userForEmail->verifyHashPassword($user->getUserPassword());
            if (!$passwordChecked)
                throw new NotFoundException("user", "email");
            session_start();
            $_SESSION["user"] = $userForEmail;
            header("Location: " . $router->url("home") . "?connected=1");
            exit();
        } catch (NotFoundException $e) {
            $error = "Addresse mail ou mot de passe incorrect";
        }
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($user, $errors);

?>

<h1>Se connecter</h1>

<?php require_once "_formSignIn.php" ?>

<?php if (isset($error)): ?>
    <?= $error ?>
<?php endif ?>