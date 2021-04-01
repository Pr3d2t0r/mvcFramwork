<?php


class LoginController extends MainController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if ($this->loggedIn){
            gotoPage('home/');
            return;
        }
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        $nextPage = null;
        if (isset($parametros['get']['next']))
            $nextPage = $parametros['get']['next'];
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/login/login-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';

    }
    public function logout() {
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        if ($this->loggedIn)
        $this->logUserOut($parametros);
        if (isset($parametros['get']['next']))
            gotoPage($parametros['get']['next'].'?success=2');
        $this->gotoLogin('?success=2');
    }
}