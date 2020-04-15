<?php
    use App\Router;

    require_once "../conf.php";
    require ROOT_PATH ."vendor/autoload.php";

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    
    if (isset($_GET["page"]) && $_GET["page"] === "1") {
        $uri = explode("?", $_SERVER["REQUEST_URI"])[0];
        $get = $_GET;
        unset($get["page"]);
        $query = http_build_query($get);
        if (!empty($query)) {
            $uri .= "?" . $query;
        }
        header("Location: " . $uri);
        http_response_code(301);
        exit();
    }

    $view_path = VIEW_PATH;
    //Pour des tests, A COMMENTER SI PAS EN MODE PLAYGROUND !!!!! *****
    //$view_path = PLAYGROUND_PATH;

    $router = new Router($view_path);
    $router ->get("/", "home/index", "home")
            ->match("/signin", "auth/signin", "signin")
            ->match("/signup", "auth/signup", "signup")

            //exemple id et slug
            ->get("/blog/category/[*:slug]-[i:id]", "category/show", "category")

            //Gestion des catégories
            ->get("/admin/categories", "admin/category/index", "admin_categories")
            ->post("/admin/category/[i:id]/delete", "admin/category/delete", "admin_category_delete")
            ->match("/admin/category/new", "admin/category/new", "admin_category_new")
            //Playground pour différents tests
            ->get("/playground/menu", "_pmenu", "p_menu")
            ->run();
?>