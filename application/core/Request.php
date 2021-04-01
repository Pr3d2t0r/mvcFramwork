<?php


/**
 * Class Request
 * @author Rafael Velosa
 */
class Request{
    public string $page;
    public string $action;
    public array|null $parameters;
    public string $method;

    /**
     * Request constructor.
     * Envia o url para a função sanitizeUrl e devide o url e coloca cada parte no seu respetivo attr
     * @param string $url
     * @param string $method
     */
    public function __construct(string $url, string $method){
        $this->method = $method;
        $this->sanitizeUrl($url);
    }

    /**
     * Recbe o url, devide e coloca cada parte no seu respetivo attr
     * @param string $url
     */
    private function sanitizeUrl(string $url){
        $path = explode("/", $url);
        $this->page = (chkArray($path, 0) == null) ? '/' : $path[0].'/';

        $this->action = (chkArray($path,1) == null) ? 'index' : $path[1];
        // remove a pos que fica no fim do array caso o user ponha uma '/' no fim do link
        $path = filter($path, function ($value) {
            return $value != "";
        });
        if (count($path)>2) $path = array_splice($path, 2);
        else $path = null;
        if (isset($_GET)) {
            $path = $path ?? [];
            foreach ($_GET as $key => $value)
                $path['get'][$key] = $value;
        }
        $this->parameters = $path;
    }

    public function __toString(){
        return "[$this->method] -> Page: $this->page, Action: $this->action";
    }
}