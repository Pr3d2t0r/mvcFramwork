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

    public function getEmail($userId){
        if (!isset($userId)){
            include_once APPLICATIONPATH.'/views/includes/404.php';
            return null;
        }
        return $this->db->getUserInfo($userId);
    }

    public function getAll(){
        $result = $this->db->select()->from($this->tableName)->runQuery();
        for ($i=0;$i<count($result);$i++){
            $result[$i]->permissions = unserialize($result[$i]->permissions);
        }
        return $result;
    }

    public function getByUsername(string $username): ?array{
        return $this->db->select()->from('user')->where('username=:username')->limit(1)->runQuery([':username'=>$username]);
    }

    public function insert($username, $password, $hasher=null){
        if ($hasher === null)
            $hasher = new PasswordHash();
        $this->db->insert('user')->values([':username', ':password', ':permissions'], ['username','password','permissions'])->runQuery([':username'=>$username, ':password'=>$hasher->encrypt($password),':permissions'=>serialize(['Any'])]);
    }
}