<?php


/**
 * Class Router
 * @author Rafael Velosa
 */
class Router{
    private array $routes = [];

    /**
     * Define o controlador para quando essa pagina for requesitada
     * @param string $url
     * @param MainController $controller
     * @return null
     */
    public function get(string $url, MainController $controller){
        $this->routes[$url]['get'] = $controller;
    }

    /**
     * Define o manipulador para quando houver um pedido post para essa pagina
     * @param $url string
     * @param PageHandler $handler
     * @return null
     */
    public function post(string $url, PageHandler $handler){
        $this->routes[$url]['post'] = $handler;
    }

    /**
     * Retorna o respetivo controlador pa pagina
     * @param Request $request
     * @return null
     */
    public function use(Request $request){
        if(isset($this->routes[$request->page][$request->method]))
            if (method_exists($this->routes[$request->page][$request->method], $request->action)) {
                $this->routes[$request->page][$request->method]->{$request->action}($request->parameters);
                return true;
            }
        return false;
    }
}