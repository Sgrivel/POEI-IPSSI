<?php

//Identifiants pour la base de données

define("DB_TYPE", "mysql");
define("DB_NAME", "tutoblog");
define("DB_HOST", "127.0.0.1");
define("DB_PORT", "3308");
define("DB_USER", "root");
define("DB_PASSWORD", "");

//Pour les images, css, js etc..

define("BASE_URL", "/");  
define("UPLOAD_URL", BASE_URL . "uploads" . DIRECTORY_SEPARATOR);
define("ASSET_URL", BASE_URL . "assets" . DIRECTORY_SEPARATOR);
define("CSS_URL", ASSET_URL . "css" . DIRECTORY_SEPARATOR);
define("IMG_URL", ASSET_URL . "img" . DIRECTORY_SEPARATOR);
define("JS_URL", ASSET_URL . "js" . DIRECTORY_SEPARATOR);

//Pour les include, require..

define("ROOT_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("PUBLIC_PATH", ROOT_PATH . "public" . DIRECTORY_SEPARATOR);  
define("VIEW_PATH", ROOT_PATH . "views" . DIRECTORY_SEPARATOR);
define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DIRECTORY_SEPARATOR);
define("PLAYGROUND_PATH", ROOT_PATH . "playground" . DIRECTORY_SEPARATOR);

//Définitions pour le debug

define("DEBUG_TIME", microtime(true));