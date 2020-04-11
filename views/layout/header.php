<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS_URL . "style.css" ?>"/>
    <link rel="shortcut icon" href="<?= IMG_URL . "favicon.png" ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <script src="<?= JS_URL . "script.js" ?>"></script>
    <title><?= $title ?? "E-Commerce" ?></title>
</head>
<body>
    <header class="container">
        <div class="header-top">
            <a href="#" class="hamburger icon"><ion-icon name="menu-outline"></ion-icon></a>
            <nav class="nav-hamburger">
                <a href="#">Accueil</a>
                <a href="#">Contact</a>
            </nav>
            <img src="https://fakeimg.pl/100x30/" class="logo">
            <form action="#" class="search">
                <ion-icon name="search-circle-outline" class="icon test"></ion-icon>
                <input type="text" name="search" class="input-search">
            </form>
            <ul class="flex-ul">
                <li><a href="#"><ion-icon name="person-circle-outline" class="icon"></ion-icon></a></li>
                <li><a href="#"><ion-icon name="cart-outline" class="icon"></ion-icon></a></li>
            </ul>
        </div>
        <hr class="header-separator">
        <div class="header-bottom">
            <nav>
                <ul>
                    <li><a href="#">PS4</a></li>
                    <li><a href="#">PS3</a></li>
                    <li><a href="#">PS2</a></li>
                    <li><a href="#">XBOX ONE X</a></li>
                    <li><a href="#">XBOX ONE S</a></li>
                    <li><a href="#">XBOX 360</a></li>
                    <li><a href="#">SWITCH</a></li>
                    <li><a href="#">WII U</a></li>
                    <li><a href="#">WII</a></li>
                    <li><a href="#">PC</a></li>
                    <li><a href="#">MAC</a></li>
                    <li><a href="#">AUTRE</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <main>