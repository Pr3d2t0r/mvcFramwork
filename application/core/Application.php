<?php


class Application{
    public Router $router;
    private Database $db;
    private Request $request;
    public function __construct(){
        $this->router = new Router();
        $this->db = new Database();
        $this->getUrlInfo();
    }

    public function run(){
        $controller = $this->router->use($this->request);
        if($controller == false)
            include_once APPLICATIONPATH.'/views/includes/404.php';
    }

    private function getUrlInfo(){
        $request = strtolower($_SERVER['REQUEST_METHOD']);
        if (isset($_GET['path']))
            $this->request = new Request($_GET['path'], $request);
        else
            $this->request = new Request('/', $request);
    }
}
