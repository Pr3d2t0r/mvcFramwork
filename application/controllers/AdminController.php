<?php


class AdminController extends MainController{

    public function __construct(){
        parent::__construct();
        $this->permission_required = "Admin";
        $this->stylesheet = "admin.css";
    }

    public function index(){
        if (!$this->loggedIn){
            $this->gotoLogin();
            return;
        }
        if(!$this->hasPermissions($this->permission_required, $this->userInfo->permissions)){
            gotoPage("home?error=af");
            return;
        }
        $this->model = $this->loadModel("userModel");
        $usersList = (new HtmlDivWrapper($this->model->getAll()))->getHtml(function ($item){
            return "<div class='box'><ul><li>$item->username</li><li>Permissions => [".implode(', ', $item->permissions)."]</li></ul></div>";
        });
        include_once APPLICATIONPATH.'/views/includes/header.php';
        include_once APPLICATIONPATH.'/views/includes/menu.php';
        include_once APPLICATIONPATH.'/views/admin/admin-view.php';
        include_once APPLICATIONPATH.'/views/includes/footer.php';
    }
}