<?php


class QueryBuilder implements QueryBuilderInterface{

    protected string $query;

    public function select(array $fields=['*']){
        $this->query = "select " . implode(", ", $fields);
        return $this;
    }

    public function from(string $table){
        $this->query .= " from $table";
        return $this;
    }

    public function where(string $exp){
        $this->query .= " where $exp";
        return $this;
    }

    public function orderBy(string $field, string $direction){
        $this->query .= " order by $field $direction";
        return $this;
    }

    public function limit($limit){
        $this->query .= " limit $limit";
        return $this;
    }

    public function insert(string $table){
        $this->query = "insert into $table";
        return $this;
    }

    public function values(array $values, array $colums=[]){
        if (!empty($colums))
            $this->query .= " (".implode(', ', $colums).")";
        $this->query .= " values (".implode(', ', $values).")";
        return $this;
    }


    public function update(string $table){
        $this->query = "update $table";
        return $this;
    }

    public function set(array $columValues){
        $this->query .= " set ".implode(', ', $columValues);
        return $this;
    }

    public function delete(string $table){
        $this->query = "delete from $table";
        return $this;
    }

    public function getQuery(){
        $query = $this->query.';';
        $this->query = "";
        return $query;
    }

    public function resetQuery(){
        $this->query = "";
        return $this;
    }
}