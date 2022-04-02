<?php

/**
 * Class LoginCore
 * @author Rafael Velosa
 */
class LoginCore{

    /**
     * Guarda true se o user estiver logado e false se o user não estiver
     * @var bool
     */
    public bool $loggedIn;

    /**
     * Guarda a info do usuario
     * @var mixed
     */
    public mixed $userInfo;

    /**
     * Guarda uma instancia da base de dados
     * @var Db
     */
    protected Db $db;

    /**
     * LoginCore constructor.
     */
    public function __construct(){
        $this->db = new Db;
        $this->passwordHasher = new PasswordHash();
        $this->loggedIn = $this->isUserLogedIn() != false;
        $this->userInfo = $this->db->getUserInfo($this->isUserLogedIn());
    }

    /**
     * Retorna false caso o user não esteja logado, caso o user esteja logado retorna o id e verifica se o segundo token existe senão gera um novo token
     * @return bool|int
     */
    protected function isUserLogedIn(){
        if(!isset($_COOKIE['loginToken'])) return false;
        $qResult = $this->db->select(['userId'])->from('logintokens')->where('token=:token')->limit(1)->runQuery([':token'=>sha1($_COOKIE['loginToken'])]);
        if(!isset($qResult[0])) return false;
        $userId = $qResult[0]->userId;
        if (isset($_COOKIE['loginToken_']))
            return $userId;
        $strong = true;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $strong));
        $this->db->insert("logintokens")->values([":userId", ":token"], ['userId', 'token'])->runQuery([':userId'=>$userId, ':token'=>sha1($token)]);
        $this->db->delete("logintokens")->where("token=:token and userId=:userId")->runQuery([':token'=>sha1($_COOKIE['loginToken']),':userId'=>$userId]);
        // token valido por 7 dias
        //                        Hora atual + 60 segundos * 60 minutos * 24 horas * 7 dias
        setcookie("loginToken", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
        //serve para renovar o token sem que o user tenha que fazer login
        setcookie("loginToken_", '0', time() + 60 * 60 * 24 * 3, '/', null, null, true);
        return $userId;
    }

    /**
     * Serve para eliminar o/s token/s da base de dados para efetuar o logout
     * @param $parametros
     */
    protected function logUserOut($parametros){
        $userId = $this->isUserLogedIn();
        if ($userId === false) return;
        if (in_array('all',$parametros))
            $this->db->delete('logintokens')->where('userId=:userId')->runQuery([':userId'=>$userId]);
        else
            if (isset($_COOKIE['loginToken'])) {
                $token = $_COOKIE['loginToken'];
                $this->db->delete('logintokens')->where('userId=:userId and token=:token')->runQuery([':userId'=>$userId, ':token'=>sha1($token)]);
            }
        setcookie("loginToken", '0', time() - 3600);
        setcookie("loginToken_", '0', time() - 3600);

    }

    /**
     * Serve para rederecionar para a pagina de login
     * @param string $get
     */
    protected function gotoLogin($get=''){
        gotoPage('login/'.$get);
    }

    /**
     * Serve para fazer login ao user
     * @param $userId
     */
    public static function login($userId){
        // cria um token para guardar
        $strong = true;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $strong));
        $db = new Db();
        $db->insert("logintokens")->values([":userId", ":token"], ['userId', 'token'])->runQuery([':userId'=>$userId, ':token'=>sha1($token)]);
        // token valido por 7 dias
        //                        Hora atual + 60 segundos * 60 minutos * 24 horas * 7 dias
        setcookie("loginToken", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
        //serve para renovar o token sem que o user tenha que fazer login
        setcookie("loginToken_", '0', time() + 60 * 60 * 24 * 3, '/', null, null, true);
    }

    /**
     * Retorna o id do user que esta logado
     * @return false|int
     */
    public static function getUserId(){
        $db = new Db;
        if(!isset($_COOKIE['loginToken'])) return false;
        $qResult = $db->select(['userId'])->from('logintokens')->where('token=:token')->limit(1)->runQuery([':token'=>sha1($_COOKIE['loginToken'])]);
        if(!isset($qResult[0])) return false;
        return $qResult[0]->userId;
    }

    /**
     * Serve para verificar se um usuario tem permisoes
     * @param string $required
     * @param array $userPermissions
     * @return bool
     */
    final protected function hasPermissions(string $required = 'Any', array $userPermissions = []){
         return in_array($required, $userPermissions);
    }
}