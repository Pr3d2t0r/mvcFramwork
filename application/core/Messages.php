<?php


/**
 * Class Messages
 * @author Rafael Velosa
 */
class Messages{

    /**
     * Guarda as msgs
     * @var array|string[][] $msgs
     */
    private static array $msgs = [
        'error' => [
            'fe' => "Campo vazio",
            'li' => "Login invalido",
            'ude' => "User não existe",
            'eu' => "Campo do username vazio",
            'iu' => "Username invalido, username apenas pode conter caracteres aplphanumericos maisculos ou minusculos, (_) ou (-) mas não pode ter dois de seguida (__) ou (_-) ou (--) e tem de estar entre 3 e 30 caracteres",
            'ue' => "Username ja esta sendo usado",
            'ep' => "Campo da password vazia",
            'ip' => "Password invalida, password tem de estar entre 3 e 30 caracteres",
            'erp' => "Password repetida vazio",
            'nep' => "Passwords diferentes",
            'pdm' => "Password incorreta",
            'af' => "Acesso Proibido"
        ],
        "success" => [
            '1' => "Logado com successo",
            '2' => "Logout com successo",
            '3' => "Registrado com successo"
        ]
    ];

    /**
     * Devolve uma msg se ouver
     * @param $get
     * @return mixed|string|null
     */
    public static function run($get){
        if(isset($get['error']))
            return [self::getMsg('error', $get['error']), 'error'];
        else if(isset($get['success']))
            return [self::getMsg('success', $get['success']), 'success'];
        return null;
    }

    /**
     * Devolve uma msg para uma respetiva ação
     * @param $name
     * @param $msg
     * @return mixed|string|null
     */
    private static function getMsg($name, $msg){
        if (isset(self::$msgs[$name][$msg]))
            return self::$msgs[$name][$msg];
        include_once APPLICATIONPATH.'/views/includes/404.php';
        return null;
    }
}