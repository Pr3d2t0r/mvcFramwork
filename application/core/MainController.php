<?php


/**
 * Class MainController
 * @author Rafael Velosa
 */
abstract class MainController extends LoginCore implements Controller{

    /**
     * Guarda o titulo da pagina
     * @var string $title
     */
    public string $title = "Default Title";

    /**
     * Guarda se é nessesario login por defeito não é nessesario
     * @var bool $login_required
     */
    public bool $login_required = false;

    /**
     * Guarda as permissoes nessesarias para entrar nesta pagina
     * @var string $permission_required
     */
    public string $permission_required = 'Any';

    /**
     * Guarda o nome da folha de estilo caso tenha
     * @var string $stylesheet
     */
    public string $stylesheet = '';

    /**
     * Guarda o nome do ficheiro script caso tenha
     * @var string $script
     */
    protected string $script = '';

    /**
     * Guarda uma msg para o user
     * @var array | null $msg
     */
    public array | null $msg = null;

    /**
     * MainController constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->msg = Messages::run($_GET);
    }

    /**
     * Carega um modelo se este existir
     * @param $modelName
     * @param string|null $alias
     * @return bool
     */
    public function loadModel($modelName, string $alias=null):bool{
        $modelName = ucfirst($modelName);
        $path = APPLICATIONPATH."/models/$modelName.php";
        if (file_exists($path)) {
            require_once $path;
            if (class_exists($modelName)) {
                $model = new $modelName($this->userInfo);
                $this->{$alias !== null ? $alias : $modelName} = &$model;
                return true;
            }
        }
        include_once APPLICATIONPATH.'/views/includes/404.php';
        return false;
    }

    /**
     * Pagina Index
     */
    abstract public function index();
}