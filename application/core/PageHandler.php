<?php


/**
 * Class PageHandler
 * Serve Para responder a pedidos POST feitos aos seus respetivos controladores
 */
abstract class PageHandler{
    /**
     * Guarda uma instancia do systema de base de dados
     * @var Db
     */
    public Db $db;

    /**
     * Responde ao pedido Post feito ao index do respetivo controlador
     * @return mixed
     */
    abstract public function index();
}