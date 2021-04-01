<?php


class StringIterator implements IIterator{

    private bool $reverse;
    private int $pos = 0;
    private string $str;

    /**
     * StringIterator constructor.
     * @param $str
     * @param bool $reverse
     */
    public function __construct($str, $reverse=false){
        $this->reverse = $reverse;
        $this->str = $str;
        if ($reverse)
            $this->pos = strlen($str)-1;
    }

    /**
     * @return mixed
     */
    public function next(){
        return $this->str[(!$this->reverse)?$this->pos++:$this->pos--];
    }

    /**
     * @return boolean
     */
    public function hasNext(){
        return (!$this->reverse)? $this->pos<strlen($this->str) : $this->pos >= 0;
    }

    /**
     * @return null
     */
    public function reset(){
        $this->pos = (!$this->reverse)? 0 : strlen($this->str)-1;
    }
}