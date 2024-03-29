<?php


class LoginHandler extends PageHandler{

    public PasswordHash $passwordHasher;
    /**
     * @return mixed
     */
    public function __construct(){
        $this->model = $this->loadModel('userModel');
        $this->passwordHasher = new PasswordHash();
    }

    public function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        if (!isset($_POST['username']) && !isset($_POST['password'])) {
            gotoPage($_GET['path'] . '?error=fe');
            return;
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $qResult = $this->model->getByUsername($username);
        if(!isset($qResult[0])) {
            gotoPage($_GET['path'] . '?error=ude');
            return;
        }
        if (!$this->passwordHasher->validPassword($password, $qResult[0]->password)) {
            gotoPage($_GET['path'] . '?error=pdm');
            return;
        }
        LoginCore::login($qResult[0]->id);
        if (isset($_POST['nextPage']) && $_POST['nextPage'] != "") {
            gotoPage($_POST['nextPage'].'?success=1');
            return;
        }
        gotoPage('?success=1');
    }
}