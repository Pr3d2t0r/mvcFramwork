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
        return $this->db->select()->from($this->tableName)->where('username=:username')->limit(1)->runQuery([':username'=>$username]);
    }

    public function usernameExists($username): bool{
        $result = $this->db->select(['id'])->from($this->tableName)->where('username=:username')->runQuery([':username'=>$username]);
        if (isset($result[0]))
            return true;
        return false;
    }

    public function insert($username, $password, $hasher=null){
        if ($hasher === null)
            $hasher = new PasswordHash();
        $this->db->insert($this->tableName)->values([':username', ':password', ':permissions'], ['username','password', 'email', 'permissions'])->runQuery([':username'=>$username, ':password'=>$hasher->encrypt($password), ':permissions'=>serialize(['Any'])]);
    }
}