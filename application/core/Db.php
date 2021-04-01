<?php


/**
 * Class Db
 * @author Rafael Velosa
 */
class Db extends QueryBuilder{
    /**
     * Guarda uma instancia do PDO para apenas obter uma instancio na aplicação toda (Singleton)
     * @var PDO
     */
    private static PDO $PDOInstance;
    /**
     * Guarda o objeto do PDO
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Retorna uma instancia do PDO (singleton)
     * @return PDO
     */
    public static function getPDOInstance(){
        if (!isset(self::$PDOInstance)){
            try {
                self::$PDOInstance = new PDO("mysql:host=".DB_HOSTNAME.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USERNAME, DB_PASSWORD);
            }catch (PDOException $e){
                echo $e->getMessage();
                include_once APPLICATIONPATH.'/views/includes/500.php';
            }
        }
        return self::$PDOInstance;
    }

    /**
     * Db constructor.
     * @author Rafael Velosa
     */
    public function __construct(){
        $this->pdo = self::getPDOInstance();
    }

    /**
     * retorna o resultado da query
     * @param array $infoArray
     * @param null $query
     * @return array|null
     */
    public function runQuery($infoArray=[], $query=null){
        if ($this->query == ""){
            $pdoQuery = $this->pdo->prepare($query);
            $pdoQuery->execute($infoArray);
        }else{
            $pdoQuery= $this->pdo->prepare($this->query);
            foreach($infoArray as $key => $value)
                $pdoQuery->bindValue($key, $value);
            $pdoQuery->execute();
        }
        if (str_contains($this->query, 'select') || str_contains(strtolower($query), 'select')){
            $result = $pdoQuery->fetchAll(PDO::FETCH_OBJ);
            $this->resetQuery();
            return $result;
        }
        return null;
    }

    /**
     * Verifica se o username existe
     * @param $username
     * @return bool
     */
    public function usernameExists($username): bool{
        $result = $this->select(['id'])->from('user')->where('username=:username')->runQuery([':username'=>$username]);
        if (isset($result[0]))
            return true;
        return false;
    }

    /**
     * Retorna a informação para um respetivo user
     * @param $id
     * @return mixed|null
     */
    public function getUserInfo($id){
        $result = $this->select()->from('user')->where('id=:id')->limit(1)->runQuery([':id'=>$id]);
        if (isset($result[0])) {
            $result[0]->permissions = unserialize($result[0]->permissions);
            return $result[0];
        }
        return null;
    }
}