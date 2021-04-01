<?php


/**
 * Interface IIterator
 * @author Rafael Velosa
 */
interface IIterator{
    public function next();
    public function hasNext();
    public function reset();
}