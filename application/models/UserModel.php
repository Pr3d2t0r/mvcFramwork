<?php


/**
 * Class UserModel
 * @author Rafael Velosa
 */
class UserModel extends MainModel{
    public function __construct($info = null){
        parent::__construct($info);
        $this->tableName = "user";
    }

    public function getUserInfo(){
        if (!isset($this->info->id)){
            include_once APPLICATIONPATH.'/views/includes/404.php';
            return null;
        }
        return $this->db->getUserInfo($this->info->id);
    }

    public function getAll(){
        $result = $this->db->select()->from($this->tableName)->runQuery();
        for ($i=0;$i<count($result);$i++){
            $result[$i]->permissions = unserialize($result[$i]->permissions);
        }
        return $result;
    }
}