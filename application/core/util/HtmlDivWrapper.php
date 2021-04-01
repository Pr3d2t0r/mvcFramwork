<?php


class HtmlDivWrapper{
    private array $dados;
    private array $classes;
    private string $id;

    public function __construct($dados, $classes=[], $id=""){
        $this->dados = $dados;
        $classes[] = "wrapper";
        $this->classes = $classes;
        $this->id = $id;
        return $this;
    }

    public function addClass($class){
        if (in_array($class, $this->classes)) return $this;
        $this->classes[] = $class;
        return $this;
    }

    public function removeClass($class){
        if (!in_array($class, $this->classes)) return $this;
        $this->classes = array_diff($this->classes, [$class]);
        return $this;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function unsetId($id){
        $this->id = "";
        return $this;
    }

    public function getHtml($action=null){
        $classes = implode(' ', $this->classes);
        $dados = $this->dados;
        if ($action != null){
            $dados=iterate($this->dados, $action);
            $dados = implode(' ', $dados);
        }

        return <<<HTML
                <div class="$classes" id="$this->id">
                    $dados
                <div/>                    
                HTML;
    }
}