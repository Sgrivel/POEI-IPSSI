<form action="" method="post">
    <?= $form->input("user_first_name", "Votre Prénom") ?>
    <?= $form->input("user_last_name", "Votre Nom") ?>
    <?= $form->input("user_pseudo", "Votre Pseudo") ?>
    <?= $form->input("user_mail", "Votre Addresse mail") ?>
    <?= $form->input("user_mail_verify", "Confirmation de votre Addresse mail") ?>
    <?= $form->input("user_password", "Votre Mot de passe") ?>
    <?= $form->input("user_password_verify", "Confirmation de votre Mot de passe") ?>
    <?= $form->input("user_fk_address", "Votre Adresse") ?>
    <button type="submit">S'inscrire</button>
</form>