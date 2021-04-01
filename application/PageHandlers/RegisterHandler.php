<?php


class RegisterHandler extends PageHandler{

    public PasswordHash $passwordHasher;

    public function __construct(){
        $this->db = new Db;
        $this->passwordHasher = new PasswordHash();
    }

    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        var_dump($parametros);
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            gotoPage($parametros['get']['path'] . '?error=eu');
            return;
        }
        $username = $_POST['username'];
        if (defined(USERNAMEREGEXVALIDATOR)) {
            if (!preg_match(USERNAMEREGEXVALIDATOR, $username)) {
                gotoPage($parametros['get']['path'] . '?error=iu');
                return;
            }
        }
        if ($this->db->usernameExists($username)){
            gotoPage($parametros['get']['path'] . '?error=ue');
            return;
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            gotoPage($parametros['get']['path'] . '?error=ep');
            return;
        }
        $password = $_POST['password'];
        if (strlen($password) < PASSWORDMINSIZE || strlen($password) > PASSWORDMAXSIZE){
            gotoPage($parametros['get']['path'] . '?error=ip');
            return;
        }

        if (!isset($_POST['rPassword']) || empty($_POST['rPassword'])) {
            gotoPage($parametros['get']['path'] . '?error=erp');
            return;
        }
        $rPassword = $_POST['rPassword'];
        if ($password != $rPassword) {
            gotoPage($parametros['get']['path'] . '?error=nep');
            return;
        }
        $this->db->insert('user')->values([':username', ':password', ':permissions'], ['username','password','permissions'])->runQuery([':username'=>$username, ':password'=>$this->passwordHasher->encrypt($password),':permissions'=>serialize(['Any'])]);
        if (isset($_POST['nextPage']) && $_POST['nextPage'] != "") {
            gotoPage($_POST['nextPage'].'?success=3');
            return;
        }
        gotoPage('login/?success=3');
    }
}