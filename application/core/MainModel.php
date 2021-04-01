<?php


/**
 * Class MainModel
 * @author Rafael Velosa
 */
class MainModel{
    protected Db $db;
    protected $tableName;
    protected $info;

    public function __construct($info){
        $this->db = new Db;
        $this->info = $info;
    }
}
