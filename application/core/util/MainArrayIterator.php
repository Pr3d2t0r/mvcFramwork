<?php


/**
 * Class ArrayIterator
 * @author Rafael Velosa
 */
class MainArrayIterator implements IIterator{
    private int $pos = 0;
    private array $list;
    public function __construct(array $list){
        $this->list = $list;
    }
    public function hasNext(){
        return isset($this->list[$this->pos]);
    }
    public function next(){
        return $this->list[$this->pos++];
    }
    public function reset(){
        $this->pos = 0;
    }
}