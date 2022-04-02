<?php


/**
 * Class RegisterController
 * @author Rafael Velosa
 */
class RegisterController extends MainController{

    /**
     * Guarda o titulo da pagina
     * @var string $title
     */
    public string $title = "Register";

    /**
     * RegisterController constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Pagina index
     */
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
        include_once APPLICATIONPATH.'/views/register/register-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }
}