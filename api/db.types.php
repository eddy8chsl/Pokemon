<?php
/**
 * 
 * GESTION DES TYPES POKEMONS
 * - id : identifiant du type
 * - name : nom du type
 * 
 */

/** fonction de récupération des pokémons */
function getTypes($optionnals = []):int|array{

    /** colonnes de la tables types */
    $columnsNames = getColumnsNames('types');

    /** préparation de la requête */
    $sql='SELECT id, name FROM types';
    if(isset($optionnals)){ // construction de la clause WHERE
        $i = 0;
        foreach($optionnals as $column => $value){
            if(in_array($column, $columnsNames)){
                $sql.= ( $i == 0 ? ' WHERE ' : ' AND ' ) . $column . '=' . ( is_int($value) ? $value : '\''. $value .'\'' );
            }
            else {
                return 400;
            }
            ++$i;
        }
    }
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $stmt->execute();

    /** fonction de callback */
    $callback=function($id, $name) {
        return [
            'id' => $id,
            'name' => $name,
        ];
    };
    $result = $stmt->fetchAll(PDO::FETCH_FUNC, $callback);

    //var_dump($result);

    if(count($result) == 0)
        return 404;
    else
        return $result;

}

/** fonction de suppression d'un pokemon */
function postType($name):int|array{

    /** contrôle des données d'entrée */
    if(!isset($name)){
        return 400;
    }
    
    /** préparation de la requête */
    $sql = 'INSERT INTO types 
        (name)
        VALUES (\''. $name .'\')';

    $stmt = $GLOBALS['connect']->prepare($sql);
    $count = $stmt->execute();

    /** code retour */
    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction d'édition d'un pokemon */
function putType($id, $name):int{
    
    /** préparation de la requête */
    $sql = 'UPDATE types SET ';
    $sql.= 'name = \''. $name . '\'';
    $sql.= ' WHERE id = '.$id;
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $count = $stmt->execute();
    
    /** gestion erreur */
    if($stmt->rowCount() === 0)
       return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;

}

/** fonction de suppression d'un pokemon */
function deleteType($id):int{
    
    /** préparation de la requête */
    $sql = 'DELETE FROM types WHERE id = '.$id;
    $stmt = $GLOBALS['connect']->prepare($sql);

    /** exécution de la requête */
    $stmt->execute();

    /** gestion erreur */
    if($stmt->rowCount() === 0)
        return 404;

    if($stmt->errorCode() !== '')
        return 200;
    else
        return 400;
}

?>