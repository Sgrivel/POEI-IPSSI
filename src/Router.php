<?php

namespace App;

use AltoRouter;
use App\Security\ForbiddenException;

class Router {
    
    /**
     * viewPath
     *
     * @var string
     */
    private $viewPath;
        
    /**
     * router
     *
     * @var AltoRouter
     */ 
    private $router;

    public function __construct(string $viewPath) 
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map("GET", $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map("POST", $url, $view, $name);
        return $this;
    }

    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map("POST|GET", $url, $view, $name);
        return $this;
    }

    public function url(string $name, array $params = []): string {
        return $this->router->generate($name, $params);
    }

    public function run(): self
    {   
        $router = $this;
        $match = $this->router->match();
        if ($match) {
            $view = $match["target"];
            $params = $match["params"];
            $isAdmin = strpos($view, "admin") !== false;
            $layout = $isAdmin ? "admin/layout/default" : "layout/default";
            //Pour le playground, à supprimer ensuite *****
            $isPlayground = strpos($view, "_p") !== false;
            $layout = $isPlayground ? "osef" : "layout/default";

            try {
                ob_start();
                require_once $this->viewPath . $view . ".php";

                $content = ob_get_clean();
                ob_end_clean();
                require_once $this->viewPath . $layout . ".php";
            } catch (ForbiddenException $e) {
                header("Location: " . $this->url("login") . "?forbidden=1");
                exit();
            }
        } else {
            require_once $this->viewPath . "e404" . ".php";
        }
        return $this;
    }
}

?>