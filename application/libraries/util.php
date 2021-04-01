<?php
/**
 * Verifica se a chave existe no array e se existir retorna
 * @param array $array
 * @param string|int $key
 * @return mixed | null
 */
function chkArray($array,$key) {
    if (isset($array[$key]) && !empty($array[$key]))
        return $array[$key];
    return null;
}

/**
 * Percore um array e efetua uma operação
 * @param array $array
 * @param closure $callback
 * @return array
 */
function iterate(array $array, $callback){
    $iterator = new MainArrayIterator($array);
    $newArray = [];
    while ($iterator->hasNext())
        $newArray[] = $callback($iterator->next());
    return $newArray;
}

/**
 * Filtra um array e retorna apenas os que passarem o filtro
 * @param array $array
 * @param closure $callback
 * @return array
 */
function filter($array, $callback){
    $iterator = new MainArrayIterator($array);
    $newArray = [];
    while ($iterator->hasNext()) {
        $value = $iterator->next();
        if($callback($value)) $newArray[] = $value;
    }
    return $newArray;
}

function reverseString($str){
    $iterator = new StringIterator($str, reverse: true);
    $newStr = "";
    while ($iterator->hasNext())
        $newStr .= $iterator->next();
    return $newStr;
}

/**
 * Vai para uma pagina
 * @param $page
 * @return null
 */
function gotoPage($page){
    header('Location: ' . HOME_URI.$page);
}