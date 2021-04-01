<?php


class HomeHandler extends PageHandler{
    function index(){
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        echo $_POST['nome'];
        var_dump($_GET);
        // do something
        if (isset($_POST['nextPage']) && $_POST['nextPage'] != "") {
            gotoPage($_POST['nextPage']);
            return;
        }
        gotoPage($_GET['path'].'?sucess=1');
    }
}