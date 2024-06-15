<?php

$db = parse_ini_file('db.ini');

if(isset($db['server']) and $db['user'] and $db['name'])
    $GLOBALS['connect'] = $connect = new PDO('pgsql:host='.$db['server'].';dbname='.$db['name'], $db['user'], $db['pwd']);


/** récupération des noms de colonnes d'une table */
function getColumnsNames($TABLE_NAME){

    $sql = 'SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = \''.$TABLE_NAME.'\'';
    $stmt = $GLOBALS['connect']->prepare($sql);
    $stmt->execute();

    $callback=function($COLUMN_NAME) {
        return $COLUMN_NAME;
    };

    return $stmt->fetchAll(PDO::FETCH_FUNC, $callback);

}

?>