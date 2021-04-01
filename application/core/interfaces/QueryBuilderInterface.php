<?php


interface QueryBuilderInterface{
    public function select(array $fields);
    public function insert(string $table);
    public function update(string $table);
    public function delete(string $table);
    public function getQuery();
}