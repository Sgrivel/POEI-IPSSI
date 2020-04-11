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
            ->get("/blog/category/[*:slug]-[i:id]", "category/show", "category")
            ->get("/blog/[*:slug]-[i:id]", "post/show", "post")
            ->match("/login", "auth/login", "login")
            ->post("/logout", "auth/logout", "logout")
            //ADMIN
            //Gestion des Articles
            ->get("/admin", "admin/post/index", "admin_posts")
            ->match("/admin/post/[i:id]", "admin/post/edit", "admin_post")
            ->post("/admin/post/[i:id]/delete", "admin/post/delete", "admin_post_delete")
            ->match("/admin/post/new", "admin/post/new", "admin_post_new")
            //Gestion des catégories
            ->get("/admin/categories", "admin/category/index", "admin_categories")
            ->match("/admin/category/[i:id]", "admin/category/edit", "admin_category")
            ->post("/admin/category/[i:id]/delete", "admin/category/delete", "admin_category_delete")
            ->match("/admin/category/new", "admin/category/new", "admin_category_new")
            //Playground pour différents tests
            ->get("/playground/menu", "_pmenu", "p_menu")
            ->run();
?>