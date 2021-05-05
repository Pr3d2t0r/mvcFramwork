<?php

include_once APPLICATIONPATH."/models/UserModel.php";

/**
 * Class UserObserver
 * @author Rafael velosa
 */
class UserObserver implements Observer{
    /**
     * serve para guardar o id do user
     * @var int $userId
     */
    protected int $userId;

    /**
     * serve para guardar o id do sujeito
     * @var int $subjectId
     */
    protected int $subjectId;

    /**
     * serve para guardar as respetivas ações
     * @var array|Closure[]
     */
    protected array $options;

    /**
     * Guarda uma instancia do modelo do user
     * @var UserModel $model
     */
    protected UserModel $model;

    /**
     * UserObserver constructor.
     * @param int $userId
     * @param int $subjectId
     */
    public function __construct(int $userId, int $subjectId){
        $this->userId = $userId;
        $this->subjectId = $subjectId;
        $this->model = new UserModel();
        $this->options = [
            "insert-event" => function(){
                $email = $this->model->getEmail($this->userId);
                // todo guardar na base de dados a versao seralizada da class email com a data de envio calculada
            }
        ];
    }

    /**
     * dispoe um evento
     * @param $status
     */
    public function send($status){
        $this->options[$status]();
    }
}