<?php


class HtmlList{
    private array $dados;
    private bool $ordered;
    private array $classes;
    private string $id;
    private string $tag;

    public function __construct($dados, $ordered=true, $classes=[], $id=""){
        $this->dados = $dados;
        $this->ordered = $ordered;
        $this->classes = $classes;
        $this->id = $id;
        $this->tag = $ordered ? "ol" : "ul";
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
        }
        return <<<HTML
                <$this->tag class="$classes" id="$this->id">
                    $dados
                <$this->tag/>                    
                HTML;
    }
}