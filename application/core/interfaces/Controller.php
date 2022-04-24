<?php


/**
 * Interface Controller
 * @author Rafael Velosa
 */
interface Controller{

    /**
     * Carega um modelo
     * @param $modelName
     * @return bool
     */
    public function loadModel($modelName): bool;
}